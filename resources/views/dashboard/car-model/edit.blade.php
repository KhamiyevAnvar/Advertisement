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
        <h1>Edit car model</h1>
        <form method="POST" action="{{route("dashboard.car-model.update", $carModel->id)}}">
            @csrf

            <div class="form-group">
                <select name="car" id="" class="form-control">
                    <option value="">Choose car model</option>
                    @foreach($cars as $car)
                        <option value="{{$car->id}}" @if($carModel->car_id == $car->id ) selected @endif>{{$car->name}}</option>
                    @endforeach
                   
                </select>
            </div>

            <div class="form-group">
                <input type="text" name="model" value="{{$carModel->name}}" class="form-control" id="exampleInputEmail1"  placeholder="Edit car name">
            </div>
            
            <button type="submit" class="btn btn-primary">Update</button>
        </form>
   </div>
@endsection

