@extends('dashboard.core.layout')

{{-- @dd($advertisements); --}}

@section('content')
    <div class="container-fluid">
        <div class="d-flex justify-content-between align-items-center py-3">
            <h3>Advertisements</h3>
            <div class="d-flex">
                <a href="{{route("dashboard.export.advertisement")}}" class="btn btn-success">
                    <i class="fa fa-file-excel"></i>
                </a>
            </div>
        </div>

        <form method="GET" action="{{ route('dashboard.advertisement.index') }}">
            @csrf
            <div class="d-flex align-items-end">
                <div class="form-group mr-3">

                    <label for="">Applier</label>
                    <input type="text" name="creator" value="{{ request()->creator }}" class="form-control"
                        id="exampleInputEmail1" placeholder="Applier">
                </div>
                <div class="form-group mr-3">

                    <label for="">Car</label>
                    <input type="text" name="car" value="{{ request()->car }}" class="form-control"
                        id="exampleInputEmail1" placeholder="Enter car ">
                </div>

                <div class="form-group mr-3">

                    <label for="">Model</label>
                    <input type="text" name="model" value="{{ request()->model }}" class="form-control"
                        id="exampleInputEmail1" placeholder="Enter model ">
                </div>

                <button type="submit" class="btn btn-primary mb-3"><i class="fa fa-search"></i></button>
                <a href="{{ route('dashboard.advertisement.index') }}" class="btn btn-warning mb-3 ml-2"><i
                        class="fa fa-rotate"></i></a>
            </div>
        </form>

        <table class="table table-striped">
            <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Applier</th>
                    <th scope="col">Car</th>
                    <th scope="col">Model </th>
                    <th scope="col">Price </th>
                    <th scope="col">Created at </th>
                    <th scope="col">Status </th>
                    <th scope="col">Actions</th>
                </tr>
            </thead>
            <tbody>
               

                @foreach ($advertisements as $item)
                    <tr>
                        <th scope="row">{{ $loop->iteration }}</th>
                        <td>{{ $item->creator }}</td>
                        <td>{{ $item->car }}</td>
                        <td>{{ $item->model }}</td>
                        <td>{{ $item->price }}</td>
                        <td>{{ $item->created_at }}</td>

                        <td class="{{$item->status_color }}">{{ $item->advertisementLabel }}</td>

                        <td>
                            <a href="{{route('dashboard.advertisement.show' , $item->id)}}" class="btn btn-sm btn-warning">
                                <i class="fa fa-eye"></i>
                            </a>
                            @if ($item->status == 1)
                                <a href="{{route('dashboard.advertisement.approve' , $item->id)}}" class="btn btn-sm btn-success">
                                    <i class="fa fa-check"></i>
                                </a>
                                <a href="{{route('dashboard.advertisement.reject' , $item->id)}}" class="btn btn-sm btn-danger">
                                    <i class="fa fa-x"></i>
                                </a>
                            @endif

                        </td>
                    </tr>
                @endforeach

            </tbody>
        </table>

        <div class="d-flex justify-content-center mt-4">
            {{ $advertisements->links() }}
        </div>
    </div>
@endsection
