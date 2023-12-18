<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Chapter extends Model
{
    use HasFactory;

    protected $table = 'chapters';
    public $timestamps = false;
    protected $fillable = [
        'guide_id',
        'title',
        'text_html',
        'text',
        'sort'
    ];

    public function guide()
    {
        return $this->belongsTo(Guide::class);
    }
}
