@extends('dashboard.core.layout')

@section('content')

   <div class="container-fluid">
        @if ($errors->any())
            <div class="alert alert-danger ">
                <ul class="m-0">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        <h1>Create car model</h1>
        <form method="POST" action="{{route("dashboard.car-model.store")}}">
            @csrf

            <div class="form-group">
                <select name="car" id="" class="form-control">
                    <option value="">Choose car model</option>
                    @foreach($cars as $car)
                        <option value="{{$car->id}}">{{$car->name}}</option>
                    @endforeach
                   
                </select>
            </div>

            <div class="form-group">
                <input type="text" name="model" class="form-control" id="exampleInputEmail1"  placeholder="Create car model">
            </div>
            
            <button type="submit" class="btn btn-primary">Create</button>
        </form>
   </div>
@endsection

