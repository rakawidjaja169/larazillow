<?php

namespace App\Models;

use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Offer extends Model
{
    use HasFactory;

    protected $fillable = ['solution', 'accepted_at', 'rejected_at'];

    public function listing(): BelongsTo
    {
        return $this->belongsTo(Listing::class, 'listing_id');
    }

    public function solver(): BelongsTo
    {
        return $this->belongsTo(User::class, 'solver_id');
    }

    public function scopeByMe(Builder $query): Builder
    {
        return $query->where('solver_id', Auth::user()?->id);
    }
}
