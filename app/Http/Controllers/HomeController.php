<?php

namespace App\Http\Controllers;

use App\Models\Document;
use App\Models\Type;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use LivewireFilemanager\Filemanager\Models\Folder;
use LivewireFilemanager\Filemanager\Models\Media;
use Vish4395\LaravelFileViewer\LaravelFileViewer;

class HomeController extends Controller
{
    public function index()
    {
        $tatal_actes = Media::count();
        $total_types = Folder::count();
        $nbre_download = Document::sum('nbre_download');
        $nbre_users = User::count();
        $latest_files = Document::latest()->take(5)->get();


        $numerisations = Media::select(
            DB::raw('MONTH(created_at) as mois'),
            DB::raw('COUNT(*) as total')
        )
        ->whereYear('created_at', date('Y'))
        ->groupBy('mois')
        ->pluck('total', 'mois')
        ->toArray();

        // Initialiser les 12 mois à 0
        $data = [];

        for ($i = 1; $i <= 12; $i++) {
            $data[] = $numerisations[$i] ?? 0;
        }


        $folders = Folder::leftJoin('media', function ($join) {
            $join->on('folders.id', '=', 'media.model_id')
                ->where(
                    'media.model_type',
                    '=',
                    'LivewireFilemanager\\Filemanager\\Models\\Folder'
                )
                ->whereNull('media.deleted_at');
        })
        ->select(
            'folders.name as folder',
            DB::raw('COUNT(media.id) as total')
        )
        ->groupBy('folders.id', 'folders.name')
        ->orderByDesc('total')
        ->get();

        $labels = $folders->pluck('folder');
        $series = $folders->pluck('total');

        return view('dashboard', compact(
            'tatal_actes',
            'total_types',
            'nbre_download',
            'nbre_users',
            'data',
            'labels',
            'series',
            'latest_files'
        ));
    }

    public function welcome()
    {
        $types = Type::orderBy('id','desc')->get();
        $documents = collect();
        $latest_files = Document::latest()->take(5)->get();

        return view('welcome',[
            'types' => $types,
            'documents' => $documents,
            'latest_files' => $latest_files
        ]);
    }

    public function search(Request $request)
    {
        $documents = Media::query();

        // Recherche uniquement par nom/titre du document
        if ($request->filled('keyword')) {

            $keywords = preg_split('/\s+/', trim($request->keyword));

            foreach ($keywords as $keyword) {
                $documents->where('name', 'like', '%' . $keyword . '%');
            }
        }

        $documents = $documents
            ->orderBy('created_at', 'desc')
            ->paginate(12)
            ->withQueryString();

        return view('welcome', compact('documents'));

    }

    public function show($id)
    {
        $file = \LivewireFilemanager\Filemanager\Models\Media::findOrFail($id);

        return response()->file($file->getPath(), [
            'Content-Type' => $file->mime_type,
            'Content-Disposition' => 'inline; filename="' . $file->file_name . '"',
        ]);
    }


    public function download($id)
    {
        $file = \LivewireFilemanager\Filemanager\Models\Media::findOrFail($id);

        return response()->download(
            $file->getPath(),
            $file->file_name
        );
    }
}
