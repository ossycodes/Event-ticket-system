<?php
use App\Newsletter;
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
/*
Route::get('/', function () {
    return view('welcome');
});
*/

Route::get('/sendmail', 'ContactsController@sendMail');

Route::get('aboutus', function(){
 return view('aboutus');
})->name('aboutus');

//Route for index
Route::get('/', 'IndexController@index')->name('/');

//Route for events
Route::get('events', 'EventsController@index')->name('events');

//Route for single page events
Route::get('/events/{id}', 'EventsController@show');

//Route for single page events
Route::get('/posts/{id}', 'BlogController@show');

//Route for Error page
Route::get('404', 'UsersController@errorpage');

//Route for contactus query message
Route::match(['get', 'post'], '/contactus', 'ContactsController@store')->name('contactus');

//Route for newsletter subscription
Route::post('/newsletter', 'NewslettersController@saveNewsletterSubscriber');

//Route for comments
Route::post('/add-comment-event', 'EventscommentController@store');

//Route for category
Route::get('/category/{id}', 'CategoryController@index');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

//Admin Routes
Route::group(['prefix' => 'system-admin', 'as' => 'system-admin.', 'middleware' => ['auth', 'isAdmin']], function(){

    Route::resource('admin/categories', 'Admin\CategoryController');
    Route::resource('admin/events', 'Admin\EventsController');
    Route::resource('admin/posts', 'Admin\BlogsController');
    Route::resource('admin/users', 'Admin\UsersController');
    Route::resource('admin/subscribers', 'Admin\NewslettersController');
    Route::resource('admin/messages', 'Admin\ContactsController');
    Route::resource('admin/profile', 'Admin\ProfileController');
    
    Route::get('admin/change-password', 'Admin\PasswordController@index');
    Route::post('admin/update-password', 'Admin\PasswordController@update');
    
    Route::get('admin/compose-mail', function(){
            return view('admin.subscribers.composemail');
    });

});

//Users Routes
Route::group(['prefix' => 'user', 'as' => 'user.', 'midlleware' => 'auth'], function(){
     Route::resource('profile', 'user\ProfileController');
});
     Route::get('change-password', 'user\PasswordController@index')->name('user.password');
     Route::post('change-password', 'user\PasswordController@update')->name('user.password.update');




