<?php

namespace Proengeno\Invoice\Positions;

use Proengeno\Invoice\Formatter\FormatableTrait;

class Position implements PositionInterface
{
    use FormatableTrait;

    private $name;
    private $scale;
    private $quantity;
    private $formatter;
    private $price;

    public function __construct(string $name, float $price, float $quantity)
    {
        $this->name = $name;
        $this->quantity = $quantity;
        $this->price = $price;
        $this->scale = strlen(substr(strrchr($price, "."), 1)) + strlen(substr(strrchr($quantity, "."), 1));
    }

    public function name(): string
    {
        return $this->name;
    }

    public function price(): float
    {
        return $this->price;
    }

    public function quantity(): float
    {
        return $this->quantity;
    }

    public function amount(): int
    {
        return (int)round(bcmul(
            bcmul($this->price, $this->quantity, $this->scale), 100, $this->scale
        ), 0);
    }

    public function jsonSerialize()
    {
        return [
            'name' => $this->name(),
            'quantity' => $this->quantity(),
            'quantity_price' => $this->price(),
            'amount' => $this->amount()
        ];
    }
}
