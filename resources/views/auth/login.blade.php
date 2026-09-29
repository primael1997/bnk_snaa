<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Connexion</title>
    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@300;400;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{asset('assets/css/bootstrap.css')}}">
    <link rel="stylesheet" href="{{asset('assets/vendors/bootstrap-icons/bootstrap-icons.css')}}">
    <link rel="stylesheet" href="{{asset('assets/css/app.css')}}">
    <link rel="stylesheet" href="{{asset('assets/css/pages/auth.css')}}">
    <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">

</head>

<body>

    <div id="auth" class="min-vh-100 d-flex align-items-center justify-content-center bg-light">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-12 col-sm-10 col-md-8 col-lg-5 col-xl-4">

                    <div class="card border-0 shadow-lg rounded-4 overflow-hidden">
                        <div class="card-body p-4 p-md-5">

                            {{-- Logo / En-tête --}}
                            <div class="text-center mb-4">

                                <div class="mb-3">
                                    <img
                                        src="{{ asset('assets/images/logo/logo1.png') }}"
                                        alt="Mairie de Banikoara"
                                        style="height: 80px; width: auto;"
                                    >
                                </div>

                                <h1 class="h3 fw-bold text-primary mb-2">
                                    Mairie de Banikoara
                                </h1>

                                <p class="text-muted mb-0">
                                    <strong>
                                        Système de Numérisation des Actes Administratifs
                                    </strong>
                                </p>

                                <small class="text-muted">
                                    SNAA
                                </small>
                            </div>

                            <hr class="my-4">

                            {{-- Messages d'erreur --}}
                            @if ($errors->any())
                                <div class="alert alert-danger rounded-3 mb-4">
                                    <div class="fw-semibold mb-1">
                                        Échec de connexion
                                    </div>

                                    <ul class="mb-0 ps-3">
                                        @foreach ($errors->all() as $error)
                                            <li>{{ $error }}</li>
                                        @endforeach
                                    </ul>
                                </div>
                            @endif

                            {{-- Formulaire --}}
                            <form action="{{ route('login') }}" method="POST">
                                @csrf

                                {{-- Identifiant --}}
                                <div class="mb-4">
                                    <label for="login" class="form-label fw-semibold">
                                        Identifiant
                                    </label>

                                    <div class="input-group input-group-lg">
                                        <span class="input-group-text bg-light border-end-0">
                                            <i class="bi bi-person text-primary"></i>
                                        </span>

                                        <input
                                            type="text"
                                            id="login"
                                            name="login"
                                            value="{{ old('login') }}"
                                            class="form-control bg-light border-start-0"
                                            placeholder="Votre identifiant"
                                            autocomplete="username"
                                            required
                                        >
                                    </div>
                                </div>

                                {{-- Mot de passe --}}
                                <div class="mb-4">
                                    <label for="password" class="form-label fw-semibold">
                                        Mot de passe
                                    </label>

                                    <div class="input-group input-group-lg">
                                        <span class="input-group-text bg-light border-end-0">
                                            <i class="bi bi-shield-lock text-primary"></i>
                                        </span>

                                        <input
                                            type="password"
                                            id="password"
                                            name="password"
                                            class="form-control bg-light border-start-0 border-end-0"
                                            placeholder="Votre mot de passe"
                                            autocomplete="current-password"
                                            required
                                        >

                                        <button
                                            type="button"
                                            class="input-group-text bg-light border-start-0"
                                            onclick="togglePassword()"
                                            title="Afficher le mot de passe"
                                        >
                                            <i id="passwordIcon" class="bi bi-eye text-muted"></i>
                                        </button>
                                    </div>
                                </div>

                                {{-- Bouton --}}
                                <button
                                    type="submit"
                                    class="btn btn-primary btn-lg w-100 rounded-3 shadow-sm py-3"
                                >
                                    <i class="bi bi-box-arrow-in-right me-2"></i>
                                    Se connecter
                                </button>
                            </form>

                            {{-- Footer --}}
                            <div class="text-center mt-4">
                                <small class="text-muted">
                                    © {{ date('Y') }} Mairie de Banikoara
                                </small>
                            </div>

                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>

<script>
    function togglePassword() {
        const password = document.getElementById('password');
        const icon = document.getElementById('passwordIcon');

        if (password.type === 'password') {
            password.type = 'text';
            icon.classList.remove('bi-eye');
            icon.classList.add('bi-eye-slash');
        } else {
            password.type = 'password';
            icon.classList.remove('bi-eye-slash');
            icon.classList.add('bi-eye');
        }
    }
</script>



    <script src="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>


    <script>
        @if ($errors->any())
            @foreach ($errors->all() as $error)
                toastr.error("{{$error}}")
            @endforeach
        @endif
    </script>

    <!-- Dynamic Delete alart -->

    <script>
        $(document).ready(function(){

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });


            $('body').on('click', '.delete-item', function(event){
                event.preventDefault();

                let deleteUrl = $(this).attr('href');

                Swal.fire({
                    title: 'Are you sure?',
                    text: "You won't be able to revert this!",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Yes, delete it!'
                    }).then((result) => {
                    if (result.isConfirmed) {

                        $.ajax({
                            type: 'DELETE',
                            url: deleteUrl,

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


    @stack('scripts')

</body>

</html>
