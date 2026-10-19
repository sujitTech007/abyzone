<?php

namespace App\Services;

class ServiceRequirementCommissionCalculator
{
    public function calculate(int $amountCents, float $commissionPercent): array
    {
        if ($amountCents < 0 || $commissionPercent < 5 || $commissionPercent > 10) {
            throw new \InvalidArgumentException('Channel Partner commission must be between 5 and 10 percent.');
        }

        $commissionCents = (int) round($amountCents * $commissionPercent / 100, 0, PHP_ROUND_HALF_UP);

        return [
            'commission_cents' => $commissionCents,
            'partner_net_cents' => $amountCents - $commissionCents,
        ];
    }
}
