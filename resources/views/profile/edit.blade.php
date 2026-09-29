@extends('layouts.theme')

@section('content')

    <div class="page-heading">
        <div class="page-title">
            <div class="row">
                <div class="col-12 col-md-6 order-md-1 order-last">
                    <h3>Profil</h3>
                    <p class="text-subtitle text-muted">Ajouter un document</p>
                </div>
                <div class="col-12 col-md-6 order-md-2 order-first">
                    <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{route('admin.dashboard')}}">Tableau de board</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Mes Informations</li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>

        <section class="section">
            <div class="row">
                <div class="col-md-6 col-sm-12">
                    <div class="card">
                        <div class="card-header">
                            <h4 class="card-title">Mes Informations</h4>
                        </div>

                        <div class="card-body">
                            <form action="{{route('admin.profile.update')}}" method="POST">
                                @csrf
                                @method('PUT')
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label for="basicInput">Noms</label>
                                            <input type="text" class="form-control" name="name" value="{{$user->name}}">
                                        </div>
                                    </div>

                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label for="basicInput">Login</label>
                                            <input type="text" class="form-control" name="login" value="{{$user->login}}">
                                        </div>
                                    </div>



                                    <div class="buttons text-center mt-3">
                                        <button type="submit" class="btn btn-primary">Sauvegarder</button>
                                    </div>

                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 col-sm-12">
                    <div class="card">
                        <div class="card-header">
                            <h4 class="card-title">Changement du mot de passe</h4>
                        </div>

                        <div class="card-body">
                            <form action="{{route('admin.profile.update.password')}}" method="POST">
                                @csrf
                                @method('PUT')
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label for="basicInput">Mot de passe actuel</label>
                                            <input type="password" class="form-control" name="current_password" placeholder="">
                                        </div>
                                    </div>

                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label for="basicInput">Nouveau mot de passe</label>
                                            <input type="password" class="form-control" name="password" placeholder="">
                                        </div>
                                    </div>

                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label for="basicInput">Confirmation du mot de passe</label>
                                            <input type="password" class="form-control" name="password_confirmation" placeholder="">
                                        </div>
                                    </div>

                                    <div class="buttons text-center mt-3">
                                        <button type="submit" class="btn btn-primary">Sauvegarder</button>
                                    </div>

                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </section>

    </div>

@endsection

