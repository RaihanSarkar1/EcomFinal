<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    //

    protected $fillable = ['user_id','address','status'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function products(){
        return $this->belongsToMany(Product::class, 'order_product')->withPivot('quantity');
    }
}
