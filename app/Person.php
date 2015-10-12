<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Person extends Model
{
    protected $fillable = [

        'first',
        'last',
        'middle',
        'maiden',
        'nickname',
        'gender',
        'home',
        'origin',
        'interests',
        'education',
        'work',
        'notes1',
        'birthdate',
        'birthplace',
        'deathdate',
        'resting_place',
        'keem_line',
        'husband_line',
        'kemler_line',
        'kaplan_line',
    ];

    protected $dates = ['birthdate', 'deathdate'];

    public function scopeDisplayable($query)
    {
        $query->where('hide_bool', '=', false);
    }

    public function scopeKaplans($query)
    {
        $query->where('kaplan_line', '=', 'true');
    }


    //get the tags associated with the given person
    public function tags()
    {
        return $this->belongsToMany('App\Tag')->withTimestamps();
    }

    //get list of tag IDs  associated with the given person
    public function getTagListAttribute()
    {
        return $this->tags->lists('id')->all();
    }





}
