<?php

namespace Proengeno\Invoice\Test\Fakes;

use Proengeno\Invoice\Formatter\TypeFormatter as FormatterInterface;

class TypeFormatter implements FormatterInterface
{
    public function __construct(string $locale)
    {
        //
    }

    public function setPattern(string $pattern): void
    {

    }

    public function format($value): string
    {
        return '';
    }
}
