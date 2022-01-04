<form class="form-inline mr-auto" action="#">
    <ul class="navbar-nav mr-3">
        @if(Auth::user()->id == 1)
        <li><a href="#" data-toggle="sidebar" class="nav-link nav-link-lg"><i class="fas fa-bars"></i></a></li>
        @endif

    </ul>
</form>
<ul class="navbar-nav navbar-right">

    @if (Auth::user()->id == 1)

    <li class="dropdown">
        <a class="fa fa-bell nav-link nav-link-lg nav-link-user  " href="#" data-toggle="dropdown">
            <span class="badge badge-danger" style="">{{auth()->user()->unreadNotifications->count()}}</span>
            {{-- <span class="badge text-danger">{{auth()->user()->unreadNotifications->count()}}</span> --}}
        </a>

        <div class="dropdown-menu dropdown-menu-right" style="width: 400px;overflow: auto;height: 70vh;">
            <div class="dropdown-title">Notificacion</div>
            @if (auth()->user()->unreadNotifications->count() == 0)
                <div class="card border-primary dropdown-item" style="width: 97.5%; padding: 0px;margin: 0px 5px; margin-bottom: 5px;">
                    <div class="card-body text-primary">
                        <h5 class="card-title">Esperando una accion</h5>
                        <h6 class="card-subtitle mb-2 text-muted h6" style="font-size: 14px;">"2021-12-30 07:36 PM"</h6>
                        <p class="card-text h6" style="white-space: pre-line;font-size: 14px;">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
                    </div>
                </div>
            @endif
            @foreach (auth()->user()->unreadNotifications as $notification)
                <!-- {{-- <a class="dropdown-item" href="#"></a> --}} -->
                <div class="card border-{{$notification->data['color']}} dropdown-item" style="width: 97.5%; padding: 0px;margin: 0px 5px; margin-bottom: 5px;">
                    <div class="card-body text-{{$notification->data['color']}}">
                        <h5 class="card-title"> {{$notification->data['accion']}}</h5>
                        <h6 class="card-subtitle mb-2 text-muted h6" style="font-size: 14px;">" {{$notification->created_at}}"</h6>
                        <p class="card-text h6" style="white-space: pre-line;font-size: 14px;">
                            El Usuario {{$notification->data['name']}} {{$notification->data['last_name']}} @if ( $notification->data['accion'] == 'Comentario') creo este {{$notification->data['accion']}}:   {{$notification->data['mensaje']}}. @else se {{$notification->data['accion']}} en el sistema. @endif
                        </p>
                    </div>
                </div>
            @endforeach
        </div>
    </li>
    @endif

    @if(\Illuminate\Support\Facades\Auth::user())
    <li class="dropdown">
        <a href="#" data-toggle="dropdown" class="nav-link dropdown-toggle nav-link-lg nav-link-user">
            <img alt="image" src="{{ asset('img/logo.png') }}"
                class="rounded-circle mr-1 thumbnail-rounded user-thumbnail ">
            <div class="d-sm-none d-lg-inline-block">
                ¡Hello! {{\Illuminate\Support\Facades\Auth::user()->name}}
                {{\Illuminate\Support\Facades\Auth::user()->last_name}}</div>
        </a>

        <div class="dropdown-menu dropdown-menu-right">
            <div class="dropdown-title">
                Welcome, {{\Illuminate\Support\Facades\Auth::user()->name}}</div>


            <a class="dropdown-item has-icon" data-toggle="modal" data-target="#changePasswordModal"
                href="{{ route('changepassword')}}" data-id="{{ \Auth::id() }}"><i class="fa fa-lock"> </i>Change
                Password</a>

            <a href="{{ url('logout') }}" class="dropdown-item has-icon text-danger"
                onclick="event.preventDefault(); localStorage.clear();  document.getElementById('logout-form').submit();">
                <i class="fas fa-sign-out-alt"></i> Logout
            </a>

            <form id="logout-form" action="{{ url('/logout') }}" method="POST" class="d-none">
                {{ csrf_field() }}
            </form>
        </div>
    </li>
    @else
    <li class="dropdown"><a href="#" data-toggle="dropdown" class="nav-link dropdown-toggle nav-link-lg nav-link-user">
            {{--                <img alt="image" src="#" class="rounded-circle mr-1">--}}
            <div class="d-sm-none d-lg-inline-block">{{ __('messages.common.hello') }}</div>
        </a>
        <div class="dropdown-menu dropdown-menu-right">
            <div class="dropdown-title">{{ __('messages.common.login') }}
                / {{ __('messages.common.register') }}</div>
            <a href="{{ route('login') }}" class="dropdown-item has-icon">
                <i class="fas fa-sign-in-alt"></i> {{ __('messages.common.login') }}
            </a>
            <div class="dropdown-divider"></div>
            <a href="{{ route('register') }}" class="dropdown-item has-icon">
                <i class="fas fa-user-plus"></i> {{ __('messages.common.register') }}
            </a>
        </div>
    </li>
    @endif
</ul>