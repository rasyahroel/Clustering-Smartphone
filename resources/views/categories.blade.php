@extends('layouts.main', ['title' => 'Kategori Telinga Siswa'])

@section('content')
    <h3 class="my-5">Kategori Telinga pada Siswa</h3>
    <div class="col-6">
        @foreach ($categories as $category)
            <div class="card mb-3 shadow">
                <a href="/students?category={{ $category->slug }}" class="card-body text-decoration-none text-dark">
                    <h5>{{ $category->name }}</h5>
                </a>
            </div>
        @endforeach
    </div>
@endsection
