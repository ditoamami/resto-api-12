<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Table extends Model
{
    protected $fillable = [
        'table_number',
        'table_status',
    ];

    public function orders()
    {
        return $this->hasMany(Order::class);
    }
}
