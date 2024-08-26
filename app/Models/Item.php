<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class Item extends Model
{
    use HasFactory;

    protected $table = 'items'; 
    protected $primaryKey = 'id';

    protected $fillable = ['selling_price','barcode', 'name', 'price','quantity'];
    public $timestamps = false;

    // public function itemsAdded()
    // {
    //     return $this->hasMany(ItemAdded::class, 'item_id', 'id');
    // }

    // public function itemsSold()
    // {
    //     return $this->hasMany(ItemSold::class, 'item_id', 'id');
    // }

    public function itemAdded()
    {
        return $this->hasMany(ItemAdded::class);
    }

    public function itemSold()
    {
        return $this->hasMany(ItemSold::class);
    }
    public function getQuantityAttribute()
    {
        $added = $this->itemAdded()->sum('quantity');
        $sold = $this->itemSold()->sum('quantity');

        return $added - $sold;
    }
}
