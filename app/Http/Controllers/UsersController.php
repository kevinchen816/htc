<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

//use App\Http\Requests;


use App\User;
use App\Models\Camera;

use Auth;
use DB;

class UsersController extends Controller
{
    // {{ csrf_field() }}

    // public function __construct()
    // {
    //     $this->middleware('auth', [
    //         'except' => ['show', 'create', 'store']
    //     ]);
    // }

    /*----------------------------------------------------------------------------------*/
    /*
        GET    /users               -> index()      // 显示所有用户页面
        GET    /users/create        -> create()     // 创建用户页面 (Register)
        POST   /users               -> store()      // 创建用户
        GET    /users/{user}        -> show()       // 显示用户页面
        GET    /users/{user}/edit   -> edit()       // 编辑用户页面
        PATCH  /users/{user}        -> update()     // 更新用户
        DELETE /users/{user}        -> destroy()    // 删除用户
    */

    /* GET /users - 显示所有用户页面 */
    public function index() {
        $users = User::paginate(30);
        //return view('users.index', compact('users'));
//        return $user; // NG
        return compact('users');
    }

    /* GET /users/create - 创建用户页面 (Register) */
    public function create() {
        return view('users.create');
    }
    // public function register() {
    //     return view('users.register');
    // }

    /* POST /users - 创建用户 */
    public function store(Request $request) {

        $this->validate($request, [
            'name' => 'required|max:50',
            'email' => 'required|email|unique:users|max:255',
            'password' => 'required|confirmed|min:6'
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt($request->password),
        ]);

        Auth::Login($user);

        session()->flash('success', '欢迎，您将在这里开启一段新的旅程~');
        return redirect()->route('users.show', [$user]);
        // return redirect()->route('users.show', [$user->id]);

        if (Auth::check()) {
            session()->flash('success', 'Register Success !!');

            $user = Auth::user();
            $camera = DB::table('cameras')->where('user_id', $user->id)->first();
            // $camera_id = $camera->id;
            $camera_id = 0; // for test
            // $camera = Camera::findOrFail($camera_id);
            return redirect()->route('cameras', $camera_id);
        } else {
            session()->flash('warning', 'Login Fail !!');
            return redirect()->back();
        }
        // return redirect()->route('users.show', [$user]);
    }

    /* GET /users/{user} - 显示用户页面 (Profile) */
    public function show(User $user) {
        // 将用户对象 $user 通过 compact 方法转化为一个关联数组
        // return view('users.show', compact('user'));

        // $cameras = $user->cameras()
        //                  ->orderBy('created_at', 'desc')
        //                  ->paginate(30);
        // $cameras = $user->cameras()->paginate(30);
        $cameras = $user->cameras()->get();
        return view('users.show', compact('user', 'cameras'));
    }
    // public function profile() {
    //     return view('users.profile');
    // }

    /* GET /users/{user}/edit - 编辑用户页面 (Edit) */
    public function edit(User $user) {
        return 'edit';
    }

    /* PATCH /users/{user} - 更新用户 (Update) */
    public function update(User $user) {
        return 'update';
    }

    /* DELETE /users/{user} - 删除用户 (Delete) */
    public function destroy(User $user) {
        return 'destroy';
    }
}
