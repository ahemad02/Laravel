<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Usercontroller;
use App\Http\Controllers\Formcontroller;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\ImageController;
use App\Http\Controllers\MailController;

Route::get('/', function () {
    return view('home');
});

Route::get('/admin/{name}', [Usercontroller::class, 'admin']);

// Route::view('welcome/{name}','welcome');

Route::view('welcome','welcome');


/*

use Illuminate\Support\Facades\View;

if(View::exists('admin')) {
} to check if a view exists

*/

Route::view('user-form','user-form');

Route::post('/add-user', [Formcontroller::class, 'addUser']);

// Route::view('about','about')->name('ab');

Route::view('about','about')->name('ab');


Route::get('/users', [Usercontroller::class, 'users']);

//<a> href="{{ route('ab') }}"</a> used as shortname for route

/*

function show(){
return to_route('ab'); //can be used like this in controller

}

Route::prefix('admin')->group(function(){
    //routes with admin prefix
})

Route::controller(Usercontroller::class)->group(function(){
    //routes with prefix controller
})

Route::view('about','about')->middleware('web');

Route::middleware('web')->group(function(){
    // routes with middleware
})



*/

Route::get('/student', [StudentController::class, 'getStudents']);

Route::get('/queries', [Usercontroller::class, 'queries']);

Route::view('login','login');
Route::view('profile','profile');

Route::post('/login', [Usercontroller::class, 'login']);

Route::view('upload','upload');

Route::post('upload', [Usercontroller::class, 'upload']);

Route::view('add','add-student');

Route::post('/add-student', [StudentController::class, 'addStudent']);

Route::view('upload1','upload1');

Route::post('/upload1', [ImageController::class, 'upload']);

Route::get('list', [ImageController::class, 'list']);

Route::post('send-email', [MailController::class, 'sendEmail']);

Route::view('send-email','send-email');