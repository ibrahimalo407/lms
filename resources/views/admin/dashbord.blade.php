@extends('layouts.admin')

@section('content')
<div class="container-fluid">
    <h2 class="mt-4 mb-4">Tableau de bord</h2>

    <!-- Graphiques -->
    <div class="row">
        <div class="col-lg-6">
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Nombre de cours par mois</h6>
                </div>
                <div class="card-body">
                    <canvas id="coursesChart" width="400" height="200"></canvas>
                </div>
            </div>
        </div>
        <div class="col-lg-6">
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Les 10 leçons les plus récentes</h6>
                </div>
                <div class="card-body">
                    <div class="list-group">
                        @foreach ($recentLessons as $lesson)
                        <a href="#" class="list-group-item list-group-item-action">
                            <div class="d-flex justify-content-between align-items-center">
                                <span>{{ $lesson->title }}</span>
                                <span class="badge badge-primary badge-pill">{{ $lesson->course->title }}</span>
                            </div>
                        </a>                       
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row mt-4">
        <div class="col-lg-6">
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Nombre d'inscriptions par mois</h6>
                </div>
                <div class="card-body">
                    <canvas id="enrollmentsChart" width="400" height="200"></canvas>
                </div>
            </div>
        </div>
        <div class="col-lg-6">
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Graphique des meilleurs étudiants</h6>
                </div>
                <div class="card-body">
                    <canvas id="topStudentsChart" width="800" height="400"></canvas>
                </div>
            </div>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    document.addEventListener("DOMContentLoaded", function() {
        // Récupération des données des graphiques
        var coursesData = {!! json_encode($coursesData) !!};
        var enrollmentsData = {!! json_encode($enrollmentsData) !!};
        var topStudentsData = {!! json_encode($topStudentsData) !!};

        // Création des graphiques
        createChart('coursesChart', 'Nombre de cours par mois', coursesData, 'bar', '#7158e2');
        createChart('enrollmentsChart', 'Nombre d\'inscriptions par mois', enrollmentsData, 'pie', '#ff3838');
        createPolarAreaChart('topStudentsChart', 'Graphique des meilleurs étudiants', topStudentsData);

        // Fonction pour créer un graphique
        function createChart(canvasId, label, data, type, backgroundColor) {
            var ctx = document.getElementById(canvasId).getContext('2d');
            new Chart(ctx, {
                type: type,
                data: {
                    labels: Object.keys(data),
                    datasets: [{
                        label: label,
                        data: Object.values(data),
                        backgroundColor: backgroundColor
                    }]
                },
                options: {
                    scales: {
                        yAxes: [{
                            ticks: {
                                beginAtZero: true
                            }
                        }]
                    }
                }
            });
        }

        // Fonction pour créer un Polar Area Chart
        function createPolarAreaChart(canvasId, label, data) {
            const names = Object.keys(data);
            const scores = Object.values(data);

            const polarData = {
                labels: names,
                datasets: [{
                    label: 'Scores des étudiants',
                    data: scores,
                    backgroundColor: [
                        '#FF6384',
                        '#4BC0C0',
                        '#FFCE56',
                        '#E7E9ED',
                        '#36A2EB'
                    ]
                }]
            };

            const options = {
                scale: {
                    ticks: {
                        beginAtZero: true,
                        max: 20, // Score max
                        stepSize: 2 // Pas de 2 sur l'axe des y
                    },
                    reverse: false
                }
            };

            var ctx = document.getElementById(canvasId).getContext('2d');
            var myChart = new Chart(ctx, {
                type: 'polarArea',
                data: polarData,
                options: options
            });
        }
    });
</script>
@endsection
