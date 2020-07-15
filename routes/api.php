<?php

// Route::group(['prefix' => 'v1', 'as' => 'api.', 'namespace' => 'Api\V1\Admin', 'middleware' => ['auth:api']], function () {
//     // Permissions
//     Route::apiResource('permissions', 'PermissionsApiController');

//     // Roles
//     Route::apiResource('roles', 'RolesApiController');

//     // Users
//     Route::apiResource('users', 'UsersApiController');

//     // Atestats
//     Route::post('atestats/media', 'AtestatApiController@storeMedia')->name('atestats.storeMedia');
//     Route::apiResource('atestats', 'AtestatApiController');

//     // Regions
//     Route::apiResource('regions', 'RegionApiController');

//     // Places
//     Route::apiResource('places', 'PlaceApiController');

//     // Categories
//     Route::apiResource('categories', 'CategoryApiController');

//     // Subcategories
//     Route::post('subcategories/media', 'SubcategoryApiController@storeMedia')->name('subcategories.storeMedia');
//     Route::apiResource('subcategories', 'SubcategoryApiController');

//     // Products
//     Route::post('products/media', 'ProductsApiController@storeMedia')->name('products.storeMedia');
//     Route::apiResource('products', 'ProductsApiController');
// });