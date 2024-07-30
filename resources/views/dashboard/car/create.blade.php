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
        <h1>Create</h1>
        <form method="POST" action="{{route("dashboard.car.store")}}">
            @csrf
            <div class="form-group">
            
            <input type="text" name="name" value="" class="form-control" id="exampleInputEmail1"  placeholder="Enter car name">
            </div>
            
            <button type="submit" class="btn btn-primary">Create</button>
        </form>
   </div>
@endsection

