@extends('layouts.theme')

@section('content')

    @push('link')
        <link rel="stylesheet" href="{{asset('assets/vendors/simple-datatables/style.css')}}">
    @endpush

        <div class="page-heading">
            <div class="page-title">
                <div class="row">
                    <div class="col-12 col-md-6 order-md-1 order-last">
                        <h3>Gestion des Utilisateurs</h3>
                        <p class="text-subtitle text-muted">Liste des utilisateurs</p>
                    </div>
                    <div class="col-12 col-md-6 order-md-2 order-first">
                        <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="{{route('admin.dashboard')}}">Tableau de board</a></li>
                                <li class="breadcrumb-item active" aria-current="page">Liste des Utilisateurs</li>
                            </ol>
                        </nav>
                    </div>
                </div>
            </div>
            <section class="section">
                <div class="card">
                    <div class="card-header">
                        <div class="card-header-action">
                            <a href="" type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addUserModal"><i class="fas fa-plus"></i> Ajouter</a>
                        </div>
                    </div>
                    <div class="card-body">
                        <table class="table table-striped" id="table1">
                            <thead>
                                <tr>
                                    <th>Nom</th>
                                    <th>Login</th>
                                    <th>Role</th>
                                    <th>Status</th>

                                    <th class="text-center">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($users as $user)
                                    <tr>
                                        <td>{{$user->name}}</td>
                                        <td>{{$user->login}}</td>
                                        <td>{{$user->role}}</td>
                                        <td>
                                            @if ($user->status == 'actif')
                                                <div class="form-check form-switch">
                                                    <input class="form-check-input change-status" name="custom-switch-checkbox" type="checkbox" data-id="{{$user->id}}" checked="" id="flexSwitchCheckDefault">
                                                    <label class="form-check-label" for="flexSwitchCheckChecked"> </label>
                                                </div>
                                                @else
                                                    <div class="form-check form-switch">
                                                        <input class="form-check-input change-status" name="custom-switch-checkbox" type="checkbox" data-id="{{$user->id}}" id="flexSwitchCheckDefault">
                                                        <label class="form-check-label" for="flexSwitchCheckDefault"></label>
                                                    </div>
                                                @endif
                                            {{-- <span class="{{$user->status == 'actif' ? 'badge bg-success' : 'badge bg-danger'}}">{{$user->status}}</span> --}}
                                        </td>
                                        <td class="text-center">
                                            <div class="buttons">
                                                <a href="" class="btn btn-outline-warning generate-password" data-id="{{$user->id}}"><i class="bi bi-bootstrap-reboot"></i></a>
                                                <a href="" class="btn btn-outline-primary" data-bs-toggle="modal" data-bs-target="#editUserModal-{{$user->id}}"><i class="bi bi-pencil-square"></i></a>
                                                <a href="{{route('admin.user.destroy', $user->id)}}" class="btn btn-outline-danger delete-item"><i class="bi bi-trash"></i></a>
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

        @include('users.addUserModal')

        @foreach ($users as $user)
            <div class="modal-success me-1 mb-1 d-inline-block">
                <div class="modal fade text-left" id="editUserModal-{{$user->id}}" tabindex="-1"
                    role="dialog" aria-labelledby="myModalLabel110"
                    aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable"
                        role="document">
                        <div class="modal-content">
                            @php
                                $use = \App\Models\User::find($user->id);
                            @endphp
                            <div class="modal-header bg-success">
                                <h5 class="modal-title white" id="myModalLabel110">
                                    Modifier un utilisateur
                                </h5>
                                <button type="button" class="close"
                                    data-bs-dismiss="modal" aria-label="Close">
                                    <i data-feather="x"></i>
                                </button>
                            </div>
                            <div class="modal-body">
                                <form class="form form-vertical" action="{{route('admin.user.update',$user->id)}}" method="POST">
                                    @method('PUT')
                                    @csrf
                                    <div class="form-body">
                                        <div class="row">
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label for="basicInput">Nom et Prénoms</label>
                                                <input type="text" value="{{$use->name}}" class="form-control" name="name" placeholder="">
                                            </div>
                                        </div>

                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label for="basicInput">Login</label>
                                                <input type="text" value="{{$use->login}}" class="form-control" name="login" placeholder="">
                                            </div>
                                        </div>

                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label for="basicInput">Role</label>
                                                <select class="form-control" name="role">
                                                    <option value="admin" {{$use->role == 'admin' ? 'selected' : ''}}>Administrateur</option>
                                                    <option value="user" {{$use->role == 'user' ? 'selected' : ''}}>Utilisateur</option>
                                                </select>
                                            </div>
                                        </div>

                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label for="basicInput">Status</label>
                                                <select class="form-control" name="status">
                                                    <option {{$use->status == 'actif' ? 'selected' : ''}} value="actif">Actif</option>
                                                    <option {{$use->status == 'inactif' ? 'selected' : ''}} value="inactif">Inactif</option>
                                                </select>
                                            </div>
                                        </div>

                                        <div class="row">
                                            <div class="col-12 d-flex justify-content-end">
                                                <button type="submit" class="btn btn-primary me-1 mb-1">Valider</button>
                                                <button type="reset" class="btn btn-light-secondary me-1 mb-1">Annuler</button>
                                            </div>
                                        </div>
                                    </div>
                                </form>
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

        <script>
            $(document).ready(function(){
                $('body').on('click', '.change-status', function(){
                    let isChecked = $(this).is(':checked');
                    let id = $(this).data('id');


                    $.ajax({
                        url: "{{route('admin.user.change-status')}}",
                        method: 'PUT',
                        data: {
                            status: isChecked,
                            id: id
                        },
                        success: function(data){
                            toastr.success(data.message)
                        },
                        error: function(xhr, status, error){
                            console.log(error);
                        }
                    })

                })
            })
        </script>

        <script>
            $('body').on('click', '.generate-password', function(e){
                e.preventDefault();

                let id = $(this).data('id');

                $.ajax({
                    url: "{{ route('admin.user.generate-password') }}",
                    method: "PUT",
                    data: {
                        id: id,
                        _token: "{{ csrf_token() }}"
                    },
                    success: function(data){
                        toastr.success(data.message);
                    },
                    error: function(xhr){
                        console.log(xhr.responseText);
                    }
                });
            });
        </script>
    @endpush
@endsection

