@extends('layouts.dashboard')

@section('content')
    <div class="infoclient">
        <h1>Detail</h1>
        <div class="corpclient">
            <div class="col-12 carteD">
                <div class="card1">
                    {{-- <img src="" alt="Avatar" style=""> --}}
                    <div class="container1">
                        <div class="bottom-left1">
                           <h4><b>FINANCE-SOLUTION</b></h4>
                        </div>
                        <div class="top-right1">
                            <h4><b> {{ $shows->type }}</b></h4>
                        </div>
                        <div class="centered">
                            <h1><b>{{ $shows->numero_carte}}</b></h1>
                        </div>
                        <div class="puce">
                            <img src="{{asset('img-side/11.png')}}" alt="">
                        </div>
                        <div class="bottom-right">
                            <img src="{{asset('img-side/12.png')}}" alt="">
                            <img src="{{asset('img-side/13.png')}}" alt="">
                        </div>
                    </div>
                  </div>
                  <div class="card1">
                    {{-- <img src="" alt="Avatar" style=""> --}}
                    <div class="container1">
                        <div class="band">
                          <p>m</p>
                        </div>
                      <h4><b>John Doe</b></h4>
                      <p>Architect & Engineer</p>
                    </div>
                  </div>

            </div>

        </div>
    </div>
@stop
