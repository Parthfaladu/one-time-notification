@extends('layouts.base')

@section('body')
    <div class="row col-sm-12 h5 ml-1 mb-4">Welcom, {{ $user->name }}</div>
    <div class="col-lg-4 col-6">
        <div class="p-3 text-white bg-info">
            <div class="inner">
                <h3>{{ $user->notifications()->count() }}</h3>
                <p>Total Notifications</p>
            </div>
            <div class="icon">
                <i class="ion ion-bag"></i>
            </div>
        </div>
    </div>

    <div class="col-lg-4 col-6">

        <div class="p-3 text-white bg-warning">
            <div class="inner">
                <h3>44 €</h3>
                <p>Credits</p>
            </div>
            <div class="icon">
                <i class="ion ion-person-add"></i>
            </div>
        </div>
    </div>

    <div class="col-lg-4 col-6">

        <div class="p-3 text-white bg-danger">
            <div class="inner">
                <h3>650 €</h3>
                <p>Spend credits</p>
            </div>
            <div class="icon">
                <i class="ion ion-pie-graph"></i>
            </div>
        </div>
    </div>
@endsection
