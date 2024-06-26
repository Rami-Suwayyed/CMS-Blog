<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RelatedRole extends Model
{
    use HasFactory;

    protected $table = 'role_user';

    protected $fillable = array('role_id', 'user_id');

}
