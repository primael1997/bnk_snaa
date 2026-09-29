@extends('layouts.theme')

@section('content')

    @push('link')
        <link rel="stylesheet" href="{{asset('assets/vendors/dripicons/webfont.css')}}">
        <link rel="stylesheet" href="{{asset('assets/css/pages/dripicons.css')}}">

        <style>
            #chart {
                max-width: 1000px;
                margin: 35px auto;
                }
        </style>
    @endpush

    <div class="page-heading">
        <h3>Tableau de board</h3>
    </div>

    <div class="page-content">
        <section class="row">
            <div class="col-12 col-lg-12">
                <div class="row">
                    <div class="col-6 col-lg-3 col-md-6">
                        <div class="card">
                            <div class="card-body px-3 py-4-5">
                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="stats-icon purple">
                                            <i class="icon dripicons-article"></i>
                                        </div>
                                    </div>
                                    <div class="col-md-8">
                                        <h6 class="text-muted font-semibold">Total actes numérisés</h6>
                                        <h6 class="font-extrabold mb-0">{{$tatal_actes}}</h6>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-6 col-lg-3 col-md-6">
                        <div class="card">
                            <div class="card-body px-3 py-4-5">
                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="stats-icon blue">
                                            <i class="icon dripicons-view-thumb"></i>
                                        </div>
                                    </div>
                                    <div class="col-md-8">
                                        <h6 class="text-muted font-semibold">Nombre de dossier</h6>
                                        <h6 class="font-extrabold mb-0">{{$total_types}}</h6>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-6 col-lg-3 col-md-6">
                        <div class="card">
                            <div class="card-body px-3 py-4-5">
                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="stats-icon red">
                                            <i class="iconly-boldBookmark"></i>
                                        </div>
                                    </div>
                                    <div class="col-md-8">
                                        <h6 class="text-muted font-semibold">Nombre de teléchargement</h6>
                                        <h6 class="font-extrabold mb-0">{{$nbre_download}}</h6>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-6 col-lg-3 col-md-6">
                        <div class="card">
                            <div class="card-body px-3 py-4-5">
                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="stats-icon green">
                                            <i class="iconly-boldAdd-User"></i>
                                        </div>
                                    </div>
                                    <div class="col-md-8">
                                        <h6 class="text-muted font-semibold">Nombre d'utilisateurs</h6>
                                        <h6 class="font-extrabold mb-0">{{$nbre_users}}</h6>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-6">
                        <div class="card">
                            <div class="card-header">
                                <h4>Graphe de numérisation des actes administatifs</h4>
                            </div>
                            <div class="card-body">
                                <div id="chart">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="card">
                            <div class="card-header">
                                <h4>Graphe de classification des types d'acte</h4>
                            </div>
                            <div class="card-body">
                                <div id="chart2">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </section>
    </div>

@endsection

@push('scripts')
    <script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>

    <script>
        var options = {
            chart: {
                type: 'bar',
            },
            series: [{
                name: 'Numérisations',
                data: @json($data)
            }],
            xaxis: {
                    categories: [
                        'Janvier',
                        'Février',
                        'Mars',
                        'Avril',
                        'Mai',
                        'Juin',
                        'Juillet',
                        'Août',
                        'Septembre',
                        'Octobre',
                        'Novembre',
                        'Décembre'
                    ]
                }
            }

            var chart = new ApexCharts(document.querySelector("#chart"), options);

            chart.render();
    </script>

    <script>
        var options = {
        series: @json($series),
        chart: {
            width: 500,
            type: 'pie',
        },
        labels: @json($labels),
        responsive: [
            {
            breakpoint: 480,
            options: {
                chart: {
                width: 200,
                },
                legend: {
                position: 'bottom',
                },
            },
            },
        ],
        }

        var chart = new ApexCharts(document.querySelector('#chart2'), options)
        chart.render()

    </script>

@endpush
