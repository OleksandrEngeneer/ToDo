<?php

namespace App\Http\Controllers;

use App\Task;
use App\Category;
use Illuminate\Http\Request;

class TaskController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public static function index()
    {
        $today = date("Y-m-d");
        $categories = Category::all();
        $tasks_today = (Task::where('deadline', $today)->where('status', 'new')->get())->toArray();
        $tasks_frozen = (Task::where('status', 'frozen')->get())->toArray();
        $tasks_done = (Task::where('status', 'completed')->get())->toArray();
        return view('tasks', [
            'tasks' => $tasks_today,
            'tasks_frozen' => $tasks_frozen,
            'tasks_done' => $tasks_done,
            'categories' => $categories
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        print_r($request['text']);
        $data = $request->validate([
            'text' => 'required|min:4|max:255',
            'deadline' => 'required',
        ]);
        Task::insert([
            'id' => null,
            'category_id' => $request['category'],
            'body' => $request['text'],
            'status' => 'new',
            'deadline' => $request['deadline'],
            'created_at' => date("Y-m-d H:i:s"),
            'updated_at' => date("Y-m-d H:i:s")
        ]);
        $today = date("Y-m-d");
        $categories = Category::all();
        $tasks_today = (Task::where('deadline', $today)->where('status', 'new')->get())->toArray();
        $tasks_frozen = (Task::where('status', 'frozen')->get())->toArray();
        $tasks_done = (Task::where('status', 'completed')->get())->toArray();
        return view('tasks', [
            'tasks' => $tasks_today,
            'tasks_frozen' => $tasks_frozen,
            'tasks_done' => $tasks_done,
            'categories' => $categories
        ]);
    }
    /**
     * Display the specified resource.
     *
     * @param  \App\Task  $task
     * @return \Illuminate\Http\Response
     */
    public function tasksDone()
    {
        if (isset($_POST['done'])) {
            foreach ($_POST as $key => $value) {
                if ($value === 'on') {
                    Task::where('id', $key)->update(['status' => 'completed']);
                };
            };
        } elseif (isset($_POST['delay'])) {
            foreach ($_POST as $key => $value) {
                if ($value === 'on') {
                    Task::where('id', $key)->update(['status' => 'frozen']);
                };
            };
        } elseif (isset($_POST['delete'])) {
            foreach ($_POST as $key => $value) {
                if ($value === 'on') {
                    Task::where('id', $key)->delete();
                };
            };
        };

        $today = date("Y-m-d");
        $categories = Category::all();
        $tasks_today = (Task::where('deadline', $today)->where('status', 'new')->get())->toArray();
        $tasks_frozen = (Task::where('status', 'frozen')->get())->toArray();
        $tasks_done = (Task::where('status', 'completed')->get())->toArray();
        return view('tasks', [
            'tasks' => $tasks_today,
            'tasks_frozen' => $tasks_frozen,
            'tasks_done' => $tasks_done,
            'categories' => $categories
        ]);
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Task  $task
     * @return \Illuminate\Http\Response
     */
    public function tasksReopen()
    {
        foreach ($_POST as $key => $value) {
            if ($value === 'on') {
                Task::where('id', $key)->update(['status' => 'new']);
            };
        };

        $today = date("Y-m-d");
        $categories = Category::all();
        $tasks_today = (Task::where('deadline', $today)->where('status', 'new')->get())->toArray();
        $tasks_frozen = (Task::where('status', 'frozen')->get())->toArray();
        $tasks_done = (Task::where('status', 'completed')->get())->toArray();
        return view('tasks', [
            'tasks' => $tasks_today,
            'tasks_frozen' => $tasks_frozen,
            'tasks_done' => $tasks_done,
            'categories' => $categories
        ]);
    }
}
