<?php
Route::get('/',['as' => 'home', function()
{
  return View::make('hello');
}]);

Route::filter('guest', function()
{
    if (Auth::check()) return Redirect::to('/');
});



Route::get('profile', function()
{
    return "Welcome." . Auth::user()->email;
})->before('auth');


Route::get('login', 'SessionsController@create');
Route::get('logout', 'SessionsController@destroy');

Route::resource('sessions', 'SessionsController', ['only' => ['index', 'create', 'destroy','store']]);
/**
 *  / = home
 * /todos - all lists
 * /todos/1 - show
 * /todos/1/edit - edit and update
 * todos/create - create new list
 */

Route::get('/', 'TasksController@index');
//Route::get('/todos', 'TodoListController@index');
//Route::get('/todos/{id}', 'ToDoListController@show');

Route::get('/db', function(){
    $result = DB::table ('Tasks')->where('name', 'Your List')->first();
    return $result->name;
});

Route::resource('todos', 'TasksController');

Event::listen('illuminate.query', function($query){

});
