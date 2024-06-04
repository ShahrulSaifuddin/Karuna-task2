<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $fillable = ['product_name', 'product_price', 'product_desc', 'publish'];

    // Method to get all products sorted by name
    public static function getAllProductsSortedByName()
    {
        return self::orderBy('product_name')->get();
    }

    public static function getProduct($id)
    {
        return self::where('id', $id)->get();
    }
}
