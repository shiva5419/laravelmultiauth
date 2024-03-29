<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Expensive extends Model
{
    use HasFactory;
    protected $table = 'expensive';

    protected $fillable = [
        'user',
        'category',
        'amount'
    ];
}
