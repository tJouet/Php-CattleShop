<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Types\AnimalType;
use App\Types\AnimalStatus;

class Animal extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        'age',
        'type',
        'race',
        'price',
        'description',
        'status',
    ];

    protected $casts = [
        'age' => 'integer',
        'type' => AnimalType::class,
        'price' => 'float',
        'status' =>  AnimalStatus::class,
    ];
}