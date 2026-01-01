<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Agenda extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'title',
        'description',
        'date',
        'time',
        'location',
        'category',
        'status',
    ];

    // Relasi: Setiap Agenda dimiliki oleh 1 User
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}