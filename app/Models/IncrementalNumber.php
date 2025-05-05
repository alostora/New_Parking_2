<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class IncrementalNumber extends Model
{
    use HasFactory, HasUuids;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [

        'final_client_id',

        'garage_id',

        'number',
    ];

    public function garage(): BelongsTo
    {
        return $this->belongsTo(Garage::class, 'garage_id', 'id');
    }

    public function finealClient(): BelongsTo
    {
        return $this->belongsTo(FinalClient::class, 'final_client_id', 'id');
    }
}
