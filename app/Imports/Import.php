<?php

namespace App\Imports;

use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;

class Import implements ToCollection
{
    /**
     * @param Collection $collection
     */
    public $data;
    public function collection(Collection $collection)
    {

        $this->data = $collection;
    }

}
