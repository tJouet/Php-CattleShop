<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Types\AnimalType;
use App\Types\AnimalStatus;
use App\Types\OwnerNames;

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
        'owner' => OwnerNames::class
    ];
}
