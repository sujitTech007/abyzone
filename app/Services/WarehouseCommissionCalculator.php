<?php

namespace App\Services;

class WarehouseCommissionCalculator
{
    public function calculate(int $subtotalCents, float $commissionPercent): array
    {
        if ($subtotalCents < 0 || $commissionPercent < 0 || $commissionPercent > 100) {
            throw new \InvalidArgumentException('Warehouse commission inputs are outside the supported range.');
        }

        $commissionCents = (int) round($subtotalCents * $commissionPercent / 100, 0, PHP_ROUND_HALF_UP);

        return [
            'commission_cents' => $commissionCents,
            'owner_net_cents' => $subtotalCents - $commissionCents,
        ];
    }
}
