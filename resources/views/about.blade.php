@extends('layouts.main', ['title' => 'About'])

@section('content')
    <h1>Halaman About</h1>
    <h3>{{ $name }}a</h3>
    <p>{{ $email }}</p>
    <img src="img/{{ $image }}" alt="{{ $name }}" width="200" class="img-thumbnail rounded-circle">
@endsection
