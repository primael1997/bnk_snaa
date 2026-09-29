<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class FileManagerTrash extends Model
{
    protected $fillable = [
        'media_id',
        'folder_id',
        'name',
        'deleted_by',
        'deleted_at',
    ];

    protected $casts = [
        'deleted_at' => 'datetime',
    ];

    public function media()
    {
        return $this->belongsTo(Media::class, 'media_id')
        ->withoutGlobalScope('not_trashed');
    }
}
