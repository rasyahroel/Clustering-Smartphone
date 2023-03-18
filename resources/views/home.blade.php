@extends('layouts.main', ['title' => 'Home'])

@section('content')
    <div class="lds-dual-ring"></div>

    <style>
        .lds-dual-ring {
            display: inline-block;
            position: absolute;
            transform: translate(-50%, -50%);
            top: 50%;
            left: 50%;
            width: 80px;
            height: 80px;
        }

        .lds-dual-ring:after {
            content: " ";
            display: block;
            width: 64px;
            height: 64px;
            margin: 8px;
            border-radius: 50%;
            border: 6px solid #000000;
            border-color: #000000 transparent #000000 transparent;
            animation: lds-dual-ring 1.2s linear infinite;
        }
    </style>

    <script>
        window.location.href = "/students";
    </script>
@endsection
