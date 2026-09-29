<?php

namespace App\Http\Controllers;

use App\Models\Type;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;


class TypeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $types = Type::orderBy('id','desc')->get();

        return view('type_doc.index', compact('types'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => ['required', 'max:200', 'unique:types,name'],
        ]);

        $dossier = Str::slug($request->name);

        Storage::disk('public')->makeDirectory('documents/'.$dossier);

        Type::create($data);

        toastr('Type de document ajouté!', 'success');

        return redirect()->route('admin.type-document.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(Type $type)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Type $type)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Type $type_document)
    {
        $type = Type::findOrFail($type_document->id);

        $data = $request->validate([
            'name' => ['required', 'max:200', 'unique:types,name'],
        ]);

        $type->update($data);

        toastr('Type de document ajouté!', 'success');

        return redirect()->route('admin.type-document.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Type $type_document)
    {
        $type = Type::findOrFail($type_document->id);
        // if(Product::where('brand_id', $brand->id)->count() > 0){
        //     return response(['status' => 'error', 'message' => 'Ce type de document contient des documents']);
        // }

        $type->delete();

        return response(['status' => 'success', 'message' => 'Deleted Successfully!']);
    }
}
