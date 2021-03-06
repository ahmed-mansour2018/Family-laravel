<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/
//
use App\Person;

//these are for mail testing:
use App\User;
use Acme\Mailers\UserMailer as Mailer;

//Route::get('/', function () {
//    return view('welcome');


Route::get('/', 'HomeController@home');
Route::get('landing', 'HomeController@landing');

// special cache filter for the outline page rendering
//* Added based on laracast: https://laracasts.com/lessons/caching-essentials
//Route::filter('cache.fetch', 'Acme\Filters\CacheFilter@fetch');
//Route::filter('cache.put', 'Acme\Filters\CacheFilter@put');
//Route::get('outline', 'OutlineController@show_outline')->before('cache.fetch')->after('cache.put');

Route::get('outline', 'OutlineController@show_outline');

Route::get('home', ['middleware' => 'auth', 'uses' => 'HomeController@home']);
Route::get('branches', 'HomeController@branches');
Route::get('account',  'HomeController@account');
Route::get('history', 'HomeController@history');
Route::get('help', 'HomeController@help');
Route::get('register', 'RegistrationController@register');
Route::post('register', 'RegistrationController@create');

Route::resource('images', 'ImageController');
Route::get('image/{images}', 'ImageController@show');
Route::get('image/list/{images}', 'ImageController@get_image_people');
Route::get('configure/{images}', 'ImageController@configure');
Route::get('images', 'ImageController@index'); // this one is on the admin side
Route::get('album', 'ImageController@album'); // this is the user-facing view

Route::get('videos', 'VideoController@album');
Route::get('video/{video}', 'VideoController@show');
Route::get('video/list/{video}', 'VideoController@get_video_people');
Route::get('videotest', 'HomeController@test');

Route::get('stories/{story}', 'StoryController@show');
Route::resource('people', 'PeopleController');
Route::resource('families', 'FamilyController');
Route::get('users/store', 'UserController@store');
Route::get('users/{users}/pester', 'UserController@pester');

Route::resource('users', 'UserController');
Route::resource('updates', 'UpdateController');
Route::get('activities', 'ActivitiesController@index');
//Route::get('users/{user}/activity', 'ActivitiesController@show');

Route::get('clearcache', 'AdminController@clear_cache');
Route::get('email_sender', 'AdminController@mail_form');
Route::post('email_sender', 'AdminController@send_mail');

Route::get('logins', 'HomeController@logins');
Route::get('admin', 'HomeController@admin');
Route::get('tableview', 'AdminController@tableview');

Route::get('person_admin_fields/{id}', 'AdminController@admin_edit_person');
Route::get('family_admin_fields/{id}', 'AdminController@admin_edit_family');

//Route::get('updates/pending', ['middleware' => 'super', 'uses' => 'UpdateController@pending']);
//Route::get('updates/pending', 'UpdateController@pending');  //syntax without middleware

Route::get('auth/login', 'HomeController@landing');
Route::get('add_note/{type}/{id}/{name}', 'NotesController@add_note');
Route::post('add_note/save', 'NotesController@store');


//Route::get('updates/{user}', [ 'uses' => 'UpdateController@user_updates']); //missing argument 1
//
//Route::get('mail', function()
//{
//    $data = [];
//Mail::send('emails.welcome', $data, function($message)
//    {
//    $message->to('ok4mee@hotmail.com')->subject('Welcome!');
//    });
//});


Route::get('tags/{tags}', 'TagsController@show');


////name the route so you can refer to it later and not have to hard code a url$router
//ex: http://family.app/updates/user/1
//Route::get('updates/user/test',function(){return 'user updates'; }); //is found
//Route::get('updates/user/{$user}',function(){return 'user updates'; }); //NotFoundHttpException in RouteCollection.php line 143:
//Route::get('updates/user/{$user}',['as' =>'user_updates', 'uses'=> 'UpdateController@user_updates'] );

//$router->bind('people', function($id)
////Route::bind('song', function($slug) //original value
//{
//    return App\Person::whereId($id)->first();
//});

Route::controllers ([
    'auth' => 'Auth\AuthController',
    'password' => 'Auth\PasswordController',
]);


//// Password reset link request routes...
//Route::get('password/email', 'Auth\PasswordController@getEmail');
//Route::post('password/email', 'Auth\PasswordController@postEmail');
////
////// Password reset routes...
//Route::get('password/reset/{token}', 'Auth\PasswordController@getReset');
//Route::post('password/reset', 'Auth\PasswordController@postReset');
//
//Route::get('foo', ['middleware' => 'super', function()
//{
//    return 'this page may only be viewed by super users';
//}]);


