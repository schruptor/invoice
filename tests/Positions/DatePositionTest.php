<?php

namespace Proengeno\Invoice\Test;

use DateTime;
use Proengeno\Invoice\Test\TestCase;
use Proengeno\Invoice\Positions\Position;
use Proengeno\Invoice\Formatter\Formatter;
use Proengeno\Invoice\Positions\DatePosition;

class DatePositionTest extends TestCase
{
    /** @test **/
    public function it_provides_the_given_date()
    {
        $position = new DatePosition($date = new DateTime, new Position('test', 1, 1));

        $this->assertEquals($date, $position->date());
    }

    /** @test **/
    public function it_provides_the_position_name()
    {
        $position = new DatePosition($date = new DateTime, new Position('test', 1, 1));

        $this->assertEquals('test', $position->name());
    }

    /** @test **/
    public function it_provides_the_given_quantity_price()
    {
        $position = new DatePosition($date = new DateTime, new Position('test', 1.22, 1));

        $this->assertEquals(1.22, $position->price());
    }

    /** @test **/
    public function it_provides_the_given_quantity()
    {
        $position = new DatePosition($date = new DateTime, new Position('test', 1, 1.55));

        $this->assertEquals(1.55, $position->quantity());
    }

    /** @test **/
    /** @test **/
    public function it_computes_the_prucuct_of_the_quantity_an_the_price()
    {
        $position = new DatePosition($date = new DateTime, new Position('test', 12, 100));

        $this->assertEquals(12 * 100 * 100, $position->amount());
    }

    /** @test **/
    public function it_roundes_the_amount_price_on_two_decimals()
    {
        $position = new DatePosition($date = new DateTime, new Position('Test1', 2.555, 1));
        $this->assertEquals(256, $position->amount());
    }

    /** @test **/
    public function it_provides_formatted_values()
    {
        $position = new DatePosition($date = new DateTime, new Position('test', 1, 1));
        $position->setFormatter(new Formatter('de_DE'));

        $this->assertEquals($date->format('d.m.Y'), $position->format('date'));
    }
}
