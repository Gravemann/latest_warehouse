<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Brand extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'name',
        'image_path',
        'image_url'
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function products(): HasMany
    {
        return $this->hasMany(Product::class);
    }

    public function scopeAuthorized(Builder $query): void
    {
        $query->where('user_id', '=' , auth()->id());
    }

    /**
     * @param void|string $value
     */

    public function scopeFiltered(Builder $builder, $value): void
    {
        $builder->when($value, function ($query) use ($value) {
            $query->whereAny(
                [
                    'name',
                    'created_at',
                    'updated_at'
                ],
                'LIKE',
                '%'. $value . '%'
            );
        });
    }

    public function scopeSorted(Builder $builder, $column, $order): void
    {
        $builder->when($column, function ($query) use ($column, $order) {
            $query->orderBy($column, $order);
        })
        ->when(is_null($column), function ($query) {
            $query->latest();
        });
    }
}
