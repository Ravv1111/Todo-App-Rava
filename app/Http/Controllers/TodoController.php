<?php

namespace App\Http\Controllers;

use App\Models\Todo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TodoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
    
        return view ('login');
    }
    public function register()
    {
    
        return view ('register');
    }
    public function dashboard()
    {
    
        return view ('dashboard');
    }
    public function logout()
    {
        Auth::logout();
        return redirect ('/');
    }
    


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|min:3',
            'date' => 'required',
            'description' => 'required|min:8',
        ]);

        Todo::create([
            'title' => $request->title,
            'date'=> $request->date,
            'description'=>$request->description,
            'user_id'=>Auth::user()->id,
            'status'=> 0,
        ]);

        return redirect('/dashboard')->with('addTodo', 'Berhasil menambahkan data Todo!');
    }

    public function data()
    {
        $todos =Todo::all();
        return view('data', compact('todos'));
    } 

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Todo  $todo
     * @return \Illuminate\Http\Response
     */
    public function show(Todo $todo)
    {
        //menampilakan satu data spesifik
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Todo  $todo
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //parameter $id mengambil data path dinamis {id}
        // ambil satu baris data yang memiliki value column id sama dengan data path dinamis id
        // yang dikirim ke route
        $todo = Todo::where('id', $id)->first();
        // kemudian arahkan/tampilan file view yang bernama edit.
        // blade.php dan kirimkan data dari $todo ke file edit tersebut dengan bantuan compact
        return view('edit', compact('todo'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Todo  $todo
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //validasi
        $request->validate([
            'title' => 'required|min:3',
            'date' => 'required',
            'description' => 'required|min:8',
        ]);
        // cari baris data yang mempunyai value colum id sama dengan id yang dikirim ke route
        Todo::where('id', $id)->update([
            'title' => $request->title,
            'date'=> $request->date,
            'description'=>$request->description,
            'user_id'=>Auth::user()->id,
            'status'=> 0,
        ]);
        //kalau  berhasil, arahkan ke halaman data dengan pemberitahuan berhasil   
        return redirect('/data')->with('successUpdate', 'Berhasil mengubah data!');
    }

    public function updateToComplated(Request $request, $id)
    {
        //cari yang akan di apdate
        //baru setelahnya data diupdate ke database melalui model
        //status tipenya boolean (0/1) : 0 (on-process) % 1 (complated)
        //carbon : package laravel yang mengelola segala hal yg behubungan denga date
        //now() : mengambil tanggal hari ini
        Todo::where('id', '=', $id)->update([
        'status' => 1,
        'done_time' => \carbon\carbon::now(),
        ]);
        // jika berhasil, akan dibalikan ke halaman awal (halaman tempat button complated berada)
        // kembali dengan pemberitahuan
    return redirect()->back()->with('done', 'ToDo telah selesai dikerjakan');
    }

   
    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Todo  $todo
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        // cari data yang mau dihapus, kalau ketemu langsung hapus datanya
        Todo::where('id', $id)->delete();
        //kalau berhasil arahin balik ke halaman data dengan pemberitahuan
        return redirect('/data')->with('successDelete','berhasil menghapus data ToDo!');
    }
}
