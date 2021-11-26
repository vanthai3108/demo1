<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AppConst extends Model
{
    const DEFAULT_ADMIN_USER_PER_PAGE = 5;
    const DEFAULT_ADMIN_ROLE_PER_PAGE = 5;
    const DEFAULT_ADMIN_COURSE_PER_PAGE = 5;
    const DEFAULT_ADMIN_TOPIC_PER_PAGE = 5;
    const DEFAULT_ADMIN_CATEGORY_PER_PAGE = 5;
    const DEFAULT_HOME_COURSE_PER_PAGE = 6;
    const DEFAULT_MY_COURSE_PER_PAGE = 6;
}
