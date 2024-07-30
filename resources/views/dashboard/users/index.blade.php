@extends('dashboard.core.layout')

@section('content')

<div class="container-fluid">
  <div class="d-flex justify-content-between py-3">
    <h3>Site registered sers</h3>
    
  </div>

  <form method="GET" action="{{route("dashboard.site-user.index")}}">
      @csrf
      <div class="d-flex align-items-end">
        <div class="form-group mr-3">
      
          <label for="">Name</label>
          <input type="text" name="name" value="{{request()->name}}" class="form-control" id="exampleInputEmail1"  placeholder="User name">
        </div>
        <div class="form-group mr-3">
        
          <label for="">Email</label>
          <input type="text" name="email" value="{{request()->email}}" class="form-control" id="exampleInputEmail1"  placeholder="Enter user email ">
        </div>
        
        <button type="submit" class="btn btn-primary mb-3"><i class="fa fa-search"></i></button>
        <a href="{{route("dashboard.site-user.index")}}"  class="btn btn-warning mb-3 ml-2"><i class="fa fa-rotate"></i></a>
      </div>
  </form>

  <table class="table table-striped">
    <thead>
      <tr>
        <th scope="col">#</th>
        <th scope="col">Name</th>
        <th scope="col">Email</th>
        <th scope="col">Phone</th>
        <th scope="col">Email verified at</th>
      </tr>
    </thead>
    <tbody>
      @foreach ($users as $user)
      <tr>
        <th scope="row">{{$loop->iteration}}</th>
        <td>{{$user->name}}</td>
        <td>{{$user->email}}</td>
        <td>{{$user->phone}}</td>
        <td>{{$user->email_verified_at}}</td>
      </tr>
      @endforeach
    
    </tbody>
</table>

<div class="d-flex justify-content-center mt-4">
  {{$users->links()}}
</div>
</div>

@endsection