<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class Product extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'sku',
        'category',
        'price',
        'stock',
        'img',
        'description',
    ];

    /**
     * Get the full URL for the product's image.
     *
     * This is an attribute accessor, which allows you to access it like a
     * regular model property: $product->image_url
     *
     * @return string
     */
    public function getImageUrlAttribute(): string
    {
        // Check if the img path exists and is not null in the database
        if ($this->img && Storage::disk('public')->exists($this->img)) {
            // Return the full URL to the image in the public storage
            return Storage::url($this->img);
        }

        // Return a default placeholder image if no image is set or found
        return 'https://placehold.co/100x100/f0f0f0/999999?text=No+Image';
    }
}
