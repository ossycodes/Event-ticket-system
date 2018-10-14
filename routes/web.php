<?php
use App\Newsletter;
use Intervention\Image\Image;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Notification;


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

//route to send mail
Route::get('/sendmail', 'ContactsController@sendMail');

//about us page route
Route::get('aboutus', function(){
 return view('aboutus');
})->name('aboutus');


//Route for index
Route::get('/', 'IndexController')->name('/');

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

//Authentication routes
Auth::routes();

//home route
Route::get('/home', 'HomeController@index')->name('home');


//Event routes
Route::group(['prefix' => 'events'], function() {

    Route::get('', 'EventsController@index')->name('events');
    //Route for single page events
    Route::get('{id}', 'EventsController@show');

});

//Admin Routes
Route::group(['prefix' => 'system-admin', 'as' => 'system-admin.', 'middleware' => ['auth', 'isAdmin']], function() {

    //Resourceful routes
    Route::resource('admin/categories', 'Admin\CategoryController', ['except' => 'show']);
    Route::resource('admin/events', 'Admin\EventsController', ['except' => 'show']);
    Route::resource('admin/posts', 'Admin\BlogsController', ['except' => 'show']);
    Route::resource('admin/users', 'Admin\UsersController');
    Route::resource('admin/subscribers', 'Admin\NewslettersController');
    Route::resource('admin/messages', 'Admin\ContactsController', ['only' => ['index', 'destroy']]);
    Route::resource('admin/profile', 'Admin\ProfileController');
    Route::resource('admin/notification', 'Admin\NotificationController');
    
    //Adminpassword controller routes
    Route::get('admin/change-password', 'Admin\PasswordController@index');
    Route::post('admin/update-password', 'Admin\PasswordController@update');
    
    Route::get('admin/compose-mail', function() {
            return view('admin.subscribers.composemail');
    });

    //activate and de-activate user's route
    Route::get('admin/activate/{id}', 'Admin\EventsController@activate');
    Route::get('admin/de-activate/{id}', 'Admin\EventsController@deActivate');

});

//User's Routes
Route::group(['prefix' => 'user', 'as' => 'user.', 'middleware' => ['isUser', 'auth']], function(){
     Route::resource('profile', 'user\ProfileController');
     Route::resource('events', 'user\EventsController');
});

//User's Routes
Route::group(['middleware' => ['isUser', 'auth']], function() {
     Route::get('change-password', 'user\PasswordController@index')->name('user.password');
     Route::post('change-password', 'user\PasswordController@update')->name('user.password.update');
     Route::get('user/delete-account/{id}', 'user\ProfileController@deleteAccount')->name('user.account.delete');
     Route::get('user/read-notification', function(){
        Auth::user()->unreadNotifications->markAsRead();
        return back();
    });
    Route::get('user/transactions', 'user\TransactionController@index')->name('user.transaction');
});


Route::group(['middleware' => 'auth'], function() {
    //paymentcontroller routes
    Route::post('/makepayment', 'PaymentController@redirectToProvider');
    Route::get('/payment/callback', 'PaymentController@handleGatewayCallback');    
});







