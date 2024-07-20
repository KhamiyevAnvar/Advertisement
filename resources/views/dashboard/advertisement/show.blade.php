@extends('dashboard.core.layout')

{{-- @dd($advertisements); --}}

@section('content')
    <div class="container-fluid">
        <div class="d-flex justify-content-between py-3">
            <h3>Advertisement</h3>
        </div>
        <div class="mt-3">
            <div class="row">
                <div class="col-md-3">
                    <div class="card" >
                        <div class="card-header">
                            Details Label
                        </div>
                        <ul class="list-group list-group-flush">
                            <li class="list-group-item">About </li>
                            <li class="list-group-item">Creator </li>
                            <li class="list-group-item">Car </li>
                            <li class="list-group-item">Model </li>
                            <li class="list-group-item">Price </li>
                            <li class="list-group-item">Currency </li>
                            <li class="list-group-item">Year </li>
                            <li class="list-group-item">Color </li>
                            <li class="list-group-item">Distance </li>
                            <li class="list-group-item">Vin code </li>
                            <li class="list-group-item">City </li>
                            <li class="list-group-item">Techizat </li>
                            <li class="list-group-item">Sekiller </li>
                        </ul>
                    </div>
                </div>
                <div class="col-md-9">
                    <div class="card">
                        <div class="card-header">
                            Details Description
                        </div>
                        <ul class="list-group list-group-flush">
                            <li class="list-group-item">{{$advertisement->body}}</li>
                            <li class="list-group-item">{{$advertisement->creator}}</li>
                            <li class="list-group-item">{{$advertisement->car}}</li> 
                            <li class="list-group-item">{{$advertisement->model}}</li> 
                            <li class="list-group-item">{{$advertisement->price}}</li> 
                            <li class="list-group-item">{{$advertisement->currency}}</li> 
                            <li class="list-group-item">{{$advertisement->year}}</li>
                            <li class="list-group-item">{{$advertisement->color}}</li> 
                            <li class="list-group-item">{{$advertisement->distance}}</li>
                            <li class="list-group-item">{{$advertisement->vin_code}}</li>
                            <li class="list-group-item">{{$advertisement->city}}</li>
                            <li class="list-group-item">
                                @foreach($advertisement->suppliers as $supplier)
                                    {{$supplier->name}}
                                    @if($loop->iteration != count($advertisement->suppliers))
                                        ,
                                    @endif
                                @endforeach
                            </li>
                            <li class="list-group-item">
                                @foreach($advertisement->photos as $photo)
                                   <img src="{{$photo->photo}}" alt="" width="100px" height="80px" style="object-fit: cover">
                                @endforeach
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
