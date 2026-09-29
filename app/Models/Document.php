<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Document extends Model
{
    use SoftDeletes;

    protected $casts = [
        'date_published' => 'datetime',
    ];

    protected $fillable = [
        'user_id',
        'type_id',
        'ref',
        'titre',
        'file',
        'date_published',
        'nbre_lecture',
        'nbre_download',
        'size',
    ];

    public function type()
    {
        return $this->belongsTo(Type::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
