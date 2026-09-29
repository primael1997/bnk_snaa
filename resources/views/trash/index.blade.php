@extends('layouts.theme')

@section('content')

    @push('link')
        <link rel="stylesheet" href="{{asset('assets/vendors/simple-datatables/style.css')}}">
    @endpush

        <div class="page-heading">
            <div class="page-title">
                <div class="row">
                    <div class="col-12 col-md-6 order-md-1 order-last">
                        <h3>Corbeille</h3>
                        <p class="text-subtitle text-muted">Les Fichiers Supprimés</p>
                    </div>
                    <div class="col-12 col-md-6 order-md-2 order-first">
                        <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="{{route('admin.dashboard')}}">Tableau de board</a></li>
                                <li class="breadcrumb-item active" aria-current="page">Corbeille</li>
                            </ol>
                        </nav>
                    </div>
                </div>
            </div>
            <section class="section">
                <div class="card">
                    <div class="card-header">

                    </div>
                    <div class="card-body">
                        <table class="table table-striped" id="table1">
                            <thead>
                                <tr>
                                    <th>Nom du fichier</th>
                                    <th>Supprimer par</th>
                                    <th>Supprimer le</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($trashed as $trash)
                                    <tr>
                                        <td><b>{{$trash->name}}</b></td>
                                        <td>{{\App\Models\User::where('id',$trash->deleted_by)->value('name')}}</td>
                                        <td>{{$trash->created_at->format('d/m/Y')}}</td>
                                        <td>
                                            <div class="buttons">
                                                <a href="{{route('admin.trash.restore',$trash->id)}}" class="btn btn-outline-primary restore-file"><i class="bi bi-arrow-counterclockwise"></i></a>
                                                <a href="{{route('admin.trash.delete',$trash->id)}}" class="btn btn-outline-danger delete-item"><i class="bi bi-trash"></i></a>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>

            </section>
        </div>

    @push('scripts')
        <script src="{{asset('assets/vendors/simple-datatables/simple-datatables.js')}}"></script>
        <script>
            // Simple Datatable
            let table1 = document.querySelector('#table1');
            let dataTable = new simpleDatatables.DataTable(table1);
        </script>

        <script>
            $(document).ready(function(){

                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });


                $('body').on('click', '.restore-file', function(event){
                    event.preventDefault();

                    let restoreUrl = $(this).attr('href');

                    Swal.fire({
                        title: 'Vous êtes sur!',
                        text: "de vouloir restaurer cet élement ??",
                        icon: 'warning',
                        showCancelButton: true,
                        confirmButtonColor: '#3085d6',
                        cancelButtonColor: '#d33',
                        confirmButtonText: 'Oui, Restaurer!'
                        }).then((result) => {
                        if (result.isConfirmed) {

                            $.ajax({
                                type: 'PUT',
                                url: restoreUrl,

                                success: function(data){

                                    if(data.status == 'success'){
                                        Swal.fire(
                                            'Deleted!',
                                            data.message,
                                            'success'
                                        )
                                        window.location.reload();
                                    }else if (data.status == 'error'){
                                        Swal.fire(
                                            'Cant Delete',
                                            data.message,
                                            'error'
                                        )
                                    }
                                },
                                error: function(xhr, status, error){
                                    console.log(error);
                                }
                            })
                        }
                    })
                })

            })
        </script>
    @endpush
@endsection

