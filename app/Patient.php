<?php

namespace App;

use App\Prescription;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Patient extends Model
{
    use SoftDeletes;
    protected $fillable = [
        'name',
        'username',
        'address',
        'phone',
        'age',
        'gender'
    ];

    /**
     * @return string
     */
    public function getRouteKeyName()
    {
        return 'username';
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\MorphOne
     */
    public function image()
    {
        return $this->morphOne(Image::class, 'imageable');
    }

    /**
     * @param array $options
     * @return bool|null|void
     * @throws \Exception
     */
    public function delete(array $options = [])
    {
        if ($this->image)
        {
            $this->image->delete();
        }

        return parent::delete($options);
    }


    /************ Relations Starts from Here ***********/
    public function prescriptions()
    {
        return $this->hasMany(Prescription::class);
    }
}