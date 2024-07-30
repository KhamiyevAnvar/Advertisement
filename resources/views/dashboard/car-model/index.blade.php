@extends('dashboard.core.layout')

@section('content')

<div class="container-fluid">
  <div class="d-flex justify-content-between py-3">
    <h3>Cars models</h3>
    <div class="d-flex">
      <div>
        <a href="{{route("dashboard.car-model.deleted")}}" class="btn btn-sm btn-warning">Trash</a>
      </div>
      <div class="ml-3">
        <a href="{{route("dashboard.car-model.create")}}" class="btn btn-sm btn-primary">Add new</a>
      </div>
    </div>
  </div>

  <form method="GET" action="{{route("dashboard.car-model.index")}}">
      @csrf
      <div class="d-flex align-items-end">
        <div class="form-group mr-3">
          <label for="">Model</label>
          <input type="text" name="model" value="{{request()->model}}" class="form-control" id="exampleInputEmail1"  placeholder="Enter car creator">
        </div>

        <div class="form-group mr-3">
          <label for="">Car</label>
          <input type="text" name="car" value="{{request()->car}}" class="form-control" id="exampleInputEmail1"  placeholder="Enter car name">
        </div>
        
        <div class="form-group mr-3">
          <label for="">Creator</label>
          <input type="text" name="creator" value="{{request()->creator}}" class="form-control" id="exampleInputEmail1"  placeholder="Enter car creator">
        </div>
        
        <button type="submit" class="btn btn-primary mb-3"><i class="fa fa-search"></i></button>
        <a href="{{route("dashboard.car-model.index")}}"  class="btn btn-warning mb-3 ml-2"><i class="fa fa-rotate"></i></a>
      </div>
  </form>

  <table class="table table-striped">
    <thead>
      <tr>
        <th scope="col">#</th>
        <th scope="col">Model name</th>
        <th scope="col">Car name</th>
        <th scope="col">Creator</th>
        <th scope="col">Created At</th>
        <th scope="col">Actions</th>
      </tr>
    </thead>
    <tbody>
      @foreach ($carModel as $model)
      <tr>
        <th scope="row">{{$loop->iteration}}</th>
        <td>{{$model->model}}</td>
        <td>{{$model->car}}</td>
        <td>{{$model->creator}}</td>
        <td>{{date( "d-m-Y", strtotime($model->modelCreated))}}</td>
        <td>
            <a href="{{route("dashboard.car-model.edit", $model->model_id)}}" class="btn btn-sm btn-primary">
                <i class="fa fa-pen"></i>
            </a>
            <a href="{{route("dashboard.car-model.delete" , $model->model_id)}}" class="btn btn-sm btn-danger">
                <i class="fa fa-trash"></i>
            </a>
        </td>
      </tr>
      @endforeach
    
    </tbody>
</table>

<div class="d-flex justify-content-center mt-4">
  {{$carModel->links()}}
</div>
</div>

@endsection