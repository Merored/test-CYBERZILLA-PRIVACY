<?php 
namespace App\Http\Controllers;
 
use App\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
 
class UsersController extends Controller
{
    public function index()
    {
        return User::all();
    }
 
    public function show($id)
    {
        return User::findOrFail($id);
    }
 
    public function update(Request $request,$id)
    {
        $user = User::findOrFail($id);
        $user->update($request->all());
 
        return $user;
    }
 
    public function store(Request $request)
    {      
        $userData = $request->input();
        $userData['password'] = \Hash::make($userData['password']);
        $user = User::create($userData);
        return $user;
    }
 
    public function destroy($id)
    {
        $user = User::findOrFail($id);
        $user->delete();
        return '';
    }
}