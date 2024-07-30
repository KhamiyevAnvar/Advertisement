@extends('dashboard.core.layout')

@section('content')

<div class="container-fluid">
  <div class="d-flex justify-content-between py-3">
    <h3>Admins</h3>
    <div class="d-flex">
      <div>
        <a href="{{route("dashboard.car.deleted")}}" class="btn btn-sm btn-warning">Trash</a>
      </div>
      <di v class="ml-3">
        <a href="{{route("dashboard.site-admin.createPage")}}" class="btn btn-sm btn-primary">Add new</a>
      </di>
    </div>
  </div>

  {{-- <form method="GET" action="{{route("dashboard.car.index")}}">
      @csrf
      <div class="d-flex align-items-end">
        <div class="form-group mr-3">
      
          <label for="">Name</label>
          <input type="text" name="name" value="{{request()->name}}" class="form-control" id="exampleInputEmail1"  placeholder="Enter car name">
        </div>
        <div class="form-group mr-3">
        
          <label for="">Creator</label>
          <input type="text" name="creator" value="{{request()->creator}}" class="form-control" id="exampleInputEmail1"  placeholder="Enter car creator">
        </div>
        
        <button type="submit" class="btn btn-primary mb-3"><i class="fa fa-search"></i></button>
        <a href="{{route("dashboard.car.resetFilter")}}"  class="btn btn-warning mb-3 ml-2"><i class="fa fa-rotate"></i></a>
      </div>
  </form> --}}

  <table class="table table-striped">
    <thead>
      <tr>
        <th scope="col">#</th>
        <th scope="col">Name</th>
        <th scope="col">Email</th>
        <th scope="col">Created At</th>
        <th scope="col">Updated At</th>
        <th scope="col">Actions</th>
      </tr>
    </thead>
    <tbody>
      @foreach ($admins as $admin)
      <tr>
        <th scope="row">{{$loop->iteration}}</th>
        <td>{{$admin->name}}</td>
        <td>{{$admin->email}}</td>
        <td>{{date( "d-m-Y", strtotime($admin->created_at))}}</td>
        <td>{{date( "d-m-Y", strtotime($admin->updated))}}</td>
        <td>
            <a href="{{route("dashboard.site-admin.edit", $admin->id)}}" class="btn btn-sm btn-primary">
                <i class="fa fa-pen"></i>
            </a>
            <a href="{{route("dashboard.site-admin.delete" , $admin->id)}}" class="btn btn-sm btn-danger">
                <i class="fa fa-trash"></i>
            </a>
        </td>
      </tr>
      @endforeach
    
    </tbody>
</table>

<div class="d-flex justify-content-center mt-4">
  {{$admins->links()}}
</div>
</div>

@endsection