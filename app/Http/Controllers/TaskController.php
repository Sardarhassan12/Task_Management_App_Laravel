<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Task;
use Illuminate\Support\Facades\Auth;

class TaskController extends Controller
{
    //For Displaying All Tasks
    public function viewAll()
    {
        $userTasks = auth()->user()->tasks;
        return view('Task.view', compact('userTasks'));
    }

    //For displaying create task form
    public function task()
    {
        return view('Task.create');
    }

    //For Creating Task and Storing IN DB
    public function createTask()
    {

        $validated = request()->validate([
            'title' => ['required'],
            'description' => ['required'],
            'deadline' => ['required'],
            'status' => ['required'],
            'image' => ['required']
        ]);
        $plainDescription = strip_tags($validated['description']);

        if(request()->has('image')){
            $image = request()->file('image');
            $imageName = time(). '.' .$image->getClientOriginalExtension();
            $imagePath = public_path('/images/tasksimages/');
            $image->move($imagePath, $imageName);
        }

        Task::create([
            'title' => $validated['title'],
            'description' => $plainDescription,
            'status' => $validated['status'],
            'deadline' => $validated['deadline'],
            'image' => $imageName,
            'user_id' =>Auth::id()
        ]);
        return redirect()->route('Task.view')->with('success','Task created successfully.');

    }

    //For Displaying Updated Task Form
    public function updateTask($id)
    {
       
        $task = Task::find($id);
        return view('Task.update', compact('task'));

    }

    //For Updating Task and Storing in DB
    public function storeUpdatedTask($id)
    {
        $validated = request()->validate([
            'title' => ['required'],
            'description' => ['required'],
            'status' => ['required'],
            'deadline' => ['required']
        ]);

        $task = Task::findOrFail($id);

        $plainDescription = strip_tags($validated['description']);

        if(request()->has('image')){
            $image = request()->file('image');
            $imageName = time(). '.' .$image->getClientOriginalExtension();
            $imagePath = public_path('/images/tasksimages/');
            $image->move($imagePath, $imageName);
        }else {
            $imageName = request()->old_image;
        }

        $task->update([
            'title' => $validated['title'],
            'description' => $plainDescription,
            'image' => $imageName,
            'deadline' => $validated['deadline'],
            'status' => $validated['status'],
        ]);
        
        return redirect()->route('Task.view')->with('success', 'Task Updated Successfully');
    }

    public function deleteTask($id)
    {
        $task = Task::find($id);
        $task->delete();

        return redirect()->route('Task.view')->with('success', 'Task Deleted Successfully');
    }  
}