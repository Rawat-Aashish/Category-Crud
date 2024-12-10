<?php

namespace App\Exports;

use App\Models\SubCategory;
use Maatwebsite\Excel\Concerns\FromCollection;

class SubCategoryExport implements FromCollection
{
    /**
     * @return \Illuminate\Support\Collection
     */
    public function collection()
    {
        $subcat = SubCategory::all()->makeHidden(['created_id', 'updated_at']);
        return $subcat;
    }
}
