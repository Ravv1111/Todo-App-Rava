@extends('layout')

@section('content')

<link rel="stylesheet" href="{{asset('assets/css/style3.css')}}">

    @if (session('failed'))
    <div class="alert alert-success">
        {{ session('isLogin') }}
    </div>
@endif

@if (session('notallowed'))
<div class="alert alert-danger">
    {{ session('notallowed') }}
</div>
@endif

@if (session('addTodo'))
<div class="alert alert-success">
    {{ Session::get('addTodo') }}
</div>
@endif
<body>
<h4>Selamat Datang {{Auth::user()->name}}</h4> 
</body>
@endsection