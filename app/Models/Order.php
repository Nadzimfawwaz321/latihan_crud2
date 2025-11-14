<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Order extends Model
{
    protected $fillable = ['nama', 'email', 'no_hp', 'alamat', 'total'];

    public function items(): HasMany
    {
        return $this->hasMany(OrderItem::class);
    }
}
