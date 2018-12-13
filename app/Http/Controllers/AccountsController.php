<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Auth;
use DB;

use App\Models\Camera;
use App\Models\Email;
use App\Models\PlanProduct;
use App\Models\PlanProductSku;
use App\Models\CartItem;

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

        $plans = DB::table('plans')
            ->where('user_id', $user_id)
            ->get();

        $handle = '';
        foreach ($plans as $plan) {
            $sku = PlanProductSku::find($plan->plan_product_sku_id);
            if ($sku) {
                $product = PlanProduct::find($sku->plan_product_id);

                // Silver 1 Month
                $txt_month = ($sku->month > 1) ? 'Month' : 'Months';
                $txt_plan = $product->title.' '.$sku->month.' '.$txt_month;

                // $12.95 per Month
                // $txt_tier = $product->title.' - '.$product->points.' Points per Month';
                if ($sku->month == 1) {
                    $txt_plan2 = $sku->price.' per Month';
                } else {
                    $txt_plan2 = $sku->price.' for '.$sku->month.' Months';
                }
                // $txt_plan2 = '<i class="fa fa-dollar-sign"></i>'.$txt_tier2;
                $txt_plan2 = $currency_region[$plan->region].$txt_plan2;

            } else {
                Debugbar::error('plan product sku not found - id='.$plan->plan_product_sku_id);
                $txt_plan = $txt_plan2 = '';
            }
            $txt_status = ucwords($plan->status);
            $txt_auto_bill = ($plan->auto_bill == 1) ? 'Yes' : 'No';
            $txt_region = $img_region[$plan->region];

            $camera_name = '(No Camera)';
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
                    // Debugbar::debug($cart->plan_product_sku_id);

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
                $action_url = '/plans/renew/'.$plan->id;
                $action_name = 'Reactive';
                $action_icon = 'refresh';
            }

            /*

            */
            $sku = null;
            $txt_tier = $txt_tier2 = 'xxx';
            if ($action == 'cart') {
                $sku = PlanProductSku::find($cart->plan_product_sku_id);

            } else if (($action == 'renew')||($action == 'reactive')) {
                $subscription = DB::table("subscriptions")->where('name', $plan->iccid)->first();
                if ($subscription) {
                    $sku = PlanProductSku::where('sub_id', $subscription->stripe_plan)->first();
                }
            }

            /* search Subscription */
            if ($sku) {
                $product = PlanProduct::find($sku->plan_product_id);

                // Silver - 5000 Points per Month
                // $155.95 for 6 Months
                $txt_tier = $product->title.' - '.$product->points.' Points per Month';
                if ($sku->month == 1) {
                    $txt_tier2 = $sku->price.' per Month';
                } else {
                    $txt_tier2 = $sku->price.' for '.$sku->month.' Months';
                }
                // $txt_tier2 = '<i class="fa fa-dollar-sign"></i>'.$txt_tier2;
                $txt_tier2 = $currency_region[$plan->region].$txt_tier2;
            }

            $handle .= '<div class="row">';
            $handle .=     '<div class="col-md-12">';
            $handle .=         '<div style="margin-top:10px; margin-bottom:4px; border-bottom: 1px solid gray;border-top: 1px solid lime; padding-bottom: 4px; padding-top: 4px;padding-left:10px; background-color: #444">';
            $handle .=             '<div class="row">';

            /* Silver 1 Month */
            $handle .=                 '<div class="col-md-5">';
            // $handle .=                     '<i class="fa fa-dot-circle"></i>';
            $handle .=                     ' <span class="label label-highlight" style="font-size:0.9em;">'.$txt_status.'</span>';
            if ($plan->status == 'active') {
                $handle .=                     ' <span class="label label-info" style="font-size: 1.00em;">'.$txt_plan.'</span>';
                $handle .=                     ' <span style="color:lime;">'.$txt_plan2.'</span>';
                $handle .=                     ' <img src="'.$txt_region.'" width="30" style="margin-bottom:10px;"/>';
            }
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
            // $handle .=                         '<span class="button-checkbox" style="margin-left:20px;">';
            // $handle .=                             '<button type="button" class="btn btn-default btn-xs" data-color="info">Auto-Bill (renews after 19/12/2018 8:00:00 am)</button>';
            // $handle .=                             '<input type="checkbox" class="hidden camera-select" name="autorenew[]" value="8"  checked  />';
            // $handle .=                             '<br /><span class="label label-warning" style="font-size:0.9em; margin-left: 20px;">Service Ends by 10/04/2019 7:59:59 am</span>';
            // $handle .=                         '</span>';
            // $handle .=                     '</p>';

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
            $handle .=                     '<a href="'.$action_url.'" style="margin-left:20px;" class="btn btn-xs btn-primary">';
            $handle .=                         '<i class="glyphicon glyphicon-'.$action_icon.'"> </i> '.$action_name;
            $handle .=                     '</a>';

// if (($action == 'cart')||($action == 'renew')||($action == 'renew')) {
if ($action != 'create') {
            $handle .=                     '<div class="alert alert-default" style="margin-left:20px; margin-bottom: 2px; margin-top:4px; background-color: #222;">';
            $handle .=                         '<p>';
            $handle .=                             '<strong>'.$txt_tier.'</strong>';
            $handle .=                         '</p>';

            $handle .=                         '<p>';
            $handle .=                             'Tier:';
            $handle .=                             '<strong>';
            $handle .=                                  ' <span class="label" style="font-size: 1.00em; color:lime;">'.$txt_tier2.'</span>';
            $handle .=                             '</strong>';
            $handle .=                         '</p>';
            $handle .=                         '<p>';
            $handle .=                             'Auto-Bill: ';
            $handle .=                             '<strong>';
            $handle .=                                  ' <span class="label" style="font-size: 1.00em;">'.$txt_auto_bill.'</span>';
            $handle .=                             '</strong>';
            $handle .=                         '</p>';
            $handle .=                     '</div>';
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
            $handle .=                 '<tr><td class="pull-right">Camera:</td>';
            $handle .=                     '<td><strong>'.$camera_name.'</strong></td>';
            $handle .=                 '</tr>';
            $handle .=                 '<tr><td class="pull-right">Plan Points:</td>';
            $handle .=                     '<td><strong>'.$plan->points.'</strong></td>';
            $handle .=                 '</tr>';
            $handle .=                 '<tr><td class="pull-right">Points Used:</td>';
            $handle .=                     '<td><strong>'.$plan->points_used.'</strong></td>';
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

        $txt = '';
        $txt .= '<option value="m%2Fd%2FY+h%3Ai%3As+a" '.$sel_mdY_his_a.'">MM/DD/YYYY HH:MM:SS AM/PM (12 hours)</option>';
        $txt .= '<option value="m%2Fd%2FY+H%3Ai%3As" '.$sel_mdY_His.'>MM/DD/YYYY HH:MM:SS (24 hours)</option>';
        $txt .= '<option value="Y%2Fm%2Fd+h%3Ai%3As+a" '.$sel_Ymd_his_a.'>YYYY/MM/DD HH:MM:SS AM/PM (12 hours)</option>';
        $txt .= '<option value="Y%2Fm%2Fd+H%3Ai%3As" '.$sel_Ymd_His.'>YYYY/MM/DD HH:MM:SS (24 hours)</option>';
        $txt .= '<option value="d%2Fm%2FY+h%3Ai%3As+a" '.$sel_dmY_his_a.'>DD/MM/YYYY HH:MM:SS AM/PM (12 hours)</option>';
        $txt .= '<option value="d%2Fm%2FY+H%3Ai%3As" '.$sel_dmY_His.'>DD/MM/YYYY HH:MM:SS (24 hours)</option>';
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

        // \Stripe\Stripe::setApiKey("sk_test_LfAFK776KACX3gaKrSxXNJ0r");
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
        session()->flash('success', 'Success: Update Credit Card Information.');
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
        //$portal = $request->portal;
        $user = Auth::user();
        $user_id = $user->id;

        session()->flash('success', 'Success: Account Devices Saved.');
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
        // \Stripe\Stripe::setApiKey("sk_test_LfAFK776KACX3gaKrSxXNJ0r");

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

    public function getStripeTest() {
        $user = Auth::user();

        /*
            {
                "id":"card_1Dh0ffG8UgnSL68UpMQMh6R3",
                "object":"card",
                "address_city":null,
                "address_country":null,
                "address_line1":null,
                "address_line1_check":null,
                "address_line2":null,
                "address_state":null,
                "address_zip":null,
                "address_zip_check":null,
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
        $card = $user->defaultCard();
        $card->name = 'Kevin Chen';
        $card->address_country = 'address_country';
        $card->address_zip = '1234';
        $card->address_state = 'address_state';
        $card->address_city = 'address_city';
        $card->address_line1 = 'address_line1';
        $card->address_line2 = 'address_line2';
        $ret = $card->save();

// \Stripe\Stripe::setApiKey("sk_test_LfAFK776KACX3gaKrSxXNJ0r");
// $customer = \Stripe\Customer::retrieve($user->stripe_id);
// $card = $customer->sources->retrieve("card_1DgiLnG8UgnSL68UDvqdza9H");
// $card->name = "Jenny Rosen";
// $card->save();
        return $ret;
    }

    public function trial() { // for test
        $user = Auth::user();
        $ret = $user->subscription('89860117851014783507')->onTrial();
        return var_dump($ret);
    }

    public function swap1() { // for test
        $user = Auth::user();
        $ret = $user->subscription('89860117851014783481')->swap('plan_au_5000_1m_1000');
        return $ret;
    }

    public function swap3() { // for test
        $user = Auth::user();
        $ret = $user->subscription('89860117851014783481')->swap('plan_au_5000_3m_3000');
        return $ret;
    }

    public function swap6() { // for test
        $user = Auth::user();
        $ret = $user->subscription('89860117851014783481')->swap('plan_au_5000_6m_6000');
        return $ret;
    }

    public function stripe_new() { // for test
        \Stripe\Stripe::setApiKey("sk_test_LfAFK776KACX3gaKrSxXNJ0r");
        $ret = \Stripe\Customer::create([
            "description" => "kevin@10ware.com", // cus_Dv0fI1h5DQi2tb
//            "currency" =>  "usd"
//          "source" => "tok_visa" // obtained with Stripe.js
        ]);
        return var_dump($ret);
    }

    public function stripe_card() { // for test
       \Stripe\Stripe::setApiKey("sk_test_LfAFK776KACX3gaKrSxXNJ0r");
        $customer = \Stripe\Customer::retrieve("cus_DvGvznoT2EBbyn");
        $ret = $customer->sources->create(["source" => "tok_mastercard"]);
        return $ret;

// $customer = \Stripe\Customer::retrieve("cus_Dv0jZNVpx8GerY");
// $card = $customer->sources->retrieve("card_1DTAiDG8UgnSL68U8rmAr1U9");
// $card->name = "Kevin Chen";
// $ret = $card->save();

//$customer = \Stripe\Customer::retrieve("cus_Dv0jZNVpx8GerY");
//$ret = $customer->sources->retrieve("card_1DTAiDG8UgnSL68U8rmAr1U9")->delete();
//return $ret;
    }

    public function stripe_customer() { // for test
        \Stripe\Stripe::setApiKey("sk_test_LfAFK776KACX3gaKrSxXNJ0r");
        $ret = \Stripe\Customer::retrieve("cus_DvGvznoT2EBbyn");
        return $ret;
    }

    public function stripe_charge() { // for test
        \Stripe\Stripe::setApiKey("sk_test_LfAFK776KACX3gaKrSxXNJ0r");

//        $ret = \Stripe\Token::create([
//          "card" => [
//            "number" => "4242424242424242",
//            "exp_month" => 11,
//            "exp_year" => 2019,
//            "cvc" => "314"
//          ]
//        ]);
//return $ret;

        //$stripeToken = ;
        //$charge = \Stripe\Charge::create([
        //    'amount' => 1000,
        //    'currency' => 'usd',
        //    'description' => 'Example charge',
        //    'source' => $stripeToken,
        //]);

        $charge = \Stripe\Charge::create([
            'amount' => 10000,
            'currency' => 'usd',
            'description' => 'Example charge',
            'customer' => 'cus_DvGvznoT2EBbyn',
        ]);

        return $charge;
    }

    /* http://tool.chinaz.com/Tools/unixtime.aspx */
    public function stripe_sub() { // for test
        \Stripe\Stripe::setApiKey("sk_test_LfAFK776KACX3gaKrSxXNJ0r");

        $subscription = \Stripe\Subscription::create([
           'customer' => 'cus_Dx6kWaXPFqZXhD',
           'items' => [['plan' => 'plan_5000_1m_us']],
           // 'billing_cycle_anchor' => 1543593600,    // 2018/12/01
           // 'trial_end' => 1543593600,             // 2018/12/01
           'trial_end' => 1542643200,             // 2018/12/20
        ]);
        return $subscription;
    }

    public function stripe_cancel() { // for test
        \Stripe\Stripe::setApiKey("sk_test_LfAFK776KACX3gaKrSxXNJ0r");
//"cancel_at_period_end": "true"
        $subscription = \Stripe\Subscription::retrieve('sub_DvH09yNROg5tdj');
        $ret = $subscription->cancel();
        return $ret;
    }

    public function stripe_pause() { // for test
        \Stripe\Stripe::setApiKey("sk_test_LfAFK776KACX3gaKrSxXNJ0r");
//        $subscription = \Stripe\Subscription::retrieve('sub_DvH09yNROg5tdj');
//        $ret = $subscription->update(['cancel_at_period_end' => true]);
        $ret = \Stripe\Subscription::update('sub_Dx7YQIW4g1fkxD', [
          'cancel_at_period_end' => true,
        ]);
        return $ret;
    }

    public function stripe_reactive() { // for test
        \Stripe\Stripe::setApiKey("sk_test_LfAFK776KACX3gaKrSxXNJ0r");
        $ret = \Stripe\Subscription::update('sub_Dx7YQIW4g1fkxD', [
          'cancel_at_period_end' => false,
        ]);
        return $ret;
    }

    public function stripe_change() { // for test
        \Stripe\Stripe::setApiKey("sk_test_LfAFK776KACX3gaKrSxXNJ0r");

        $subscription = \Stripe\Subscription::retrieve('sub_DxCpW25xCDyLlx');

        $ret = \Stripe\Subscription::update('sub_DxCpW25xCDyLlx', [
            'cancel_at_period_end' => false,
            // 'cancel_at_period_end' => true,
            // 'prorate' => false,
            'items' => [
                [
                    'id' => $subscription->items->data[0]->id, //"id":"si_DvH0QM6GF5Bllt"
                    'plan' => 'plan_5000_3m_us',
                ],
            ],
        ]);
        return $ret;
    }

    /*-----------------------------------------------------------*/
    //public function charge_test(Request $request) {
    //    $portal = $request->portal;
    //    if (!Auth::check()) {
    //        return $this->back_to_login($portal);
    //    }
    //
    //    $user = Auth::user();
    //    $user_id = $user->id;
    //
    //    // Set your secret key: remember to change this to your live secret key in production
    //    // See your keys here: https://dashboard.stripe.com/account/apikeys
    //    \Stripe\Stripe::setApiKey("sk_test_LfAFK776KACX3gaKrSxXNJ0r");
    //
    //    // Token is created using Checkout or Elements!
    //    // Get the payment token ID submitted by the form:
    //    $stripeToken = $_POST['stripeToken'];
    //    $charge = \Stripe\Charge::create([
    //        'amount' => 1000,
    //        'currency' => 'usd',
    //        'description' => 'Example charge',
    //        'source' => $stripeToken,
    //    ]);
    //    return $charge;
    //}

/*
    public function billing2(Request $request) {
        \Stripe\Stripe::setApiKey('sk_test_LfAFK776KACX3gaKrSxXNJ0r'); //Ë½Ô¿
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

/*
{
"id":"ch_1DRfkRG8UgnSL68UPte47gdT",
"object":"charge",
"amount":168,
"amount_refunded":0,
"application":null,
"application_fee":null,
"balance_transaction":"txn_1DRfkRG8UgnSL68Uc8PLZqma",
"captured":true,"created":1541077087,
"currency":"usd",
"customer":null,
"description":"Example charge",
"destination":null,
"dispute":null,
"failure_code":null,
"failure_message":null,
"fraud_details":[],
"invoice":null,
"livemode":false,
"metadata":[],
"on_behalf_of":null,"order":null,"outcome":{"network_status":"approved_by_network","reason":null,"risk_level":"normal","risk_score":36,"seller_message":"Payment complete.","type":"authorized"},"paid":true,"payment_intent":null,"receipt_email":null,"receipt_number":null,"refunded":false,"refunds":{"object":"list","data":[],"has_more":false,"total_count":0,"url":"\/v1\/charges\/ch_1DRfkRG8UgnSL68UPte47gdT\/refunds"},"review":null,"shipping":null,"source":{"id":"card_1DRfjeG8UgnSL68UhOlA9f77","object":"card","address_city":null,"address_country":null,"address_line1":null,"address_line1_check":null,"address_line2":null,"address_state":null,"address_zip":null,"address_zip_check":null,"brand":"Visa","country":"US","customer":null,"cvc_check":"pass","dynamic_last4":null,"exp_month":1,"exp_year":2019,"fingerprint":"e1uOCX2OaLtiKe7m","funding":"credit","last4":"4242","metadata":[],"name":null,"tokenization_method":null},"source_transfer":null,"statement_descriptor":null,"status":"succeeded","transfer_group":null}

*/
