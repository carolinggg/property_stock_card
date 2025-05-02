<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Stock extends Model
{
    use HasFactory;

    // Specify which attributes are mass assignable
    protected $fillable = [
        'item_id',
        'quantity',
        'unit_cost',
        'reference',
        'receipt_qty',
        'no_of_days_consume',
        'unit',
        'supply_from',
    ];

    // Define the relationship with the Item model
    public function item()
    {
        return $this->belongsTo(Item::class);
    }
}
