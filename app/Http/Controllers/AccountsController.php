<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Auth;
use DB;

use App\Models\Camera;
use App\Models\Device;
use App\Models\Mobile;
use App\Models\Email;
use App\Models\PlanProduct;
use App\Models\PlanProductSku;
use App\Models\CartItem;

use Carbon\Carbon;

use Debugbar;

class AccountsController extends Controller
{
    //public function back_to_login($portal) {
    //    //if (!Auth::check()) {
    //        //session()->flash('warning', 'Please Login first');
    //        //return redirect()->route('login');
    //        if ($portal == 10) {
    //            return redirect()->route('login.10ware');
    //        } else if ($portal == 11) {
    //            return redirect()->route('login.de');
    //        } else {
    //            return redirect()->route('login');
    //        }
    //    //}
    //}

    function ts($code) {
        $txt = 'htc.'.$code;
        $trans = trans($txt);
        if (empty($trans) || $trans == $txt) {
            $trans = $code;
        }
        return $trans;
    }

    /*-----------------------------------------------------------*/
    public function postActiveTab(Request $request) {
        //$portal = $_POST['portal'];
        //if (!Auth::check()) {
        //    return $this->back_to_login($portal);
        //}

        // plan, billing, devices, options, email
        // plans, billing, remote, security, email
        $sel_account_tab = $_POST['tab'];
        $data['sel_account_tab'] = $sel_account_tab;
        Auth::user()->update($data);
        return $sel_account_tab;
    }

    /*-----------------------------------------------------------*/
    // public function _profile($portal = 0) {
    //     $user = Auth::user();
    //     $data['sel_menu'] = 'account';
    //     $user->update($data);

    //     //return view('account.profile', compact('user'));
    //     return view('account.profile', compact('portal', 'user'));
    // }

    public function getProfile() {
        $user = Auth::user();
        $data['sel_menu'] = 'account';
        $user->update($data);

        return view('account.profile', compact('user'));
        // return $this->_profile(0);
    }

    /*-----------------------------------------------------------*/
//     public function html_MyPlansX() {
//         $user = Auth::user();
//         $user_id = $user->id;

//         $plans = DB::table('plans')
//             ->where('user_id', $user_id)
//             ->get();

//         $handle = '';
//         foreach ($plans as $plan) {
//             $camera_name = '(No Camera)';
//             if ($plan->camera_id) {
//                 $camera = Camera::find($plan->camera_id);
//                 if ($camera) {
//                     $camera_name = $camera->description;
//                 }
//             }

//             $handle .= '<div class="row">';
//             $handle .=     '<div class="col-md-12">';
//             $handle .=         '<div style="margin-top:10px; margin-bottom:4px; border-bottom: 1px solid gray;border-top: 1px solid lime; padding-bottom: 4px; padding-top: 4px;padding-left:10px; background-color: #444">';
//             $handle .=             '<div class="row">';
//             $handle .=                 '<div class="col-md-5">';
//             // $handle .=                     '<i class="fa fa-dot-circle"></i>';
//             // $handle .=                     '<span class="label label-info" style="font-size: 1.00em;">Prepaid 6 Months</span>';
//             $handle .=                     '<span class="label label-success" style="font-size:0.9em;">Active</span>';
//             $handle .=                     '<p></p>';
//             $handle .=                 '</div>';
//             $handle .=                 '<div class="col-md-5">';
//             $handle .=                 '</div>'; // <!-- end col -->
//             $handle .=             '</div>';
//             $handle .=         '</div>';
//             $handle .=     '</div>';
//             $handle .= '</div>';

//             $handle .= '<div class="row">';
//             $handle .=     '<div class="col-sm-6">';
//             $handle .=         '<table class="table plan-table">';
//             $handle .=             '<tbody>';
// //            $handle .=                 '<tr><td class="pull-right"><i class="fa fa-bolt"></i>Sim ICCID:</td>';
//             $handle .=                 '<tr><td class="pull-right"></i>ICCID:</td>';
//             $handle .=                     '<td><strong>'.$plan->iccid.'</strong></td>';
//             $handle .=                 '</tr>';
//             //$handle .=                 '<tr><td class="pull-right"><i class="fa fa-camera"> </i> Camera:</td>';
//             $handle .=                 '<tr><td class="pull-right">Camera:</td>';
//             $handle .=                     '<td><strong>'.$camera_name.'</strong></td>';
//             $handle .=                 '</tr>';
//             $handle .=                 '<tr><td class="pull-right">Plan Points:</td>';
//             $handle .=                     '<td><strong>'.$plan->points.'</strong></td>';
//             $handle .=                 '</tr>';
//             $handle .=                 '<tr><td class="pull-right">Points Used:</td>';
//             $handle .=                     '<td><strong>'.$plan->points_used.'</strong></td>';
//             $handle .=                 '</tr>';
// //            $handle .=                 '<tr><td class="pull-right">SMS Sent:</td>';
// //            $handle .=                     '<td><strong>'.$plan->sms_sent.'</strong></td>';
// //            $handle .=                 '</tr>';
//             $handle .=             '</tbody>';
//             $handle .=         '</table>';
//             $handle .=     '</div>';
//             $handle .= '</div>';
//         }
//         return $handle;
//     }

    public function html_MyPlans() {
        Debugbar::info(__METHOD__);

        $img_region = array(
            'us' => '/images/usd.png',
            'ca' => '/images/cad.png',
            'eu' => '/images/eur.png',
            'au' => '/images/aud.png',
        );

        $currency_region = array(
            'us' => '$',
            'ca' => '$',
            'eu' => '€',
            'au' => '$',
            // 'gb' => '£', // gbp
        );

        $user = Auth::user();
        $user_id = $user->id;

        if ($user->permission == 1) {
            $plans = DB::table('plans')
                ->get();
        } else {
            $plans = DB::table('plans')
                ->where('user_id', $user_id)
                ->get();
        }

        $txtAutoBill = $this->ts('Auto-Bill');
        $txtCamera = $this->ts('Camera');
        // $txtPlanPoints = $this->ts('Plan Points');
        // $txtPointsUsed = $this->ts('Points Used');
        $txtPoints = $this->ts('Points');
        $txtFor = $this->ts('for');

        $txtPlanTotal = $this->ts('Plan Total');
        $txtPlanUsed = $this->ts('Plan Used');

        $handle = '';
        $txt_plan = '';
        $txt_plan2 = '';
        foreach ($plans as $plan) {
            $plan_style = $plan->style ? $plan->style : 'test';

            $plan_total = sprintf('%d MB', $plan->points);

            $plan_used_mb = round($plan->points_used/(1024*1024), 2);
            $percent = round(($plan_used_mb/$plan->points)*100, 2);
            $plan_used = sprintf('%.2f MB (%6.2f %%)', $plan_used_mb, $percent);

            // $plan_used = sprintf('%.2f MB', $plan_used_mb);

            // $sku = PlanProductSku::find($plan->plan_product_sku_id);
            $sku = PlanProductSku::where('sub_plan', $plan->sub_plan)->first(); // au_5000_1m
            if ($sku) {
                $product = PlanProduct::find($sku->plan_product_id);

                // Silver - 3 Months
                $txt_plan = $product->title.' - '.$sku->month.' Month'.(($sku->month>1)?'s':'');

                // // $9.00 for 1000 Points
                // $txt_plan2 = sprintf('%s %s %s %s', $sku->price, $txtFor, $product->points*$sku->month, $txtPoints);
                // $txt_plan2 = $currency_region[$plan->region].$txt_plan2;

            } else {
                Debugbar::error('plan product sku not found - '.$plan->sub_plan);
            }
            $txt_status = ucwords($plan->status);
            $txt_auto_bill = ($plan->auto_bill == 1) ? 'Yes' : 'No';
            $txt_region = ($plan->region) ? $img_region[$plan->region] : '';

            // $camera_name = '(No Camera)';
            $camera_name = sprintf('(%s)', $this->ts('No Camera'));
            if ($plan->camera_id) {
                $camera = Camera::find($plan->camera_id);
                if ($camera) {
                    $camera_name = $camera->description;
                }
            }

            // Cart: deactive & in cart
            // Create New Plan: deactive & no in cart
            // Renew: active
            // Reactive: suspend
            if ($plan->status == 'deactive') {
                $cart = CartItem::where('iccid', $plan->iccid)->first();
                if ($cart) {
                    $action = 'cart';
                    $action_url = '/shop/cart/';
                    $action_name = 'Cart';
                    $action_icon = 'shopping-cart';

                } else {
                    $action = 'create';
                    $action_url = '/plans/create/'.$plan->id;
                    $action_name = 'Create New Plan';
                    $action_icon = 'plus';
                }
            } else if ($plan->status == 'active') {
                $action = 'renew';
                $action_url = '/plans/renew/'.$plan->id;
                $action_name = 'Renew';
                $action_icon = 'refresh';
            } else {
                $action = 'reactive';
                $action_url = '/plans/reactive/'.$plan->id;
                $action_name = 'Reactive';
                $action_icon = 'saved';
            }

            $action_name = $this->ts($action_name);

            /*

            */
            $sku = null;
            $txt_tier = $txt_tier2 = 'xxx';
            $txt_service_end = '';
            if ($action == 'cart') {
                $sku = PlanProductSku::find($cart->plan_product_sku_id);

            } else if (($action == 'renew')||($action == 'reactive')) {
                // $subscription = DB::table("subscriptions")->where('name', $plan->iccid)->first();
                // if ($subscription) {
                //     $sku = PlanProductSku::where('sub_plan', $subscription->stripe_plan)->first();
                //     if ($subscription->ends_at) {
                //         $dt = date_create($subscription->ends_at);
                //         $dt = date_format($dt, $user->date_format);
                //         // $txt_service_end = 'Service Ends by 2019/10/04 07:59:59';
                //         $txt_service_end = 'Service Ends by '.$dt;
                //     }
                // }

                $sku = PlanProductSku::where('sub_plan', $plan->renew_plan)->first();

                $dt = date_create($plan->sub_start);
                $txtServiceStart = $this->ts('Service Start at');
                $timeServiceStart = date_format($dt, $user->date_format);

                $dt = date_create($plan->sub_end);
                $txtServiceEnd = $this->ts('Service End at');
                $txtServiceRenew = $this->ts('Service Renew at');
                $txt_service_end = date_format($dt, $user->date_format);
            }

            /* search Subscription */
            if ($sku) {
                $product = PlanProduct::find($sku->plan_product_id);

                // Silver - 3 Months
                // $txt_tier = $product->title.' - '.$product->points.' Points per Month';
                $txt_tier = $product->title.' - '.$sku->month.' Month'.(($sku->month>1)?'s':'');

                // $txt_tier2 = sprintf('%s %s %s %s', $sku->price, $txtFor, $product->points*$sku->month, $txtPoints);
                // $txt_tier2 = $currency_region[$plan->region].$txt_tier2;
            }

// $handle .= '<table class="table">';
//             $handle .=                          '<tr><td >Service Start at : </td>';
//             $handle .=                              '<td>'.$timeServiceStart.'</td>';
//             $handle .=                          '</tr>';

//             $handle .=                          '<tr><td >Service : </td>';
//             $handle .=                              '<td>'.$timeServiceStart.'</td>';
//             $handle .=                          '</tr>';
// $handle .= '</table>';

            $handle .= '<div class="row">';
            $handle .=     '<div class="col-md-12">';
            $handle .=         '<div style="margin-top:10px; margin-bottom:4px; border-bottom: 1px solid gray;border-top: 1px solid lime; padding-bottom: 4px; padding-top: 4px;padding-left:10px; background-color: #444">';
            $handle .=             '<div class="row">';

            /* Silver 1 Month */
            $handle .=                 '<div class="col-md-5">';
            // $handle .=                     '<i class="fa fa-dot-circle"></i>';
            $handle .=                     ' <span class="label label-highlight" style="font-size:0.9em;">'.$txt_status.'</span>';
if ($plan->status == 'active') {
    if ($plan_style == 'test') {
                $handle .=                     ' <span class="label label-info" style="font-size: 1.00em;">'.'TEST'.'</span>';
    } else {
                $handle .=                     ' <span class="label label-info" style="font-size: 1.00em;">'.$txt_plan.'</span>';
                // $handle .=                     ' <span style="color:lime;">'.$txt_plan2.'</span>';
                // $handle .=                     ' <img src="'.$txt_region.'" width="30" style="margin-bottom:10px;"/>';

            // $handle .=                     ' <span class="label label-highlight" style="font-size:0.9em;">'.$txt_status.'</span>';

            /* Auto-Reserve */
            // $handle .=                     '<p style="margin-top:4px;">';
            // $handle .=                          '<span class="button-checkbox" style="margin-left:20px;">';
            // $handle .=                              '<button type="button" class="btn btn-default btn-xs" data-color="info">Auto-Reserve (<i class="fa fa-dollar-sign"></i>10)</button>';
            // $handle .=                              '<input type="checkbox" class="hidden camera-select" name="autoreserve[]" value="8"   />';
            // $handle .=                          '</span>';
            // $handle .=                     '</p>';
            /* Auto-Bill */
            // $handle .=                     '<p>';
            // $handle .=                     '<p style="margin-top:4px;">';
            // $handle .=                         '<span class="button-checkbox" style="margin-left:20px;">';
            // // $handle .=                             '<button type="button" class="btn btn-default btn-xs" data-color="info">Auto-Bill (renews after 19/12/2018 8:00:00 am)</button>';
            // // $handle .=                             '<input type="checkbox" class="hidden camera-select" name="autorenew[]" value="8"  checked  />';
            // // // $handle .=                             '<br /><span class="label label-warning" style="font-size:0.9em; margin-left: 20px;">Service Ends by 10/04/2019 7:59:59 am</span>';
            // // $handle .=                             '<br /><span class="text-warning" style="font-size:0.9em; margin-left: 20px;">'.$timeServiceStart.'</span>';
            // // $handle .=                             '<br /><span class="text-warning" style="font-size:0.9em; margin-left: 20px;">'.$txt_service_end.'</span>';
            // $handle .=                         '</span>';
            // $handle .=                     '</p>';

            $handle .=                     '<p style="margin-top:8px;">';
            $handle .=                     '<table class="table">';
            $handle .=                         '<tbody class="text-warning">';
            $handle .=                             '<tr><td class="pull-right">'.$txtServiceStart.' : </td>';
            $handle .=                                 '<td>'.$timeServiceStart.'</td>';
            $handle .=                             '</tr>';
            if ($plan->auto_bill) {
                $handle .=                         '<tr><td class="pull-right">'.$txtServiceRenew.' : </td>';
            } else {
                $handle .=                         '<tr><td class="pull-right">'.$txtServiceEnd.' : </td>';
            }

            $handle .=                                 '<td>'.$txt_service_end.'</td>';
            $handle .=                         '</tr>';
            $handle .=                         '</tbody>';
            $handle .=                     '</table>';
            $handle .=                     '</p>';
    }
}
            $handle .=                     '<p></p>';
            $handle .=                 '</div>'; // <!-- end col-md-5 -->

            /* Configure Plan Renewal */
// TODO
           $handle .=                 '<div class="col-md-5">';
           // if ($action == 'active') {
           //  $handle .=                     '<a href="/plans/renew/'.$plan->id.'"  style="margin-left:20px;" class="btn btn-xs btn-primary">';
           //  $handle .=                         '<i class="glyphicon glyphicon-refresh"> </i> Configure Plan Renewal';
           //  $handle .=                     '</a>';
           //  $handle .=                     '<div class="alert alert-default" style="margin-left:20px; margin-bottom: 2px; margin-top:4px; background-color: #222;">';
           //  $handle .=                         '<p>';
           //  $handle .=                             'Renew Tier:';
           //  $handle .=                             '<strong>';
           //  $handle .=                                  ' <span class="label label-info" style="font-size: 1.00em;">Silver 1 Month</span>';
           //  $handle .=                                  ' <span style="color:lime;"><i class="fa fa-dollar-sign"></i>12.95 per Month</span>';
           //  $handle .=                             '</strong>';
           //  $handle .=                         '</p>';
           //  $handle .=                         '<p>';
           //  $handle .=                             'Renew Auto-Reserve: ';
           //  $handle .=                             '<strong>'.$txt_auto_bill.'</strong>';
           //  $handle .=                         '</p>';
           // } else if ($action == 'cart') {
if ($plan_style == 'test') {

} else {
            $handle .=                     '<a href="'.$action_url.'" style="margin-left:20px;" class="btn btn-xs btn-primary">';
            $handle .=                         '<i class="glyphicon glyphicon-'.$action_icon.'"> </i> '.$action_name;
            $handle .=                     '</a>';

        // if (($action == 'cart')||($action == 'renew')||($action == 'renew')) {
        if ($action != 'create') {
            $handle .=                     '<div class="alert alert-default" style="margin-left:20px; margin-bottom: 2px; margin-top:4px; background-color: #222;">';
            if ($plan->auto_bill) {
                $handle .=                     '<p>';
                $handle .=                         '<strong>'.$txt_tier.'</strong>';
                $handle .=                     '</p>';

                // $handle .=                     '<p>';
                // // $handle .=                         'Tier:';
                // $handle .=                         '<strong>';
                // // $handle .=                              ' <span class="label" style="font-size: 1.00em; color:lime;">'.$txt_tier2.'</span>';
                // $handle .=                              ' <span style="font-size: 1.00em; color:lime;">'.$txt_tier2.'</span>';
                // $handle .=                         '</strong>';
                // $handle .=                     '</p>';
            }
            $handle .=                         '<p>';
            $handle .=                             $txtAutoBill.': ';
            $handle .=                             '<strong>';
            $handle .=                                  ' <span class="label" style="font-size: 1.00em;">'.$txt_auto_bill.'</span>';
            $handle .=                             '</strong>';
            $handle .=                         '</p>';
            $handle .=                     '</div>';
        }
}

           $handle .=                 '</div>'; // <!-- end col-md-5 -->
//+
            $handle .=             '</div>'; // <!-- end row -->
            $handle .=         '</div>';
            $handle .=     '</div>'; // <!-- end col-md-12 -->
            $handle .= '</div>'; // <!-- end row -->

            $handle .= '<div class="row">';
            $handle .=     '<div class="col-sm-6">';
            $handle .=         '<table class="table plan-table">';
            $handle .=             '<tbody>';
//            $handle .=                 '<tr><td class="pull-right"><i class="fa fa-bolt"></i>Sim ICCID:</td>';
            $handle .=                 '<tr><td class="pull-right"></i>ICCID:</td>';
            $handle .=                     '<td><strong>'.$plan->iccid.'</strong></td>';
            $handle .=                 '</tr>';
            //$handle .=                 '<tr><td class="pull-right"><i class="fa fa-camera"> </i> Camera:</td>';
            $handle .=                 '<tr><td class="pull-right">'.$txtCamera.':</td>';
            $handle .=                     '<td><strong>'.$camera_name.'</strong></td>';
            $handle .=                 '</tr>';
            // $handle .=                 '<tr><td class="pull-right">'.$txtPlanPoints.':</td>';
            // $handle .=                     '<td><strong>'.$plan->points.'</strong></td>';
            $handle .=                 '<tr><td class="pull-right">'.$txtPlanTotal.':</td>';
            $handle .=                     '<td><strong>'.$plan_total.'</strong></td>';
            $handle .=                 '</tr>';
            // $handle .=                 '<tr><td class="pull-right">'.$txtPointsUsed.':</td>';
            // $handle .=                     '<td><strong>'.$plan->points_used.'</strong></td>';
            $handle .=                 '<tr><td class="pull-right">'.$txtPlanUsed.':</td>';
            $handle .=                     '<td><strong>'.$plan_used.'</strong></td>';
            $handle .=                 '</tr>';
            // $handle .=                 '<tr><td class="pull-right">SMS Sent:</td>';
            // $handle .=                     '<td><strong>'.$plan->sms_sent.'</strong></td>';
            // $handle .=                 '</tr>';

            /* Reserve */
            // $handle .=                 '<tr>';
            // $handle .=                     '<td class="pull-right">Reserve:</td>';
            // $handle .=                     '<td>';
            // //$handle .=                         '(No Reserve)';
            // $handle .=                         '<strong><i class="fa fa-dollar-sign"></i>10.00 (6666.66 points) </strong>';
            // $handle .=                         '<br />';
            // $handle .=                         '<a href="/plans/buy-reserve/8" class="btn btn-xs btn-primary">';
            // $handle .=                             '<i class="glyphicon glyphicon-shopping-cart"></i> Buy Points Reserve (<i class="fa fa-dollar-sign"></i>10)';
            // $handle .=                         '</a>';
            // $handle .=                     '</td>';
            // $handle .=                 '</tr>';
/* for test
$handle .=                 '<tr>';
            $handle .= '<td>';
            // $handle .=     '<a href="/plan/mobilerevoke/77" class="btn btn-xs btn-warning"><i class="fa fa-times-circle"> </i> Pause</a>';
            $handle .=     '<a href="/plan/pause/'.$plan->id.'" class="btn btn-xs btn-warning">Pause</a>';
            $handle .=     '<a href="/plan/active/'.$plan->id.'" class="btn btn-xs btn-warning">Active</a>';
            $handle .=     '<a href="/plan/change/'.$plan->id.'" class="btn btn-xs btn-warning">Change</a>';
            $handle .=     '<a href="/plan/cancel/'.$plan->id.'" class="btn btn-xs btn-warning">Cancel</a>';

            $handle .= '</td>';
$handle .=                 '</tr>';
*/
            $handle .=             '</tbody>';
            $handle .=         '</table>';
            $handle .=     '</div>'; // <!-- end col-sm-6 -->

/* TODO
            $handle .=     '<div class="col-sm-6">';
            $handle .=         '<div style="background-color:#222;padding-top:10px;padding-bottom:10px;">';
            $handle .=             '<h4 style="margin-left:10px"><strong>Plan Activity</strong></h4>';

            $handle .=                  '<h5 style="margin-left:24px">';
            $handle .=                      '<i class="fa fa-sync" style="color:white;"></i>';
            $handle .=                      '2018/11/20 23:43:59 | Points Reserve';
            $handle .=                      '(#<a class="label label-highlight view-invoice" id="25" data-invoice="&lt;table class=&quot;table plan-table&quot;&gt;&lt;tbody&gt;&lt;tr&gt;&lt;td class=&quot;pull-right&quot;&gt;Invoice Date:&lt;/td&gt;&lt;td&gt;&lt;strong&gt;2018/11/20 23:43:59&lt;/strong&gt;&lt;/td&gt;&lt;/tr&gt;&lt;tr&gt;&lt;td class=&quot;pull-right&quot;&gt;Total:&lt;/td&gt;&lt;td&gt;&lt;strong&gt;13.50&lt;/strong&gt;&lt;/td&gt;&lt;/tr&gt;&lt;tr&gt;&lt;td class=&quot;pull-right&quot;&gt;Charge ID:&lt;/td&gt;&lt;td&gt;&lt;strong&gt;ch_1DYbOMHMprYyJrNbd90lSYK3&lt;/strong&gt;&lt;/td&gt;&lt;/tr&gt;&lt;tr&gt;&lt;td class=&quot;pull-right&quot;&gt;Card:&lt;/td&gt;&lt;td&gt;&lt;strong&gt;Visa&lt;/strong&gt;&lt;/td&gt;&lt;/tr&gt;&lt;tr&gt;&lt;td class=&quot;pull-right&quot;&gt;Last4:&lt;/td&gt;&lt;td&gt;&lt;strong&gt;4242&lt;/strong&gt;&lt;/td&gt;&lt;/tr&gt;&lt;tr&gt;&lt;td class=&quot;pull-right&quot;&gt;Expire Date:&lt;/td&gt;&lt;td&gt;&lt;strong&gt;1/2019&lt;/strong&gt;&lt;/td&gt;&lt;/tr&gt;&lt;tr&gt;&lt;td class=&quot;pull-right&quot;&gt;Country:&lt;/td&gt;&lt;td&gt;&lt;strong&gt;US&lt;/strong&gt;&lt;/td&gt;&lt;/tr&gt;&lt;tr&gt;&lt;td class=&quot;pull-right&quot;&gt;Currency:&lt;/td&gt;&lt;td&gt;&lt;strong&gt;aud&lt;/strong&gt;&lt;/td&gt;&lt;/tr&gt;&lt;tr&gt;&lt;td colspan=2&gt;&lt;hr&gt;&lt;/td&gt;&lt;/tr&gt;&lt;tr&gt;&lt;td class=&quot;pull-right&quot;&gt;(1) Points Reserve:&lt;br /&gt;For IccID: 89860117851014783481&lt;/td&gt;&lt;td&gt;13.50&lt;/td&gt;&lt;/tr&gt;&lt;/tbody&gt;&lt;/table&gt;">00025</a>)';
            $handle .=                  '</h5>';

            $handle .=                  '<h5 style="margin-left:24px">';
            $handle .=                      '<i class="fa fa-sync" style="color:white;"></i>';
            $handle .=                      '2018/11/20 23:30:02 | Points Reserve';
            $handle .=                      '(#<a class="label label-highlight view-invoice" id="24" data-invoice="&lt;table class=&quot;table plan-table&quot;&gt;&lt;tbody&gt;&lt;tr&gt;&lt;td class=&quot;pull-right&quot;&gt;Invoice Date:&lt;/td&gt;&lt;td&gt;&lt;strong&gt;2018/11/20 23:30:02&lt;/strong&gt;&lt;/td&gt;&lt;/tr&gt;&lt;tr&gt;&lt;td class=&quot;pull-right&quot;&gt;Total:&lt;/td&gt;&lt;td&gt;&lt;strong&gt;10.00&lt;/strong&gt;&lt;/td&gt;&lt;/tr&gt;&lt;tr&gt;&lt;td class=&quot;pull-right&quot;&gt;Charge ID:&lt;/td&gt;&lt;td&gt;&lt;strong&gt;ch_1DYbArHMprYyJrNbULRs178r&lt;/strong&gt;&lt;/td&gt;&lt;/tr&gt;&lt;tr&gt;&lt;td class=&quot;pull-right&quot;&gt;Card:&lt;/td&gt;&lt;td&gt;&lt;strong&gt;Visa&lt;/strong&gt;&lt;/td&gt;&lt;/tr&gt;&lt;tr&gt;&lt;td class=&quot;pull-right&quot;&gt;Last4:&lt;/td&gt;&lt;td&gt;&lt;strong&gt;4242&lt;/strong&gt;&lt;/td&gt;&lt;/tr&gt;&lt;tr&gt;&lt;td class=&quot;pull-right&quot;&gt;Expire Date:&lt;/td&gt;&lt;td&gt;&lt;strong&gt;1/2019&lt;/strong&gt;&lt;/td&gt;&lt;/tr&gt;&lt;tr&gt;&lt;td class=&quot;pull-right&quot;&gt;Country:&lt;/td&gt;&lt;td&gt;&lt;strong&gt;US&lt;/strong&gt;&lt;/td&gt;&lt;/tr&gt;&lt;tr&gt;&lt;td class=&quot;pull-right&quot;&gt;Currency:&lt;/td&gt;&lt;td&gt;&lt;strong&gt;usd&lt;/strong&gt;&lt;/td&gt;&lt;/tr&gt;&lt;tr&gt;&lt;td colspan=2&gt;&lt;hr&gt;&lt;/td&gt;&lt;/tr&gt;&lt;tr&gt;&lt;td class=&quot;pull-right&quot;&gt;(1) Points Reserve:&lt;br /&gt;For IccID: 89860117851014783481&lt;/td&gt;&lt;td&gt;10.00&lt;/td&gt;&lt;/tr&gt;&lt;/tbody&gt;&lt;/table&gt;">00024</a>)';
            $handle .=                  '</h5>';

            $handle .=                 '<h5 style="margin-left:24px">';
            $handle .=                     '<i class="fa fa-signal" style="color:lime;"></i>';
            $handle .=                     '19/11/2018 9:45:36 pm | Activation';
            $handle .=                 '</h5>';

            $handle .=                 '<h5 style="margin-left:24px">';
            $handle .=                     '<i class="fa fa-signal" style="color:orange;"></i>';
            $handle .=                     '19/11/2018 9:45:28 pm | Suspension';
            $handle .=                 '</h5>';

            $handle .=         '</div>';
            $handle .=     '</div>'; // <!-- end col-sm-6 -->
*/
            $handle .= '</div>'; // <!-- end row -->
        }
        return $handle;
    }

    /*-----------------------------------------------------------*/
    public function html_DateFormat() {
        $user = Auth::user();
        $user_id = $user->id;

        $sel_mdY_his_a = '';
        $sel_mdY_His = '';
        $sel_Ymd_his_a = '';
        $sel_Ymd_His = '';
        $sel_dmY_his_a = '';
        $sel_dmY_His = '';
        $selected = 'selected="selected"';

        if ($user->date_format == 'm/d/Y h:i:s a') {
            $sel_mdY_his_a = $selected;
        } else if ($user->date_format == 'm/d/Y H:i:s') {
            $sel_mdY_His = $selected;
        } else if ($user->date_format == 'Y/m/d h:i:s a') {
            $sel_Ymd_his_a = $selected;
        } else if ($user->date_format == 'Y/m/d H:i:s') {
            $sel_Ymd_His = $selected;
        } else if ($user->date_format == 'd/m/Y h:i:s a') {
            $sel_dmY_his_a = $selected;
        } else if ($user->date_format == 'd/m/Y H:i:s') {
            $sel_dmY_His = $selected;
        }

        $txtMDY = $this->ts('MM/DD/YYYY');
        $txtYMD = $this->ts('YYYY/MM/DD');
        $txtDMY = $this->ts('DD/MM/YYYY');
        $txtHMS = $this->ts('HH:MM:SS');
        $txtAMPM = $this->ts('AM/PM');
        $txt12H = $this->ts('12 hours');
        $txt24H = $this->ts('24 hours');

        $opt1 = sprintf('%s %s %s (%s)', $txtMDY, $txtHMS, $txtAMPM, $txt12H);
        $opt2 = sprintf('%s %s (%s)', $txtMDY, $txtHMS, $txt24H);
        $opt3 = sprintf('%s %s %s (%s)', $txtYMD, $txtHMS, $txtAMPM, $txt12H);
        $opt4 = sprintf('%s %s (%s)', $txtYMD, $txtHMS, $txt24H);
        $opt5 = sprintf('%s %s %s (%s)', $txtDMY, $txtHMS, $txtAMPM, $txt12H);
        $opt6 = sprintf('%s %s (%s)', $txtDMY, $txtHMS, $txt24H);

        $txt = '';
        // $txt .= '<option value="m%2Fd%2FY+h%3Ai%3As+a" '.$sel_mdY_his_a.'">MM/DD/YYYY HH:MM:SS AM/PM (12 hours)</option>';
        // $txt .= '<option value="m%2Fd%2FY+H%3Ai%3As" '.$sel_mdY_His.'>MM/DD/YYYY HH:MM:SS (24 hours)</option>';
        // $txt .= '<option value="Y%2Fm%2Fd+h%3Ai%3As+a" '.$sel_Ymd_his_a.'>YYYY/MM/DD HH:MM:SS AM/PM (12 hours)</option>';
        // $txt .= '<option value="Y%2Fm%2Fd+H%3Ai%3As" '.$sel_Ymd_His.'>YYYY/MM/DD HH:MM:SS (24 hours)</option>';
        // $txt .= '<option value="d%2Fm%2FY+h%3Ai%3As+a" '.$sel_dmY_his_a.'>DD/MM/YYYY HH:MM:SS AM/PM (12 hours)</option>';
        // $txt .= '<option value="d%2Fm%2FY+H%3Ai%3As" '.$sel_dmY_His.'>DD/MM/YYYY HH:MM:SS (24 hours)</option>';
        $txt .= '<option value="m%2Fd%2FY+h%3Ai%3As+a" '.$sel_mdY_his_a.'">'.$opt1.'</option>';
        $txt .= '<option value="m%2Fd%2FY+H%3Ai%3As" '.$sel_mdY_His.'>'.$opt2.'</option>';
        $txt .= '<option value="Y%2Fm%2Fd+h%3Ai%3As+a" '.$sel_Ymd_his_a.'>'.$opt3.'</option>';
        $txt .= '<option value="Y%2Fm%2Fd+H%3Ai%3As" '.$sel_Ymd_His.'>'.$opt4.'</option>';
        $txt .= '<option value="d%2Fm%2FY+h%3Ai%3As+a" '.$sel_dmY_his_a.'>'.$opt5.'</option>';
        $txt .= '<option value="d%2Fm%2FY+H%3Ai%3As" '.$sel_dmY_His.'>'.$opt6.'</option>';
        return $txt;
    }

    /*-----------------------------------------------------------*/
    // Confirm  -> Success: Mobile Access Approved for ID [617]
    // Block    -> Success: Mobile Access Blocked for ID [782]
    // Unblock  -> Success: Mobile Access Allowed for ID [617]
    public function html_Devices() {
        $user = Auth::user();
        $user_id = $user->id;

        $devices = DB::table('devices')->where('user_id', $user_id)->get();
        $txt = '';
        $txtDeviceInfo = $this->ts('Device Info');
        // $txtSendNotify = $this->ts('Send Notifications');
        $txtNotifyHB = $this->ts('Notify on Heartbeat');
        $txtNotifyUpload = $this->ts('Notify on Upload');
        // $txtLastActive = $this->ts('Last Active');
        // $txtBlock = $this->ts('Block now');
        $txtRemove = $this->ts('Remove');

        if ($devices->count() > 0) {
            $txt .= '<thead>';
            $txt .=     '<tr>';
            // $txt .=         '<th>Device Info</th>';
            $txt .=         '<th>'.$txtDeviceInfo.'</th>';
            // $txt .=         '<th>Confirmed</th>';
            $txt .=     '</tr>';
            $txt .= '</thead>';

            $txt .= '<tbody>';
            foreach ($devices as $device) {
                $id = $device->id;

                $mobile = DB::table('mobiles')->where('device_id', $device->device_id)->first();
                if (!$mobile) continue;

                $name = $mobile->name;
                $model = $mobile->model;
                $os = $mobile->os;
                $ver = $mobile->ver;

                if ($os == 'android') {
                    $os = 'Android';
                } else if ($os == 'ios') {
                    $os = 'iOS';
                }
                $device_info = sprintf('%s - %s', $name, $model);
                $device_os = sprintf('%s %s', $os, $ver);
                // $device_info = sprintf('%s - %s (%s %s)', $device->name, $device->model, $os, $device->ver);
                // $notify_checked = ($device->push_notify == 'on') ? 'checked' : '';
                $hb_checked = ($device->push_hb == 'on') ? 'checked' : '';
                $upload_checked = ($device->push_upload == 'on') ? 'checked' : '';

                $txt .= '<tr>';
                $txt .=     '<td colspan=3>';
                $txt .=         '<i class="fa fa-dot-circle" style="color:lime;"> </i> '.$device_info.'<br/>';
                $txt .=         '<span style="color:yellowgreen;">'.$device_os.'</span>';
                // $txt .=         '<span style="color:yellowgreen;">'.$device->push_id.'</span>';
                // $txt .=         '<span style="color:yellowgreen;">.'$txtLastActive.': 2019/01/18 03:02:45</span>';
                $txt .=     '</td>';
                $txt .= '</tr>';
                $txt .= '<tr>';
                $txt .=     '<td>';
                // $txt .=         '<span class="button-checkbox">';
                // $txt .=             '<button type="button" class="btn btn-default btn-xs" data-color="info">'.$txtSendNotify.'</button>';
                // $txt .=             '<input type="checkbox" class="hidden camera-select" name="push_notify[]" value="'.$id.'" '.$notify_checked.' /> ';
                // $txt .=         '</span>';
                $txt .=         '<span class="button-checkbox">';
                $txt .=             '<button type="button" class="btn btn-default btn-xs" data-color="info">'.$txtNotifyHB.'</button>';
                $txt .=             '<input type="checkbox" class="hidden camera-select" name="push_hb[]" value="'.$id.'" '.$hb_checked.' /> ';
                $txt .=         '</span>';
                $txt .=         '<span class="button-checkbox">';
                $txt .=             '<button type="button" class="btn btn-default btn-xs" data-color="info">'.$txtNotifyUpload.'</button>';
                $txt .=             '<input type="checkbox" class="hidden camera-select" name="push_upload[]" value="'.$id.'" '.$upload_checked.' /> ';
                $txt .=         '</span>';
                $txt .=     '</td>';

                $txt .=     '<td>';
                // $txt .=         'Yes';
                // $txt .=         '<a href="/account/mobilerevoke/617" class="btn btn-xs btn-warning"><i class="fa fa-times-circle"> </i> '.$txtBlock.'</a> ';
                $txt .=         '<a href="/account/deviceremove/'.$id.'" class="btn btn-xs btn-danger"><i class="fa fa-trash"> </i> '.$txtRemove.'</a>';
                // $txt .=         '<a href="/account/mobileinstate/617" class="btn btn-xs btn-success"><i class="fa fa-times-circle"> </i> Unblock</a>';
                // $txt .=         '<a href="/account/mobileconfirm/77" class="btn btn-xs btn-success">Confirm now</a>';
                $txt .=     '</td>';
                $txt .= '</tr>';
            }
            $txt .= '</tbody>';
        }
        return $txt;
    }

    /*-----------------------------------------------------------*/
    public function html_EmailSetup() {
        Debugbar::info(__METHOD__);

        $user = Auth::user();
        $user_id = $user->id;

        $emails = DB::table('emails')->where('user_id', $user_id)->get();

        $email_addr = [];
        $index = 1;
        foreach ($emails as $email) {
            $email_addr[$index] = $email->email;
            $index++;
        }
//return count($email_addr);
//return $email_addr[1];

//return $emails;
//return $email->email;
//return count($emails);
//return $emails[0];

//$ret['emails'] = $emails;
//return $ret;

        $index = 1;
        $handle = '';
        $handle .= '<div class="col-md-6">';
        for ($i=1; $i<=2; $i++) {
            for ($j=1; $j<=5; $j++) {
                if (isset($email_addr[$index])) {
                    $value = $email_addr[$index];
                } else {
                    $value='';
                }

                //$id = 'g'.$i.'_email'.$j;
                $id = 'email_'.$index;
                $placeholder = 'Input Email '.$index;
                $handle .= '<div class="row">';
                $handle .=     '<div class="col-md-12">';
                ////$handle .=         <!--
                ////$handle .=         <div class="form-group">
                ////$handle .=             <label class="col-md-4 control-label">Email 1</label>
                ////$handle .=             <div class="col-md-7">
                ////$handle .=                 <input type="text" name="g1_email1" maxlength="70" value="test@gmail.com" id="g1_email1" class="form-control" placeholder="Input Email 1">
                ////$handle .=             </div>
                ////$handle .=         </div>
                ////$handle .=         -->
                $handle .=         '<div class="input-group" style="margin-bottom:8px;">';
                $handle .=             '<input type="text" name="'.$id.'" maxlength="70" value="'.$value.'" id="'.$id.'" class="form-control" placeholder="'.$placeholder.'">';
                $handle .=             '<div class="input-group-btn">';
                $handle .=                 '<button class="trash-email btn btn-default" style="background-color: #aaa;padding-top:12px!important;padding-bottom:12px!important;border: none;" input-id="'.$id.'" title="Clear Email">';
                $handle .=                     '<i class="glyphicon glyphicon-trash"></i>';
                $handle .=                 '</button>';
                $handle .=             '</div>';
                $handle .=         '</div>';
                $handle .=     '</div>';
                $handle .= '</div>';
                $index++;
            }
        }
        $handle .= '</div>';

        $handle .= '<div class="col-md-6">';
        for ($i=3; $i<=3; $i++) {
            for ($j=1; $j<=5; $j++) {
                //$id = 'g'.$i.'_email'.$j;
                $id = 'email_'.$index;
                $placeholder = 'Input Email '.$index;
                $handle .= '<div class="row">';
                $handle .=     '<div class="col-md-12">';
                $handle .=         '<div class="input-group" style="margin-bottom:8px;">';
                $handle .=             '<input type="text" name="'.$id.'" maxlength="70" value="" id="'.$id.'" class="form-control" placeholder="'.$placeholder.'">';
                $handle .=             '<div class="input-group-btn">';
                $handle .=                 '<button class="trash-email btn btn-default" style="background-color: #aaa;padding-top:12px!important;padding-bottom:12px!important;border: none;" input-id="'.$id.'" title="Clear Email">';
                $handle .=                     '<i class="glyphicon glyphicon-trash"></i>';
                $handle .=                 '</button>';
                $handle .=             '</div>';
                $handle .=         '</div>';
                $handle .=     '</div>';
                $handle .= '</div>';
                $index++;
            }
        }
        $handle .= '</div>';

        return $handle;
    }

    /*-----------------------------------------------------------*/
    public function postPlans(Request $request) {
        //$portal = $request->portal;
        $user = Auth::user();
        $user_id = $user->id;

        session()->flash('success', 'Success: Account Plans Saved.');
        return redirect()->back();
    }

    /*
    {
        "_token":"NU81sCo2nwHyYvMQYugQzrZzMr0O5p8szCRNe5nl",
        "cardholder-name":"Kevin",
        "cardholder-phone":"18664933085",
        "stripeToken":"tok_1DThUGG8UgnSL68Ub0C7FfEh"
    }
    */
    /*
        us 4242 4242 4242 4242
        ca 4000 0012 4000 0000
        eu 4000 0027 6000 0016 (Germany)
        eu 4000 0025 0000 0003 (France)
        au 4000 0003 6000 0006
        cn 4000 0015 6000 0002
        hk 4000 0034 4000 0004
    */
    public function postBilling(Request $request) {
        // {"_token":"xxxx","cardholder-name":"Kevin","stripeToken":"tok_1Dh1V9G8UgnSL68USELWLL34"}
        $next = $request->input('next', 'back');
        $card_name = $request->input('cardholder-name');
        // $card_phone = $request->input('cardholder-phone');

        $user = Auth::user();
        // $user_id = $user->id;

        // \Stripe\Stripe::setApiKey(config('services.stripe.secret'));
        // $stripeToken = $_POST['stripeToken'];
        // $ret = \Stripe\Customer::create([
        //     "email" => $user->email,
        //     "description" => $_POST['cardholder-name'],
        //     // "name" => $_POST['cardholder-name'],
        //     // "phone" => $_POST['cardholder-phone'],
        //     // "address" => 'ADDRESS.....',
        //     // "currency" =>  "usd"
        //     'source' => $stripeToken,
        // ]);

        /* Stripe - create customer id */
        $stripeToken = $_POST['stripeToken'];
        // if ($request->mode == 'new') {
        if ($user->stripe_id) {
            $user->updateCard($stripeToken);
        } else {
            $ret = $user->createAsStripeCustomer($stripeToken);
            // $ret = $user->createAsStripeCustomer($stripeToken, [
            //     // 'address_country' => 'USA', //NG
            //     // 'currency' => 'aud', //NG
            //     'description' => 'This is a description.', // OK
            //     'email' => 'test@10ware.com', // OK
            // ]);
        }

        $card = $user->defaultCard();
        if ($card) {
            $card->name = $card_name;
            // $card->address_country = 'address_country';
            // $card->address_zip = '1234';
            // $card->address_state = 'address_state';
            // $card->address_city = 'address_city';
            // $card->address_line1 = 'address_line1';
            // $card->address_line2 = 'address_line2';
            $card = $card->save();

            // "exp_month":1,
            // "exp_year":2019,
            $user->card_expiry = $card->exp_month.'/'.$card->exp_year;
            $user->card_name = $card_name;
            // $user->card_phone = $card_phone;
            $user->update();
        }

        // session()->flash('success', 'Success: Your Credit card was updated and attached to your account.');
        // session()->flash('success', 'Success: Update Credit Card Information.');
        $txt = $this->ts('update_card_success');
        session()->flash('success', $txt);
        if ($next == 'cart') {
            if ($user->sel_menu != 'cart') {
                $user->sel_menu = 'cart';
                $user->update();
            }
            return redirect()->route('shop.cart');
        } else {
            // return redirect()->route('account.profile');
            return redirect()->back();
        }
    }

    public function postDevices(Request $request) {
        // {"_token":"xxxx"}
        // {"_token":"xxxx","push_hb":["1"],"push_upload":["2"]}
        $user = Auth::user();
        $user_id = $user->id;

        // DB::update(
        //     'update devices set push_notify=?, push_hb=?, push_upload=? where user_id=?',
        //     ['off', 'off', 'off', $user_id]
        // );
        DB::update(
            'update devices set push_hb=?, push_upload=? where user_id=?',
            ['off', 'off', $user_id]
        );

        // if (isset($request['push_notify'])) {
        //     $items = $request['push_notify'];
        //     foreach ($items as $item) {
        //         $db = Device::find($item);
        //         $db->push_notify = 'on';
        //         $bool = $db->save();
        //     }
        // }

        if (isset($request['push_hb'])) {
            // $push_hb = $request['push_hb'];
            // $count = count($push_hb);
            // for ($i=0; $i<$count; $i++) {
            //     echo $push_hb[$i];
            //     echo '<br/>';
            // }

            $items = $request['push_hb'];
            foreach ($items as $item) {
                // echo $item;
                // echo '<br/>';
                $db = Device::find($item);
                $db->push_hb = 'on';
                $bool = $db->save();
            }
        }

        if (isset($request['push_upload'])) {
            $items = $request['push_upload'];
            foreach ($items as $item) {
                $db = Device::find($item);
                $db->push_upload = 'on';
                $bool = $db->save();
            }
        }

        session()->flash('success', 'Success: Account Devices Saved.');
        return redirect()->back();
    }

    public function getDeviceRemove($device_id) {
        $db = Device::find($device_id);
        $db->delete();
        session()->flash('success', 'Success: Account Devices Removed.');
        return redirect()->back();
    }

    /*
        {"_token":"xxx","portal":"0","date_format":"m%2Fd%2FY+g%3Ai%3As+a"}
    */
    public function postOptions(Request $request) {
        $date_format = $request->date_format;
        $date_format = str_replace('%2F', '/', $date_format);
        $date_format = str_replace('%3A', ':', $date_format);
        $date_format = str_replace('+', ' ', $date_format);
        //return $date_format;

        //$sel_account_tab = $_POST['tab'];
        $data['date_format'] = $date_format;
        Auth::user()->update($data);

        session()->flash('success', 'Success: Account Options Saved.');
        return redirect()->back();
    }

    public function postEmails(Request $request) {
        //$portal = $request->portal;
        $user = Auth::user();
        $user_id = $user->id;

        $email_addr = [];
        for ($i=1; $i<=15; $i++) {
            $id = 'email_'.$i;
            if ($request[$id]) {
                array_push($email_addr, $request[$id]);
            }
        }
        $email_addr = array_unique($email_addr);
        $email_addr = array_reverse($email_addr);

        $affected = DB::update(
            'delete from emails where user_id = ?', [$user_id]
        );

        $count = count($email_addr);
        while ($count > 0) {
            $email = new Email;
            $email->email = array_pop($email_addr);
            $email->user_id = $user_id;
            $email->save();
            $count--;
        }

        //session()->flash('success', 'Success: Account Emails Saved. Some new email recipients were sent system email verifications. Until verified these addresses will not get any email.');
        session()->flash('success', 'Success: Account Emails Saved.');
        return redirect()->back();
    }

    public function postEmailChange(Request $request) {
        //$portal = $request->portal;
        $user = Auth::user();
        $user_id = $user->id;

        //session()->flash('warning', 'Error: This email address is already in use!');
        session()->flash('success', 'Success: Send Email Change Request.');
        return redirect()->back();
    }

    public function getPasswordSendResetEmail() {
        //$portal = $request->portal;
        $user = Auth::user();
        $user_id = $user->id;

        session()->flash('success', 'Success: Send Password Reset Email.');
        // return redirect()->route('password.email'); // NG (post)
        return redirect()->back();
    }

    //public function profile_emails() { // TODO
    //    if (!Auth::check()) {
    //        session()->flash('warning', 'Please Login first');
    //        return redirect()->route('login');
    //    }
    //
    //    $user = Auth::user();
    //    //$user_id = $user->id;
    //    return view('account.profile', compact('user'));
    //}

    /*-----------------------------------------------------------*/
    // [composer.json]
    // "stripe/stripe-php": "^6.20"
    // "laravel/cashier": "~6.0"
    //
    // composer require stripe/stripe-php
    // 4242 4242 4242 4242
    // 5555555555554444
    // 378282246310005
    /*
        {"_token":"a0HAJf1b5WAGZkDFWFriD8FDZNdzyNCGj1r2YtMm","cardholder-name":"Kevin","cardholder-phone":"18664933085",
         "stripeToken":"tok_1DR0OHG8UgnSL68UTWNMptbB"}
    */
    public function stripe() { // for test
        // \Stripe\Stripe::setApiKey(config('services.stripe.secret'));

        $user = Auth::user();
        $user_id = $user->id;

$ret = $user->subscribed('main'); // true, false
// $ret = $user->subscription('main')->onGracePeriod();
// $ret = $user->subscription('main')->cancelled();
return var_dump($ret);
// return $ret;

// $ret = $user->subscription('main')->cancel();
// $ret = $user->subscription('main')->cancelNow();
// $invoices = $user->invoices();
// return $invoices;

// $ret = $user->subscription('main')->resume();
        //return redirect()->back();
    }

    public function stripeCardGet() {
        \Stripe\Stripe::setApiKey(config('services.stripe.secret'));
        /*
            {
                "id":"card_1Dh0ffG8UgnSL68UpMQMh6R3",
                "object":"card",
                "address_city":null,
                "address_country":null,
                "address_line1":null, "address_line1_check":null,
                "address_line2":null,
                "address_state":null,
                "address_zip":null, "address_zip_check":null,
                "brand":"Visa",
                "country":"AU",
                "customer":"cus_E9JChurv4Dhiah",
                "cvc_check":"pass",
                "dynamic_last4":null,
                "exp_month":1,
                "exp_year":2019,
                "fingerprint":"VcL1sXkTk3GuqULy",
                "funding":"credit",
                "last4":"0006",
                "metadata":[],
                "name":"Jenny Rosen",
                "tokenization_method":null
            }
        */
        /*
            Billing address:
                address_line1
                address_line2
                address_city, address_state, 1234, address_country
        */
        $user = Auth::user();
        $card = $user->defaultCard();
        return dd($card);
    }

    public function stripeCardUpdate() {
        \Stripe\Stripe::setApiKey(config('services.stripe.secret'));

        $user = Auth::user();

        $card = $user->defaultCard();
        $card->name = 'Kevin Chen';
        $card->address_country = 'address_country';
        $card->address_zip = '1234';
        $card->address_state = 'address_state';
        $card->address_city = 'address_city';
        $card->address_line1 = 'address_line1';
        $card->address_line2 = 'address_line2';
        $ret = $card->save();
        return $ret;
    }

    // https://stripe.com/docs/api/subscriptions/object
    public function stripeSubscriptionGet($sub_id = null, $subscription_name = null) {
        \Stripe\Stripe::setApiKey(config('services.stripe.secret'));

        $user = Auth::user();

        if ($subscription_name) {
            $sub_id = $user->subscription($subscription_name)->stripe_id;
        // } else {
        //     $sub_id = 'sub_E9fsz77ZAGt3ml';
        }

        $sub = \Stripe\Subscription::retrieve($sub_id);

        echo 'id = '.$sub_id;
        echo '</br>';

        $date = date_create();
        date_timestamp_set($date, $sub->billing_cycle_anchor);
        echo 'billing_cycle_anchor = '.date_format($date, 'Y-m-d H:i:s (U)');
        echo '</br>';
        date_timestamp_set($date, $sub->current_period_start);
        echo 'current_period_start = '.date_format($date, 'Y-m-d H:i:s (U)');
        echo '</br>';
        date_timestamp_set($date, $sub->current_period_end);
        echo 'current_period_end   = '.date_format($date, 'Y-m-d H:i:s (U)');
        echo '</br>';
        echo 'cancel_at_period_end = ';
        echo ($sub->cancel_at_period_end=='true') ? 'true (Auto-Bill: No)' : 'false (Auto-Bill: Yes)';
        echo '</br>';
        echo '<hr>';

        date_timestamp_set($date, $sub->trial_start);
        echo 'trial_start = '.date_format($date, 'Y-m-d H:i:s (U)');
        echo '</br>';
        date_timestamp_set($date, $sub->trial_end);
        echo 'trial_end   = '.date_format($date, 'Y-m-d H:i:s (U)');
        echo '</br>';
        echo '<hr>';

        date_timestamp_set($date, $sub->start);
        echo 'start   = '.date_format($date, 'Y-m-d H:i:s (U)');
        echo '</br>';
        date_timestamp_set($date, $sub->ended_at);
        echo 'ended_at   = '.date_format($date, 'Y-m-d H:i:s (U)');
        echo '</br>';

        echo $sub->items->data[0]->id;
        echo '</br>';
        echo $sub->plan->id;
        echo '</br>';

        echo '<hr>';
        echo Carbon::now();
        echo '</br>';
        echo Carbon::now('Australia/Brisbane');
        echo '</br>';

        return dd($sub);
    }

    public function stripeSubscriptionCreate($plan) {
        \Stripe\Stripe::setApiKey(config('services.stripe.secret'));
        $user = Auth::user();
        $ret = \Stripe\Subscription::create([
            'customer' => $user->stripe_id,
            'items' => [
                [
                    'plan' => $plan,
                ],
            ],
            'metadata' => [
                'order_sn' => 'KT123456666',
                'iccid' => '89860117851014783481',
            ],
            'prorate' => false,
            'cancel_at_period_end' => false,
            // 'billing_cycle_anchor' => 1546272000, // 2019-01-01 00:00:00
        ]);
        return dd($ret);

        // $ret = $user->newSubscription('89860117851014783481', $plan)->create(null, [
        //     // 'email' => $email,
        //     'metadata' => [
        //         'order_sn' => 'KT123456666',
        //         'iccid' => '89860117851014783481',
        //     ],
        // ]);
        // return $ret;
    }

    // public function stripeSubscriptionUpdate($subscription_name = null) {
    public function stripeSubscriptionUpdate($subscription_id, $plan) {
        \Stripe\Stripe::setApiKey(config('services.stripe.secret'));

        // $subscription = \Stripe\Subscription::retrieve("sub_E9alHUZK4SRcoK");
        // $subscription->id = 'au_5000_3m';
        // // $subscription->customer = 'cus_E9af0ON3WpCGto'; // NG
        // $subscription->prorate = false;
        // // $subscription->billing_cycle_anchor = unchanged; // now, unchanged (NG)
        // $subscription->cancel_at_period_end = false;
        // // $subscription->tax_percent = 10;
        // $subscription->save();

        $subscription = \Stripe\Subscription::retrieve($subscription_id);
        $ret = \Stripe\Subscription::update($subscription_id , [
            'items' => [
                [
                    'id' => $subscription->items->data[0]->id,
                    'plan' => $plan,
                ],
            ],
            'prorate' => false,
            'cancel_at_period_end' => false,
            // 'billing_cycle_anchor' => 'unset', // unset, 'now', or 'unchanged'
            // 'trial_end' => $subscription->current_period_end, //1546007683,
        ]);

        // Changing plan intervals. There's no way to leave billing cycle unchanged.

        return dd($ret);
    }

    public function stripeSubscriptionDelete($subscription_name = null) {
        \Stripe\Stripe::setApiKey(config('services.stripe.secret'));

        $sub_id = 'sub_E9ZxsDczLVJt5S';
        $sub = \Stripe\Subscription::retrieve($sub_id);
        $ret = $sub->cancel();
        return $ret;
    }

    public function getStripeTest1() {
        $user = Auth::user();
        \Stripe\Stripe::setApiKey(config('services.stripe.secret'));
        $charge = \Stripe\Charge::create([
            'amount' => 100,
            'currency' => $user->currency, //'usd',
            'description' => 'This is an example charge.',
            'customer' =>$user->stripe_id, //'cus_DvGvznoT2EBbyn',
        ]);

// charge.succeeded
echo $charge->id.'<br/>';           // ch_1Di2B7G8UgnSL68UAb5ufwbI
echo $charge->customer.'<br/>';     // cus_E9af0ON3WpCGto
echo $charge->amount.'<br/>';       // 100
echo $charge->currency.'<br/>';     // usd
echo $charge->status.'<br/>';       // succeeded
echo $charge->description.'<br/>';  // This is an example charge.
echo $charge->invoice.'<br/>';      // null
// echo $charge->metadata.'<br/>';
return dd($charge);
    }

    public function getStripeTest2() {
        $user = Auth::user();
        \Stripe\Stripe::setApiKey(config('services.stripe.secret'));
        $invoice_item = \Stripe\InvoiceItem::create([
            "customer" => $user->stripe_id,
            "amount" => 123,
            "currency" => $user->currency,
            "description" => "SILVER 5000 Points per Month - for 1 Month",
            // "description" => "SILVER 5000 for 1 Month",
            'metadata' => [
                'order_no' => '20181211071911733169', //$order->no,
                'iccid' => '89860117851014783481', // $iccid,
                'plan' => 'au_5000_1m',
            ],
        ]);
// echo $invoice_item.'<br/>';
// return dd($invoice_item);

        $invoice_item = \Stripe\InvoiceItem::create([
            "customer" => $stripe_id,
            "amount" => 456,
            "currency" => $currency,
            "description" => "SILVER 5000 Points per Month - for 3 Months",
            // "description" => "SILVER 5000 for 3 Month",
            'metadata' => [
                'order_no' => '20181211071911733169', //$order->no,
                'iccid' => '89860117851014783507', // $iccid,
                'plan' => 'au_5000_3m',
            ],
        ]);
// echo $invoice_item.'<br/>';
// return dd($invoice_item);

        $invoice = \Stripe\Invoice::create([
            "customer" => $stripe_id,
            // "auto_advance" => true, /* auto-finalize this draft after ~1 hour */
            "auto_advance" => false,
            'metadata' => [
                'order_no' => '20181211071911733169', //$order->no,
            ],
        ]);
        // return dd($invoice);

        // $invoice = \Stripe\Invoice::retrieve("in_1Di2TWG8UgnSL68UyISyvYcU");
        // $invoice->finalizeInvoice(); // NG
        $ret = $invoice->pay();

echo $ret->customer.'<br/>';    // cus_E9af0ON3WpCGto
echo $ret->charge.'<br/>';      // ch_1Di2cYG8UgnSL68U1YxHtDxP
echo $ret->paid.'<br/>';        // true
echo $ret->status.'<br/>';      // paid (draft, open, paid, uncollectible, or void)
return dd($ret);
    }

    public function getStripeTest3() {
        \Stripe\Stripe::setApiKey(config('services.stripe.secret'));

        $user = Auth::user();
        $stripe_id = $user->stripe_id;
        // $currency = $user->currency;

        $sub_end = Carbon::now()->addMonth(1)->timestamp;
        $subscription = \Stripe\Subscription::create([
            'customer' => $user->stripe_id,
            'items' => [
                ['plan' => 'au_20000_1m']
            ],
            'metadata' => [
                'iccid' => '89860117851014783481',
            ],
            'prorate' => false,
            'cancel_at_period_end' => false,
//            'trial_end' => $sub_end,
            // 'billing_cycle_anchor' => $sub_end,
        ]);
return dd($subscription);
    }

    public function getStripeTest4() {
        \Stripe\Stripe::setApiKey(config('services.stripe.secret'));

        $sub_id = 'sub_EEKP1LbRq2KWOr';
        $subscription = \Stripe\Subscription::retrieve($sub_id);
// return dd($subscription);

        if ($subscription) {
            if ($subscription->trial_end != $subscription->current_period_end) {
                echo 'trial_end != current_period_end<br/>';
                $subscription = \Stripe\Subscription::update($sub_id , [
                    'prorate' => false,
                    'trial_end' => $subscription->current_period_end,
                ]);
            }

            $subscription = \Stripe\Subscription::update($sub_id , [
                'items' => [
                    [
                        'id' => $subscription->items->data[0]->id,
                        'plan' => 'au_5000_1m',
                    ],
                ],
                'prorate' => false,
                'cancel_at_period_end' => false,
                /* Changing plan intervals. There's no way to leave billing cycle unchanged. */
                // 'billing_cycle_anchor' => 'unchanged',
                // 'billing_cycle_anchor' => $subscription->billing_cycle_anchor, // NG
            ]);
            // return dd($subscription); // for debug
        }
return dd($subscription);
    }

    public function getStripeTest() {
        // \Stripe\Stripe::setApiKey("sk_test_LfAFK776KACX3gaKrSxXNJ0r");
        \Stripe\Stripe::setApiKey(config('services.stripe.secret'));
        $user = Auth::user();

//         $charge = \Stripe\Charge::retrieve("ch_1DiChoG8UgnSL68UOemUqSt8");
// return dd($charge);

        // $subscription_name = '89860117851014783481';
        // $subscription_name = '89860117851014783507';
// return $user->newSubscription($subscription_name, 'au_5000_1m')->create();
// // return $user->subscription($subscription_name)->cancelNow();
// $user->subscription($subscription_name)->cancel(); // Auto-Bill: No

// return $this->stripeSubscriptionCreate('au_10000_1m');
// return $this->stripeSubscriptionUpdate();
// return $this->stripeSubscriptionDelete();
// return $this->stripeCardUpdate();
// return $this->stripeCardGet();
// return $this->stripeSubscriptionGet($subscription_name);
return $this->stripeSubscriptionGet('sub_EA2qCz3bBPMHC7');
return;

/*
    用户 *必须* 仍然在他们的宽限期内才可以恢复订阅

    如果用户取消订阅，然后在订阅完全过期前恢复该订阅，他们将不会被立即计费。
    相反，他们的订阅将会被重新激活，需要按照原来的支付流程再次进行支付。
*/
// $user->subscription($subscription_name)->resume(); // Auto-Bill: Yes

// $user->subscription($subscription_name)->swap('au_5000_1m');
// return;

// $ret = \Stripe\Subscription::update($sub_id, [
//     'cancel_at_period_end' => true,     // cancel, pause
//     // 'cancel_at_period_end' => false,    // resume, reactive
// ]);

    /*
        prorate:
            If false, the anchor period will be free (similar to a trial)
            and no proration adjustments will be created.
    */
//     $subscription = \Stripe\Subscription::retrieve($sub_id);
//     $subscription->cancel_at_period_end = false;
//     $subscription->prorate = false;
//     // $subscription->items->id = 'au_5000_3m';
//     $subscription->save();

// $user->subscription($subscription_name)->swap('au_5000_1m');

// $si_id = $subscription->items->data[0]->id;
// $si = \Stripe\SubscriptionItem::retrieve($si_id);
// $si->plan = 'au_5000_1m';
// $si->save();

    // // $ret = $subscription->update(['cancel_at_period_end' => true]);
    // \Stripe\Subscription::update($sub_id, [
    //     // 'cancel_at_period_end' => false,
    //     // // 'cancel_at_period_end' => true,
    //     // // 'prorate' => false,
    //     'items' => [
    //         [
    //             'id' => $subscription->items->data[0]->id, //"id":"si_DvH0QM6GF5Bllt"
    //             'plan' => 'au_5000_3m',
    //         ],
    //     ],
    //     // 'plan' => [
    //     //     'id' => 'au_5000_3m',
    //     // ]
    // ]);

// // return dd($user->subscription($subscription_name)->valid());
// // return dd($user->subscription($subscription_name)->active());
// // return dd($user->subscription($subscription_name)->recurring());
// // return dd($user->subscription($subscription_name)->cancelled());
// return dd($user->subscription($subscription_name)->ended());
// return dd($user->subscription($subscription_name)->onTrial());
return dd($user->subscription($subscription_name)->onGracePeriod());

// return $user->subscription($subscription_name);
// return dd($user->subscribed($subscription_name));
// return dd($user->subscribed($subscription_name, 'au_5000_1m'));
// return dd($user->subscribedToPlan('au_5000_1m', $subscription_name));
// return dd($user->onPlan('au_5000_1m'));

// $customer = \Stripe\Customer::retrieve($user->stripe_id);
// $card = $customer->sources->retrieve("card_1DgiLnG8UgnSL68UDvqdza9H");
// $card->name = "Jenny Rosen";
// $card->save();
    }

/*
    public function billing2(Request $request) {
        \Stripe\Stripe::setApiKey(config('services.stripe.secret'));
        $post = request()->post();
        if (empty($post['order_id']) || empty($post['stripe_token']))
            return ['status' => -1, 'msg' => '²ÎÊý´íÎó'];

        try{
            $charge = \Stripe\Charge::create(
                [
                    'amount' => 10.10,  //Ö§¸¶½ð¶î
                    'currency' => 'USD',
                    'source' => $post['stripe_token'], //token
                    //¸½¼ÓÐÅÏ¢
                    'metadata' => [
                        'order_sn' => 'KT123456666', //¶©µ¥ºÅ
                        'name' => 'xxx', //ÐÕÃû
                        'tel' =>  '11234566', //µç»°ºÅ
                        'zip_code' =>  '111111'  //ÓÊ±à
                    ]
                ]
            );
        }catch (\Exception $e){
            return ['status' => -1, 'msg' => $e->getMessage()];
        }

        $event = $charge->jsonSerialize();

        if ($event['status'] == 'succeeded' || $event['status'] == 'pending'){
            return ['status' => 1, 'msg' => 'Ö§¸¶³É¹¦'];
        }else{
            return ['status' => -1, 'msg' => $event['status']];
        }
    }
*/

/*
// WebHookÒì²½Í¨Öª

\Stripe\Stripe::setApiKey('sk_test_xxxxxxxxxxxxxxxxxxxxxx');  //Ë½Ô¿

$endpoint_secret = 'whsec_xxxxxxxxxxxxxxxxx'; //webhookË½Ô¿

$payload = @file_get_contents("php://input");
$sig_header = $_SERVER["HTTP_STRIPE_SIGNATURE"];
$event = null;

try {
    $event = \Stripe\Webhook::constructEvent(
        $payload, $sig_header, $endpoint_secret
    );

    $data = $event->data->object;

    if (empty($data->metadata->order_sn)) {
        http_response_code(400); // Invalid payload
        exit();
    }

    $order_sn = $data->metadata->order_sn;  //È¡³ö¶©µ¥ºÅ

    if ($event->type == 'charge.succeeded'){
        //succeeded ³É¹¦

    }elseif($event->type == 'charge.pending'){
        //pending ÉóºË

    }elseif($event->type == 'charge.refunded'){
        //refunded ÍË¿î

    }elseif ($event->type == 'charge.failed') {
        //failed Ê§°Ü£¬£¨ÐÅÓÃ¿¨ÑéÖ¤Ê§°ÜÒ²»á·¢¸ÃÇëÇó£©

    }

} catch(\UnexpectedValueException $e) {
    http_response_code(400); // Invalid payload
    exit();
} catch(\Stripe\Error\SignatureVerification $e) {
    http_response_code(400); // Invalid signature
    exit();
}

http_response_code(200);  //³É¹¦Çë·µ»Ø200ÇëÇóÂë
exit();

*/

}