<?php

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
use App\Staff;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/create', function() {
    $staff = Staff::find(1);
    $staff->photos()->create(['path'=>'example.jpg']);
});

Route::get('/read', function() {
    $staff = Staff::findOrFail(1);

    foreach($staff->photos as $photo) {
        echo $photo;
    }
});

Route::get('/update', function() {
    $staff = Staff::findOrFail(1);
    $photo = $staff->photos()->whereId(1)->first();
    $photo->path = "Update example.jpg";
    $photo->save();
});

Route::get('/delete', function() {
    $staff = Staff::findOrFail(1);
    $staff->photos()->delete();
});

Route::get('/assign', function() {
    $staff = Staff::findOrFail(1);
    $photo = Photo::findOrFail(2);
    $staff->photos()->save($photo);
})

Route::get('/un-assign', function() {
    $staff = Staff::findOrFail(1);
    $staff->photos()->whereId(2)->update(['imageable_id'=>'', 'imageable_type'=>'']);
})
