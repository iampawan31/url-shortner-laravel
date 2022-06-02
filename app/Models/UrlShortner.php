<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UrlShortner extends Model
{
    protected $table = 'urlshortners';

    protected $fillable = ['link', 'code'];
}
