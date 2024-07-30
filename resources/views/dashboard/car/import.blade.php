@extends('dashboard.core.layout')

@section('content')
    <div class="container">
        <h3 class="mb-4">Import cars</h3>
        <form action="{{route("dashboard.car.import")}}" method="POST" enctype="multipart/form-data">
          @csrf
            <div class="input-group mb-3">
                <div class="input-group-prepend">
                    <span class="input-group-text" id="inputGroupFileAddon01">Upload</span>
                </div>
                <div class="custom-file">
                    <input type="file" name="cars" class="custom-file-input" id="inputGroupFile01"
                        aria-describedby="inputGroupFileAddon01">
                    <label class="custom-file-label" for="inputGroupFile01">Choose file</label>
                </div>
            </div>
            <button class="btn btn-primary" type="submit">Import </button>
        </form>
    </div>
@endsection
