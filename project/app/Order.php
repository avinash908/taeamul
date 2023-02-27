<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
class Order extends Model
{
    use SoftDeletes;
    
    protected $fillable = ['total_qty', 'user_id', 'total_amount', 'order_number', 'payment_status', 'payment_method', 'customer_email', 'customer_name', 'customer_phone', 'customer_address', 'customer_city', 'customer_state','customer_zip','ship_to','shipping_name', 'shipping_email', 'shipping_phone', 'shipping_address', 'shipping_city', 'shipping_state', 'shipping_zip', 'order_note', 'status'];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function items()
    {
        return $this->hasMany(OrderItem::class);
    }

    public function vendororders()
    {
        return $this->hasMany('App\VendorOrder');
    }
}