<?php

Route::get('login', 'SessionsController@create');
Route::get('logout', 'SessionsController@destoy');

Route::resource('sessions', 'SessionsController');
/**
 *  / = home
 * /todos - all lists
 * /todos/1 - show
 * /todos/1/edit - edit and update
 * todos/create - create new list
 */

Route::get('/', 'TodoListController@index');
//Route::get('/todos', 'TodoListController@index');
//Route::get('/todos/{id}', 'ToDoListController@show');

Route::get('/db', function(){
    $result = DB::table ('todo_lists')->where('name', 'Your List')->first();
    return $result->name;
});

Route::resource('todos', 'ToDoListController');

Event::listen('illuminate.query', function($query){

});
