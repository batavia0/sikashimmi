<?php

use App\Http\Controllers\UserController;
use App\Http\Controllers\uang_kasController;
use App\Http\Controllers\anggotaController;
use App\Http\Controllers\pengeluaranController;
use App\Http\Controllers\laporanController;
use App\Http\Controllers\paymentController;
use App\Http\Controllers\ApiController;
use App\Models\m_uang_kas;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\DB;

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

// Route::GET('home', [UserController::class, 'home']);

/*
|--------------------------------------------------------------------------
| Routes for Views
|--------------------------------------------------------------------------
*/
//Payment
// Route::POST('/payment', [paymentController::class, 'payment_POST'])->name('payment_POST');
// Route::GET('/paymentdetails', [paymentController::class, 'index'])->name('paymentdetails');
Route::middleware(['auth'])->group(function () {
    Route::GET('/', function () {
        $data['contoh'] = DB::table('uang_kas')->sum('terbayar');
        $data['substract'] = DB::table('pengeluaran')->sum('jumlah_pengeluaran');
        $data['countAnggota'] = DB::table('anggota')->count('id_anggota');
        $data['title'] = 'Welcome';
        return view('home', $data);
    })->name('home');
    //Payment class
    Route::GET('/payment', [UserController::class, 'payment'])->name('payment');
    Route::GET('/payment/handle/{id_bulan_pembayaran}', [PaymentController::class, 'GETpayment'])->name('GETpayment');
    Route::POST('/payment/handle/{id_bulan_pembayaran}', [PaymentController::class, 'payment_POST']);
    //End Payment

    Route::GET('/uang_kas', [UserController::class, 'uang_kas'])->name('uang_kas');
    Route::GET('/detail_uang_kas/{id_bulan_pembayaran}', [uang_kasController::class, 'showDetails'])->name('detail_uang_kas');
    Route::GET('/tambah_bulan', [uang_kasController::class, 'tambahBulan'])->name('tambah_bulan');
    Route::GET('/tambah_anggota', [UserController::class, 'tambah_anggota'])->name('tambah_anggota');
    Route::GET('/v_pengeluaran', [pengeluaranController::class, 'pengeluaran'])->name('pengeluaran');
    Route::GET('/v_detailpengeluaran/{id_pengeluaran}', [pengeluaranController::class, 'detail'])->name('detail_pengeluaran');
    Route::GET('/v_tambahpengeluaran', [pengeluaranController::class, 'tambah_pengeluaran'])
        ->name('tambah_pengeluaran')
        ->middleware('auth');
    Route::GET('/anggota', [UserController::class, 'anggota'])->name('anggota');
    /*
    Route::GET('/v_pengeluaran/edit/{id_pengeluaran}', [pengeluaranController::class,'ubah_pengeluaran']);
    Route::POST('/pengeluaran/update/{id_pengeluaran}', [pengeluaranController::class,'update']);
    Route::GET('/pengeluaran/delete/{id_pengeluaran}', [pengeluaranController::class,'hapus_pengeluaran']);
    */
    Route::GET('/riwayat', [UserController::class, 'riwayatKasMasuk'])->name('riwayatpemasukkan');
    Route::GET('/riwayat_pengeluaran', [UserController::class, 'riwayatKasKeluar'])->name('riwayatpengeluaran');
    Route::GET('/laporan', [laporanController::class, 'laporan'])->name('laporan');
    Route::POST('/print_laporan_pemasukkan', [laporanController::class, 'laporanPemasukkan'])->name('print.pemasukkan');
    // Route::GET('/belajar', [UserController::class,'belajarphp'])->name('belajar'); for debug
    Route::GET('/profile', [UserController::class, 'profile'])->name('profile');
    Route::GET('/password', [UserController::class, 'password'])->name('password');
});
Route::GET('/register', [UserController::class, 'register'])->name('register');
Route::GET('/login', [UserController::class, 'login'])->name('login');

/*
|--------------------------------------------------------------------------
| Routes for Actions
|--------------------------------------------------------------------------
*/
Route::GET('/anggota{id_anggota}', [anggotaController::class, 'destroy'])->name('delete.anggota');
Route::GET('/logout', [UserController::class, 'logout'])->name('logout');
Route::GET('/v_tambahpengeluaran/{id_pengeluaran}', [pengeluaranController::class, 'destroy'])->name('delete.pengeluaran');
Route::GET('/v_pengeluaran/{id_pengeluaran}', [pengeluaranController::class, 'show'])->name('detail.pengeluaran');
Route::GET('/laporan/print_pemasukkan', [laporanController::class, 'laporanPemasukkan'])->name('x.pemasukkan');
Route::GET('/laporan/print_pengeluaran', [laporanController::class, 'laporanPengeluaran'])->name('print.pengeluaran');
Route::POST('/register', [UserController::class, 'register_action'])->name('register.action');
Route::POST('/login', [UserController::class, 'login_action'])->name('login.action');
Route::POST('/password', [UserController::class, 'password_action'])->name('password.action');
Route::POST('/anggota{id_anggota}', [anggotaController::class, 'update'])->name('update.anggota');
Route::POST('/anggota', [anggotaController::class, 'store'])->name('tambah.anggota');
Route::POST('/v_pengeluaran/{id_pengeluaran}', [pengeluaranController::class, 'update'])->name('update.pengeluaran');
Route::POST('/tambah_bulan', [uang_kasController::class, 'action_bulan_pembayaran'])->name('action_bulan_pembayaran');
Route::POST('/v_tambahpengeluaran', [pengeluaranController::class, 'store'])->name('action.pengeluaran');
Route::POST('/detail_uang_kas/{id_bulan_pembayaran}', [uang_kasController::class, 'insert_anggota'])->name('insertanggota'); //PAUSEd DUE TO INCOSCISTENCY
Route::PUT('/profile', [UserController::class, 'profile_action'])->name('profile.action');
Route::put('/detail_uang_kas{id_uang_kas}', [uang_kasController::class, 'uang_kas_action'])->name('update.uang_kas');
Route::DELETE('/uang_kas{id_bulan_pembayaran}', [uang_kasController::class, 'destroy'])->name('delete');
Route::PUT('uang_kas{id_uang_kas}', [uang_kasController::class, 'update'])->name('update');
/*
|--------------------------------------------------------------------------
| Routes for Actions Payment
|--------------------------------------------------------------------------
*/
Route::POST('/payment-handler', [ApiController::class, 'payment_handler'])->name('payment-handler'); //Tangkap API JSON Midtrans

// Route::GET('detail_uang_kas', function(){
// })->middleware('auth')->name('detail_uang_kas'); //Akses dibatasi sampai user login terlebih dahulu
