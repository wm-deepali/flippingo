<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OTP extends Model
{
    use HasFactory;
    protected $table = 'customer_otp';

    protected $fillable = ['value', 'type', 'otp', 'expiry', 'verified'];

    protected $dates = ['expiry'];

    public static function verifyOTP($value, $otp, $type = 'mobile')
    {
        $otpRecord = self::where('value', $value)
            ->where('type', $type)
            ->where('otp', $otp)
            ->where('expiry', '>=', now())
            ->first();

        if ($otpRecord) {
            $otpRecord->verified = true;
            $otpRecord->save();
            return true;
        }
        return false;
    }

    public static function deleteOTP($value, $otp, $type = 'mobile')
    {
        $otpRecord = self::where('value', $value)
            ->where('type', $type)
            ->where('otp', $otp)
            ->first();

        if ($otpRecord) {
            $otpRecord->delete();
            return true;
        }
        return false;
    }
}

