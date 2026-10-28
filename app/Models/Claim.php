<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Claim extends Model
{
    protected $table = 'claims';
    protected $fillable = ['user_id', 'cloth_id', 'status'];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function cloth(): BelongsTo
    {
        return $this->belongsTo(Cloth::class);
    }
}