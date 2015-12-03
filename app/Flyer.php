<?php

namespace Foobooks;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Query\Builder;

class Flyer extends Model
{
    /**
     * A Flyer is composed of many photos
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    protected $fillable = [
        'street',
        'city',
        'state',
        'country',
        'zip',
        'price',
        'description'
    ];

    /**
     * Find the flyer at the given address
     * @param $zip
     * @param $street
     * @return mixed
     * Note: this is commented out because I decided to use a static function instead
     */
    /*
    public function scopeLocatedAt($query, $zip, $street)
    {
        $street = str_replace('-',' ', $street);
        return $query->where(compact('zip', 'street'))->firstOrFail();
    }
    */


    public static function locatedAt($zip, $street){
        $street = str_replace('-',' ', $street);
        return static::where(compact('zip','street'))->firstOrFail();
    }

    public function getPriceAttribute($price){
    return '$' . number_format($price);
    }

    public function addPhoto(Photo $photo){

        return $this->photos()->save($photo);
    }

    /*
     * A flyer is composed of many photos
     */
    public function photos()
    {
        return $this->hasMany('Foobooks\Photo');
    }
}
