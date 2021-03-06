<?php

namespace Proengeno\Invoice\Formatter;

use Proengeno\Invoice\Formatter\Formatter;

interface Formatable
{
    public function setFormatter(Formatter $formatter): void;

    public function format(string $method): string;
}
