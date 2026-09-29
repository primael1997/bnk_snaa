@extends('layouts.theme')

@section('content')

    @push('link')
        <link rel="stylesheet" href="{{asset('assets/vendors/simple-datatables/style.css')}}">
        @filemanagerStyles
    @endpush

        <div class="page-heading">
            <div class="page-title">
                <div class="row">
                    <div class="col-12 col-md-6 order-md-1 order-last">
                        <h3>Documents</h3>
                        <p class="text-subtitle text-muted">Liste des fichiers</p>
                    </div>
                    <div class="col-12 col-md-6 order-md-2 order-first">
                        <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="{{route('admin.dashboard')}}">Tableau de board</a></li>
                                <li class="breadcrumb-item active" aria-current="page">Documents</li>
                            </ol>
                        </nav>
                    </div>
                </div>
            </div>
            <section class="section mt-5">
                <div class="card">
                    {{-- <div class="card-header">
                        <div class="card-header-action">
                            <a href="{{route('admin.document.create')}}" type="button" class="btn btn-primary"><i class="fas fa-plus"></i> Ajouter</a>
                        </div>
                    </div> --}}
                    <div class="card-body">
                        {{-- <table class="table table-striped" id="table1">
                            <thead>
                                <tr>
                                    <th>Réf</th>
                                    <th>Titre</th>
                                    <th>Type de document</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($files as $file)
                                    <tr>
                                        <td>{{$file->ref}}</td>
                                        <td>{{$file->titre}}</td>
                                        <td><span class="badge bg-success">{{$file->type->name}}</span></td>
                                        <td>
                                            <div class="buttons">
                                                <a href="#" type="button" data-bs-toggle="modal" data-bs-target="#showModalFile-{{$file->id}}" class="btn btn-outline-secondary"><i class="bi bi-eye-fill"></i></a>
                                                <a href="{{route('admin.document.edit',$file->id)}}" class="btn btn-outline-primary"><i class="bi bi-pencil-square"></i></a>
                                                <a href="{{route('admin.document.destroy', $file->id)}}" class="btn btn-outline-danger delete-item"><i class="bi bi-trash"></i></a>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table> --}}
                        <x-livewire-filemanager />
                    </div>
                </div>

            </section>
        </div>

    @foreach ($files as $file)
        <div class="modal-success me-1 mb-1 d-inline-block">
            <!--Success theme Modal -->
            <div class="modal fade text-left" id="showModalFile-{{$file->id}}" tabindex="-1"
                role="dialog" aria-labelledby="myModalLabel110"
                aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable"
                    role="document">
                    @php
                        $fil = \App\Models\Document::find($file->id);
                    @endphp
                    <div class="modal-content">
                        <div class="modal-header bg-success">
                            <h5 class="modal-title white" id="myModalLabel110">
                                {{$fil->titre}}
                            </h5>
                            <button type="button" class="close"
                                data-bs-dismiss="modal" aria-label="Close">
                                <i data-feather="x"></i>
                            </button>
                        </div>
                        <div class="modal-body">
                            <p><b>Réference : </b>{{$fil->ref}}</p>
                            <p><b>Titre : </b>{{$fil->titre}}</p>
                            <p><span>Type : <span class="badge bg-success">{{$fil->type->name}}</span></p>
                            <p><b>Taille : </b>{{$fil->size}}</p>
                            <p><b>Nbre de Lecture : </b>{{$fil->nbre_lecture}}</p>
                            <p><b>Nbre de Télechargement : </b>{{$fil->nbre_download}}</p>

                            <div class="text-center">
                                <a href="{{route('admin.file.download',$file->id)}}" type="button" class="btn btn-success ml-1">
                                <i class="bi bi-download"></i>
                                <span class="d-none d-sm-block">Télécharger</span>
                            </a>
                            </div>

                        </div>
                        <div class="modal-footer">
                            <button type="button"
                                class="btn btn-light-secondary"
                                data-bs-dismiss="modal">
                                <i class="bx bx-x d-block d-sm-none"></i>
                                <span class="d-none d-sm-block">Fermer</span>
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endforeach
    @push('scripts')
        @filemanagerScripts
        <script src="{{asset('assets/vendors/simple-datatables/simple-datatables.js')}}"></script>
        <script>
            // Simple Datatable
            let table1 = document.querySelector('#table1');
            let dataTable = new simpleDatatables.DataTable(table1);
        </script>
    @endpush
@endsection

