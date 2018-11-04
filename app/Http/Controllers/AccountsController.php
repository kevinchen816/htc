<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Auth;
use DB;

use App\Models\Camera;
use App\Models\Email;

class AccountsController extends Controller
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
    public function activetab(Request $request) {
        $portal = $_POST['portal'];
        if (!Auth::check()) {
            return $this->back_to_login($portal);
        }

        // plan, billing, devices, options, email
        // plans, billing, remote, security, email
        $sel_account_tab = $_POST['tab'];
        $data['sel_account_tab'] = $sel_account_tab;
        Auth::user()->update($data);
        return $sel_account_tab;
    }

    /*-----------------------------------------------------------*/
    public function _profile($portal) {
        if (!Auth::check()) {
            return $this->back_to_login($portal);
        }

        $user = Auth::user();
        $data['sel_menu'] = 'account';
        $user->update($data);

        //return view('account.profile', compact('user'));
        return view('account.profile', compact('portal', 'user'));
    }

    public function profile() {
        return $this->_profile(0);
    }

    public function profile_10ware() {
        return $this->_profile(10);
    }

    /*-----------------------------------------------------------*/
    public function MyPlans() {
        //return 'Hello';
        $user = Auth::user();
        $user_id = $user->id;

        $plans = DB::table('plans')
            ->where('user_id', $user_id)
            ->get();

        $handle = '';
        foreach ($plans as $plan) {
            $camera_name = '(No Camera)';
            if ($plan->camera_id) {
                $camera = Camera::find($plan->camera_id);
                if ($camera) {
                    $camera_name = $camera->description;
                }
            }

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
//            //$handle .=                 '<tr><td class="pull-right"><i class="fa fa-camera"> </i> Camera:</td>';
//            $handle .=                 '<tr><td class="pull-right">Camera:</td>';
//            $handle .=                     '<td><strong>'.$camera_name.'</strong></td>';
//            $handle .=                 '</tr>';
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

    /*-----------------------------------------------------------*/
    public function Emails() {
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

    public function emails_save(Request $request) {
        $portal = $request->portal;
        if (!Auth::check()) {
            return $this->back_to_login($portal);
        }

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

        // $token = 'tok_1DRfjeG8UgnSL68UwpYMG4Kf';
        // $ret = \Stripe\Charge::create([
        //     'amount' => 1000,
        //     'currency' => 'usd',
        //     'description' => 'Example charge',
        //     'source' => $token,
        // ]);

/*
    plan_id:
    id_us_2500_m_895,
    id_us_5000_m_1295,   id_us_5000_3m_3695,
    id_us_10000_m_1995,  id_us_10000_3m_5795,
    id_us_20000_m_2695,  id_us_20000_3m_7795,

    id_au_5000_m,   id_au_5000_3m,
    id_au_10000_m,  id_au_10000_3m,
    id_au_20000_m,  id_au_20000_3m,
*/
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
// return var_dump($ret);
        //return redirect()->back();
    }

    /*-----------------------------------------------------------*/
    /*
    {
    "name":"main",
    "stripe_id":"sub_DuMETFmgmIV10k",
    "stripe_plan":"plan_DuMDwpbpnIAhBz",
    "quantity":1,
    "trial_ends_at":null,
    "ends_at":null,
    "user_id":1,
    "updated_at":"2018-11-04 06:22:39",
    "created_at":"2018-11-04 06:22:39",
    "id":2}
    */
    public function billing(Request $request) {
// return $request;
        $portal = $request->portal;
        if (!Auth::check()) {
            return $this->back_to_login($portal);
        }

        $user = Auth::user();
        $user_id = $user->id;

        // Set your secret key: remember to change this to your live secret key in production
        // See your keys here: https://dashboard.stripe.com/account/apikeys
//        \Stripe\Stripe::setApiKey("sk_test_LfAFK776KACX3gaKrSxXNJ0r");

        // Token is created using Checkout or Elements!
        // Get the payment token ID submitted by the form:
        $stripeToken = $_POST['stripeToken'];
        // $charge = \Stripe\Charge::create([
        //     'amount' => 1000,
        //     'currency' => 'usd',
        //     'description' => 'Example charge',
        //     'source' => $stripeToken,
        // ]);


//$ret = $user->updateCard($stripeToken);
//return 'OK';	
	// $response['user'] = $user;
// $response['stripeToken'] = $stripeToken;
// $response['ret'] = $ret;
// return $response;

        /*
            plan_id:
            id_us_2500_m_895,
            id_us_5000_m_1295,   id_us_5000_3m_3695,
            id_us_10000_m_1995,  id_us_10000_3m_5795,
            id_us_20000_m_2695,  id_us_20000_3m_7795,

            id_au_5000_m,   id_au_5000_3m,
            id_au_10000_m,  id_au_10000_3m,
            id_au_20000_m,  id_au_20000_3m,
        */
         $subscription_name = 'main'; // iccie OR iccid + plan_id ?
         $plan_id = 'id_us_500_3days'; // id_us_5000_m, id_us_5000_3m, id_us_5000_m, id_us_5000_3m
        // // $email = 'test.10ware.com';
        // // $ret = $user->newSubscription('main_test', 'plan_DuMDwpbpnIAhBz')->create($stripeToken);
         $ret = $user->newSubscription($subscription_name, $plan_id)->create($stripeToken);
        // // $ret = $user->newSubscription($subscription_name, $plan_id)->create($stripeToken, [
        // //     'email' => $email,
        // // ]);
//        $user->charge(100);
 return $ret;
	return var_dump($ret);
	return 'OK';

// $invoices = $user->invoices();
// return view('account.__invoice', compact('invoices'));
//         return redirect()->back();
    }

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
