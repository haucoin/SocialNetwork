<?php

/**
 * @name Social Network
 * @version 2.0
 * @author Holland Aucoin and Salvatore Parascandola
 *
 * @desc - Web.app is a file that outlines the necessary routes for the application
 */

// Route to the index page
Route::get('/', function () {
    return view('index');
});

// Route to the login page
Route::get('/login', function () {
    return view('login');
});

// Route to the registration page
Route::get('/registration', function () {
    return view('registration');
});

// Route to the home page
Route::get('/home', function () {
    return view('homePage');
});

// Route to the profile page
Route::get('/profile', function() {
	return view('profile');
});

// Call the authenticateUser method within the LoginRegistrationController using the /loginUser route
Route::post('/loginUser', 'LoginRegistrationController@authenticateUser');

// Call the registerUser method within the LoginRegistrationController using the /registerUser route
Route::post('/registerUser', 'LoginRegistrationController@registerUser');

// Call the editUser method within the LoginRegistrationController using the /editUser route
Route::post('/editUser', 'LoginRegistrationController@editUser');

// Call the logout method within the LoginRegistrationController using the /logout route
Route::get('/logout', 'LoginRegistrationController@logout');

// Call the adminPage method within the AdminController using the /admin route
Route::get('/admin', 'AdminController@adminPage');

// Call the deleteUser method within the AdminController using the /deleteUser route
Route::post('/deleteUser', 'AdminController@deleteUser');

// Call the suspendUser method within the AdminController using the /suspendUser route
Route::post('/suspendUser', 'AdminController@suspendUser');

// Call the viewUser method within the AdminController using the /adminViewUser route
Route::post('/adminViewUser', 'AdminController@viewUser');

// Call the adminEditUser method within the AdminController using the /adminEditUser route
Route::post('/adminEditUser', 'AdminController@adminEditUser');

    
