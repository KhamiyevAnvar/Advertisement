@extends('siteUser.core.layout')

@section('content')
    {{-- @include('siteUser.core.filter') --}}
    <main>
        <section class="filter p-4">
            <form class="row" action="" method="GET">
                <div class="col-12 col-md-3">
                    {{-- <input type="hidden" name="current_page" value=""> --}}
                    <select class="form-element pr-2" name='car_id'>
                        <option value="">Car</option>
                        @foreach ($cars as $car)
                            <option value="{{ $car->id }}" {{request()->car_id== $car->id  ? 'selected' : ''}}>{{ $car->name }}</option>
                        @endforeach
                    </select>
                    
                </div>
                <div class="col-12 col-md-3">
                  <select class="form-element pr-2" name='fuel_id'>
                    <option value="">Fuel</option>
                    @foreach ($fuels as $fuel)
                        <option value="{{ $fuel->id }}" {{request()->fuel_id ==$fuel->id ? 'selected' : ''}} >{{ $fuel->name }}</option>
                    @endforeach
                </select>
                </div>

                <div class="col-12 d-flex justify-content-end">
                    <button class="btn btn-danger">Axtar</button>
                </div>
            </form>
        </section>
        <section class="announcement p-4">
            <div class="header d-flex justify-content-between">
                <span class="fw-bold">PREMİUM ELANLAR</span>
                <span>Lorem lorem lorem</span>
            </div>
            <div class="row mt-4">
                @foreach ($advertisements as $advertisement)
                    <div class="col-12 col-md-3">
                        <a href="{{ route('showAdvertisement', $advertisement->id) }}" target="_blank" class="card">
                            <div class="position-relative">
                                <img src="https://turbo.azstatic.com/assets/application/sprites/main-81621bca022dacba82baf03eb6a48661caa4cadfcac266156ebeadeb662d1b14.svg#bookmarks--favorite-unselected"
                                    class="like-icon" />
                                <span class="robbin">Salon</span>
                                <img class="card-img-top"
                                    src="{{ $advertisement->photo ? asset($advertisement->photo->photo) : '' }}"
                                    alt="" />
                            </div>
                            <div class="card-body">
                                <div class="gap-1">
                                    <span class="price">{{ $advertisement->price }}</span>
                                    <span class="model">{{ $advertisement->car }}</span>
                                    <span
                                        class="info">{{ $advertisement->year . ', ' . $advertisement->distance . ' km' }}</span>
                                    <span class="location-info">
                                        {{ $advertisement->city . ', ' . $advertisement->updated_at }}</span>
                                </div>
                            </div>
                        </a>
                    </div>
                @endforeach
            </div>
            <div class="d-flex justify-content-center mt-4">
                <div>
                    {{ $advertisements->links() }}
                </div>
            </div>
        </section>
    </main>
@endsection
