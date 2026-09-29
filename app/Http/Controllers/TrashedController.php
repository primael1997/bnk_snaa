<?php

namespace App\Http\Controllers;

use App\Models\Document;
use App\Models\FileManagerTrash;
use App\Services\FileManagerTrashService;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Request;

class TrashedController extends Controller
{
    public function index()
    {
        $trashed = FileManagerTrash::orderBy('id','desc')->get();

        return view('trash.index', compact('trashed'));
    }

    public function restore(Request $request, $id)
    {
        $trash = FileManagerTrash::findOrFail($id);

        app(FileManagerTrashService::class)->restore($trash);

        toastr('success', 'Le fichier a été restauré avec succès');
    }

    public function forceDelete($id)
    {
        $trash = FileManagerTrash::findOrFail($id);

        app(FileManagerTrashService::class)->forceDelete($trash);

        toastr('success', 'Le fichier a été supprimé.');
    }
}
