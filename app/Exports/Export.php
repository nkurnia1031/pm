<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromArray;

class Export implements FromArray
{
    public $data;
    function array(): array
    {
        return $this->data;
    }
}
