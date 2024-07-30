@extends('dashboard.core.layout')

@section('content')
    <div class="container-fluid">
        <div class="d-flex justify-content-between py-3">
            <h3>Cars</h3>
           
            <div class="d-flex">
                <div>
                    <a href="{{route("dashboard.car.import-view")}}" class="btn btn-sm btn-success">
                       Import excel
                    </a>
                </div>
                <div class="ml-3">
                    <a href="{{ route('dashboard.car.deleted') }}" class="btn btn-sm btn-warning">Trash</a>
                </div>
                <div class="ml-3">
                    <a href="{{ route('dashboard.car.create') }}" class="btn btn-sm btn-primary">Add new</a>
                </div>
            </div>
        </div>

        <form method="GET" action="{{ route('dashboard.car.index') }}">
            @csrf
            <div class="d-flex align-items-end">
                <div class="form-group mr-3">

                    <label for="">Name</label>
                    <input type="text" name="name" value="{{ request()->name }}" class="form-control"
                        id="exampleInputEmail1" placeholder="Enter car name">
                </div>
                <div class="form-group mr-3">

                    <label for="">Creator</label>
                    <input type="text" name="creator" value="{{ request()->creator }}" class="form-control"
                        id="exampleInputEmail1" placeholder="Enter car creator">
                </div>

                <button type="submit" class="btn btn-primary mb-3"><i class="fa fa-search"></i></button>
                <a href="{{ route('dashboard.car.resetFilter') }}" class="btn btn-warning mb-3 ml-2"><i
                        class="fa fa-rotate"></i></a>
            </div>
        </form>

        <table class="table table-striped">
            <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Name</th>
                    <th scope="col">Creator</th>
                    <th scope="col">Created At</th>
                    <th scope="col">Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($cars as $car)
                    <tr>
                        <th scope="row">{{ $loop->iteration }}</th>
                        <td>{{ $car->name }}</td>
                        <td>{{ $car->creator }}</td>
                        <td>{{ date('d-m-Y', strtotime($car->created_at)) }}</td>
                        <td>
                            <a href="{{ route('dashboard.car.edit', $car->id) }}" class="btn btn-sm btn-primary">
                                <i class="fa fa-pen"></i>
                            </a>
                            <a href="{{ route('dashboard.car.delete', $car->id) }}" class="btn btn-sm btn-danger">
                                <i class="fa fa-trash"></i>
                            </a>
                        </td>
                    </tr>
                @endforeach

            </tbody>
        </table>

        <div class="d-flex justify-content-center mt-4">
            {{ $cars->links() }}
        </div>
    </div>
@endsection
