<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Item extends Model
{
    use HasFactory;

    protected $fillable = [
        'item_name',
        'item_description',
        'supply_type',
        'unit_of_measure',
        'stock_number'
    ];

    public function issuances()
{
    return $this->hasMany(\App\Models\Issuance::class, 'item_id');
}
public function stocks()
{
    return $this->hasMany(\App\Models\Stock::class, 'item_id');
}

}
