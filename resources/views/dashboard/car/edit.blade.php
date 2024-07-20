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
        <h1>Edit</h1>
        <form method="POST" action="{{route("dashboard.car.update", $car->id)}}">
            @csrf
            <div class="form-group">
            
            <input type="text" name="name" value="{{$car->name}}" class="form-control" id="exampleInputEmail1"  placeholder="Edit car name">
            </div>
            
            <button type="submit" class="btn btn-primary">Update</button>
        </form>
   </div>
@endsection

