<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
class VendorOrder extends Model
{
    use SoftDeletes;
    
    protected $fillable = [
        'shop_id','order_id', 'product_id', 'quantity', 'price', 'order_number','color','size','total_price', 'status',
    ];

    public function shop()
    {
        return $this->belongsTo('App\Shop');
    }
    public function order()
    {
        return $this->belongsTo('App\Order');
    }
    public function product()
    {
        return $this->belongsTo('App\Product');
    }
}
