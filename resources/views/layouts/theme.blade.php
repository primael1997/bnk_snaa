<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="csrf-token" content="{{ csrf_token() }}" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SN2A - Mairie Banikoara</title>

    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@300;400;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">
    <link rel="stylesheet" href="{{asset('assets/css/bootstrap.css')}}">

    <link rel="stylesheet" href="{{asset('assets/vendors/iconly/bold.css')}}">

    <link rel="stylesheet" href="{{asset('assets/vendors/perfect-scrollbar/perfect-scrollbar.css')}}">
    <link rel="stylesheet" href="{{asset('assets/vendors/bootstrap-icons/bootstrap-icons.css')}}">
    <link rel="stylesheet" href="{{asset('assets/css/app.css')}}">
    <link rel="shortcut icon" href="{{asset('assets/images/favicon.svg')}}" type="image/x-icon">

    @stack('link')

    <style>
        #toast-container > .toast-success {
            background-color: #28a745 !important;
            color: #fff !important;
        }

        #toast-container > .toast-error {
            background-color: #dc3545 !important;
            color: #fff !important;
        }

        #toast-container > .toast {
            opacity: 1 !important;
        }
    </style>

</head>

<body>
    <div id="app">
        <div id="sidebar" class="active">
            <div class="sidebar-wrapper active">
                <div class="sidebar-header">
                    <div class="d-flex justify-content-between">
                        <div class="logo">
                            <a href="#"><img src="{{asset('assets/images/logo/logo1.png')}}" style="heigth:80px" alt="Logo" srcset=""></a>
                        </div>
                        <div class="toggler">
                            <a href="#" class="sidebar-hide d-xl-none d-block"><i class="bi bi-x bi-middle"></i></a>
                        </div>
                    </div>
                </div>

                @include('layouts.aside')

                <button class="sidebar-toggler btn x"><i data-feather="x"></i></button>
            </div>
        </div>
        <div id="main">
            <header class="mb-3">
                <a href="#" class="burger-btn d-block d-xl-none">
                    <i class="bi bi-justify fs-3"></i>
                </a>
            </header>

            @yield('content')


        </div>
    </div>
    <script src="{{asset('assets/vendors/jquery.min.js')}}"></script>
    <script src="{{asset('assets/vendors/perfect-scrollbar/perfect-scrollbar.min.js')}}"></script>
    <script src="{{asset('assets/js/bootstrap.bundle.min.js')}}"></script>

    {{-- <script src="{{asset('assets/vendors/apexcharts/apexcharts.js')}}"></script> --}}
    {{-- <script src="{{asset('assets/js/pages/dashboard.js')}}"></script> --}}

    <script src="{{asset('assets/js/main.js')}}"></script>
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


