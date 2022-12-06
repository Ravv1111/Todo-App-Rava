@extends('layout')
@section('content')
<link rel="stylesheet" href="{{asset('assets/css/style.css')}}">
<body>
       <div class="background">
         <div class="shape"></div>
         <div class="shape"></div>
       </div>
    <form action= "{{ route('login.post')}}" method="POST">
        @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
     @endif
 @if (session('notallowed'))
 <div class="alert alert-danger">
     {{ session('notallowed') }}
 </div>
 @endif
        @csrf
        <h3>RAV</h3>

        <label for="username">Username</label>
        <input type="text" placeholder="username" id="username" name="username">

        <label for="password">Password</label>
        <input type="password" placeholder="password" id="password" name="password">
       
        
    <button type="submit">Log In</button> 

    <div class="social">
        <a href="/register" style="text-decoration:none">Sign Up</a>
    </div>

    </form>
</body>
@endsection
