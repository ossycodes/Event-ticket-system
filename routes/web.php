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


//Admin Routes
Route::group(['prefix' => 'system-admin', 'as' => 'system-admin.', 'middleware' => ['auth', 'isAdmin']], function(){

    Route::resource('admin/categories', 'Admin\CategoryController');
    Route::resource('admin/events', 'Admin\EventsController');
    Route::resource('admin/posts', 'Admin\BlogsController');
    Route::resource('admin/users', 'Admin\UsersController');
    Route::resource('admin/subscribers', 'Admin\NewslettersController');
    Route::resource('admin/messages', 'Admin\ContactsController');
    
    //to-do
    //use a resource controller for all your admin routes
    //create a new folder named admin in controller, were all your resource controllers would go into
});



/*
Just praticing One to One Relationship
*/

Route::get('/customer/{id}', 'CustomersController@showPhone');
Route::get('/phonenumber/{id}', 'PhonesController@showCustomer');


/*
Just praticing One to many relationship
*/
Route::get('/show-customer-with-hobbie/{id}', 'HobbieController@showCustomerWithHobbie');
Route::get('/all-hobbies-of-customer/{id}', 'CustomersController@showAllHobbiesOfCustomer');

/*
Just praticing  how to get authenticated user details
UsersController@details, gets the authenticated User details
*/
Route::get('/get-user-details', 'UsersController@userDetails');
Route::get('/array-details', 'UsersController@getApp');
Route::get('/get-user-details-method-two', 'UsersController@AnotherWayToGetUserdetails');
Route::get('/check-if-user-is-authenticated', 'UsersController@checkIfUserIsAuthenticated')->middleware('auth');
Route::get('/check-if-password-match', 'UsersController@checkIfUserPasswordMatches');


Route::get('/displayproduct/{product}', 'ProductsController@show');
Route::get('/display_product_price/{product}', 'ProductsController@showPrice');


//----  Admin Routes -----\\

//gets the all contactus messages
Route::get('/admin/get-contactus-messages', 'ContactsController@getContactusMessages');


/*
Route model binding(Implicit binding)
Route::get('/displayproduct/{product}', function(App\Product $product){
		echo $product->name;
});
*/

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
