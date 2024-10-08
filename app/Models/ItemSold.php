<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ItemSold extends Model
{
    use HasFactory;

    protected $table = 'item_sold'; 

    protected $fillable = ['item_id', 'quantity', 'date'];
    public $timestamps = false;

    public function item()
    {
        return $this->belongsTo(Item::class, 'item_id', 'id');
    }
}
