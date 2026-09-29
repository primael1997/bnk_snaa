@extends('layouts.theme')

@section('content')

    <div class="page-heading">
        <div class="page-title">
            <div class="row">
                <div class="col-12 col-md-6 order-md-1 order-last">
                    <h3>Documents</h3>
                    <p class="text-subtitle text-muted">Modifier un document</p>
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

        <section class="section">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">Fichier</h4>
                </div>

                <div class="card-body">
                    <form id="documentForm" data-id="{{ $file->id }}" enctype="multipart/form-data">
                        @csrf
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="basicInput">Reférence</label>
                                    <input type="text" class="form-control" value="{{$file->ref}}" name="ref" placeholder="Réference du document">
                                </div>
                            </div>

                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="basicInput">Titre</label>
                                    <input type="text" class="form-control" value="{{$file->titre}}" name="titre" placeholder="Titre du document">
                                </div>
                            </div>

                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="basicInput">Fichier</label>
                                    <input type="file" class="form-control" name="fichier">
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="basicInput">Date de publication</label>
                                    <input type="date" class="form-control" name="date_publication" value="{{ \Carbon\Carbon::parse($file->date_published)->format('Y-m-d') }}">
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="basicInput">Type de document</label>
                                    <select class="form-control" name="type_id" id="type_id">
                                        @foreach ($types as $type)
                                            <option {{$file->type_id == $type->id ? 'selected': ''}} value="{{$type->id}}">{{$type->name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            <div class="buttons text-center mt-3">
                                <button type="submit" class="btn btn-primary">Modifier</button>
                                <button type="reset" class="btn btn-secondary">Annuler</button>
                            </div>

                        </div>
                    </form>
                </div>
            </div>
        </section>

    </div>

@endsection

@push('scripts')
    <script>
        $(document).ready(function(){
             $('#documentForm').submit(function (e) {

                e.preventDefault();

                let id = $(this).data('id');
                let formData = new FormData(this);

                formData.append('_method', 'PUT');

                $.ajax({
                    url: "/admin/document/"+id,
                    type: "POST",
                    data: formData,
                    processData: false,
                    contentType: false,

                    success: function (response) {

                        toastr.success(response.message);
                        setTimeout(function () {
                            window.location.href = response.redirect;
                        }, 1000); 

                        $('#documentForm')[0].reset();
                    },

                    error: function (xhr) {

                        console.log(xhr.responseJSON);

                        toastr.error("Une erreur est survenue.");
                    }
                });

            });
        });
    </script>
@endpush
