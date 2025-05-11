<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Model;

class AvailableFinalClientPackage extends Model
{
    use HasFactory, HasUuids;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */

    protected $fillable = [

        'client_id',

        "available_customer_count",

        'final_cliend_number_of_usage',

        'stopped_at',
    ];

    protected $casts = [

        'stopped_at' => 'datetime',

        'created_at' => 'datetime'
    ];

    public function client(): BelongsTo
    {
        return $this->belongsTo(User::class, 'client_id', 'id');
    }

    public function garage(): BelongsTo
    {
        return $this->belongsTo(Garage::class, 'garage_id', 'id');
    }
}
