<?php

namespace App;

use App\Patient;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Prescription extends Model
{
    use SoftDeletes;
    protected $fillable = [
        'patient_id',
        'date',
        'description',
    ];

    public function patient()
    {
        return $this->belongsTo(Patient::class);
    }

        /**
     * @return string
     */
    public function getRouteKeyName()
    {
        return 'id';
    }
}
