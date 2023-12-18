<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Guide extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'guides';
    protected $fillable = [
        'title',
        'icon',
        'text',
        'program_link',
        'doc_link',
        'sort',
        'approved',
        'public'
    ];

    public function chapters()
    {
        return $this->hasMany(Chapter::class);
    }
    public function files()
    {
        return $this->hasMany(GuideFiles::class)->orderBy('created_at', 'desc');
    }
}
