<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GuideFiles extends Model
{
    use HasFactory;

    protected $table = 'guide_files';
    protected $fillable = [
        'guide_id',
        'name',
        'path'
    ];

    const UPDATED_AT = null;
}
