@extends('layouts.dashboard')

@section('content')

    <div class="card" style="width: 18rem;">
            <div class="card-body">
                <h2 class="card-title" style="color:#fff; text-align:center;">Clients</h2>
                <div class="imag">
                    <a href=""><i class="fa fa-user" aria-hidden="true" style="margin-right: 1.3rem;font-size: 5em;color: #fff;"></i></a>
                    <h1>{{ $clients }}</h1>
                </div>
            </div>
    </div>
          <div class="card" style="width: 18rem;">
            <div class="card-body">
                <h2 class="card-title" style="color:#fff; text-align:center;">Transactions</h2>
               <div class="imag">
                <a href=""><i class="fa fa-share" aria-hidden="true" style="margin-right: 1.3rem;font-size: 5em;color: #fff;"></i></a>
            </div>
            </div>
          </div>
          <div class="card" style="width: 18rem;">
            <div class="card-body" style="">
              <h2 class="card-title" style="color:#fff; text-align:center;">Entreprises</h2>
              <div class="imag">
                <a href=""><i class="fa fa-building" aria-hidden="true" style="margin-right: 1.3rem;font-size: 5em;color: #fff;"></i></a>
                <h1>{{ $entreprises }}</h1>
            </div>
            </div>
          </div>
          <div class="card" style="width: 18rem;">
            <div class="card-body">
                <h2 class="card-title" style="color:#fff; text-align:center;">Employés</h2>
                <div class="imag">
                    <a href=""><i class="fa fa-users left" aria-hidden="true" style="margin-right: 0.7rem;font-size: 5em;color: #fff;"></i></a>
                    <h1>{{ $employes }}</h1>
                </div>
            </div>
            </div>

@endsection
