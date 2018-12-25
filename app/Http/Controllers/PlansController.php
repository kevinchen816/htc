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
use Debugbar;

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
    public function getPlanAdd() {
        $user = Auth::user();
        $data['sel_menu'] = 'plan';
        $user->update($data);
        return view('plans.add', compact('user'));
    }

    /*
        Error: Please input an ICCID.
        Error: Invalid ICCID. Verify that you have input the ICCID correctly.
        Error: Please read and agree to the TERMS and CONDITIONS.
        Error: Invalid ICCID. Verify you have not already used this ICCID in another plan and that you have input the ICCID correctly.
    */
    public function postPlanAdd(Request $request) {
        //{"_token":"xxxx","mode":"new","iccid":null,"submit-new-plan":"update"}
        //{"_token":"xxxx","mode":"new","iccid":null,"agree-terms":"on","submit-new-plan":"update"}
        $user = Auth::user();
        $user_id = $user->id;

        /* check ICCID */
        // $result = $this->validate($request, [
        //    'iccid' => 'required|unique:plans|max:20',
        // ]);
        if (!$request->iccid) {
            session()->flash('danger', 'Please input an ICCID.');
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
            // session()->flash('danger', 'ICCID had used.');
            session()->flash('danger', 'This ICCID has already been registered.');
            return redirect()->back();
        }

        /* search SIM */
        // $sim = DB::table('sims')->where('iccid', $iccid)->first();
        // if (!$sim) {
        //     session()->flash('danger', 'Invalid ICCID.');
        //     return redirect()->back();
        // }
        // $region = $sim->region; // us, ca, eu, au, cn, tw
        // $style = $sim->style; // demo, normal

// for test
// if ($user->permission == 1) {
    $region = 'au'; // for test
    $style = 'normal'; // for test
// } else {
//     $region = 'au'; // for test
//     $style = 'test'; // for test
// }
//+

        if ($style == 'test') {
            $status = 'active';
            $points = 50000;
        } else {
            $status = 'deactive';
            $points = 0;
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

        // if ($user->permission == 1) {
            $mode = 'create';
            return view('plans.create', compact('user', 'plan', 'mode'));
        // } else {
        //     $data['sel_account_tab'] = 'plans';
        //     Auth::user()->update($data);
        //     session()->flash('success', 'Create Success');
        //     return redirect()->route('account.profile');
        // }
    }

    /*----------------------------------------------------------------------------------*/
    public function getPlanCreate($plan_id) {
        $user = Auth::user();

        // // $plan = Plan::findOrFail($plan_id);
        $plan = Plan::find($plan_id);
        if (!$plan) {
            session()->flash('danger', 'ICCID not exist.');
            return redirect()->back();
        }
        // $iccid = $plan->iccid;

        // $data['sel_menu'] = 'plan';
        // $user->update($data);

        $mode = 'create'; // TODO
        return view('plans.create', compact('user', 'plan', 'mode'));
    }

    public function postPlanCreate(Request $request) {
        // {"_token":"xxxx","mode":"create","planid":"5","tier":"21","auto-bill":"on","submit-new-plan":"create"}
        $plan_id = $request->input('planid');
        $sku_id = $request->input('tier');
        $auto_bill = ($request->input('auto-bill') == 'on') ? 1: 0;

        /* search Plan */
        $plan = Plan::find($plan_id);
        if (!$plan) {
            session()->flash('danger', 'Add Cart Fail.');
            return redirect()->back();
        }

        $sku = PlanProductSku::find($sku_id);
         if (!$sku) {
            session()->flash('danger', 'Plan not found.');
            return redirect()->back();
        }
        // $plan->plan_product_sku_id = $sku_id;
        $plan->sub_plan = $sku->sub_plan; // au_5000_1m
        $plan->renew_plan = $sku->sub_plan;
        $plan->auto_bill = $auto_bill;
        $plan->update();

        $user = Auth::user();

        // 从数据库中查询该商品是否已经在购物车中 (reference)
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

        // 创建购物车记录
        $cart = new CartItem(['quantity' => 1, 'iccid' => $plan->iccid]);
        $cart->user()->associate($user);
        $cart->planProductSku()->associate($sku_id);
        $cart->save();

        // Success: Buy Reserve for Plan with SIM ICCID 8944503540145561039 was added to your cart.
        if ($user->stripe_id) {
            return redirect()->route('shop.cart');
        } else {
            $next = 'cart';
            return view('shop.editcard', compact('user', 'next'));
            // return redirect()->route('shop.editcard');
        }
        // return redirect()->route('account.profile');
    }

    /*----------------------------------------------------------------------------------*/
    // public function getPlanUpdate($plan_id) {
    //     $user = Auth::user();

    //     // // $plan = Plan::findOrFail($plan_id);
    //     $plan = Plan::find($plan_id);
    //     if (!$plan) {
    //         session()->flash('danger', 'ICCID not exist.');
    //         return redirect()->back();
    //     }
    //     // $iccid = $plan->iccid;

    //     // $data['sel_menu'] = 'plan';
    //     // $user->update($data);

    //     $mode = 'update'; // TODO
    //     return view('plans.create', compact('user', 'plan', 'mode'));
    // }

    // public function postPlanUpdate(Request $request) {
    //     // {"_token":"xxxx","mode":"setup","planid":"13","tier":"20","submit-new-plan":"update"}
    //     $plan_id = $request->planid;
    //     $sku_id = $request->tier;

    //     /* search Plan */
    //     // $plan = DB::table('plans')->where('id', $request->planid)->first();
    //     // $plan = Plan::findOrFail($plan_id);
    //     $plan = Plan::find($plan_id);
    //     if (!$plan) {
    //         session()->flash('danger', 'Update Cart Fail.');
    //         return redirect()->back();
    //     }
    //     $plan->plan_product_sku_id = $sku_id;
    //     $plan->update();

    //     $user = Auth::user();
    //     $iccid = $plan->iccid;

    //     // 创建或修改购物车记录
    //     $cart = CartItem::where('iccid', $iccid)->first();
    //     if ($cart) {
    //         $cart->planProductSku()->associate($sku_id);
    //         $cart->update();
    //     } else {
    //         $cart = new CartItem(['quantity' => 1, 'iccid' => $iccid]);
    //         $cart->user()->associate($user);
    //         $cart->planProductSku()->associate($sku_id);
    //         $cart->save();
    //     }

    //     // Success: Buy Reserve for Plan with SIM ICCID 8944503540145561039 was added to your cart.
    //     return redirect()->route('shop.cart');
    //     // return redirect()->route('account.profile');
    // }

    /*----------------------------------------------------------------------------------*/
    public function getPlanRenew($plan_id) {
        $user = Auth::user();
        $plan = Plan::find($plan_id);
        if (!$plan) {
            session()->flash('danger', 'ICCID not exist. id='.$plan_id);
            return redirect()->back();
        }
        $mode = 'renew';
        return view('plans.create', compact('user', 'plan', 'mode'));
    }

    public function postPlanRenew(Request $request) {
        \Stripe\Stripe::setApiKey("sk_test_LfAFK776KACX3gaKrSxXNJ0r");

        // {"_token":"xxxx","mode":"renew","planid":"12","tier":"22","auto-bill":"on","submit-new-plan":"renew"}
        $plan_id = $request->input('planid'); //$request->planid;
        $sku_id = $request->input('tier'); //$request->tier;
        $auto_bill = ($request->input('auto-bill') == 'on') ? 1: 0;

        $user = Auth::user();
        $plan = Plan::find($plan_id);
        if (!$plan) {
            session()->flash('danger', 'Renew ICCID not found. '.$plan_id);
            return redirect()->route('account.profile');
        }

        $sku = PlanProductSku::find($sku_id);
        if (!$sku) {
            session()->flash('danger', 'Rernew plan product not found. '.$sku_id);
            return redirect()->route('account.profile');
        }

        // // // if ($auto_bill != $plan->auto_bill) {
        // //     if ($auto_bill) {
        // //         $user->subscription($plan->iccid)
        // //              ->swap($sku->sub_plan);
        // //              // ->resume();
        // //     } else {
        // //         $user->subscription($plan->iccid)
        // //              ->swap($sku->sub_plan)
        // //              ->cancel();
        // //     }
        // // // }

        $plan->auto_bill = $auto_bill;
        // $plan->renew_plan = $sku->sub_plan;
        if ($auto_bill) {
            $plan->renew_plan = $sku->sub_plan;
        } else {
            $plan->renew_plan = $plan->sub_plan;
        }
        $plan->update();

        if ($plan->sub_id) {
            $subscription = \Stripe\Subscription::retrieve($plan->sub_id);
            $subscription = \Stripe\Subscription::update($plan->sub_id , [
                'items' => [
                    [
                        'id' => $subscription->items->data[0]->id,
                        'plan' => $sku->sub_plan,
                    ],
                ],
                'cancel_at_period_end' => $auto_bill ? false : true,
// 'billing_cycle_anchor' => $subscription->billing_cycle_anchor, // NG
// 'billing_cycle_anchor' => 'unchanged', // Changing plan intervals. There's no way to leave billing cycle unchanged.
'prorate' => false,
            ]);
            // return dd($subscription); // for debug
        }

        // Success: Your account Renewal setup was saved.
        session()->flash('success', 'Renew Success');
        return redirect()->route('account.profile');
    }

    /*----------------------------------------------------------------------------------*/
    public function getPlanReactive($plan_id) {
        $user = Auth::user();
        $plan = Plan::find($plan_id);
        if (!$plan) {
            session()->flash('danger', 'ICCID not exist. id ='.$plan_id);
            return redirect()->back();
        }
        $mode = 'reactive';
        return view('plans.create', compact('user', 'plan', 'mode'));
    }

     public function postPlanReactive(Request $request) {
        return $this->postPlanCreate($request);
    }

    /*----------------------------------------------------------------------------------*/
    public function getPlanCancel() {
        return redirect()->route('account.profile');
    }

    /*----------------------------------------------------------------------------------*/
    public function html_CreatePlan($plan, $mode) {
        Debugbar::debug('plan='.$plan);
        Debugbar::debug('mode='.$mode); // create, (update X), renew

        $region = $plan->region; // us, ca, eu, au, cn, tw

        if ($mode == 'renew') {
            // $sku_id = 0;
            // $subscription = DB::table("subscriptions")->where('name', $plan->iccid)->first();
            // if ($subscription) {
            //     $sku = PlanProductSku::where('sub_plan', $subscription->stripe_plan)->first();
            //     $sku_id = ($sku) ? $sku->id : 0;
            // }

            // $sku = PlanProductSku::where('sub_plan', $plan->renew_plan)->first();
            // $sku_id = ($sku) ? $sku->id : 0;
            $select_sub_plan = $plan->renew_plan;

        } else if ($mode == 'reactive') {
            // $sku = PlanProductSku::where('sub_plan', $plan->sub_plan)->first();
            // $sku_id = ($sku) ? $sku->id : 0;
            $select_sub_plan = $plan->sub_plan;
        }

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
                if (($mode == 'renew')||($mode == 'reactive')) {
                    // $checked = ($sku->id == $sku_id) ? 'checked' : '';
                    $checked = ($sku->sub_plan == $select_sub_plan) ? 'checked' : '';
                }

                if ($sku->month == 1) {
                    $sku_month = 'per Month';
                } else {
                    $sku_month = 'for '.$sku->month.' Month';
                }
                $cpp = '[cpp: '.($sku->price/$points).']'; //'[cpp: 0.00259]';

                // $txt .=             '<div class="radio">';
                // $txt .=                 '<label><input type="radio" name="tier" checked value="20" ><span style="color:white;">12.95</span> <span style="color:lime;">per Month</span> <span style="color:red;">[cpp: 0.00259]</span></label>';
                // $txt .=             '</div>';
                $txt .=             '<div class="radio">';
                $txt .=                 '<label>';
                $txt .=                     '<input type="radio" name="tier" '.$checked.' value="'.$sku->id.'" >';
                $txt .=                         '<span style="color:white;">'.$sku->price.'</span>'; // 12.95
                $txt .=                         '<span style="color:lime;"> '.$sku_month.'</span>'; // per Month
                $txt .=                         '<span style="color:red;"> '.$cpp.'</span>'; // [cpp: 0.00259]
                $txt .=                 '</label>';
                $txt .=             '</div>';

                if ($mode == 'create') {
                    $checked = '';
                }
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
        $user->subscription($plan->iccid)->cancel();
        session()->flash('success', 'Pause Success');
        return redirect()->back();
    }

    public function active(Plan $plan) {
        $user = Auth::user();
        $user->subscription($plan->iccid)->resume();
        session()->flash('success', 'Active Success');
        return redirect()->back();
    }

    public function change(Plan $plan) {
        $user = Auth::user();
        $user->subscription($plan->iccid)->swap('au_5000_1m');
        session()->flash('success', 'Change Success');
        return redirect()->back();
    }

    public function cancel(Plan $plan) {
        //$user = Auth::user();
        session()->flash('success', 'Cancel Success');
        return redirect()->back();
    }
}
