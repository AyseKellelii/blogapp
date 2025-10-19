@extends('panel.app')

@section('content')
    <div class="content-wrapper">
        <div class="container-xxl flex-grow-1 container-p-y">

            <!-- Sayı Kutuları -->
            <div class="row mb-4">
                <div class="col-md-3">
                    <div class="card text-center shadow-sm border-primary">
                        <div class="card-body">
                            <h5 class="text-primary">Toplam Kategoriler</h5>
                            <h2>{{ $totalCategories }}</h2>
                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="card text-center shadow-sm border-info">
                        <div class="card-body">
                            <h5 class="text-info">Toplam Bloglar</h5>
                            <h2>{{ $totalPosts }}</h2>
                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="card text-center shadow-sm border-success">
                        <div class="card-body">
                            <h5 class="text-success">Yayınlanmış</h5>
                            <h2>{{ $publishedPosts }}</h2>
                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="card text-center shadow-sm border-warning">
                        <div class="card-body">
                            <h5 class="text-warning">Taslak / Yayınlanmamış</h5>
                            <h2>{{ $unpublishedPosts }}</h2>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Grafikler -->
            <div class="row">
                <div class="col-lg-8">
                    <div class="card shadow-sm mb-4">
                        <div class="card-header bg-primary text-white">
                            <h5 class="mb-0">Aylara Göre Yayınlanan Bloglar</h5>
                        </div>
                        <div class="card-body">
                            <canvas id="postsChart"></canvas>
                        </div>
                    </div>
                </div>

                <div class="col-lg-4">
                    <div class="card shadow-sm mb-4">
                        <div class="card-header bg-info text-white">
                            <h5 class="mb-0">Blog Yayın Durumu</h5>
                        </div>
                        <div class="card-body">
                            <canvas id="statusChart"></canvas>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- Chart.js --}}
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

    <script>
        // Aylara Göre Blog Grafiği
        const postsCtx = document.getElementById('postsChart').getContext('2d');
        new Chart(postsCtx, {
            type: 'line',
            data: {
                labels: @json($months),
                datasets: [{
                    label: 'Yayınlanan Blog Sayısı',
                    data: @json($postCounts),
                    borderColor: '#4e73df',
                    backgroundColor: 'rgba(78, 115, 223, 0.1)',
                    tension: 0.3,
                    fill: true
                }]
            }
        });

        // Yayın Durumu Grafiği
        const statusCtx = document.getElementById('statusChart').getContext('2d');
        new Chart(statusCtx, {
            type: 'doughnut',
            data: {
                labels: ['Yayınlanmış', 'Taslak'],
                datasets: [{
                    data: [{{ $publishedPosts }}, {{ $unpublishedPosts }}],
                    backgroundColor: ['#1cc88a', '#f6c23e'],
                    hoverOffset: 4
                }]
            }
        });
    </script>
@endsection
