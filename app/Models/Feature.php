<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Feature extends Model
{
    protected $fillable = ['nome'];

    public function properties()
    {
        return $this->belongsToMany(Property::class, 'property_feature');
    }
}

