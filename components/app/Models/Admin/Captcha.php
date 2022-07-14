<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Captcha extends Model
{
    use HasFactory;

    protected $table = 'captchas';
    protected $guarded = [];

    protected $casts = [
        'status' => 'boolean',
    ];
}
