<?php


Auth::routes();

Route::group(['prefix' => 'admin','middleware' => 'RoleAcc',], function() {
            
	Route::get('/', 'AdminController@index')->name('admin');
	Route::get('/home', 'AdminController@index')->name('admin.home');
	Route::get('/dashboard', 'AdminController@index')->name('admin.dashboard');
	Route::get('/create', 'AdminController@create')->name('admin.create');
	Route::get('/trash', 'AdminController@trash')->name('admin.trash');
	Route::get('/edit/{id}', 'AdminController@edit')->name('admin.edit');
	Route::get('/delete/{id}', 'AdminController@delete')->name('admin.delete');
	Route::get('/restore/{id}', 'AdminController@restore')->name('admin.restore');
	Route::post('/pDelete/{id}', 'AdminController@pDelete')->name('admin.pDelete');
	Route::post('/create', 'AdminController@store')->name('admin.store');
	Route::post('/update/{id}', 'AdminController@update')->name('admin.update');
	Route::post('/delete/{id}', 'AdminController@delete')->name('admin.delete');

	Route::get('/posts', 'AdminController@posts')->name('admin.posts');
	Route::get('/categories', 'CategoryController@index')->name('admin.categories');
	Route::post('/categories', 'CategoryController@store')->name('admin.categories');
	Route::get('/catEdit/{id}', 'CategoryController@edit')->name('admin.catEdit');
	Route::get('/catDelete/{id}', 'CategoryController@delete')->name('admin.catDelete');
	Route::post('/catUpdate/{id}', 'CategoryController@update')->name('admin.catUpdate');



	//pages 
	Route::get('/pages', 'PagesController@pages')->name('admin.pages');
	Route::get('/pageCreate', 'PagesController@create')->name('admin.pageCreate');
	Route::post('/pageStore', 'PagesController@store')->name('admin.pageStore');
	Route::get('/pageEdit/{id}', 'PagesController@edit')->name('admin.pageEdit');
	Route::post('/pageUpdate/{id}', 'PagesController@update')->name('admin.pageUpdate');
	Route::post('/pageDelete/{id}', 'PagesController@delete')->name('admin.pageDelete');
	Route::get('/pageTrash', 'PagesController@trash')->name('admin.pageTrash');
	Route::get('/pageRestore/{id}', 'PagesController@restore')->name('admin.pageRestore');
	Route::post('/ppDelete/{id}', 'PagesController@ppDelete')->name('admin.ppDelete');


	//social links 
	Route::get('/socialLinks', 'SocialLinksController@index')->name('admin.socialLinks');
	Route::post('/socialLinks', 'SocialLinksController@store')->name('admin.socialLinks');
	Route::get('/slEdit/{id}', 'SocialLinksController@edit')->name('admin.slEdit');
	Route::post('/slUpdate/{id}', 'SocialLinksController@update')->name('admin.slUpdate');
	Route::get('/slDelete/{id}', 'SocialLinksController@delete')->name('admin.slDelete');

	//site details
	Route::get('/SiteDetails', 'AdminController@SiteDetails')->name('admin.SiteDetails');
	Route::get('/CreatesiteSD', 'AdminController@CreatesiteSD')->name('admin.CreatesiteSD');
	Route::post('/storeSD', 'AdminController@siteSDstore')->name('admin.storeSD');
	Route::get('/editSD', 'AdminController@editSD')->name('admin.editSD');
	Route::post('/updateSD', 'AdminController@updateSD')->name('admin.updateSD');

	//site comments
	Route::get('/comments', 'AdminController@comments')->name('admin.comments');
	Route::get('/dComment/{id}', 'AdminController@dComment')->name('admin.dComment');
	Route::get('/tComments', 'AdminController@tComments')->name('admin.tComments');
	Route::get('/commentR/{id}', 'AdminController@commentR')->name('admin.commentR');

	//profile actions
	Route::get('/profileAction', 'AdminController@profileAction')->name('admin.profileAction');
	Route::get('/changePassword', 'AdminController@changePassword')->name('admin.changePassword');\
	Route::post('/changePassword', 'AdminController@updatePass')->name('admin.changePassword');









	
    
});

Route::post('/post/{slug}', 'PostController@addComment')->name('cComment');
Route::get('/deleteCom/{id}', 'PostController@deleteComment')->name('dComment');
Route::get('/logout', 'PagesController@logout')->name('logout');

Route::get('/posts', 'PostController@index')->name('posts');
Route::get('/post/{slug}', 'PostController@show')->name('post');
Route::get('/category/{id}/{catname}', 'CategoryController@posts')->name('catPosts');



Route::get('/', 'PagesController@index')->name('home');
Route::get('/{pageName}', 'PagesController@index');





