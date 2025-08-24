<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'status', // <-- આ લાઈન ઉમેરો
    ];

    /**
     * Define the relationship to the Product model.
     */
    public function products()
    {
        return $this->hasMany(Product::class, 'category', 'name');
    }
}
