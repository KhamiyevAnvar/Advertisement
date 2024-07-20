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
        <div>
            
        </div>
        <div class="registrationBlock">
            
            <div class="registrationBlockPopup">
               
                    <a
                    href="{{route("registration")}}"
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
                <div class="registrationBlockPopupName">Hesaba giris</div>
                <form action="{{route('login')}}" method="POST">
                    @csrf
                    <div>
                        <input
                            type="email"
                            name="email"
                            placeholder="Email unvani daxil edin"
                            class="registrationBlockPopupInput"
                        />
                    </div>
                    <div>
                        <button type="submit" class="registrationBlockPopupSubmit">
                            Gonder
                        </button>
                    </div>
                </form>
                @if(session('failed'))
                    <div class="alert alert-danger mt-3 text-center">{{session('failed')}}</div>
                @endif

                <div class="mt-2 text-center">
                    If you don't have anncoun
                    <a href="{{route('registrationPage')}}">registration</a> that link.
                </div>
            </div>
        </div>
    </body>
</html>
