<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Cashier\Billable;
use Laravel\Sanctum\HasApiTokens;

class Company extends Model
{
    // use HasFactory;

    protected $table = 'companies';
    protected $guarded = [];

    protected $dates = ['created_at', 'updated_at', 'trial_ends_at'];

    public function users()
    {
        return $this->hasMany(User::class);
    }

    public function settings() {
        return $this->hasMany(Setting::class);
    }

    public function setting($key, $default = null) {
        $setting = Setting::where('company_id', $this->id)->where('key', $key)->first();
        return $setting ? $setting->value : $default;
    }
}
