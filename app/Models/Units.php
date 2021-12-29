<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Units extends Model
{
    use HasFactory;
    
    public $table = 'units';

    protected $fillable = [
        'name',
        'id_owner',
        'id_users_live',
    ];
}
