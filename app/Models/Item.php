<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


class Item extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'items'; 
    protected $primaryKey = 'id';
    public $incrementing = false;
    protected $keyType = 'string';

    protected $fillable = ['barcode', 'name', 'initial_stock'];
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
