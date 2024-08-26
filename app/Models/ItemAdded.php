<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ItemAdded extends Model
{
    use HasFactory;

    protected $table = 'item_added';

    protected $fillable = ['item_id', 'quantity', 'date'];
    public $timestamps = false;

    public function item()
    {
        return $this->belongsTo(Item::class, 'item_id', 'id');
    }
}
