<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Log extends Model
{
    use HasFactory;

    protected $table = 'logs';
    protected $fillable = [
        'operation_id',
        'text',
        'uid',
        'item_id'
    ];
    const UPDATED_AT = null;

    public function operation()
    {
        return $this->belongsTo(Operation::class);
    }

    public function itemable()
    {
        return $this->morphTo();
    }
}
