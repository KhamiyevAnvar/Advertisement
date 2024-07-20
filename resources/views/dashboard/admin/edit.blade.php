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

       {{-- @dd(request()); --}}
        <h1>Edit  admin</h1>
        <form method="POST" action="{{route("dashboard.site-admin.update", $admin->id)}}">
            @csrf
            <div class="form-group">
                <input type="text" name="name" class="form-control" value="{{ $admin->name}}" id=""  placeholder="Enter name">
                
            </div>    
            <div class="form-group">
                <input type="email" name="email" class="form-control" id="" value="{{ $admin->email}}" placeholder="Enter email">
            </div>
            <div class="form-group">
                <input type="password" name="password"  class="form-control" id=""  placeholder="Enter password">
            </div>
            
            <button type="submit" class="btn btn-primary">Update</button>
        </form>
   </div>
@endsection

