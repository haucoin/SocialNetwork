<?php

/**
 * @name Social Network
 * @version 6.0
 * @author Holland Aucoin and Salvatore Parascandola
 *
 * @desc - Web.app is a file that outlines the necessary routes for the application
 */



/**
 * Main page routes
 */

// Route to the index page using the / route
Route::get('/', function () { return view('index'); });

// Call the viewHome method within the UserController using the /home route
Route::get('/home', 'UserController@viewHome');

// Route to the settings page using the /settings route
Route::get('/settings', function() { return view('settings'); });

// Route to the error page using the /errorPage route
Route::get('/error', function() { return view('error'); });



/**
 * UserController routes - USERS
 */

// Route to the login page using the /login route
Route::get('/login', function () { return view('login'); });

// Call the authenticateUser method within the UserController using the /loginUser route
Route::post('/loginUser', 'UserController@authenticateUser');

// Route to the registration page using the /registration route
Route::get('/registration', function () { return view('registration'); });

// Call the registerUser method within the UserController using the /registerUser route
Route::post('/registerUser', 'UserController@registerUser');

// Route to the confirmation page using the /confirmation route
Route::get('/confirmation', function () { return view('confirmation'); });

// Call the updateUser method within the UserController using the /updateUser route
Route::post('/updateUser', 'UserController@updateUser');

// Call the logout method within the UserController using the /logout route
Route::get('/logout', 'UserController@logout');



/**
 * UserController routes - ADMIN
 */

// Call the manageUserAccounts method within the UserController using the /manageUserAccounts route
Route::get('/manageUserAccounts', 'UserController@manageUserAccounts');

// Call the viewUserAccount method within the UserController using the /viewUserAccount route
Route::post('/viewUserAccount', 'UserController@viewUserAccount');

// Call the editUserAccount method within the UserController using the /editUserAccount route
Route::post('/editUserAccount', 'UserController@editUserAccount');

// Call the updateUserAccount method within the UserController using the /updateUserAccount route
Route::post('/updateUserAccount', 'UserController@updateUserAccount');

// Call the deleteUserAccount method within the UserController using the /deleteUserAccount route
Route::post('/deleteUserAccount', 'UserController@deleteUserAccount');

// Call the suspendUserAccount method within the UserController using the /suspendUserAccount route
Route::post('/suspendUserAccount', 'UserController@suspendUserAccount');



/**
 * ProfileController routes
 */

// Call the viewProfile method within the ProfileController using the /profile route
Route::get('/profile', 'ProfileController@viewProfile')->name('profile');

// Call the editProfile method within the ProfileController using the /editProfile route
Route::post('/editProfile', 'ProfileController@editProfile');

// Call the updateProfile method within the ProfileController using the /updateProfile route
Route::post('/updateProfile', 'ProfileController@updateProfile');



/**
 * EducationController routes
 */

// Route to the add education page using the /addEducation route
Route::get('/addEducation', function() { return view('addEducation'); });

// Call the createEducation method within the EducationController using the /createEducation route
Route::post('/createEducation', 'EducationController@createEducation');

// Call the deleteEducation method within the EducationController using the /deleteEducation route
Route::post('/deleteEducation', 'EducationController@deleteEducation');



/**
 * JobController routes
 */

// Route to the add job page using the /addJob route
Route::get('/addJob', function() { return view('addJob'); });

// Call the createJob method within the JobController using the /createJob route
Route::post('/createJob', 'JobController@createJob');

// Call the deleteUser method within the JobController using the /deleteUser route
Route::post('/deleteJob', 'JobController@deleteJob');



/**
 * PostController routes - USERS
 */

// Call the viewAllPosts method within the PostController using the /jobPostings route
Route::get('/jobPostings', 'PostController@viewAllPosts')->name("jobPostings");

// Call the viewUser method within the PostController using the /viewPost route
Route::post('/viewPost', 'PostController@viewPost');

// Route to the application page using the /apply route
Route::get('/apply', function () { return view('application'); });

// Call the sortJobPostings method within the PostController using the /submitApplication route
Route::post('/submitApplication', 'PostController@viewAllPosts');



/**
 * PostController routes - ADMIN
 */

// Route to the add posting page using the /addPosting route
Route::get('/addPosting', function() { return view('addPosting'); });

// Call the createPost method within the PostController using the /createPost route
Route::post('/createPost', 'PostController@createPost');

// Call the editPost method within the PostController using the /editPost route
Route::post('/editPost', 'PostController@editPost');

// Call the updatePost method within the PostController using the /updatePost route
Route::post('/updatePost', 'PostController@updatePost');

// Call the deletePost method within the PostController using the /deletePost route
Route::post('/deletePost', 'PostController@deletePost');

// Call the searchJobPostings method within the PostController using the /searchJobPostings route
Route::post('/searchJobPostings', 'PostController@searchJobPostings');

// Call the sortJobPostings method within the PostController using the /sortJobPostings route
Route::post('/sortJobPostings', 'PostController@sortJobPostings');



/**
 * GroupController routes - USERS
 */

// Call the groups method within the GroupController using the /groups route
Route::get('/groups', 'GroupController@groups');

// Call the viewGroup method within the GroupController using the /viewGroup route
Route::post('/viewGroup', 'GroupController@viewGroup');

// Call the joinGroup method within the GroupController using the /joinGroup route
Route::post('/joinGroup', 'GroupController@joinGroup');

// Call the leaveGroup method within the GroupController using the /leaveGroup route
Route::post('/leaveGroup', 'GroupController@leaveGroup');



/**
 * GroupController routes - ADMIN
 */

// Route to the add group page using the /addGroup route
Route::get('/addGroup', function() { return view('addGroup'); });

// Call the createGroup method within the GroupController using the /createGroup route
Route::post('/createGroup', 'GroupController@createGroup');

// Call the editGroup method within the PostController using the /editGroup route
Route::post('/editGroup', 'GroupController@editGroup');

// Call the updateGroup method within the GroupController using the /updateGroup route
Route::post('/updateGroup', 'GroupController@updateGroup');

// Call the deleteGroup method within the GroupController using the /deleteGroup route
Route::post('/deleteGroup', 'GroupController@deleteGroup');



/**
 * ProfileRESTController routes
 */

Route::resource('/profilerest', 'ProfileRESTController');



/**
 * PostingRESTController routes
 */

Route::resource('/postingrest', 'PostingRESTController');

