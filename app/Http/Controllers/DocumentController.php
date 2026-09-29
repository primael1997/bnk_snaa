<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\Models\Document;
use App\Models\Type;

class DocumentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $files = Document::orderBy('id','desc')->get();

        return view('document.index', compact('files'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $types = Type::orderBy('id','desc')->get();

        return view('document.create', compact('types'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'ref' => 'required',
            'titre' => 'required',
            'fichier' => 'required|file',
            'date_publication' => 'required',
            'type_id' => 'required'
        ]);

        if ($request->hasFile('fichier')) {
            // Recherche du dossier et enrégistrement du fichier
            $fichier = $request->file('fichier');
            $type = Type::findOrFail($request->type_id);
            $dossier = Str::slug($type->name);
            $extension = $fichier->getClientOriginalExtension();

            $nomFichier = Str::slug($request->titre).'-'.time().'.'.$extension;

            $path = $fichier->storeAs('documents/'.$dossier, $nomFichier, 'public');

            // Récupération de la taille du fichier
            $size = $fichier->getSize();
            $sizeFormat = formatFileSize($size);


            // Enrégistrement des données
            $file = new Document();
            $file->ref = $request->ref;
            $file->titre = $request->titre;
            $file->file = $path;
            $file->date_published = $request->date_publication;
            $file->size = $sizeFormat;
            $file->type_id = $request->type_id;
            $file->user_id = Auth::user()->id;

            $file->save();
        }

        return response(['message' => 'Document ajouté avec succès!']);
    }

    /**
     * Display the specified resource.
     */
    public function show(Document $document)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Document $document)
    {
        $types = Type::orderBy('id','desc')->get();
        $file = Document::findOrFail($document->id);

        return view('document.edit', compact('file','types'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Document $document)
    {
        $file = Document::findOrFail($document->id);
        if ($file) {
            $request->validate([
                'ref' => 'required',
                'titre' => 'required',
                'fichier' => 'nullable|file',
                'date_publication' => 'required',
                'type_id' => 'required'
            ]);

            if ($request->hasFile('fichier')) {

                $fichier = $request->file('fichier');

                $nom = Str::slug($request->titre).'-'.time().'.'.$fichier->getClientOriginalExtension();

                $path = $fichier->storeAs('documents',$nom,'public');

                $file->file = $path;
                $size = $fichier->getSize();
                $sizeFormat = formatFileSize($size);
                $file->size = $sizeFormat;
            }

            $file->ref = $request->ref;
            $file->titre = $request->titre;
            $file->date_published = $request->date_publication;

            $file->type_id = $request->type_id;
            $file->user_id = Auth::user()->id;

            $file->save();

            return response()->json([
                'status' => 'success',
                'message' => 'Document modifié avec succès',
                'redirect' => route('admin.document.index')
            ]);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Document $document)
    {
        $file = Document::findOrfail($document->id);

        $file->delete();

        return response(['status' => 'success', 'message' => 'Document Suprimé!']);
    }

    public function download($id)
    {
        $file = Document::findOrFail($id);
        $filePath = public_path('storage/' . $file->file);

        return response()->download($filePath);
    }
}
