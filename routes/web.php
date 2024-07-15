<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\DB;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/
Route::redirect('/', '/admin');
    
// Route::get('/', function () {
//     return view('welcome');
// });
Route::get('/test', function () {
     // DB::table('model_has_roles')->where(array('model_id'=>auth()->id()))->first();
    //  $users = DB::table('users')
    //             ->where('email', 'like', 'perawat%')
    //             ->get();
    // foreach($users as $p){
    //     DB::table('profil_perawats')->insert([
    //         'jeniskelamin' => 'Laki-Laki',
    //         'namalengkap' => $p->name,
    //         'is_vokasi_ners' => 'ners',
    //         'user_id' => $p->id,
    //         'setuju' => 1,
    //     ]);
        
    // }
});
