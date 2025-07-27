<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Customer; // Make sure this is at the top
use App\Models\Product;

class Order extends Model
{
    protected $fillable = ['product_id', 'quantity', 'order_date'];
    
    public function product()
    {
        return $this->belongsTo(Product::class);
    }

    public function customer()
    {
        return $this->belongsTo(Customer::class);
    }

    protected $casts = [
        'order_date' => 'date',
    ];
}
