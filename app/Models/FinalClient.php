<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;
use SimpleSoftwareIO\QrCode\Facades\QrCode;
use Illuminate\Database\Eloquent\Model;

class FinalClient extends Model
{
    use HasFactory, HasUuids, SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */

    protected $fillable = [

        'name',

        'phone',

        'email',

        'client_id',

        'stopped_at',
    ];

    protected $casts = [

        'stopped_at' => 'datetime'
    ];

    protected $appends = [
        'final_client_qr',
    ];

    public function getFinalClientQrAttribute()
    {

        $prefix = "ORB"; // [ Length => 3, Data => ORB, Comment =>Hard-code ]
        $version = "001"; // [ Length => 3, Data => 001, Comment =>Hard-code ]
        $systemNo = "7901001"; // [ Length => 7, Data => CODESITE+NODE ZONE, Comment =>To be provided by Orbility ]7901001
        $accountNumber = "00001"; // [ Length => 5, Data => 00001, Comment =>Hard-code  ]
        $ID = "0012312345"; // [ Length => 10, Data => 0012312345, Comment =>Incremental number to be generated by the app  ]
        $validFrom = Carbon::now()->format('YmdHis'); // [ Length => 14, Data => 20130801142500, Comment =>Date/Hour on format YYYYMMDDHHMMSS To be generated by the App ]
        // $validUntil = Carbon::now()->addHours(1)->format('YmdHis'); // [ Length => 14, Data => 20130910235959, Comment =>Date/Hour on format YYYYMMDDHHMMSS To be generated by the App ]
        $validUntil = Carbon::now()->addDays(3)->format('YmdHis'); // [ Length => 14, Data => 20130910235959, Comment =>Date/Hour on format YYYYMMDDHHMMSS To be generated by the App ]
        $rebateType = "01"; // [ Length => 2, Data => 01, Comment =>Hard-code ]
        $valueOfTheRebate  = "00000"; // [ Length => 5, Data => 00000, Comment =>Hard-code ]
        $numberOfUses  = "001"; // [ Length => 3, Data => 001, Comment =>Hard-code ]
        $additionalData  = "0000000000"; // [ Length => 10, Data => 0000000000, Comment =>Hard-code ]

        $clefElectra = "A54_&ELECTRA24";

        $code =  $prefix . $version . $systemNo . $accountNumber . $ID . $validFrom . $validUntil . $rebateType . $valueOfTheRebate . $numberOfUses . $additionalData;

        $hashed_code = sha1($code . $clefElectra);

        $checkSum = $hashed_code[4] . $hashed_code[9] . $hashed_code[14];  // [ Length => 3, Data => Afc, Comment =>Calculation of the Checksum. Please check below]

        $compelete_code = $code . $checkSum;

        // dd($compelete_code);
        // dd($compelete_code);

        return QrCode::size(250)->generate($compelete_code);
    }

    protected function createdAt(): Attribute
    {
        return Attribute::make(
            get: fn(string $value) => date('Y-m-d', strtotime($value)),
        );
    }

    public function client(): BelongsTo
    {
        return $this->belongsTo(User::class, 'client_id', 'id');
    }
}
