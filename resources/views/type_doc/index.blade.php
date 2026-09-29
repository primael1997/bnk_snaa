@extends('layouts.theme')

@section('content')

    <div class="page-heading">
        <div class="page-title">
            <div class="row">
                <div class="col-12 col-md-6 order-md-1 order-last">
                    <h3>Type de document</h3>
                </div>
                <div class="col-12 col-md-6 order-md-2 order-first">
                    <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{route('admin.dashboard')}}">Tableau de board</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Type de document</li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>

        <!-- Basic Tables start -->
        <section class="section mt-5">
            <div class="row" id="basic-table">
                <div class="col-6 col-md-6 mx-auto">
                    <div class="card">
                        <div class="card-header">
                            <h4 class="card-title">Liste des types de documents</h4>
                            <div class="card-header-action">
                                <a href="" type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#success"><i class="fas fa-plus"></i> Ajouter</a>
                            </div>
                        </div>
                        <div class="card-content">
                            <div class="card-body">

                                <!-- Table with outer spacing -->
                                <div class="table-responsive">
                                    <table class="table table-lg">
                                        <thead>
                                            <tr>
                                                <th>TYPE DOCUMENT</th>
                                                <th>ACTION</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($types as $type)
                                            <tr>
                                                <td class="text-bold-500">{{$type->name}}</td>

                                                <td class="text-bold-500">
                                                    <div class="buttons">
                                                        <a href="#" class="btn btn-outline-primary" data-bs-toggle="modal" data-bs-target="#success-edit-{{$type->id}}"><i class="bi bi-pencil-square"></i></a>
                                                        <a href="{{route('admin.type-document.destroy', $type->id)}}" class="btn btn-outline-danger delete-item"><i class="bi bi-trash"></i></a>
                                                    </div>
                                                </td>
                                            </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>

    @include('type_doc.addModelType')

    <!--Success theme Modal -->
    @foreach ($types as $type)
    <div class="modal-success me-1 mb-1 d-inline-block">
        <div class="modal fade text-left" id="success-edit-{{$type->id}}" tabindex="-1"
            role="dialog" aria-labelledby="myModalLabel110"
            aria-hidden="true">
            @php
                $typ = \App\Models\Type::find($type->id);
            @endphp
            <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable"
                role="document">
                <div class="modal-content">
                    <div class="modal-header bg-success">
                        <h5 class="modal-title white" id="myModalLabel110">
                            Ajout d'un type de document
                        </h5>
                        <button type="button" class="close"
                            data-bs-dismiss="modal" aria-label="Close">
                            <i data-feather="x"></i>
                        </button>
                    </div>
                    <div class="modal-body">

                        @include('type_doc.editModelType')

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


@endsection
