<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class SubCategory extends Model
{
    use HasFactory;

    protected $table = 'sub_categories';

    protected $fillable = [
        'parent_category_id',
        'name'
    ];

    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class, 'parent_category_id');
    }
}