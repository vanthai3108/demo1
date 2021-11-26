<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Topic extends Model
{
    use HasFactory;
    protected $fillable = ['name', 'description', 'course_id', 'user_id'];
    public function course() {
        return $this->belongsTo('App\Models\Course');
    }
    public function user() {
        return $this->belongsTo('App\Models\User');
    }
}
