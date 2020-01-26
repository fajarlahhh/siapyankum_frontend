@extends('pages.konsultasihukum.app')

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-4">
                <div class="user-wrapper">
                    <ul class="users" id="listuser">
                        @foreach($data as $user)
                            <li class="user" id="{{ md5($user->pengguna_id) }}">
                                {{--will show unread count notification--}}
                                @if($user->unread)
                                    <span class="pending">{{ $user->unread }}</span>
                                @endif

                                <div class="media">
                                    <div class="media-left">
                                        <img src="/assets/img/user/user.png" alt="" class="media-object">
                                    </div>

                                    <div class="media-body">
                                        <p class="name">{{ $user->pengguna_nama }}</p>
                                        <p class="email">{{ $user->pengguna_id }}</p>
                                    </div>
                                </div>
                            </li>
                        @endforeach
                    </ul>
                </div>
            </div>

            <div class="col-md-8" id="messages">

            </div>
        </div>
        <br>
        <a href="/" class="btn btn-lg btn-primary">Kembali</a>
        <a href="/konsultasihukum" class="btn btn-lg btn-success">Refresh</a>
    </div>
@endsection
