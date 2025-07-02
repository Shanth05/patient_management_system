<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use App\Models\User;
use App\Models\Patient;
use App\Models\Appointment;

class Clinic extends Model
{
    public function users():BelongsToMany
    {
        return $this->belongsToMany(User::class, 'clinic_user');
    }

    public function patients():HasMany
    {
        return $this->hasMany(Patient::class, 'clinic_patient');
    }

    public function appointments():HasMany
    {
        return $this->hasMany(Appointment::class);
    }
}
