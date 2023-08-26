<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Matakuliah extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function kodeMatakuliah(): Attribute
    {
        return Attribute::make(
            get: fn(string $value) => strtoupper($value)
        );
    }
}