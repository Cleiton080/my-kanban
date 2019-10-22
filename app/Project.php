<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    protected $fillable = ['name', 'description', 'favorite'];

    public function stages()
    {
        return $this->hasMany(Stage::class);
    }
}
