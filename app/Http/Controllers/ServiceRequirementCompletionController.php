<?php

namespace App\Http\Controllers;

use App\Helpers\NotificationHelper;
use App\Models\ServiceRequirement;
use App\Models\ServiceRequirementOffer;
use App\Models\ServiceRequirementPayment;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ServiceRequirementCompletionController extends Controller
{
    public function partnerComplete(Request $request, ServiceRequirement $serviceRequirement): RedirectResponse
    {
        DB::transaction(function () use ($request, $serviceRequirement) {
            $requirement = ServiceRequirement::query()
                ->whereKey($serviceRequirement->id)
                ->lockForUpdate()
                ->firstOrFail();
            abort_unless(in_array($requirement->status, ['awarded', 'completed'], true), 409);
            $acceptedOffer = $requirement->offers()
                ->where('channel_partner_id', $request->user()->id)
                ->where('status', 'accepted')
                ->firstOrFail();

            if (! $requirement->partner_completed_at) {
                $requirement->partner_completed_at = now();
                $requirement->save();
                NotificationHelper::sendToUser(
                    $requirement->requester_id,
                    'service_completion',
                    'Channel Partner marked service complete',
                    "The Channel Partner marked \"{$requirement->title}\" as complete. Confirm completion to enable payment."
                );
            }

            $this->finalizeIfBothConfirmed($requirement, $acceptedOffer);
        });

        return redirect()
            ->route('channel-partner.opportunities.show', $serviceRequirement)
            ->with('success', 'Your completion confirmation has been recorded.');
    }

    public function requesterComplete(Request $request, ServiceRequirement $serviceRequirement): RedirectResponse
    {
        DB::transaction(function () use ($request, $serviceRequirement) {
            $requirement = ServiceRequirement::query()
                ->whereKey($serviceRequirement->id)
                ->lockForUpdate()
                ->firstOrFail();
            abort_unless(
                $requirement->requester_id === $request->user()->id
                    && $requirement->requester_role === $request->user()->role
                    && in_array($requirement->status, ['awarded', 'completed'], true),
                404
            );
            $acceptedOffer = $requirement->offers()->where('status', 'accepted')->firstOrFail();

            if (! $requirement->requester_completed_at) {
                $requirement->requester_completed_at = now();
                $requirement->save();
                NotificationHelper::sendToUser(
                    $acceptedOffer->channel_partner_id,
                    'service_completion',
                    'Requester confirmed service completion',
                    "The requester confirmed \"{$requirement->title}\" as complete."
                );
            }

            $this->finalizeIfBothConfirmed($requirement, $acceptedOffer);
        });

        return redirect()
            ->route($this->routeName($request, 'service-requirements.show'), $serviceRequirement)
            ->with('success', 'Your completion confirmation has been recorded.');
    }

    private function finalizeIfBothConfirmed(
        ServiceRequirement $requirement,
        ServiceRequirementOffer $acceptedOffer
    ): void {
        $requirement->refresh();
        if (! $requirement->partner_completed_at || ! $requirement->requester_completed_at) {
            return;
        }

        $requirement->update([
            'status' => 'completed',
            'service_completed_at' => $requirement->service_completed_at ?? now(),
        ]);

        ServiceRequirementPayment::firstOrCreate(
            ['service_requirement_id' => $requirement->id],
            [
                'service_requirement_offer_id' => $acceptedOffer->id,
                'requester_id' => $requirement->requester_id,
                'channel_partner_id' => $acceptedOffer->channel_partner_id,
                'status' => 'payment_due',
                'currency' => 'CAD',
                'amount_cents' => (int) round((float) $acceptedOffer->amount * 100),
            ]
        );
    }

    private function routeName(Request $request, string $route): string
    {
        return ($request->user()->role === 'vendor' ? 'owner' : 'user').'.'.$route;
    }
}
