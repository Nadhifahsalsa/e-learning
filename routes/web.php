<?php

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\matkul;
use App\Http\Controllers\pdfCOntroller;
use App\Models\tugas;
use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    $dataRekap = DB::table('tugas')
                    ->select(DB::raw("AVG(nilai) as AVG"), DB::raw("nama_tugas as 'Nama Tugas'"))
                    ->groupBy("Nama Tugas")
                    ->pluck('AVG', 'Nama Tugas');
        $labels = $dataRekap->keys();
        $data = $dataRekap->values();

    $siswa = DB::table('users')
            ->where('role', '=', 'siswa')
            ->get();
        // dd(compact('labels', 'data'));
    return view('admin.dashboard', [
        'charts' => compact('labels', 'data'),
        'siswa' => $siswa
    ]);
    
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');  

require __DIR__.'/auth.php';

// Route::get('/', function () {
//     return view('layouts.app');
// });

Route::get('/jadwal', function () {
    return view('admin.jadwal');
});

Route::get('/form_mk', function () {
    return view('admin.form_mk');
});

Route::resource('/matkul', matkul::class);

Route::get('/matkul', function() {
    $data = DB::table('matkul')
    ->join('jadwal', 'jadwal.id_mk', '=', 'matkul.id')
    ->select()
    ->get();
    return view('admin.matkul', ["data" => $data]);
});

Route::get('/tugaskuliah', function() {
    $tugas = DB::table('tugas')->where('id_siswa', '=', auth()->id())->get();
    $tugasdosen = DB::table('tugas')->where('id_dosen', '=', auth()->id())->get();
    return view('admin.tugaskuliah', ['tugas'=>$tugas, 'tugasdosen'=>$tugasdosen]);
});

Route::get('/tugas', function() {
    return view('admin.form');
});
Route::PUT('/submit/{id}', function($id) {
    DB::update('update tugas set tugas = "submit" where id = ?', [$id]);
    return redirect('/tugaskuliah');
});

Route::post('/tugas', function (Request $request) {
    DB::table('tugas')->insert([
        'id_siswa'=>$request->id_siswa,
        'id_dosen'=>$request->id_dosen,
        'nama_tugas'=>$request->nama,
        'deskripsi'=>$request->deskripsi,
        'deadline'=>$request->date,
    ]);
    return redirect('/tugaskuliah');
});

Route::get('/tugas/{id}', function($id) {
    $tugas = tugas::find($id);
    $tugas->delete();
    return redirect('/tugaskuliah');
})->name('deleteTugas');

Route::PUT('/tugas/edit/{id}', function($id, Request $request) {
    DB::table('tugas')
            ->where('id', $id)
            ->update([
                'deadline' => $request->deadline,
                'nilai' => $request->nilai,
            ]);
    // DB::update("update tugas set deadline ='".$request->deadline."' where id = ?", [$id]);
    return redirect('/tugaskuliah');
});

Route::get('/pdf/{id}', [pdfCOntroller::class, 'index']);