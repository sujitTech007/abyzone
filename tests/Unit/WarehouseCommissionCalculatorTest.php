<?php

namespace Tests\Unit;

use App\Services\WarehouseCommissionCalculator;
use InvalidArgumentException;
use PHPUnit\Framework\TestCase;

class WarehouseCommissionCalculatorTest extends TestCase
{
    public function test_default_thirty_percent_split_uses_pre_tax_amount(): void
    {
        $share = (new WarehouseCommissionCalculator())->calculate(10001, 30);

        $this->assertSame([
            'commission_cents' => 3000,
            'owner_net_cents' => 7001,
        ], $share);
    }

    public function test_admin_override_is_applied_to_pre_tax_amount(): void
    {
        $share = (new WarehouseCommissionCalculator())->calculate(25000, 40);

        $this->assertSame([
            'commission_cents' => 10000,
            'owner_net_cents' => 15000,
        ], $share);
    }

    public function test_rates_outside_the_revenue_share_range_are_rejected(): void
    {
        $this->expectException(InvalidArgumentException::class);

        (new WarehouseCommissionCalculator())->calculate(10000, 100.01);
    }
}
