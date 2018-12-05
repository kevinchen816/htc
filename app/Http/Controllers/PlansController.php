<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Plan;
use App\Models\PlanProduct;
use App\Models\PlanProductSku;
use App\Models\CartItem;
use GuzzleHttp\Client;
use Carbon\Carbon;

use Auth;
use DB;

// https://blog.csdn.net/m0sh1/article/details/80402589
// composer require "guzzlehttp/guzzle:~6.3"
// composer require guzzlehttp/guzzle

class PlansController extends Controller
{
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

    /*----------------------------------------------------------------------------------*/
    public function getAddPlan() {
        $user = Auth::user();
        $data['sel_menu'] = 'plan';
        $user->update($data);
        // return view('plans.add-plan', compact('user'));
        return view('plans.add', compact('user'));
    }

    /*
        Error: Please input an ICCID.
        Error: Invalid ICCID. Verify that you have input the ICCID correctly.
        Error: Please read and agree to the TERMS and CONDITIONS.
        Error: Invalid ICCID. Verify you have not already used this ICCID in another plan and that you have input the ICCID correctly.
    */
    public function postAddPlan(Request $request) {
        //{"_token":"xxxx","mode":"new","iccid":null,"submit-new-plan":"update"}
        //{"_token":"xxxx","mode":"new","iccid":null,"agree-terms":"on","submit-new-plan":"update"}
        $user = Auth::user();
        $user_id = $user->id;

        /* check ICCID */
        // $result = $this->validate($request, [
        //    'iccid' => 'required|unique:plans|max:20',
        // ]);
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

        /* search Plan */
        $plan = DB::table('plans')->where('iccid', $iccid)->first();
        if ($plan) {
            //session()->flash('danger', 'Invalid ICCID. (** Verify you have not already used this ICCID in another plan and that you have input the ICCID correctly.)');
            session()->flash('danger', 'ICCID had used.');
            return redirect()->back();
        }

        /* search SIM */
        // $sim = DB::table('sims')->where('iccid', $iccid)->first();
        // if (!$sim) {
        //     session()->flash('danger', 'Invalid ICCID.');
        //     return redirect()->back();
        // }
        // $region = $sim->region; // us, ca, eu, au, cn, tw
        // $style = $sim->style; // demo

$region = 'au'; // for test
$style = 'demo'; // for test
        if ($style == 'demo') {
            $status = 'active';
            $points = 50000;
        } else {
            // $status = 'suspend';
            // $points = 0;
            $status = 'active';
            $points = 50000;
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
        $plan = Plan::create([
            'iccid' => $iccid,
            'user_id' => $user_id,
            'region' => $region,
            'style' => $style,
            'status' => $status,
            'points' => $points,
        ]);

////$ret = $this->m2m_iccid_active('89610185002185155463');
////$ret = $this->m2m_iccid_deactive('89610185002185155463');
//$ret = $this->m2m_iccid_active($iccid);

// old
        // TODO
        $data['sel_account_tab'] = 'plans';
        Auth::user()->update($data);
        //+
        // // session()->flash('success', 'Create Success');
        // return redirect()->route('account.profile');

// new (TODO)
        // // $mode = 'setup';
        // // return view('plans.setup', compact('user', 'plan', 'mode'));
        $mode = 'create';
        return view('plans.create', compact('user', 'plan', 'mode'));
    }

    /*----------------------------------------------------------------------------------*/
    public function postBuyPlan(Request $request) {
        // {"_token":"xxxx","mode":"setup","planid":"13","tier":"20","submit-new-plan":"update"}
// return $request;

        /* search Plan */
        // $plan = DB::table('plans')->where('id', $request->planid)->first();
        $plan = Plan::findOrFail($request->planid);
        if (!$plan) {
            session()->flash('danger', 'Add Cart Fail.');
            return redirect()->back();
        }
        $iccid = $plan->iccid;

        $sku_id = $request->tier;
        $quantity = 1;

        // // 从数据库中查询该商品是否已经在购物车中
        // if ($cart = $user->cartItems()->where('plan_product_sku_id', $skuId)->first()) {

        //     // 如果存在则直接叠加商品数量
        //     $cart->update([
        //         'quantity' => $cart->quantity + $quantity,
        //     ]);
        // } else {

        //     // 否则创建一个新的购物车记录
        //     $cart = new CartItem(['quantity' => $quantity]);
        //     $cart->user()->associate($user);
        //     $cart->planProductSku()->associate($skuId);
        //     $cart->save();
        // }

        $user = Auth::user();

        // 创建一个新的购物车记录
        $cart = new CartItem(['quantity' => $quantity, 'iccid' => $iccid]);
        $cart->user()->associate($user);
        $cart->planProductSku()->associate($sku_id);
        $cart->save();

        // return [];
        // return redirect()->route('account.profile');

// Success: Buy Reserve for Plan with SIM ICCID 8944503540145561039 was added to your cart.
        // return view('shop.cart', compact('user'));
        return redirect()->route('shop.cart');
    }

    /*----------------------------------------------------------------------------------*/
//     public function postSetupPlan(Request $request) {
//         // {"_token":"xxxx","mode":"setup","planid":"13","tier":"20","submit-new-plan":"update"}
// return $request;
//         $sku_id = $request->tier;
//     }

//     public function getRenewPlan(Plan $plan) {
//         $user = Auth::user();
// //        $data['sel_menu'] = 'my_plans';
// //        $user->update($data);

//         $user_id = $user->id;
//         // $plans = DB::table('plans')
//         //     ->where('user_id', $user_id)
//         //     //->orderBy('created_at', 'desc')
//         //     ->paginate(10);

//         //return view('plans._usa', compact('user', 'plans'));
// //        return view('plans._usa', compact('user'));
//         return view('plans._australia', compact('user'));
//     }

    /*----------------------------------------------------------------------------------*/
    public function html_CreatePlan($plan) {
        $region = $plan->region; // us, ca, eu, au, cn, tw

        // $product = PlanProduct::findOrFail(14); // 查找不存在的记录时会抛出异常
        // $product = PlanProduct::find(14);
        $products = DB::table("plan_products")
            // ->where('region', $region)
            ->whereRaw('region = ? and active = ?', [$region, 1])
            ->orderBy('points','asc') // asc, desc
            ->get();

        $txt = '';
        $checked = 'checked';
        foreach ($products as $product) {
            $product_id = $product->id;
            $points = $product->points;
            $description = $points.' Points per Month';

            $skus = DB::table("plan_product_skus")
                // ->where('plan_product_id', $product_id)
                ->whereRaw('plan_product_id = ? and active = ?', [$product_id, 1])
                ->orderBy('price','asc') // asc, desc
                ->get();

            $txt .= '<div class="alert alert-default alert-ratetier">';
            $txt .=     '<div class="row">';
            $txt .=         '<div class="col-md-5">';
            $txt .=             '<div class="label-tier">'.$product->title.'</div>';
            $txt .=             '<p class="tier-desc">'.$description.'</p>';
            $txt .=         '</div>';
            $txt .=         '<div class="col-md-7">';
            foreach ($skus as $sku) {
                $sku_id = $sku->id;
                $month = $sku->month;
                $price = $sku->price;
                $cpp = '[cpp: '.($price/$points).']'; //'[cpp: 0.00259]';

                if ($month == 1) {
                    $sku_month = 'per Month';
                } else {
                    $sku_month = 'for '.$month.' Month';
                }

                // $txt .=             '<div class="radio">';
                // $txt .=                 '<label><input type="radio" name="tier" checked value="20" ><span style="color:white;">12.95</span> <span style="color:lime;">per Month</span> <span style="color:red;">[cpp: 0.00259]</span></label>';
                // $txt .=             '</div>';
                $txt .=             '<div class="radio">';
                $txt .=                 '<label><input type="radio" name="tier" '.$checked.' value="'.$sku_id.'" ><span style="color:white;">'.$price.'</span> <span style="color:lime;"> '.$sku_month.'</span> <span style="color:red;"> '.$cpp.'</span></label>';
                $txt .=             '</div>';
                $checked = '';
            }
            $txt .=         '</div>';
            $txt .=     '</div>';
            $txt .= '</div>';
        }
        return $txt;
    }

    public function html_SetupPlan($plan) {
        return 'html_SetupPlan';
    }

    // public function html_SetupPlanX($plan) {
    //     $txt = '';
    //     $txt .= '<div class="alert alert-default alert-ratetier">';
    //     $txt .=     '<div class="row">';
    //     $txt .=         '<div class="col-md-5">';
    //     $txt .=             '<div class="label-tier">SILVER</div>';
    //     $txt .=             '<p class="tier-desc">5000 Points per Month</p>';
    //     $txt .=         '</div>';
    //     $txt .=         '<div class="col-md-7">';
    //     $txt .=             '<div class="radio">';
    //     $txt .=                 '<label><input type="radio" name="tier"  checked value="20" ><span style="color:white;">12.95</span> <span style="color:lime;">per Month</span> <span style="color:red;">[cpp: 0.00259]</span></label>';
    //     $txt .=             '</div>';
    //     $txt .=             '<div class="radio">';
    //     $txt .=                 '<label><input type="radio" name="tier"  value="22" ><span style="color:white;">36.95</span> <span style="color:lime;">for 3 Months</span> <span style="color:red;">[cpp: 0.00246]</span></label>';
    //     $txt .=             '</div>';
    //     $txt .=         '</div>';
    //     $txt .=     '</div>';
    //     $txt .= '</div>';

    //     $txt .= '<div class="alert alert-default alert-ratetier">';
    //     $txt .=     '<div class="row">';
    //     $txt .=         '<div class="col-md-5">';
    //     $txt .=             '<div class="label-tier">GOLD</div>';
    //     $txt .=             '<p class="tier-desc">10000 Points per Month</p>';
    //     $txt .=         '</div>';
    //     $txt .=         '<div class="col-md-7">';
    //     $txt .=             '<div class="radio">';
    //     $txt .=                 '<label><input type="radio" name="tier"  value="24" ><span style="color:white;">19.95</span> <span style="color:lime;">per Month</span> <span style="color:red;">[cpp: 0.00200]</span></label>';
    //     $txt .=             '</div>';
    //     $txt .=             '<div class="radio">';
    //     $txt .=                 '<label><input type="radio" name="tier"  value="26" ><span style="color:white;">57.95</span> <span style="color:lime;">for 3 Months</span> <span style="color:red;">[cpp: 0.00193]</span></label>';
    //     $txt .=             '</div>';
    //     $txt .=         '</div>';
    //     $txt .=     '</div>';
    //     $txt .= '</div>';

    //     $txt .= '<div class="alert alert-default alert-ratetier">';
    //     $txt .=     '<div class="row">';
    //     $txt .=         '<div class="col-md-5">';
    //     $txt .=             '<div class="label-tier">PLATINUM PRO</div>';
    //     $txt .=             '<p class="tier-desc">20000 Points per Month</p>';
    //     $txt .=         '</div>';
    //     $txt .=         '<div class="col-md-7">';
    //     $txt .=             '<div class="radio">';
    //     $txt .=                 '<label><input type="radio" name="tier"  value="28" ><span style="color:white;">26.95</span> <span style="color:lime;">per Month</span> <span style="color:red;">[cpp: 0.00135]</span></label>';
    //     $txt .=             '</div>';
    //     $txt .=             '<div class="radio">';
    //     $txt .=                 '<label><input type="radio" name="tier"  value="30" ><span style="color:white;">77.95</span> <span style="color:lime;">for 3 Months</span> <span style="color:red;">[cpp: 0.00130]</span></label>';
    //     $txt .=             '</div>';
    //     $txt .=         '</div>';
    //     $txt .=     '</div>';
    //     $txt .= '</div>';
    //     return $txt;
    // }

    /*----------------------------------------------------------------------------------*/
    public function pause(Plan $plan) {
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
        $user = Auth::user();

        $subscription_name = $plan->iccid;
        $user->subscription($subscription_name)->resume();

        session()->flash('success', 'Active Success');
        return redirect()->back();
    }


    public function change(Plan $plan) {
        $user = Auth::user();

        // $user->subscription('main')->swap('provider-plan-id');
        $subscription_name = $plan->iccid;
        $new_plan = 'plan_5000_3m_us';
        $user->subscription($subscription_name)->swap($new_plan);

        session()->flash('success', 'Change Success');
        return redirect()->back();
    }

    public function cancel(Plan $plan) {
        //$user = Auth::user();
        session()->flash('success', 'Cancel Success');
        return redirect()->back();
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
}
