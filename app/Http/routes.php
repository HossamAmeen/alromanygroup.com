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

Route::get('/','Site\Pages@home');
Route::post('/','Site\Pages@post_contact');
Route::get('products','Site\Pages@products');
Route::get('agencies','Site\Pages@agencies');
Route::get('offers','Site\Pages@offers');
Route::get('offers/{id}','Site\Pages@single_offer');
Route::get('about-us','Site\Pages@about_us');
Route::get('portfolio','Site\Pages@portfolio');
Route::get('news','Site\Pages@news');
Route::get('follows','Site\Pages@follows');
Route::get('news/{id}','Site\Pages@single_news');
Route::get('contact','Site\Pages@contact');
Route::post('contact','Site\Pages@post_contact');
Route::get('projects','Site\Projects@index');
Route::get('projects/single/{id}','Site\Projects@single');
Route::get('faq','site\Questions@index');
Route::post('faq','site\Questions@question_store');
Route::get('teams','site\Pages@teams');


Route::get('reset-password','Auth\PasswordController@get_email');
Route::post('password/email','Auth\PasswordController@postEmail');
Route::get('password/reset/{token}','Auth\PasswordController@get_reset');
Route::post('password/reset','Auth\PasswordController@postReset');

Route::get('/admin', 'Admin\Account@login')->name('loginAdmin');

Route::post('/admin', 'Admin\Account@post_login');
Route::get('logout', 'Admin\Account@logout');


Route::group(['middleware' => ['auth']], function () {
    Route::get('edit-profile','Admin\Account@edit_profile');
    Route::post('edit-profile','Admin\Account@post_edit_profile');
});

//admins
Route::group(['middleware' => ['checkAdmin']], function () {


    Route::get('/admin/managers', 'Admin\Manager@index');
    Route::get('/admin/manager/add', 'Admin\Manager@create');
    Route::post('/admin/manager/add', 'Admin\Manager@store');
    Route::get('/admin/manager/{id}/delete', 'Admin\Manager@destroy');
//    Route::post('/admin/managers/{id}/edit-role', 'Admin\Manager@edit_role');
    Route::get('/admin/manager/edit/{id}', 'Admin\Manager@edit');
    Route::post('/admin/manager/edit/{id}', 'Admin\Manager@update');


   });


Route::group(['middleware' => ['checkSuperVisor']], function () {


    Route::get('/admin/prefs', 'Admin\Prefs@index');
    Route::post('/admin/prefs', 'Admin\Prefs@update');

    //works routes
    Route::get('admin/works', 'Admin\Work@index');
    Route::post('admin/works', 'Admin\Work@store');
    Route::get('admin/work/{id}/delete', 'Admin\Work@destroy');

    //news routes
    Route::get('admin/news', 'Admin\News@index');
    Route::get('admin/news/add', 'Admin\News@create');
    Route::post('admin/news/add', 'Admin\News@store');
    Route::get('admin/news/{id}/delete', 'Admin\News@destroy');
    Route::get('admin/news/{id}/update', 'Admin\News@edit');
    Route::put('admin/news/{id}/update', 'Admin\News@update');
    //follows routes
    Route::get('admin/follows', 'Admin\Follows@index');
    Route::get('admin/follows/add', 'Admin\Follows@create');
    Route::post('admin/follows/add', 'Admin\Follows@store');
    Route::get('admin/follows/{id}/delete', 'Admin\Follows@destroy');
    Route::get('admin/follows/{id}/update', 'Admin\Follows@edit');
    Route::put('admin/follows/{id}/update', 'Admin\Follows@update');
        /////////////// employees
    Route::resource('admin/employees', 'Admin\EmployeeController');
    Route::get('admin/employees/{id}/delete', 'Admin\EmployeeController@destroy');
        ////////////// clients
    Route::resource('admin/clients', 'Admin\ClientController');
    Route::get('admin/clients/{id}/delete', 'Admin\ClientController@destroy');

        //////////// projects
    Route::resource('admin/projects', 'Admin\ProjectController');
    Route::get('admin/projects/{id}/delete', 'Admin\ProjectController@destroy');
        ///////////////////// project
    Route::any('admin/project-configration', 'Admin\ProjectController@configration');
        //////////////////// Equivalent
    Route::resource('admin/equivalents', 'Admin\EquivalentController');
    Route::get('admin/equivalents/{id}/delete', 'Admin\EquivalentController@destroy');

    //Project routes
    Route::get('admin/offers', 'Admin\Offers@index');
    Route::get('admin/offers/add', 'Admin\Offers@create');
    Route::post('admin/offers/add', 'Admin\Offers@store');
    Route::get('admin/offers/{id}/delete', 'Admin\Offers@destroy');
    Route::get('admin/offers/{id}/update', 'Admin\Offers@edit');
    Route::get('admin/offers/{id}/books', 'Admin\Offers@books');
    Route::post('admin/offers/{id}/books', 'Admin\Offers@post_books');
    Route::put('admin/offers/{id}/update', 'Admin\Offers@update');
    Route::get('admin/offers/{id}/images', 'Admin\Offers@images');
    Route::post('admin/offers/{id}/images', 'Admin\Offers@store_images');
    Route::get('admin/offers/{offersId}/image/{imageId}/delete', 'Admin\Offers@delete_image');
    Route::get('admin/offers/custom/{id}', 'Admin\Offers@get_projects_byID');


    //FAQ routes
    Route::get('admin/faq', 'Site\Questions@all_faq');
    Route::get('admin/faq/replay/{id}', 'Site\Questions@replay');
    Route::put('admin/faq/replay/{id}', 'Site\Questions@replay_question');
    Route::get('admin/faq/{id}/delete', 'Site\Questions@destroy');

});