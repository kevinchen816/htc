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

        $portal = $user->portal;
        return view('plans.add-plan', compact('portal', 'user'));
    }

    public function my_plans() {
        $user = Auth::user();
        $data['sel_menu'] = 'my_plans';
        $user->update($data);

        $portal = $user->portal;
        return view('plans.my-plans', compact('portal', 'user'));
    }

    public function MyPlans() {
        //return 'Hello';
        $user = Auth::user();
        $user_id = $user->id;

        $plans = DB::table('plans')
            ->where('user_id', $user_id)
            ->get();

        $handle = '';
        foreach ($plans as $plan) {
            //$camera_name = '(No Camera)';
            //if ($plan->camera_id) {
            //    $camera = Camera::find($plan->camera_id);
            //    if ($camera) {
            //        $camera_name = $camera->description;
            //    }
            //}

            $handle .= '<div class="row">';
            $handle .=     '<div class="col-md-12">';
            $handle .=         '<div style="margin-top:10px; margin-bottom:4px; border-bottom: 1px solid gray;border-top: 1px solid lime; padding-bottom: 4px; padding-top: 4px;padding-left:10px; background-color: #444">';
            $handle .=             '<div class="row">';
            $handle .=                 '<div class="col-md-5">';
            $handle .=                     '<i class="fa fa-dot-circle"></i>';
            $handle .=                     '<span class="label label-info" style="font-size: 1.00em;">Prepaid 6 Months</span>';
            $handle .=                     '<span class="label label-success" style="font-size:0.9em;">Active</span>';
            $handle .=                     '<p></p>';
            $handle .=                 '</div>';
            $handle .=                 '<div class="col-md-5">';
            $handle .=                 '</div>'; // <!-- end col -->
            $handle .=             '</div>';
            $handle .=         '</div>';
            $handle .=     '</div>';
            $handle .= '</div>';

            $handle .= '<div class="row">';
            $handle .=     '<div class="col-sm-6">';
            $handle .=         '<table class="table plan-table">';
            $handle .=             '<tbody>';
//            $handle .=                 '<tr><td class="pull-right"><i class="fa fa-bolt"></i>Sim ICCID:</td>';
            $handle .=                 '<tr><td class="pull-right"></i>ICCID:</td>';
            $handle .=                     '<td><strong>'.$plan->iccid.'</strong></td>';
            $handle .=                 '</tr>';
//            $handle .=                 '<tr><td class="pull-right"><i class="fa fa-camera"> </i> Camera:</td>';
            //$handle .=                 '<tr><td class="pull-right">Camera:</td>';
            //$handle .=                     '<td><strong>'.$camera_name.'</strong></td>';
            //$handle .=                 '</tr>';
            $handle .=                 '<tr><td class="pull-right">Plan Points:</td>';
            $handle .=                     '<td><strong>'.$plan->points.'</strong></td>';
            $handle .=                 '</tr>';
            $handle .=                 '<tr><td class="pull-right">Points Used:</td>';
            $handle .=                     '<td><strong>'.$plan->points_used.'</strong></td>';
            $handle .=                 '</tr>';
//            $handle .=                 '<tr><td class="pull-right">SMS Sent:</td>';
//            $handle .=                     '<td><strong>'.$plan->sms_sent.'</strong></td>';
//            $handle .=                 '</tr>';
            $handle .=             '</tbody>';
            $handle .=         '</table>';
            $handle .=     '</div>';
            $handle .= '</div>';
        }
        return $handle;
    }

    public function my_plans2() {

        if (!Auth::check()) {
            session()->flash('warning', 'Please Login first');
            return redirect()->route('login');
        }

        $user = Auth::user();
        $data['sel_menu'] = 'my_plans';
        $user->update($data);

        $user_id = $user->id;
        $plans = DB::table('plans')
            ->where('user_id', $user_id)
            //->orderBy('created_at', 'desc')
            ->paginate(10);

        $portal = $user->portal;
        return view('plans.my-plans2', compact('portal', 'user', 'plans'));
    }

    public function MyPlans2($plans) {
        //$user = Auth::user();
        //$user_id = $user->id;
        //
        //$plans = DB::table('plans')
        //    ->where('user_id', $user_id)
        //    ->get();

        $handle = '';
        foreach ($plans as $plan) {
            $handle .= '<tr>';
            $handle .=    '<td>'.$plan->iccid.'</td>';
            $handle .=    '<td>'.$plan->points.'</td>';
            $handle .=    '<td>'.$plan->points_used.'</td>';
            $handle .=    '<td>'.$plan->status.'</td>';
        }
        return $handle;
    }

    /*
        Error: Please input an ICCID.
        Error: Invalid ICCID. Verify that you have input the ICCID correctly.
        Error: Please read and agree to the TERMS and CONDITIONS.
        Error: Invalid ICCID. Verify you have not already used this ICCID in another plan and that you have input the ICCID correctly.
    */
    public function add(Request $request) {
//{"_token":"fK8teZaHgyy7v5kFgxE0kdNdpWygTSWIqylVOZEP","mode":"new","iccid":null,"submit-new-plan":"update"}
//{"_token":"fK8teZaHgyy7v5kFgxE0kdNdpWygTSWIqylVOZEP","mode":"new","iccid":null,"agree-terms":"on","submit-new-plan":"update"}
//return $request;
        //$result = $this->validate($request, [
        //    'iccid' => 'required|unique:plans|max:20',
        //]);
        if (!Auth::check()) {
            session()->flash('warning', 'Please Login first');
            return redirect()->route('login');
        }

        if (!$request->iccid) {
            //session()->flash('danger', 'Error: Please input an ICCID.');
            session()->flash('danger', 'Please input ICCID.');
            return redirect()->back();
        }

        //if (!$request['agree-terms']) {
        //    session()->flash('danger', 'Error: Please read and agree to the TERMS and CONDITIONS.');
        //    return redirect()->back();
        //}

        $plan = DB::table('plans')
            ->where('iccid', $request->iccid)
            ->first();
        if ($plan) {
            //session()->flash('danger', 'Invalid ICCID. (** Verify you have not already used this ICCID in another plan and that you have input the ICCID correctly.)');
            session()->flash('danger', 'ICCID had used.');
            return redirect()->back();
        }

        //$user = Auth::user();
        $plan = Plan::create([
            'iccid' => $request->iccid,
            'status' => 'active',
            'points' => 50000, //$request->points, // for test
            'user_id' => Auth::user()->id,
        ]);

        //session()->flash('success', 'Create Success');
        //return redirect()->route('plans.show', [$plan]);
        //return view('plans.show', compact('user', 'plan'));
//        return redirect()->route('account.profile');

        $portal = $request->portal;
        if ($portal == 10) {
            return redirect()->route('my.plans.10ware');
        } else if ($portal == 11) {
            return redirect()->route('my.plans.germany');
        } else {
            return redirect()->route('my.plans.germany');
        }
        //return redirect()->route('my.plans');
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

            //session()->flash('success', 'Create Success');
            return view('plans.show', compact('user', 'plan'));
        } else {
            session()->flash('warning', 'Please Login first');
            return redirect()->route('login');
        }
    }

    /*----------------------------------------------------------------------------------*/
    /* All - GET /xxx */
    public function index() {
        if (!Auth::check()) {
            session()->flash('warning', 'Please Login first');
            return redirect()->route('login');
        }

        $user = Auth::user();
        $data['sel_menu'] = 'user';
        $user->update($data);

        //$plans = Plan::all();
        //$plans = Plan::paginate(5);
        $plans = $user->plans()
            //->orderBy('created_at', 'desc')
            ->paginate(10);
        return view('plans.index', compact('user', 'plans'));
    }

    /* Read - GET /xxx/{id} */
    public function show(Plan $plan) {
        if (!Auth::check()) {
            session()->flash('warning', 'Please Login first');
            return redirect()->route('login');
        }

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

    /*----------------------------------------------------------------------------------*/
    /* Edit - GET /xxx/{id}/edit */
    public function edit(Plan $plan) {
        $user = Auth::user();
        return view('plans.edit', compact('user', 'plan'));

        // $this->authorize('update', $plan);
        // return view('plans.edit', compact('plan'));
    }

    /* Update - PATCH /xxx/{id} */
    public function update(Plan $plan, Request $request) {
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

    /*----------------------------------------------------------------------------------*/
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
