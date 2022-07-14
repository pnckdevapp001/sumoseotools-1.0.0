<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Sidebar extends Model
{
    use HasFactory;
    protected $table = 'sidebars';
    protected $guarded = [];
    protected $casts = [
        'tool_status' => 'boolean',
        'post_status' => 'boolean'
    ];
}
