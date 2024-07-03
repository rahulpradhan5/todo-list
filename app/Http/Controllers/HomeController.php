<?php

namespace App\Http\Controllers;

use App\Models\todo_list;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    //index

    public function index(Request $request)
    {
        $tasks = todo_list::where('user_id', Auth::id())->where('completed_status', 0)->orderBy('created_at', 'desc')->get();
        return view('welcome', ['tasks' => $tasks]);
    }

    // add task
    public function addTask(Request $request)
    {

        $task =  todo_list::create([
            'task' => $request->task,
            'user_id' => Auth::id(),
        ]);
        if ($task) {
            if ($request->showall == true) {
                $tasks = todo_list::where('user_id', Auth::id())->orderBy('created_at', 'desc')->get();
            } else {
                $tasks = todo_list::where('user_id', Auth::id())->where('completed_status', 0)->orderBy('created_at', 'desc')->get();
            }
            return view('healper.taskLoad', ['tasks' => $tasks]);
        } else {
            return 'Failed';
        }
    }


    // mark completed
    public function markTask(Request $request)
    {
        $task = todo_list::where('id', $request->taskId)->where('user_id', Auth::id())->first();
        if ($task) {
            // Update the completed status
            $task->update([
                'completed_status' => 1
            ]);

            // Retrieve the updated list of tasks for the user
            if ($request->showall == true) {
                $tasks = todo_list::where('user_id', Auth::id())->orderBy('created_at', 'desc')->get();
            } else {
                $tasks = todo_list::where('user_id', Auth::id())->where('completed_status', 0)->orderBy('created_at', 'desc')->get();
            }
            return view('healper.taskLoad', ['tasks' => $tasks]);
        } else {
            return 'Failed';
        }
    }

    // delete task
    public function deleteTask(Request $request)
    {
        $task = todo_list::where('id', $request->taskId)->where('user_id', Auth::id())->first();
        if ($task) {
            // Update the completed status
            $deleted = $task->delete();
            if ($deleted) {
                return "Success";
            } else {
                return 'Failed';
            }
        } else {
            return 'Failed';
        }
    }

    // show all

    public function showAll(Request $request)
    {
        if ($request->showall == 1) {
            $tasks = todo_list::where('user_id', Auth::id())->orderBy('created_at', 'desc')->get();
        } else {
            $tasks = todo_list::where('user_id', Auth::id())->where('completed_status', 0)->orderBy('created_at', 'desc')->get();
        }
        return view('healper.taskLoad', ['tasks' => $tasks]);
    }
}
