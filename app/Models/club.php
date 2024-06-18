<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class club extends Model
{
    use HasFactory;
    protected $fillable = [
        'club_id','club_name','club_number','club_slug','club_banner'
    ];
}
