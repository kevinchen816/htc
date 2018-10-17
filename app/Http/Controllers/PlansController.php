<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Plan;

use Auth;
use DB;

class PlansController extends Controller
{
    public function view() {
        // if (Auth::check()) {
        //     $user = Auth::user();
        //     return view('account.profile', compact('user'));
        // } else {
        //     return view('account.profile');
        // }
        $user = Auth::user();
        $data['sel_menu'] = 'plan';
        $user->update($data);
        return view('plans.add-plan', compact('user'));
    }

    public function add(Request $request) {
//return $request;

//Error: Please input an ICCID.
//Error: Invalid ICCID. Verify that you have input the ICCID correctly.
//Error: Please read and agree to the TERMS and CONDITIONS.
//Error: Invalid ICCID. Verify you have not already used this ICCID in another plan and that you have input the ICCID correctly.

        //$result = $this->validate($request, [
        //    'iccid' => 'required|unique:plans|max:20',
        //]);

//$ret['result'] = $result;
//return $ret;

        if (Auth::check()) {
            $user = Auth::user();

            if (!$request->iccid) {
                session()->flash('danger', 'Error: Please input an ICCID.');
                return redirect()->back();
            }

            $plan = DB::table('plans')
                ->where('iccid', $request->iccid)
                ->first();
            if ($plan) {
                session()->flash('danger', 'Invalid ICCID. Verify you have not already used this ICCID in another plan and that you have input the ICCID correctly.');
                return redirect()->back();
            }

            $plan = Plan::create([
                'iccid' => $request->iccid,
                'status' => 'active',
                //'points' => $request->points,
                'user_id' => Auth::user()->id,
            ]);

            //session()->flash('success', 'Create Success');
            //return redirect()->route('plans.show', [$plan]);
            //return view('plans.show', compact('user', 'plan'));
            return redirect()->route('account.profile');

        } else {
            session()->flash('warning', 'Please Login first');
            return redirect()->route('login');
        }
    }

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
        if (Auth::check()) {
            $user = Auth::user();

            // $plans = Plan::all();
            $plans = Plan::paginate(5);
            return view('plans.index', compact('user', 'plans'));
        } else {
            session()->flash('warning', 'Please login first.');
            return redirect()->route('login');
        }
    }

    /* Create Page - GET /xxx/create  */
    public function create() {
        $user = Auth::user();
        return view('plans.create', compact('user'));
    }

    /* Create - POST /xxx  */
    /*
        Error: Invalid ICCID. Verify you have not already used this ICCID in another plan and that you have input the ICCID correctly.
    */
    public function store(Request $request) {
        // return 'store';
//return $request;

        $this->validate($request, [
            'iccid' => 'required|unique:plans|max:20',
        ]);

        if (Auth::check()) {
            $user = Auth::user();

            $plan = Plan::create([
                'iccid' => $request->iccid,
                'status' => 'active',
                'points' => $request->points,
                'user_id' => Auth::user()->id,
            ]);

            session()->flash('success', 'Create Success');
            //return redirect()->route('plans.show', [$plan]);
            return view('plans.show', compact('user', 'plan'));
        } else {
            session()->flash('warning', 'Please Login first');
            return redirect()->route('login');
        }
    }

    /* Read - GET /xxx/{id} */
    public function show(Plan $plan) {
        $user = Auth::user();
        return view('plans.show', compact('user', 'plan'));

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
        $user = Auth::user();
        return view('plans.edit', compact('user', 'plan'));

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
        $user = Auth::user();

        $plan->delete();
        // return back();

        // $plans = Plan::all();
        $plans = Plan::paginate(5);

        session()->flash('success', 'Delete Success');
        return view('plans.index', compact('user', 'plans'));
    }
}
