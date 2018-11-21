<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Plan;
use GuzzleHttp\Client;
use Carbon\Carbon;

use Auth;
use DB;

// https://blog.csdn.net/m0sh1/article/details/80402589
// composer require "guzzlehttp/guzzle:~6.3"
// composer require guzzlehttp/guzzle

class PlansController extends Controller
{
    public function back_to_login($portal) {
        //if (!Auth::check()) {
            //session()->flash('warning', 'Please Login first');
            //return redirect()->route('login');
            if ($portal == 10) {
                return redirect()->route('login.10ware');
            } else if ($portal == 11) {
                return redirect()->route('login.de');
            } else {
                return redirect()->route('login');
            }
        //}
    }

    /*-----------------------------------------------------------*/
    public function _view($portal) {
        if (!Auth::check()) {
            return $this->back_to_login($portal);
        }

        $user = Auth::user();
        $data['sel_menu'] = 'plan';
        $user->update($data);

        $portal = $user->portal;
        return view('plans.add-plan', compact('portal', 'user'));
    }

    public function view() {
        return $this->_view(0);
    }

    public function view_10ware() {
        return $this->_view(10);
    }

    public function view_germany() {
        return $this->_view(11);
    }

    /*-----------------------------------------------------------*/
    public function m2m_put($api, $body) {
        $client = new \GuzzleHttp\Client();
        //$res = $client->request('GET', 'https://api.github.com/repos/guzzle/guzzle');
        //return $res->getStatusCode(); // "200"
        //return $res->getHeader('content-type'); // ["application\/json; charset=utf-8"]
        //return $res->getBody();

        // Send an asynchronous request.
        //$request = new \GuzzleHttp\Psr7\Request('GET', 'http://httpbin.org');
        //$promise = $client->sendAsync($request)->then(function ($response) {
        //    echo 'I completed! ' . $response->getBody();
        //});
        //$promise->wait();

        $url = 'https://restapi-telstra.jasper.com/rws/api/v1/';
        $url_api = $url.$api;
        $res = $client->request('PUT', $url_api, [
            'headers' => [
                'Content-type'=> 'application/json',
                'Authorization'=> 'Basic bWljaGFlbGxpOmMzZThlMTNlLTYxOTAtNGUwNy1iMzZjLTI4ZGZiMGM1Yzc4OQ==',
            ],
            'body' => $body
        ]);
        return $res->getStatusCode();
    }

    public function m2m_iccid_active($iccid) {
        $api = 'devices/'.$iccid;
        $body = json_encode(['status' => 'ACTIVATED']); // ACTIVATED, DEACTIVATED
        $ret = $this->m2m_put($api, $body);
        return $ret;
    }

    public function m2m_iccid_deactive($iccid) {
        $api = 'devices/'.$iccid;
        $body = json_encode(['status' => 'DEACTIVATED']); // ACTIVATED, DEACTIVATED
        $ret = $this->m2m_put($api, $body);
        return $ret;
    }

    /*-----------------------------------------------------------*/
    public function stripe_new() {
        \Stripe\Stripe::setApiKey("sk_test_LfAFK776KACX3gaKrSxXNJ0r");
        $ret = \Stripe\Customer::create([
            "description" => "kevin@10ware.com", // cus_Dv0fI1h5DQi2tb
//            "currency" =>  "usd"
//          "source" => "tok_visa" // obtained with Stripe.js
        ]);
        return var_dump($ret);
    }

    /*-----------------------------------------------------------*/
    /*
        Error: Please input an ICCID.
        Error: Invalid ICCID. Verify that you have input the ICCID correctly.
        Error: Please read and agree to the TERMS and CONDITIONS.
        Error: Invalid ICCID. Verify you have not already used this ICCID in another plan and that you have input the ICCID correctly.
    */
    public function add(Request $request) {
        //{"_token":"fK8teZaHgyy7v5kFgxE0kdNdpWygTSWIqylVOZEP","mode":"new","iccid":null,"submit-new-plan":"update"}
        //{"_token":"fK8teZaHgyy7v5kFgxE0kdNdpWygTSWIqylVOZEP","mode":"new","iccid":null,"agree-terms":"on","submit-new-plan":"update"}
        // return $request;

        $portal = $request->portal;
        if (!Auth::check()) {
            return $this->back_to_login($portal);
        }
        $user = Auth::user();

        /* check ICCID */
        //$result = $this->validate($request, [
        //    'iccid' => 'required|unique:plans|max:20',
        //]);
        if (!$request->iccid) {
            //session()->flash('danger', 'Error: Please input an ICCID.');
            session()->flash('danger', 'Please input ICCID.');
            return redirect()->back();
        }
        $iccid = $request->iccid;

        //if (!$request['agree-terms']) {
        //    session()->flash('danger', 'Error: Please read and agree to the TERMS and CONDITIONS.');
        //    return redirect()->back();
        //}

        $plan = DB::table('plans')
            ->where('iccid', $iccid)
            ->first();
        if ($plan) {
            //session()->flash('danger', 'Invalid ICCID. (** Verify you have not already used this ICCID in another plan and that you have input the ICCID correctly.)');
            session()->flash('danger', 'ICCID had used.');
            return redirect()->back();
        }

        /* Stripe - create customer id */
//        if ($request->mode == 'new') {
//            $stripeToken = $_POST['stripeToken'];
//            if (!$user->stripe_id) {
//                // $ret = $user->createAsStripeCustomer($stripeToken);
//                $ret = $user->createAsStripeCustomer($stripeToken, [
//                    // 'currency' => 'usd',
//                ]);
//            }
//        }

        /* Stripe - subscribe plan */
//        $subscription_name = $iccid; //'89860117851014783481'
//        $plan_id = 'plan_5000_1m_us';
//        // $plan_id = 'plan_100_1d_us';
//        if (!$request['auto-bill']) {
//            $user->newSubscription($subscription_name, $plan_id)->create()->cancel();
//        } else {
//            $user->newSubscription($subscription_name, $plan_id)->create();
//        }
//        // $user->subscription($subscription_name)->cancel();

        /* create Plan */
        //$user = Auth::user();
        $plan = Plan::create([
            'iccid' => $request->iccid,
            'status' => 'active',
            'points' => 50000, //$request->points, // for test
            'user_id' => Auth::user()->id,
        ]);

        // plan, billing, devices, options, email
        // plans, billing, remote, security, email
        $data['sel_account_tab'] = 'plans';
        Auth::user()->update($data);

        //session()->flash('success', 'Create Success');
        //return redirect()->route('plans.show', [$plan]);
        //return view('plans.show', compact('user', 'plan'));
//        return redirect()->route('account.profile');

////$ret = $this->m2m_iccid_active('89610185002185155463');
////$ret = $this->m2m_iccid_deactive('89610185002185155463');
//$ret = $this->m2m_iccid_active($iccid);

        if ($portal == 10) {
            //return redirect()->route('my.plans.10ware');
            return redirect()->route('account.profile');
        } else if ($portal == 11) {
            return redirect()->route('my.plans.de');
        } else {
            return redirect()->route('account.profile');
        }
        //return redirect()->route('my.plans');
    }

    /*-----------------------------------------------------------*/
//    public function my_plans() {
//        $user = Auth::user();
//        $data['sel_menu'] = 'my_plans';
//        $user->update($data);
//
//        $portal = $user->portal;
//        return view('plans.my-plans', compact('portal', 'user'));
//    }

// move to AccountsController::MyPlans()
//    public function MyPlans() {
//        //return 'Hello';
//        $user = Auth::user();
//        $user_id = $user->id;
//
//        $plans = DB::table('plans')
//            ->where('user_id', $user_id)
//            ->get();
//
//        $handle = '';
//        foreach ($plans as $plan) {
//            //$camera_name = '(No Camera)';
//            //if ($plan->camera_id) {
//            //    $camera = Camera::find($plan->camera_id);
//            //    if ($camera) {
//            //        $camera_name = $camera->description;
//            //    }
//            //}
//
//            $handle .= '<div class="row">';
//            $handle .=     '<div class="col-md-12">';
//            $handle .=         '<div style="margin-top:10px; margin-bottom:4px; border-bottom: 1px solid gray;border-top: 1px solid lime; padding-bottom: 4px; padding-top: 4px;padding-left:10px; background-color: #444">';
//            $handle .=             '<div class="row">';
//            $handle .=                 '<div class="col-md-5">';
//            $handle .=                     '<i class="fa fa-dot-circle"></i>';
//            $handle .=                     '<span class="label label-info" style="font-size: 1.00em;">Prepaid 6 Months</span>';
//            $handle .=                     '<span class="label label-success" style="font-size:0.9em;">Active</span>';
//            $handle .=                     '<p></p>';
//            $handle .=                 '</div>';
//            $handle .=                 '<div class="col-md-5">';
//            $handle .=                 '</div>'; // <!-- end col -->
//            $handle .=             '</div>';
//            $handle .=         '</div>';
//            $handle .=     '</div>';
//            $handle .= '</div>';
//
//            $handle .= '<div class="row">';
//            $handle .=     '<div class="col-sm-6">';
//            $handle .=         '<table class="table plan-table">';
//            $handle .=             '<tbody>';
////            $handle .=                 '<tr><td class="pull-right"><i class="fa fa-bolt"></i>Sim ICCID:</td>';
//            $handle .=                 '<tr><td class="pull-right"></i>ICCID:</td>';
//            $handle .=                     '<td><strong>'.$plan->iccid.'</strong></td>';
//            $handle .=                 '</tr>';
////            $handle .=                 '<tr><td class="pull-right"><i class="fa fa-camera"> </i> Camera:</td>';
//            //$handle .=                 '<tr><td class="pull-right">Camera:</td>';
//            //$handle .=                     '<td><strong>'.$camera_name.'</strong></td>';
//            //$handle .=                 '</tr>';
//            $handle .=                 '<tr><td class="pull-right">Plan Points:</td>';
//            $handle .=                     '<td><strong>'.$plan->points.'</strong></td>';
//            $handle .=                 '</tr>';
//            $handle .=                 '<tr><td class="pull-right">Points Used:</td>';
//            $handle .=                     '<td><strong>'.$plan->points_used.'</strong></td>';
//            $handle .=                 '</tr>';
////            $handle .=                 '<tr><td class="pull-right">SMS Sent:</td>';
////            $handle .=                     '<td><strong>'.$plan->sms_sent.'</strong></td>';
////            $handle .=                 '</tr>';
//            $handle .=             '</tbody>';
//            $handle .=         '</table>';
//            $handle .=     '</div>';
//            $handle .= '</div>';
//        }
//        return $handle;
//    }

    /*-----------------------------------------------------------*/
    public function _my_plans2($portal) {
        if (!Auth::check()) {
            //session()->flash('warning', 'Please Login first');
            //return redirect()->route('login');
            return $this->back_to_login($portal);
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

    public function my_plans2() {
        return $this->_my_plans2(0);
    }

    public function my_plans2_10ware() {
        return $this->_my_plans2(10);
    }

    public function my_plans2_germany() {
        return $this->_my_plans2(11);
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

    /*----------------------------------------------------------------------------------*/
    public function pause(Plan $plan) {
        $portal = 0; //$request->portal;
        if (!Auth::check()) {
            return $this->back_to_login($portal);
        }
        $user = Auth::user();

        // $plan->delete();
        // // return back();

        // // $plans = Plan::all();
        // $plans = Plan::paginate(5);

        // $subscriptions = DB::table('subscriptions')->where('iccid', $iccid)->get();
        // $subscription = $subscription->first();
        $subscription_name = $plan->iccid;
        $user->subscription($subscription_name)->cancel();

        session()->flash('success', 'Pause Success');
        // return view('plans.index', compact('user', 'plans'));
        return redirect()->back();
    }

    public function active(Plan $plan) {
        $portal = 0; //$request->portal;
        if (!Auth::check()) {
            return $this->back_to_login($portal);
        }
        $user = Auth::user();

        $subscription_name = $plan->iccid;
        $user->subscription($subscription_name)->resume();

        session()->flash('success', 'Active Success');
        return redirect()->back();
    }


    public function change(Plan $plan) {
        $portal = 0; //$request->portal;
        if (!Auth::check()) {
            return $this->back_to_login($portal);
        }
        $user = Auth::user();

        // $user->subscription('main')->swap('provider-plan-id');

        $subscription_name = $plan->iccid;
        $new_plan = 'plan_5000_3m_us';
        $user->subscription($subscription_name)->swap($new_plan);

        session()->flash('success', 'Change Success');
        return redirect()->back();
    }

    public function cancel(Plan $plan) {
        $portal = 0; //$request->portal;
        if (!Auth::check()) {
            return $this->back_to_login($portal);
        }
        $user = Auth::user();

        session()->flash('success', 'Cancel Success');
        return redirect()->back();
    }

    public function renew(Plan $plan) {
//return $plan;

        $portal = 0; //$request->portal;
        if (!Auth::check()) {
            return $this->back_to_login($portal);
        }
        $user = Auth::user();
//        $data['sel_menu'] = 'my_plans';
//        $user->update($data);

        $user_id = $user->id;
        $plans = DB::table('plans')
            ->where('user_id', $user_id)
            //->orderBy('created_at', 'desc')
            ->paginate(10);

//        $portal = $user->portal;
        //return view('plans._usa', compact('portal', 'user', 'plans'));
//        return view('plans._usa', compact('portal', 'user'));
        return view('plans._australia', compact('portal', 'user'));
    }

    public function setup(Request $request) {
return $request;

    }
}
