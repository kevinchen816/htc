<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Plan;

use Auth;
use DB;

class PlansController extends Controller
{
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

    /* All - GET /xxx */
    public function index() {
        // return view('plans.index');

        // $plans = Plan::all();
        $plans = Plan::paginate(5);
        return view('plans.index', compact('plans'));
    }

    /* Create Page - GET /xxx/create  */
    public function create() {
        return view('plans.create');

        // return view('plans.create');
    }

    /* Create - POST /xxx  */
    /*
        Error: Invalid ICCID. Verify you have not already used this ICCID in another plan and that you have input the ICCID correctly.
    */
    public function store(Request $request) {
        // return 'store';

        $this->validate($request, [
            'iccid' => 'required|unique:plans|max:20',
        ]);

        if (Auth::check()) {
            $plan = Plan::create([
                'iccid' => $request->iccid,
                'points' => $request->points,
                'user_id' => Auth::user()->id,
            ]);

            session()->flash('success', 'Create Success');
            return redirect()->route('plans.show', [$plan]);
        } else {
            session()->flash('warning', 'Please Login first');
            return redirect()->route('plans.index');
        }
    }

    /* Read - GET /xxx/{id} */
    public function show(Plan $plan) {
        // return 'show';
        return view('plans.show', compact('plan'));

        // 将用户对象 $user 通过 compact 方法转化为一个关联数组
        // return view('users.show', compact('user'));

        // $cameras = $user->cameras()
        //                  ->orderBy('created_at', 'desc')
        //                  ->paginate(30);
        // $cameras = $user->cameras()->paginate(30);

        // $cameras = $user->cameras()->get();
        // return view('plans.show', compact('plan'));
    }

    /* Edit - GET /xxx/{id}/edit */
    public function edit(Plan $plan) {
        // return 'edit';
        return view('plans.edit', compact('plan'));

        // $this->authorize('update', $plan);
        // return view('plans.edit', compact('plan'));
    }

    /* Update - PATCH /xxx/{id} */
    public function update(Plan $plan, Request $request) {
        // return 'update';
        $this->validate($request, [
            'points' => 'required',
            'points_used' => 'required',
        ]);

        $data['points'] = $request->points;
        $data['points_used'] = $request->points_used;
        $plan->update($data);

        session()->flash('success', 'Update Success');

        return redirect()->route('plans.show', $plan->id);
    }

    /* Delete - DELETE /xxx/{id} */
    public function destroy(Plan $plan) {
        // return 'delete';
        $plan->delete();
        session()->flash('success', 'Delete Success');

        // return back();
        // $plans = Plan::all();
        $plans = Plan::paginate(5);
        return view('plans.index', compact('plans'));
    }
}
