<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use App\Models\User;
use App\Models\Patient;
use Illuminate\Support\Str;
use App\Models\Appointment;

class Clinic extends Model
{
    public static function boot()
    {
        parent::boot();

        static::saving(function ($clinic) {
            if (empty($clinic->slug)) {
                $clinic->slug = Str::slug($clinic->name);
            }
        });
    }
    
    public function users():BelongsToMany
    {
        return $this->belongsToMany(User::class, 'clinic_user');
    }

    public function patients():HasMany
    {
        return $this->hasMany(Patient::class, 'clinic_id');
    }

    public function appointments():HasMany
    {
        return $this->hasMany(Appointment::class);
    }
}
