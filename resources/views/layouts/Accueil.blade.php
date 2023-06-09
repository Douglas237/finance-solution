@extends('layouts.dashboard')

@section('content')
    <div class="container">
        <div class="card" style="width: 18rem;">
            <div class="card-body">
                <h2 class="card-title" style="color:#fff; text-align:center;">Clients</h2>
                <div class="imag">
                    <a href=""><i class="fa fa-user" aria-hidden="true"
                            style="margin-right: 1.3rem;font-size: 5em;color: #fff;"></i></a>
                    <h1>{{ $clients }}</h1>
                </div>
            </div>
        </div>
        <div class="card" style="width: 18rem;">
            <div class="card-body">
                <h2 class="card-title" style="color:#fff; text-align:center;">Comptes</h2>
                <div class="imag">
                    <a href="">
                        <i class="fa-sharp fa-light fa-earth-americas" aria-hidden="true"
                            style="margin-right: 1.3rem;font-size: 5em;color: #ffffff;"></i></a>
                    <h1>{{ $compte }}</h1>
                </div>
            </div>
        </div>
        <div class="card" style="width: 18rem;">
            <div class="card-body" style="">
                <h2 class="card-title" style="color:#fff; text-align:center;">Entreprises</h2>
                <div class="imag">
                    <a href=""><i class="fa fa-building" aria-hidden="true"
                            style="margin-right: 1.3rem;font-size: 5em;color: #fff;"></i></a>
                    <h1>{{ $entreprises }}</h1>
                </div>
            </div>
        </div>
        <div class="card" style="width: 18rem;">
            <div class="card-body">
                <h2 class="card-title" style="color:#fff; text-align:center;">Employés</h2>
                <div class="imag">
                    <a href=""><i class="fa fa-users left" aria-hidden="true"
                            style="margin-right: 0.7rem;font-size: 5em;color: #fff;"></i></a>
                    <h1>{{ $employes }}</h1>
                </div>
            </div>
        </div> 
    </div>
    <div class="col-md-12">
        <div class="col-md-6">
            <canvas id="myChart"></canvas>
        </div>
        <div class="col-md-6">
            <canvas id="myChart"></canvas>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script type="text/javascript">
        var months = JSON.parse('{!!json_encode($months) !!}');
        var monthCount = JSON.parse('{!!json_encode($monthCount) !!}');
    </script>
    <script>
        const ctx = document.getElementById('myChart');
      
        new Chart(ctx, {
          type: 'bar',
          data: {
            labels: months,
            datasets: [{
              label: 'nouveaux clients',
              data: monthCount,
              backgroundColor: [
                'rgba(2, 80, 28)',
              ],
              borderWidth: 1
            }]
          },
          options: {
            scales: {
              y: {
                beginAtZero: true
              }
            }
          }
        });
    </script>          
@endsection
