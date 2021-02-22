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

// Route to the settings page
Route::get('/settings', function() {
	return view('settings');
});

// Route to the add education page
Route::get('/addEducation', function() {
	return view('addEducation');
});

// Route to the add job page
Route::get('/addJob', function() {
	return view('addJob');
});


// Call the authenticateUser method within the UserController using the /loginUser route
Route::post('/loginUser', 'UserController@authenticateUser');

// Call the registerUser method within the UserController using the /registerUser route
Route::post('/registerUser', 'UserController@registerUser');

// Call the editUser method within the UserController using the /editUser route
Route::post('/editUser', 'UserController@editUser');

// Call the logout method within the UserController using the /logout route
Route::get('/logout', 'UserController@logout');


// Call the viewProfile method within the ProfileController using the /profile route
Route::get('/profile', 'ProfileController@viewMyProfile')->name('profile');

// Call the editProfilePage method within the ProfileController using the /editProfilePage route
Route::post('/editProfilePage', 'ProfileController@editProfilePage');

// Call the editProfilePage method within the ProfileController using the /saveProfile route
Route::post('/saveProfile', 'ProfileController@editProfile');


// Call the adminPage method within the AdminController using the /admin route
Route::get('/admin', 'AdminController@adminPage');

// Call the deleteUser method within the AdminController using the /deleteUser route
Route::post('/deleteUser', 'AdminController@deleteUser');

// Call the suspendUser method within the AdminController using the /suspendUser route
Route::post('/suspendUser', 'AdminController@suspendUser');

// Call the viewUser method within the AdminController using the /adminViewUser route
Route::post('/adminViewUser', 'AdminController@viewUser');

// Call the adminEditUser method within the AdminController using the /adminEditUser route
Route::post('/adminEdit', 'AdminController@adminEdit');

// Call the adminEditUser method within the AdminController using the /adminEditUser route
Route::post('/adminSaveUser', 'AdminController@adminSaveUser');



// Call the addUserEducation method within the EducationController using the /addUserEducation route
Route::post('/addUserEducation', 'EducationController@addUserEducation');



// Call the addUserJob method within the JobController using the /addUserJob route
Route::post('/addUserJob', 'JobController@addUserJob');

    
