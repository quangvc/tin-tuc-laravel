<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Console\View\Components\Confirm;
use Illuminate\Support\Facades\DB;
use PhpParser\Node\Expr\Cast\Object_;

class DashboardController extends Controller
{
    public function index() {
        // $users = User::all();
        $users = User::search()->paginate(10);
        // $users = User::paginate(10);
        $count = User::count();

        return view('dashboard', compact('users', 'count'));
    }

    public function create() {
        return view('admin.create');
    }

    public function store(Request $request) {
        $request->validate([
            'name' => ['required', 'min:3', 'max:30' ],
            'email' => 'bail|required|email|unique:users,email, . $this->id',
            'password' => 'bail|required|min:5',
            'phone' => 'bail|required|numeric|digits_between:9,12',
            'address' => 'bail|required',
            'avatar' => 'bail|image|max:2048|mimes:jpeg,png,jpg|mimetypes:image/jpeg,image/png,image/jpg',

        ]);
        $user = new User();
        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = bcrypt($request->password);
        $user->phone = $request->phone;
        $user->address = $request->address;
        
        if ($request->has('avatar')) {
            $file = $request->avatar;
            $user->profile_photo_path = $file->getClientOriginalName();
            
            $file->move(base_path('public/avatars'), $user->profile_photo_path);   
        }        
        // dd($request->avatar);         
        $user->status = $request->status;
        $user->role = $request->role;

        $user->save();
        return redirect('/dashboard')->with('message', 'Created successfully');
    }

    public function edit($id) {
        $user = User::find($id);
        return view('admin.edit', compact('user'));
    }

    public function update(Request $request, $id) {
        $request->validate([
            'name' => ['required', 'min:3', 'max:30' ],
            'email' => 'bail|required|email|unique:users,email,' . $request->id,
            'phone' => 'bail|required|numeric|digits_between:9,12',
            'address' => 'bail|required',
            'avatar' => 'bail|image|max:2048|mimes:jpeg,png,jpg|mimetypes:image/jpeg,image/png,image/jpg',

        ]);
        $user = User::find($id);
        $user->name = $request->name;
        $user->email = $request->email;
        $user->phone = $request->phone;
        $user->address = $request->address;        
        if ($request->has('avatar')) {
            $file = $request->avatar;
            $user->profile_photo_path = $file->getClientOriginalName();            
            $file->move(base_path('public/avatars'), $user->profile_photo_path);   
        }             
        $user->status = $request->status;
        $user->role = $request->role;

        $user->save();  
        return redirect('/dashboard')->with('message', 'Updated successfully');      
    }

    public function destroy($id) {
        User::destroy($id);
        return redirect('/dashboard')->with('message', 'Deleted successfully');
    }

    // public function show() {
    //     return view('dashboard');
    // }
}
