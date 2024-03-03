<?php

namespace App\Http\Controllers\Admin;

use App\Events\DueTask;
use App\Helpers\ResponseBuilder;
use App\Http\Controllers\Controller;
use App\Models\Task;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Exception;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Validation\Rule;

class TaskController extends Controller
{

    public function index(Request $request)
{
    // Retrieve tasks with users
    $tasks = Task::with('users:id')->latest()->get();
    // Pass the tasks to the view
    return view('admin.tasks.index', compact('tasks'));
}


public function filterByStatus($status)
    {
        switch ($status) {
            case 'upcoming':
                $tasks = Task::with('users')->where('due_date','>',Carbon::today())
                ->where('due_date','<=',Carbon::tomorrow())->where('status', 'due')->get();
                break;
            case 'completed':
                $tasks = Task::with('users:id')->where('status', 'completed')->latest()->get();
                break;
            case 'overdue':
                $tasks = Task::with('users:id')->where('status','overdue')->latest()->get();
                break;
            case 'pending':
                $tasks = Task::with('users:id')->where('status', 'pending')->latest()->get();
                break;
            case 'canceled':
                $tasks = Task::with('users:id')->where('status', 'canceled')->latest()->get();
                break;
            default:
                $tasks = Task::with('users:id')->latest()->get();
                break;
        }

        return view('admin.tasks.index', compact('tasks'));
    }

    public function createTask(){
        return view('admin.tasks.create');
    }

    public function store(Request $request){
        try{
            DB::beginTransaction();
            $validator = Validator::make($request->all(),[
                'title'=> 'required',
                'description' => 'nullable',
                'due_date'=> 'required|timestamp',
                'priority_level' => 'required|integer',
                'status' => 'required|in:pending, due, overdue, canceled, completed',
                'user_id' => ['required', Rule::exists('users', 'id')->whereNull('deleted_at')]

            ]);

            // if(!$validator){
            //     return redirect()->back()->with('error','enter valied values');
            // }
            $data= $request->only('title','description','due_date','priority_level','status');
            $task= Task::create($data);
            $task->users()->attach($request->user_id);

            DB::commit();
            event(new DueTask($task));
            return redirect()->route('user.tasks')->with('success','Task has created successfully');

        }catch(Exception $e){
            DB::rollBack();
            // return redirect()->back()->with('error','something went wrong try again');
            return $e->getMessage();
        }
    }

    public function edit($id){
        $task = Task::with('users:id')->find($id);
        if($task){
            return view('admin.tasks.edit',compact('task'));
        }
        else{
            return redirect()->back()->with('error','Task not found');
        }
    }


    public function update(Request $request , $id){
        try{
            DB::beginTransaction();
            $task = Task::find($id);
            $validator = Validator::make($request->all(),[
                'title'=> 'required',
                'description' => 'nullable',
                'due_date'=> 'required|timestamp',
                'priority_level' => 'required|integer',
                'status' => 'required|in:pending, due, overdue, canceled, completed',
                // 'user_id' => ['required', Rule::exists('users', 'id')->whereNull('deleted_at')]

            ]);

            if(!$validator){
                return redirect()->back()->with('error','enter valied values');
            }

            $data= $request->only('title','description','due_date','priority_level','status');
            $task->update($data);

            DB::commit();
            event(new DueTask($task));
            return redirect()->route('user.tasks')->with('success','Task has updated successfully');

        }catch(Exception $e){
            DB::rollBack();
            return redirect()->back()->with('error',$e->getMessage());
        }
    }



    public function delete($id){
        try{
            DB::beginTransaction();
            $task= Task::find($id);
            if($task){
                $task->users()->detach();
                $task->delete();
                DB::commit();
                return redirect()->route('user.tasks')->with('success','Task has deleted successfully');
            }
            else{
                return redirect()->back()->with('error','Task not found');
            }

        }catch(Exception $e){
            DB::rollBack();
            return redirect()->back()->with('error',$e->getMessage());
        }
    }
}
