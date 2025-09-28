<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'user_id',
        'name',
        'email',
        'address',
        'city',
        'state',
        'zip',
        'subtotal',       // <-- Sudharo
        'discount',       // <-- Sudharo
        'delivery_fee',   // <-- Sudharo
        'total',
        'payment_method',
        'payment_status',
        'status',
    ];

    /**
     * Get the items for the order.
     */
    public function items()
    {
        return $this->hasMany(OrderItem::class);
    }

    /**
     * Get the user that owns the order.
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}

