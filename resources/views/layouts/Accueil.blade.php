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

        <script>
            const data = {
                labels: [
                    'Red',
                    'Blue',
                    'Yellow'
                ],
                datasets: [{
                    label: 'My First Dataset',
                    data: [300, 50, 100],
                    backgroundColor: [
                        'rgb(255, 99, 132)',
                        'rgb(54, 162, 235)',
                        'rgb(255, 205, 86)'
                    ],
                    hoverOffset: 4
                }]
            };
            const config = {
                type: 'pie',
                data: data,
            };
        </script>
    </div>
@endsection
