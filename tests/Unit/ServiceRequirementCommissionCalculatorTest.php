<?php

namespace Tests\Unit;

use App\Services\ServiceRequirementCommissionCalculator;
use InvalidArgumentException;
use PHPUnit\Framework\TestCase;

class ServiceRequirementCommissionCalculatorTest extends TestCase
{
    public function test_five_percent_channel_partner_commission(): void
    {
        $share = (new ServiceRequirementCommissionCalculator())->calculate(10000, 5);

        $this->assertSame([
            'commission_cents' => 500,
            'partner_net_cents' => 9500,
        ], $share);
    }

    public function test_ten_percent_channel_partner_commission(): void
    {
        $share = (new ServiceRequirementCommissionCalculator())->calculate(10000, 10);

        $this->assertSame([
            'commission_cents' => 1000,
            'partner_net_cents' => 9000,
        ], $share);
    }

    public function test_channel_partner_commission_outside_five_to_ten_percent_is_rejected(): void
    {
        $this->expectException(InvalidArgumentException::class);

        (new ServiceRequirementCommissionCalculator())->calculate(10000, 10.01);
    }
}
