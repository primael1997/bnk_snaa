@extends('layouts.theme')

@section('content')

    <div class="page-heading">
        <div class="page-title">
            <div class="row">
                <div class="col-12 col-md-6 order-md-1 order-last">
                    <h3>Documents</h3>
                    <p class="text-subtitle text-muted">Ajouter un document</p>
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
                    <form action="{{route('admin.user.update',$user->id)}}" method="POST">
                        @csrf
                        @method('put')
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="basicInput">Nom et Prénoms</label>
                                    <input type="text" class="form-control" value="{{$user->name}}" name="name" placeholder="">
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="basicInput">Login</label>
                                    <input type="text" class="form-control" value="{{$user->login}}" name="login" placeholder="">
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="basicInput">Role</label>
                                    <select class="form-control" name="role">
                                        <option {{$user->role == 'admin' ? 'selected' : ''}} value="admin">Administrateur</option>
                                        <option {{$user->role == 'user' ? 'selected' : ''}} value="user">Utilisateur</option>
                                    </select>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="basicInput">Status</label>
                                    <select class="form-control" name="status">
                                        <option {{$user->status == 'actif' ? 'selected' : ''}} value="actif">Actif</option>
                                        <option {{$user->status == 'inactif' ? 'selected' : ''}} value="inactif">Inactif</option>
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


