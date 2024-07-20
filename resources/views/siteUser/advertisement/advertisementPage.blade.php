@extends('siteUser.core.layout')

@section('content')
    <main>
        <section class="headerBottom p-4">
            <div class="header d-flex justify-content-between">
                <span class="fw-bold">ELAN YERLƏŞDİRMƏK</span>
                <!-- <span>Lorem lorem lorem</span> -->
            </div>
        </section>
        <section class="p-4">
            <div>
                <ul>
                    <li>
                        Üç ay ərzində bir nəqliyyat vasitəsi yalnız bir dəfə pulsuz dərc
                        oluna bilər.
                    </li>
                    <li>
                        Üç ay ərzində təkrar və ya oxşar elanlar (marka/model, rəng)
                        ödənişlidir.
                    </li>
                    <li>
                        Elanınızı saytın ön sıralarında görmək üçün "İrəli çək"
                        xidmətindən istifadə edin.
                    </li>
                </ul>
            </div>
            <form action="{{ route('createAdvertisement') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="row">
                    <div class="col-12 col-md-6">
                        <div class="newAutoFormBlock">
                            <label for="">Marka</label>
                            <select name="car_id" id="car_id" class="formAutoDesignSelect">
                                <option value="">Select</option>
                                @foreach ($cars as $car)
                                    <option value="{{ $car->id }}">{{ $car->name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="col-12 col-md-6">
                        <div class="newAutoFormBlock">
                            <label for="">Yanacaq növü </label>
                            <select name="fuel_type_id" id="" class="formAutoDesignSelect">
                                <option value="">Select</option>
                                @foreach ($fuels as $fuel)
                                    <option value="{{ $fuel->id }}">{{ $fuel->name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="col-12 col-md-6">
                        <div class="newAutoFormBlock">
                            <label for="model_id">Model </label>
                            <select name="model_id" id="model_id" class="formAutoDesignSelect">
                                <option value="">Select</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-12 col-md-6">
                        <div class="newAutoFormBlock">
                            <label for="">Ötürücü </label>
                            <select name="gear_id" id="" class="formAutoDesignSelect">
                                <option value="">Select</option>
                                @foreach ($gears as $gear)
                                    <option value="{{ $gear->id }}">{{ $gear->name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <div class="col-12 col-md-6">
                        <div class="newAutoFormBlock">
                            <label for="">Ban növü </label>
                            <select name="ban_id" id="" class="formAutoDesignSelect">
                                <option value="">Select</option>
                                @foreach ($bans as $ban)
                                    <option value="{{ $ban->id }}">{{ $ban->name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <!-- text radio -->

                    <div class="col-12 col-md-6">
                        <div class="newAutoFormBlock">
                            <label for="">İl </label>
                            <select name="year" id="" class="formAutoDesignSelect">
                                <option value="">Select</option>
                                @for ($i = date('Y'); $i > 1900; $i--)
                                    <option value="{{ $i }}">{{ $i }}</option>
                                @endfor
                            </select>
                        </div>
                    </div>
                    {{-- @dd($currencies) --}}
                    <div class="col-12 col-md-6 mt-4 pt-3">
                       
                        <div class="row ">
                            
                            <div class="col-md-6">
                                <label for="">Qiymet </label>
                                <div class="form-group">
                                    <input type="number" name="price" class="form-control" />
                                </div>
                            </div>
                            <div class="col-md-6">
                                <label for="">Valyuta </label>
                                <select class="form-control" name="currency_id">
                                    <option value="">Default select</option>
                                    @foreach ($currencies as $curren)
                                        <option value="{{ $curren->id }}">{{ $curren->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>

                    <div class="col-12 col-md-6">
                        <div class="newAutoFormBlock">
                            <label for="">Color </label>
                            <select name="color_id" id="" class="formAutoDesignSelect">
                                <option value="">Select</option>
                                @foreach ($colors as $color)
                                    <option value="{{ $color->id }}">{{ $color->name . ' - ' . $color->hex_code }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                    </div>


                    <div class="col-12 col-md-6">
                        <div class="form-group">
                            <label for="">Yurus (KM)</label>
                            <input type="text" name="distance" class="form-control" />
                        </div>
                    </div>

                    <div class="col-12 col-md-6">
                        <div class="form-group">
                            <label for="">Vin code</label>
                            <input type="text" name="vin_code" class="form-control" />
                        </div>
                    </div>
                </div>
                <div class="autoSupply mt-5">
                    <div class="autoSupplyName">Avtomobilin təchizatı</div>
                    <div class="row autoSupplyBlock">

                        @foreach ($suppliers as $supplier)
                            <div class="col-12 col-md-3">
                                <div class="autoSupplyBlockDesign">
                                    <input type="checkbox" name="supplier_ids[]" id="{{ $supplier->name }}"
                                        value="{{ $supplier->id }}" />
                                    <label for="{{ $supplier->name }}">{{ $supplier->name }}</label>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>

                <div class="row">
                    <div class="col-12">

                        <div class="mb-3">
                            <label for="formFile" class="form-label">Sekil elave edit</label>
                            <input class="form-control" type="file" name="photos[]" id="formFile" multiple>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-12">
                        <div class="form-floating">
                            <textarea class="form-control" placeholder="Leave a comment here" name="body" id="floatingTextarea2" style="height: 100px"></textarea>
                            <label for="floatingTextarea2">Qeyd</label>
                        </div>
                    </div>
                </div>

                <div class="contactInfo">
                    <div class="contactInfoName">Əlaqə</div>
                    <p>
                        Elan dərc olunduqdan sonra əlaqə məlumatları ilə bağlı heç bir
                        dəyişiklik həyata keçirilmir.
                    </p>
                    <div class="contactInfoBlock">
                        <div class="contactInfoDesign">
                            <label for="">Şəhər </label>
                            <select name="city_id" id="" class="contactInfoDesignInput">
                                <option value="">Select</option>
                                @foreach ($cities as $city)
                                    <option value="{{ $city->id }}">{{ $city->name }}</option>
                                @endforeach

                            </select>
                        </div>
                        <div class="addAutoSubButtonBlock">
                            <button type="submit" class="addAutoSubButton">
                                Davam et
                            </button>
                        </div>
                    </div>
                </div>
            </form>
        </section>
    </main>


    <script>
        $(document).on('change', '#car_id', async function(e) {

            var id = e.target.value;
            var link = 'http://localhost:8000/api/car-model/' + id;


            var data = '';
            console.log('dat1 :' + data);
            async function getData(file) {
                let x = await fetch(file).then((res) => res.json());
                return x;
            }



            data = await getData(link);

            console.log('dat2 :' + data);

            $("#model_id option").remove();
            $("#model_id").append("<option value=''>Select model</option>")
            data.map((item) => {
                $("#model_id").append("<option value=" + item['id'] + ">" + item['name'] + "</option>")
            })

        });
    </script>
@endsection
