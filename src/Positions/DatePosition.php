<?php

namespace Proengeno\Invoice\Positions;

use DateTime;
use Proengeno\Invoice\Formatter\FormatableTrait;

class DatePosition implements PositionInterface
{
    use FormatableTrait;

    private $date;
    private $corePosition;

    public function __construct(DateTime $date, Position $corePosition)
    {
        $this->date = $date;
        $this->corePosition = $corePosition;
    }

    public function date(): DateTime
    {
        return $this->date;
    }

    public function name(): string
    {
        return $this->corePosition->name();
    }

    public function price(): float
    {
        return $this->corePosition->price();
    }

    public function quantity(): float
    {
        return $this->corePosition->quantity();
    }

    public function amount(): int
    {
        return $this->corePosition->amount();
    }

    public function jsonSerialize()
    {
        return array_merge($this->corePosition->jsonSerialize(), [
            'date' => $this->date()->format('Y-m-d'),
        ]);
    }
}
