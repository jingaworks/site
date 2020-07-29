<?php

Route::apiResource('/test', 'Api\V1\Admin\AtestatApiController');



// Route::get('/test', 'HomeController@test');
// Route::redirect('/', '/login');
Route::get('/home', function () {
    if (session('status')) {
        return redirect()->route('admin.home')->with('status', session('status'));
    }

    return redirect()->route('admin.home');
});

Auth::routes();
// Admin

Route::group(['prefix' => 'admin', 'as' => 'admin.', 'namespace' => 'Admin', 'middleware' => ['auth']], function () {
    Route::get('/', 'HomeController@index')->name('home');
    // Permissions
    Route::delete('permissions/destroy', 'PermissionsController@massDestroy')->name('permissions.massDestroy');
    Route::resource('permissions', 'PermissionsController');

    // Roles
    Route::delete('roles/destroy', 'RolesController@massDestroy')->name('roles.massDestroy');
    Route::resource('roles', 'RolesController');

    // Users
    Route::delete('users/destroy', 'UsersController@massDestroy')->name('users.massDestroy');
    Route::resource('users', 'UsersController');

    // Atestats
    Route::delete('atestats/destroy', 'AtestatController@massDestroy')->name('atestats.massDestroy');
    Route::post('atestats/media', 'AtestatController@storeMedia')->name('atestats.storeMedia');
    Route::post('atestats/ckmedia', 'AtestatController@storeCKEditorImages')->name('atestats.storeCKEditorImages');
    Route::resource('atestats', 'AtestatController');

    // Regions
    Route::delete('regions/destroy', 'RegionController@massDestroy')->name('regions.massDestroy');
    Route::resource('regions', 'RegionController');

    // Places
    Route::delete('places/destroy', 'PlaceController@massDestroy')->name('places.massDestroy');
    Route::resource('places', 'PlaceController');
    Route::post('places/ajax_data', 'PlaceController@ajax_call')->name('places.get_ajax');

    // Categories
    Route::delete('categories/destroy', 'CategoryController@massDestroy')->name('categories.massDestroy');
    Route::resource('categories', 'CategoryController');

    // Subcategories
    Route::delete('subcategories/destroy', 'SubcategoryController@massDestroy')->name('subcategories.massDestroy');
    Route::post('subcategories/media', 'SubcategoryController@storeMedia')->name('subcategories.storeMedia');
    Route::post('subcategories/ckmedia', 'SubcategoryController@storeCKEditorImages')->name('subcategories.storeCKEditorImages');
    Route::resource('subcategories', 'SubcategoryController');

    // Products
    Route::delete('products/destroy', 'ProductsController@massDestroy')->name('products.massDestroy');
    Route::post('products/media', 'ProductsController@storeMedia')->name('products.storeMedia');
    Route::post('products/ckmedia', 'ProductsController@storeCKEditorImages')->name('products.storeCKEditorImages');
    Route::resource('products', 'ProductsController')->middleware(['attested']);
});
Route::group(['prefix' => 'profile', 'as' => 'profile.', 'namespace' => 'Auth', 'middleware' => ['auth']], function () {
// Change password
    if (file_exists(app_path('Http/Controllers/Auth/ChangePasswordController.php'))) {
        Route::get('password', 'ChangePasswordController@edit')->name('password.edit');
        Route::post('password', 'ChangePasswordController@update')->name('password.update');
    }
});