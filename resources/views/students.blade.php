@extends('layouts.main')

@section('content')
    <h3 class="mt-5 mb-3">{{ $title }}</h3>

    {{-- Fungsi Search --}}
    <div class="row">
        <div class="col-md-6">
            <form action="/students">
                @if (request('category'))
                    <input type="hidden" name="category" value="{{ request('category') }}">
                @endif
                @if (request('user'))
                    <input type="hidden" name="user" value="{{ request('user') }}">
                @endif
                <div class="input-group mb-3">
                    <input type="search" class="form-control" placeholder="Search .." name="search"
                        value="{{ request('search') }}">
                    <button class="btn btn-info" type="submit">Search</button>
                </div>
            </form>
        </div>
    </div>

    <div class="row">
        <div class="col-auto">
            <h5>Total siswa</h5>
        </div>
        <div class="col-auto">
            <h5>: {{ $scount }} orang</h5>
        </div>
    </div>
    <div class="row">
        <div class="col-auto">
            <h6>Siswa Perempuan</h6>
        </div>
        <div class="col-auto">
            <h6>: {{ $scountp }} orang</h6>
        </div>
    </div>
    <div class="row">
        <div class="col-auto">
            <h6>Siswa Laki-Laki</h6>
        </div>
        <div class="col-auto">
            <h6>&emsp;&nbsp;: {{ $scountl }} orang</h6>
        </div>
    </div>

    {{-- Pagination --}}
    <div class="d-flex justify-content-end">
        {{ $students->links() }}
    </div>

    @if ($students->count())
        @foreach ($students as $student)
            <div class="list-group mb-3 shadow">
                <a href="/students/{{ $student->slug }}"
                    class="list-group-item list-group-item-action flex-column align-items-start">
                    <div class="d-flex w-100 justify-content-between">
                        <h5 class="mb-1">{{ $student->name }}</h5>
                        <small class="my-2 text-muted">Berkategori {{ $student->category->name }}</small>
                    </div>
                    <small>{{ $student->sch_name }},</small>
                    <small>{{ $student->class }}</small>
                </a>
            </div>
        @endforeach
    @else
        <p class="text-center fs-4">No Student found.</p>
    @endif


@endsection
