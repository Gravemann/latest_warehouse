<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Facades\DB;

class Client extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'name',
        'surname',
        'contact_number',
        'company',
        'image_path',
        'image_url',
    ];

    protected function userClient() :Attribute
    {
        return Attribute::make(
            get: fn () => $this->user_id->name,
        );
    }

    protected function fullName() :Attribute
    {
        return Attribute::make(
            get: fn () => $this->name . ' ' . $this->surname,
        );
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function orders(): HasMany
    {
        return $this->hasMany(Order::class);
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
                    'surname',
                    DB::raw("CONCAT(name,' ',surname)"),
                    'contact_number',
                    'company'
                ],
                'LIKE',
                '%' . $value . '%'
            );
        }); 
    }

    public function scopeSorted(Builder $builder, $column, $order): void
    {
        $builder->when($column, function ($query) use ($column, $order) {
            $query->orderBy($column, $order);
        })
        ->when(\is_null($column), function ($query) {
            $query->latest();
        });
    }
}
