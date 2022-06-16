<?php

namespace App\Models;

use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

/**
 * @property mixed $data
 */
class Product extends Model
{
    use HasFactory, Sluggable;

    protected $fillable = [
        'name',
        'price',
        'data',
    ];

    protected $casts = [
        'data' => 'array',
    ];

    /**
     * Return the sluggable configuration array for this model.
     *
     * @return array
     */
    public function sluggable(): array
    {
        return [
            'slug' => [
                'source' => 'name',
            ]
        ];
    }

    /**
     * Creates the relationship between a product and the orders where it was added.
     * A product can be added to many orders.
     *
     * @return BelongsToMany
     */
    public function orders(): BelongsToMany
    {
        return $this->belongsToMany(Order::class);
    }

    // Getters

    /**
     * Sets the slug to be the main object id
     *
     * @return string
     */
    public function getRouteKeyName(): string
    {
        return 'slug';
    }

    /**
     * Returns the requested key in the data field for the product
     *
     * @param string $key
     * @param $default
     *
     * @return string|array|mixed
     */
    public function getData(string $key, $default = null): mixed
    {
        return data_get($this->data, $key, $default);

    }
}
