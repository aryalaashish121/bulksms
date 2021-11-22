<?php

namespace App\Imports;

use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class ContactImport implements ToCollection, WithHeadings
{
    /**
    * @param Collection $collection
    */
    public function collection(Collection $collection)
    {
    
    }
}
