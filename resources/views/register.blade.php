@extends('layout')

@section('content')
   

<link rel="stylesheet" href="{{asset('assets/css/style2.css')}}">
<body>
<link href="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css"     
rel="stylesheet" id="bootstrap-css">
<script src="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>

<form action="/register" method="POST" class="">
   @csrf
   @if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
 @endif
 <section class="get-in-touch">

   <label for="username">Name</label>
   <input type="text" placeholder="name" id="name" name="name">

   <label for="username">Username</label>
   <input type="username" placeholder="username" id="username" name="username">

   <label for="email">Email</label>
   <input type="email" placeholder="email" id="email" name="email">
   
   <label for="password">Password</label>
   <input type="password" placeholder="password" id="password" name="password">
  
   
   
 <button type="submit" style="margin-top: 20px"; >Submit</button>

   <div class="sosial" style="margin-top: 10px;">
       <a href="/login" style="padding-left: 165px; color:black; text-decoration:none;"> log In</a>   
   </div>
</form>

   {{ session('berhasil') }}
</section>
</body>
@endsection
