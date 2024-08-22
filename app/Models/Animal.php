<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Types\AnimalType;
use App\Types\AnimalStatus;


class Animal extends Model
{
    protected $table = 'animals';
    use HasFactory;
    protected $fillable = [
        'name',
        'age',
        'type',
        'race',
        'price',
        'description',
        'status',
        'owner_id',
    ];

    protected $casts = [
        'age' => 'integer',
        'type' => AnimalType::class,
        'price' => 'float',
        'status' =>  AnimalStatus::class,
    ];

    public function owner()
    {
        return $this->belongsTo(User::class, 'owner_id');
    }

    public function images()
    {
        return $this->hasMany(Image::class);
    }
}
