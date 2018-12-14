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

/*Route::get('/', function () {
    return view('welcome');
});*/
use App\Task;
use Illuminate\Http\Request;

Route::group(['middleware' => 'web'], function () {

    /**
     * Show Task Dashboard
     */
    Route::get('/', function () {
    	$tasks = Task::orderBy('created_at', 'asc')->get();

        return view('tasks', [
            'tasks' => $tasks
        ]);        
    });

    /**
     * Add New Task
     */
    Route::post('/task', function (Request $request) {
        $validator = Validator::make($request->all(), [
            'title' => 'required|max:255',
        ]);

        if ($validator->fails()) {
              return redirect('/')
              ->withInput()
              ->withErrors($validator);
        }

        $task = new Task;
        $task->title = $request->title;
        $task->description = $request->description;
        $task->done = 0 ;
        $task->save();

        return redirect('/');
    });

    /**
     * Save Task
     */
    Route::patch('/task/{task}', function (Request $request, Task $task) {
        $validator = Validator::make($request->all(), [
            'title' => 'required|max:255',
        ]);

        if ($validator->fails()) {
              return redirect('/')
              ->withInput()
              ->withErrors($validator);
        }

        $task->title = $request->title;
        $task->description = $request->description;
        $task->done = $request->done?1:0 ;
        $task->save();

        return redirect('/');
    });
    /**
     * Edit Task
     */
    Route::get('/task/{task}', function (Task $task) {    	

    	$tasks = Task::orderBy('created_at', 'asc')->get();

        return view('tasks', [
            'tasks' => $tasks,
            'task'=>$task
        ]);      

        
    });

    /**
     * Delete Task
     */
    Route::delete('/task/{task}', function (Task $task) {
    	$task->delete();

        return redirect('/');
    });
});
