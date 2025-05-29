<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Stock extends Model
{
    use HasFactory;

    protected $fillable = [
        'item_id',
        'quantity',
        'unit_cost',
        'reference',
        'ris_number',
        'receipt_qty',
        'no_of_days_consume',
        'unit',
        'supply_from',
    ];

    public function item()
    {
        return $this->belongsTo(Item::class);
    }
}
