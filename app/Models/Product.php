<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'brand_id',
        'name',
        'purchase_price',
        'sale_price',
        'quantity',
        'image_path',
        'image_url',
    ];


    public function brand(): BelongsTo
    {
        return $this->belongsTo(Brand::class);
    }

    public function orders(): HasMany
    {
        return $this->hasMany(Order::class);
    }

    public function scopeAuthorized(Builder $query): void
    {
        $query->where('user_id', '=' , auth()->id());
    }

    public function scopeAuthorizedJoin(Builder $query): void
    {
        $query->where('products.user_id', '=', auth()->id());
    }

    /**
     * @param void|string $value
     */

    public function scopeFiltered(Builder $builder, $value): void
    {
        $builder->join('brands', 'products.brand_id', '=', 'brands.id')
            ->select('brands.name', 'products.*')
            ->when($value, function ($query) use ($value) {
                $query->whereAny(
                    [
                        'brands.name',
                        'products.name',
                        'products.purchase_price',
                        'products.sale_price',
                        'products.quantity'
                    ],
                    'LIKE',
                    '%' . $value . '%'
                );
            });
    }

    public function scopeSorted(Builder $builder, $column, $order): void
    {
        $builder->when($column, function ($query) use ($column, $order) {
            $query->orderBy($column, $order)->latest('products.id');
        })
        ->when(is_null($column), function ($query) {
            $query->latest('products.id');
        });
    }
}
