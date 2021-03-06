<?php

namespace Proengeno\Invoice\Test\Positions;

use Proengeno\Invoice\Test\TestCase;
use Proengeno\Invoice\Positions\Position;
use Proengeno\Invoice\Positions\PositionGroup;
use Proengeno\Invoice\Positions\PositionInterface;

class PositionGroupTest extends TestCase
{
    /** @test **/
    public function it_tell_wether_it_has_vat_or_not()
    {
        $test = new PositionGroup(PositionGroup::NET, 19.0, [new Position('test', 1.55555, 100)]);

        $this->assertTrue($test->hasVat());
    }

    /** @test **/
    public function it_provides_the_group_type()
    {
        $net = new PositionGroup(PositionGroup::NET, 19.0, [new Position('test', 1.55555, 100)]);
        $gross = new PositionGroup(PositionGroup::GROSS, 19.0, [new Position('test', 1.55555, 100)]);

        $this->assertTrue($net->isNet());
        $this->assertFalse($net->isGross());

        $this->assertTrue($gross->isGross());
        $this->assertFalse($gross->isNet());
    }

    /** @test **/
    public function it_provides_the_positions_of_the_group()
    {
        $group = new PositionGroup(PositionGroup::NET, 19.0, [
            new Position('test', 1.55555, 100), new Position('test', 2, 100)
        ]);

        $this->assertCount(2, $group->positions());
    }

    /** @test **/
    public function it_computes_the_total_amounts_of_the_group()
    {
        $net = new PositionGroup(PositionGroup::NET, 19.0, [
            new Position('test', 1.55555, 100), new Position('test', 2, 100)
        ]);

        $gross = new PositionGroup(PositionGroup::GROSS, 19.0, [
            new Position('test', 1.55555, 100), new Position('test', 2, 100)
        ]);

        $this->assertEquals($net->grossAmount(), $net->netAmount() + $net->vatAmount());
        $this->assertEquals($gross->grossAmount(), $gross->netAmount() + $gross->vatAmount());
    }

    /** @test **/
    public function it_can_iterate_over_the_positions()
    {
        $group = new PositionGroup(PositionGroup::NET, 19.0, [
            new Position('test', 1.55555, 100), new Position('test', 2, 100)
        ]);

        foreach ($group as $position) {
            $this->assertInstanceOf(PositionInterface::class, $position);
        }
    }

    /** @test **/
    public function it_array_like_acces_positions()
    {
        $group = new PositionGroup(PositionGroup::NET, 19.0, [
            new Position('test', 1.55555, 100), new Position('test', 2, 100)
        ]);

        $this->assertInstanceOf(PositionInterface::class, $group[0]);
    }
}
