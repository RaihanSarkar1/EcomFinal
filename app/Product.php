<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    //
    protected $fillable = ['code'];

    public function categories() {
        return $this->belongsToMany(Category::class, 'product_category');
    }
}
