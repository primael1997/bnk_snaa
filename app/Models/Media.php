<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use LivewireFilemanager\Filemanager\Models\Media as FilemanagerMedia;

class Media extends FilemanagerMedia
{
    use SoftDeletes;
}
