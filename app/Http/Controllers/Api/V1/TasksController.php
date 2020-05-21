<?php 
namespace App\Http\Controllers\Api\V1;
 
use Auth;
use App\Task;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
 
class TasksController extends Controller
{
    
    
    public function index($userId)
    {
        return Task::where('user_id', $userId)->get();
    }
 
    public function show($userId, $id)
    {
        return Task::findOrFail($id);
    }
 
    public function update(Request $request,$userId, $id)
    {
        $task = Task::findOrFail($id);
        $task->update($request->all());
 
        return $task;
    }
 
    public function store(Request $request, $userId)
    {      
        $request->user_id = $userId;
        $task = Task::create($request->all());
        return $task;
    }
 
    public function destroy($userId, $id)
    {
        $task = Task::findOrFail($id);
        $task->delete();
        return '';
    }
}