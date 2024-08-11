<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ItemSold extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'item_sold'; 

    protected $fillable = ['item_barcode', 'quantity', 'date'];
    public $timestamps = false;

    public function item()
    {
        return $this->belongsTo(Item::class, 'item_barcode', 'barcode');
    }
}
