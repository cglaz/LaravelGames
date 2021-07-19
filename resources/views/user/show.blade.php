@extends('layout.main')

@section('title', 'Użytkownik')

@section('sidebar')
    @parent
    <div>Lista użytkowników: <a href="{{ route('get.users') }}">Link</a></div>
@endsection

@section('content')
    <div class="card">
        <h5 class="card-header">{{ $user['name'] }}</h5>
        <div class="card-body">
            @if($user->avatar)
                <img src="{{ asset('storage/'.$user->avatar) }}" class="rounded mx-auto d-block user-avatar" alt="">
            @else
                <img src="/images/avatar.png" class="rounded mx-auto d-block">
            @endif
            <ul>
                <li>Id: {{ $user->id }}</li>
                <li>Name: {{ $user->name }}</li>
                <li>Email: {{ $user->email }}</li>
                <li>Phone: {{ $user->phone }}</li>
            </ul>

            <a href="{{ route('get.users') }}" class="btn btn-light">Lista użytkowników</a>
        </div>
    </div>
@endsection
