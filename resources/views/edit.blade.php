@extends('layout')

@section('content')

    <form action="/update/{{$todo['id']}}" method="post" style="max-width: 500px; margin: auto;">
     @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
     @endif
     {{--  mengirim data ke controller yg ditampung oleh Request $request --}}
        @csrf
        {{-- karena attribute method pada tag form cuman bisa GET/POST sedangkang buat update
            data itu pake method PATCH,jadi method="post" di form di timpa saa method 
            patch ini --}}
        @method('PATCH')
        <div class="d-flex flex-column">
            <label>Title</label>
            <input type="text" name="title" value="{{$todo['title']}}">
        </div>
        <div class="d-flex flex-column">
            <label>Date</label>
            <input type="date" name="date" value="{{$todo['date']}}">
        </div>
        <div class="d-flex flex-column">
            <label>Description</label>
           {{-- kenapa text area gapunya attribute value? karena textarea bukan tgermaksud
                tag input/select dan dia punya penutup tag, jadi buat nampilinya langsung 
                tanpa atribut valur (seblum penutp tag textarea) --}}
            <textarea name="description" id="" cols="30" rows="10">{{$todo['description']}}</textarea>
        </div>
        <button type="submit">Submit</button>
    </form>
@endsection