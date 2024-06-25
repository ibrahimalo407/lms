@extends('layouts.admin')

@section('content')
<div class="container-fluid">
    <h2 class="mt-4 mb-4">Tableau de bord</h2>

    <!-- Graphiques -->
    <div class="row">
        <div class="col-lg-6 mb-4">
            <div class="card shadow-sm">
                <div class="card-header py-3 bg-primary text-white">
                    <h6 class="m-0 font-weight-bold">Nombre de cours par mois</h6>
                </div>
                <div class="card-body">
                    <canvas id="coursesChart" width="400" height="200"></canvas>
                </div>
            </div>
        </div>
        <div class="col-lg-6 mb-4">
            <div class="card shadow-sm">
                <div class="card-header py-3 bg-primary text-white">
                    <h6 class="m-0 font-weight-bold">Les 10 leçons les plus récentes</h6>
                </div>
                <div class="card-body">
                    <div class="list-group">
                        @foreach ($recentLessons as $lesson)
                        <a href="#" class="list-group-item list-group-item-action d-flex justify-content-between align-items-center">
                            <span>{{ $lesson->title }}</span>
                            <span class="badge bg-primary">{{ $lesson->course->title }}</span>
                        </a>
                        @endforeach
                        @if($recentLessons->isEmpty())
                            <p class="text-muted">Aucune leçon récente trouvée.</p>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-lg-6 mb-4">
            <div class="card shadow-sm">
                <div class="card-header py-3 bg-primary text-white">
                    <h6 class="m-0 font-weight-bold">Nombre d'inscriptions par mois</h6>
                </div>
                <div class="card-body">
                    <canvas id="enrollmentsChart" width="400" height="200"></canvas>
                </div>
            </div>
        </div>
        <div class="col-lg-6 mb-4">
            <div class="card shadow-sm">
                <div class="card-header py-3 bg-primary text-white">
                    <h6 class="m-0 font-weight-bold">Graphique des meilleurs étudiants</h6>
                </div>
                <div class="card-body">
                    <canvas id="topStudentsChart" width="400" height="400"></canvas>
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
        createLineChart('coursesChart', 'Nombre de cours par mois', coursesData, 'rgba(113, 88, 226, 0.2)', 'rgba(113, 88, 226, 1)');
        createBarChart('enrollmentsChart', 'Nombre d\'inscriptions par mois', enrollmentsData, 'rgba(255, 56, 56, 0.2)', 'rgba(255, 56, 56, 1)');
        createPolarAreaChart('topStudentsChart', 'Graphique des meilleurs étudiants', topStudentsData);

        // Fonction pour créer un graphique en ligne
        function createLineChart(canvasId, label, data, backgroundColor, borderColor) {
            var ctx = document.getElementById(canvasId).getContext('2d');
            new Chart(ctx, {
                type: 'line',
                data: {
                    labels: Object.keys(data),
                    datasets: [{
                        label: label,
                        data: Object.values(data),
                        backgroundColor: backgroundColor,
                        borderColor: borderColor,
                        borderWidth: 2,
                        fill: true,
                        tension: 0.4
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    scales: {
                        y: {
                            beginAtZero: true
                        }
                    },
                    plugins: {
                        legend: {
                            display: true,
                            position: 'bottom'
                        },
                        tooltip: {
                            enabled: true
                        }
                    },
                    animation: {
                        duration: 1000,
                        easing: 'easeInOutQuad'
                    }
                }
            });
        }

        // Fonction pour créer un diagramme en barres
        function createBarChart(canvasId, label, data, backgroundColor, borderColor) {
            var ctx = document.getElementById(canvasId).getContext('2d');
            new Chart(ctx, {
                type: 'bar',
                data: {
                    labels: Object.keys(data),
                    datasets: [{
                        label: label,
                        data: Object.values(data),
                        backgroundColor: backgroundColor,
                        borderColor: borderColor,
                        borderWidth: 2
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    scales: {
                        y: {
                            beginAtZero: true
                        }
                    },
                    plugins: {
                        legend: {
                            display: true,
                            position: 'bottom'
                        },
                        tooltip: {
                            enabled: true
                        }
                    },
                    animation: {
                        duration: 1000,
                        easing: 'easeInOutQuad'
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
                    label: label,
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
                responsive: true,
                maintainAspectRatio: false,
                scales: {
                    r: {
                        beginAtZero: true,
                        max: 20, // Score max
                        stepSize: 2 // Pas de 2 sur l'axe des y
                    }
                },
                plugins: {
                    legend: {
                        display: true,
                        position: 'bottom'
                    },
                    tooltip: {
                        enabled: true
                    }
                },
                animation: {
                    duration: 1000,
                    easing: 'easeInOutQuad'
                }
            };

            var ctx = document.getElementById(canvasId).getContext('2d');
            new Chart(ctx, {
                type: 'polarArea',
                data: polarData,
                options: options
            });
        }
    });
</script>
@endsection
