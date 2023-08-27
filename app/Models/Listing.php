<?php

namespace App\Models;

use Illuminate\Contracts\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Listing extends Model
{
    use HasFactory;

    // protected $fillable is used to specify the fields that can be mass-assigned from Listing::create([]);
    protected $fillable = [
        'products',
        'quantity',
        'description',
        'address',
        'price',
    ];

    public function owner(): BelongsTo
    {
        return $this->belongsTo(
            \App\Models\User::class,
            'by_user_id'
        );
    }

    public function scopeMostRecent(Builder $query): Builder
    {
        return $query->orderByDesc('created_at');
    }

    public function scopeFilter(Builder $query, array $filters): Builder
    {
        return $query->when(
            $filters['products'] ?? false,
            fn ($query, $value) => $query->where('products', 'LIKE', '%' . $value . '%')
        )
        ->when(
            $filters['quantity'] ?? false,
            fn ($query, $value) => $value === '6' 
                ? $query->where('quantity', '>=', 6) 
                : $query->where('quantity', $value)
        )                    
        ->when(
            $filters['priceFrom'] ?? false,
            fn ($query, $value) => $query->where('price', '>=', $value)
        )->when(
            $filters['priceTo'] ?? false,
            fn ($query, $value) => $query->where('price', '<=', $value)
        );
    }
}
