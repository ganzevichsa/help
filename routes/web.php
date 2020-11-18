<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
//Главная страница
Route::get('/', function () {
    $objects = App\ObjectIt::all();
    $objects_to = App\Object_to::all();
    return view('welcome', compact('objects_to', 'objects'));
});
//Добавление заявки
Route::post('tasks/add', 'WelcomeController@taskItAdd')->name('taskIt.add');
Route::post('tasks/addtaskmail', 'HomeController@addTaskMail')->name('taskIt.addTaskMail');
//Статус заявки
Route::get('/statuszayavki', function () {
    return view('statuszayavki');
});
Route::post('/statuszayavkiYes', 'WelcomeController@statusZayavkiYes')->name('statusZayavkiYes');
Route::get('/status/taskit/{id}', 'WelcomeController@statusTaskIt')->name('statusTaskIt');
Route::post('/statuszayavkiYes/commentadd', 'WelcomeController@taskGuestCommentAdd')->name('taskGuest.comment.add');

//Метод аут и отключенная регистрация
Auth::routes(['register' => false]);

Route::get('/home', 'HomeController@index')->name('home');
Route::get('/home/cableJournal', 'HomeController@cableJournal')->name('It.cableJournal');
Route::get('/home/mail', 'HomeController@taskItMail')->name('taskIt.mail');
Route::get('/home/bagi', 'HomeController@bagiIT')->name('bagiIT');
Route::post('home/bagi/add', 'HomeController@bagsAdd')->name('bags.add');
Route::post('home/comment/add', 'HomeController@commentAdd')->name('taskIt.comment.add');
Route::post('home/mailotvet/add', 'HomeController@mailotvetAdd')->name('taskIt.mailotvet.add');
Route::get('/home/edit', 'HomeController@edit')->name('home.edit');
Route::post('home/edit/object/add', 'HomeController@objectAdd')->name('object.add');
Route::post('home/edit/category/add', 'HomeController@categoryAdd')->name('category.add');
Route::post('home/edit/object_to/add', 'HomeController@object_toAdd')->name('object_to.add');
Route::get('/home/tasks/completed', 'HomeController@TasksItCompleted')->name('TasksIt.completed');
Route::get('/home/tasks/intheprocess', 'HomeController@TasksItIntheprocess')->name('TasksIt.intheprocess');
Route::get('/home/tasks/notcompleted', 'HomeController@TasksItNotcompleted')->name('TasksIt.notcompleted');
Route::get('/home/tasks/my', 'HomeController@MyTasksIndex')->name('my.tasksIt');
Route::get('/home/tasks/my/completed', 'HomeController@MyTasksItCompleted')->name('TasksIt.my.completed');
Route::get('/home/tasks/my/intheprocess', 'HomeController@MyTasksItIntheprocess')->name('TasksIt.my.intheprocess');
Route::get('/home/tasks/my/notcompleted', 'HomeController@MyTasksItNotcompleted')->name('TasksIt.my.notcompleted');
Route::post('/home/tasks/status', 'HomeController@tasksItStatus')->name('tasksIt.status');
Route::post('/home/tasks/responsible', 'HomeController@tasksItResponsible')->name('tasksIt.responsible');
Route::post('/home/tasks/edittaskhome', 'HomeController@tasksItEdittaskhome')->name('tasksIt.edittaskhome');





