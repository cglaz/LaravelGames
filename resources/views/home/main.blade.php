@extends('layout.main')

@section('content')
    <h2 class="mt-4">Dashboard</h2>

    <div>
        <p>Witaj {{ $user->name }}</p>
    </div>
@endsection
