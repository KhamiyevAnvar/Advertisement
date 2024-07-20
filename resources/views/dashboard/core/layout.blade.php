@include('dashboard.core.head')
@include('dashboard.core.sidebar')
@include('dashboard.core.topbar')

<div class="container-fluid">
    @if(session("success"))
        <div class="alert alert-success">
            {{session("success")}}
        </div>
    @endif

    @if(session("failed"))
        <div class="alert alert-danger">
            {{session("failed")}}
        </div>
    @endif
</div>

@yield('content')

@include('dashboard.core.footer')