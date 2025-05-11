<?php

namespace App\Models;

use App\Notifications\ResetPasswordEmail;
use App\Notifications\VerifyEmail;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Hash;
use SimpleSoftwareIO\QrCode\Facades\QrCode;

class User extends Authenticatable implements MustVerifyEmail
{
    use HasApiTokens, HasFactory, Notifiable, HasUuids, SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */

    protected $fillable = [

        'name',

        'phone',

        'email',

        'password',

        'address',

        'country_id',

        'governorate_id',

        'user_account_type_id',

        'garage_id',

        'file_id',

        'api_token',

        'email_verification_code',

        'reset_password_code',

        'email_verified_at',

        'stopped_at',

    ];

    protected $hidden = [

        'password',

        'api_token',

        'remember_token',
    ];

    protected $casts = [

        'email_verified_at' => 'datetime',

        'stopped_at' => 'datetime'
    ];

    protected $appends = [
        'client_qr',
    ];

    public function getClientQrAttribute()
    {
        return QrCode::size(100)/* ->backgroundColor(255, 255, 0) */->generate(url('guest/final-client/registration/' . $this->id));
    }

    protected function createdAt(): Attribute
    {
        return Attribute::make(
            get: fn(string $value) => date('Y-m-d', strtotime($value)),
        );
    }

    protected function password(): Attribute
    {
        return Attribute::make(
            set: fn($value) => Hash::make($value),
        );
    }

    public function sendEmailVerificationNotification()
    {
        $this->notify(new VerifyEmail);
    }

    public function sendResetPasswordCodeNotification()
    {
        $this->notify(new ResetPasswordEmail);
    }

    public function country(): BelongsTo
    {
        return $this->belongsTo(Country::class, 'country_id', 'id');
    }

    public function governorate(): BelongsTo
    {
        return $this->belongsTo(Country::class, 'governorate_id', 'id');
    }

    public function file(): BelongsTo
    {
        return $this->belongsTo(File::class, 'file_id', 'id');
    }

    public function accountType(): BelongsTo
    {
        return $this->belongsTo(SystemLookup::class, 'user_account_type_id', 'id');
    }

    public function garage(): BelongsTo
    {
        return $this->belongsTo(Garage::class, 'garage_id', 'id');
    }

    public function availableFinalClientPackages(): HasMany
    {
        return $this->hasMany(AvailableFinalClientPackage::class, 'client_id', 'id');
    }

    public function getAvailableCustomerCountAttribute()
    {
        $availableFinalClientPackages = $this->availableFinalClientPackages()->latest()->first();
        return $availableFinalClientPackages ? $availableFinalClientPackages->available_customer_count : 0;
    }

    public function getTotalUsedCustomerAttribute()
    {
        $availableFinalClientPackages = $this->availableFinalClientPackages()->latest()->first();
        return $availableFinalClientPackages ? $availableFinalClientPackages->final_cliend_number_of_usage : 0;
    }

    public function getTotalAvailableCustomerAttribute()
    {
        $availableFinalClientPackages = $this->availableFinalClientPackages()->latest()->first();
        return $availableFinalClientPackages ? $availableFinalClientPackages->available_customer_count - $availableFinalClientPackages->final_cliend_number_of_usage : 0;
    }
}
