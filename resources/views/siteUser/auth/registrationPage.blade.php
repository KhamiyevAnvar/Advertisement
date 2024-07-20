<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8" />
        <meta
            name="viewport"
            content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0"
        />
        <meta http-equiv="X-UA-Compatible" content="ie=edge" />
        <link rel="stylesheet" href="{{asset("turbo/bootstrap/bootstrap.min.css")}}" />
        <link rel="stylesheet" href="{{asset("turbo/index.css")}}" />
        <title>TapAz</title>
    </head>
    <body>
        <div class="registrationBlock">
            <div>
                @if(session('failed'))
                    {{session('failed')}}
                @endif
            </div>
            <div class="registrationBlockPopup">
                <a
                    href="{{route("index")}}"
                    class="registrationBlockPopupBackLink"
                    title="exit"
                >
                    <svg
                        xmlns="http://www.w3.org/2000/svg"
                        viewBox="0 0 320 512"
                    >
                        <path
                            d="M9.4 233.4c-12.5 12.5-12.5 32.8 0 45.3l192 192c12.5 12.5 32.8 12.5 45.3 0s12.5-32.8 0-45.3L77.3 256 246.6 86.6c12.5-12.5 12.5-32.8 0-45.3s-32.8-12.5-45.3 0l-192 192z"
                        />
                    </svg>
                </a>
                <div class="registrationBlockPopupName">Registrasiya</div>
               <form action="{{route("registration")}}" method="Post">
                @csrf
                <div>
                    <input
                        type="text"
                        name="name"
                        placeholder="Adinizi elave edin"
                        class="registrationBlockPopupInput"
                    />
                </div>
                <div>
                    <input
                        type="email"
                        name="email"
                        placeholder="Email elave edin"
                        class="registrationBlockPopupInput"
                    />
                </div>
                <div>
                    <input
                        type="number"
                        name="phone"
                        placeholder="Nomre elave edin"
                        class="registrationBlockPopupInput"
                    />
                </div>
                <div>
                    <button type="submit" class="registrationBlockPopupSubmit">
                        Tesdiqleme gonderilsin
                    </button>
                </div>
               </form>
            </div>
        </div>
    </body>
</html>
