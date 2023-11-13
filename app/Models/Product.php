<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;
    protected $table = "products";
    protected $guarded = ['id'];
    protected $casts = [
        'image' => 'array',
    ];
    public function category()
    {
        return $this->belongsTo(Category::class,'category_id');
    }

    public function subcategory()
    {
        return $this->belongsTo(SubCategory::class,'sub_categories_id');
    }
    public function brand()
    {
        return $this->belongsTo(Brand::class,'brands_id');
    }
}
