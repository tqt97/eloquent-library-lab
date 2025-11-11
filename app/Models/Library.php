<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasManyThrough;

class Library extends Model
{
    /** @use HasFactory<\Database\Factories\LibraryFactory> */
    use HasFactory;

    protected $fillable = [
        'name',
        'slug',
        'address',
        'latitude',
        'longitude',
    ];

    public function books(): HasMany
    {
        return $this->hasMany(Book::class);
    }

    public function users(): HasMany
    {
        return $this->hasMany(User::class);
    }

    public function borrowings(): HasManyThrough
    {
        return $this->hasManyThrough(Borrowing::class, Book::class);
    }
}
