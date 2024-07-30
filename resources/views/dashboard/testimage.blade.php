

<form method="Post" action="{{route("dashboard.car.imageUploads")}}" enctype="multipart/form-data">
    @csrf
    <div class="d-flex align-items-end">
      <div class="form-group mr-3">
    
        <label for="">Image</label>
        <input type="file" name="testImg" class="form-control" id="exampleInputEmail1"  placeholder="Enter car name">
      </div>
      
      
      <button type="submit" class="btn btn-primary mb-3">save</button>
      {{session('data')}}
    </div>
</form>
