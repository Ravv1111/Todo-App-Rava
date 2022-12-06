@extends('layout')

@section('content')

    @if (session('successUpdate'))
        <div class="alert alert-success">
            {{session('successUpdate')}}
        </div>
    @endif

    @if (session('done'))
    <div class="alert alert-success">
        {{session('done')}}
    </div>
    @endif

    @if (session('successDelete'))
        <div class="alert alert-danger">
            {{session('successDelete')}}
        </div>
    @endif

    <table class="table table-success table-striped table-bordered" style="max-width: 1300px; margin: 35px; ">
        <tr>
            <td>No</td>
            <td>Kegiatan</td>
            <td>Deskripsi</td>
            <td>Batas Waktu</td>
            <td>Status</td>
            <td>Aksi</td>
        </tr>
        @php
            $no = 1;
        @endphp 
        @foreach ($todos as $todo)
        <tr>
            {{-- tiap di looping, $no bakal ditambah 1 --}}
            <td>{{ $no++ }}</td>
            <td>{{ $todo['title'] }}</td>
            <td>{{ $todo['description'] }}</td>
            {{-- Carbon : package date pada laravel, nantinya si date yang 2022-11-22 
                 jadi formatnya 22 november 2022--}}
            <td>{{ \Carbon\Carbon::parse($todo['date'])->format('j F,Y') }}</td>
            {{-- Konsep ternary, if statusnya 1 nampilin teks complated kalo 0 nampilin teks on-process . 
                status tuh boolean kan? cmn antara 1 atau 0 --}}
            <td>{{ $todo['status'] ? 'Complated' : 'On-process' }}</td>
            <td class="d-flex">
                {{-- karena path {id} merupakan path dinamis, jadi kita harus isi
                 path dinamis tersebut, karena kita mengisinya dengan data dinamis/data dari 
                 database jadi buat isinya pake kurung kurawal dua kali --}}
              
                {{-- fitur delete harus mengunakan form lagi. tombol hapusnya
                    disimpan di tag button type submit. kenapa pake form? kerena kita kan
                    mau ubah (hapus itu masuk ke ubah data kan?), nah  --}}
                <form action="/destroy/{{$todo['id']}}" method="POST">
                    @csrf
                    @method('DELETE')
                       <a href="/edit/{{$todo['id']}}" class="btn btn-primary btn-sm">Edit</a>      
                       <button type="submit" class="btn btn-secondary btn-sm me-2">Hapus</button>    
                </form>
                @if ($todo['status'] == 0)
                <form action="/complated/{{$todo['id']}}" method="POST">
                    @csrf
                    @method('PATCH')
                    <button type="submit" class="btn btn-success btn-sm ">Complated</button> 
                </form>
                @endif
            </td>
        </tr>
        @endforeach
    </table>
@endsection