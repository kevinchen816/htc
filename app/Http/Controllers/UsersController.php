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

    public function __construct()
    {
        $this->middleware('auth', [
            // 'except' => ['show', 'create', 'store']
            'except' => ['show', 'create', 'store', 'index', 'create_10ware', 'create_germany']
        ]);

        $this->middleware('guest', [
            'only' => ['create']
        ]);
    }

    public function route_to_cameras($portal) {
        if ($portal == 10) {
            return redirect()->route('cameras.10ware');
        } else if ($portal == 11) {
            return redirect()->route('cameras.germany');
        } else {
            return redirect()->route('cameras');
        }
    }

    /*----------------------------------------------------------------------------------*/
    /*
        GET    /users/create        -> create()     // 创建用户页面 (Register)
        POST   /users               -> store()      // 创建用户

        GET    /users               -> index()      // 显示所有用户页面
        GET    /users/{user}        -> show()       // 显示用户页面

        GET    /users/{user}/edit   -> edit()       // 编辑用户页面
        PATCH  /users/{user}        -> update()     // 更新用户

        DELETE /users/{user}        -> destroy()    // 删除用户
    */

    /*----------------------------------------------------------------------------------*/
    /* GET /users/create - 创建用户页面 (Register) */
    public function create() {
        $portal = 0;
        return view('users.create', compact('portal'));
    }

    public function create_10ware() {
        $portal = 10;
        return view('users.create', compact('portal'));
    }

    public function create_germany() {
        $portal = 11;
        return view('users.create', compact('portal'));
    }

    /* POST /users - 创建用户 */
    public function store(Request $request) {
        $this->validate($request, [
            'name' => 'required|max:50',
            'email' => 'required|email|unique:users|max:255',
            'password' => 'required|confirmed|min:6'
        ]);

        $portal = $request->portal;
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt($request->password),
            'portal' => $portal,
            'permission' => 0,
        ]);

        Auth::Login($user);

        //return redirect()->route('cameras');
        return $this->route_to_cameras($portal);


        //if (Auth::check()) {
        //    session()->flash('success', 'Register Success !!');
        //    return redirect()->route('users.show', [$user]); // [$user] = [$user->id]
        //} else {
        //    session()->flash('warning', 'Login Fail !!');
        //    return redirect()->back();
        //}
    }

    /*----------------------------------------------------------------------------------*/
    /* GET /users - 显示所有用户页面 */
    public function index() {
        // $users = User::all();
        $users = User::paginate(5);
        return view('users.index', compact('users'));
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

    /*----------------------------------------------------------------------------------*/
    /* GET /users/{user}/edit - 编辑用户页面 (Edit) */
    public function edit(User $user) {
        if (!Auth::check()) {
            session()->flash('warning', 'Please Login first');
            return redirect()->route('login');
        }

        $user = Auth::user();
        $data['sel_menu'] = 'user';
        $user->update($data);

        $this->authorize('update', $user);
        return view('users.edit', compact('user'));
    }

    /* PATCH /users/{user} - 更新用户 (Update) */
    public function update(User $user, Request $request) {
        $this->validate($request, [
            'name' => 'required|max:50',
            // 'password' => 'required|confirmed|min:6'
            'password' => 'nullable|confirmed|min:6'
        ]);

        // $user->update([
        //     'name' => $request->name,
        //     'password' => bcrypt($request->password),
        // ]);

        $data = [];
        $data['name'] = $request->name;
        if ($request->password) {
            $data['password'] = bcrypt($request->password);
        }
        $user->update($data);

        session()->flash('success', '个人资料更新成功！');
        return redirect()->route('users.show', $user->id);
    }

    /*----------------------------------------------------------------------------------*/
    /* DELETE /users/{user} - 删除用户 (Delete) */
    public function destroy(User $user) {
        $user->delete();
        session()->flash('success', '成功删除用户！');
        return back();
    }
}
