<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Course extends Model
{
    use HasFactory;
    protected $fillable = [ 'name', 'description', 'image', 'numberOfSessions', 'shift', 'startDate', 'endDate','category_id' ];
    public function topics() {
        return $this->hasMany('App\Models\Topic');
    }
    public function category() {
        return $this->belongsTo('App\Models\Category');
    }
    public function users() {
        return $this->belongsToMany('App\Models\User');
    }
}
