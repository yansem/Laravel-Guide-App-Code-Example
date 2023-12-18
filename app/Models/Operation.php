<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Operation extends Model
{
    use HasFactory;

    protected $table = 'operations';
    protected $fillable = [
        'title',
        'table_id'
    ];
    public $timestamps = false;

    public function table()
    {
        return $this->belongsTo(Table::class);
    }
}
