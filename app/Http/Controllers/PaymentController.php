<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Reseller;
use App\Models\Payment;
use App\Models\Fund;
use App\Models\Topup;
use DB, Auth;
use Pusher;

class PaymentController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        if(Auth::user()->role == 'superadmin'){
            $payments = Payment::get();
        }elseif(Auth::user()->role == 'admin'){
           $payments = Payment::get();
        }else{
           $payments = Payment::where(['user_id' => Auth::user()->id])->get(); 
        }

        $users = User::where('role', 'reseller')->get();
        
        return view('payment', compact('payments', 'users'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        try {
            if(!empty($request->id)){
                $deleted_payment = $this->deletePayment($request);

                if($deleted_payment['status'] == 'success'){
                    $payment_created = $this->createPayment($request);
                    return json_encode($payment_created); 
                }else{
                    return json_encode(['message' => FAIL, 'status' => 'failed'], 500);
                }
                
            }else{
                $payment_created = $this->createPayment($request);
                return json_encode($payment_created);                
            }
            
            return json_encode(['message' => FAIL, 'status' => 'failed'], 500);
        } catch (\Exception $e) {
            DB::rollBack();

            return json_encode(['message' => FAIL, 'status' => 'failed'], 500);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $payment = Payment::where('id', $id)->first();
        $delete_payment = $this->deletePayment($payment);
        return json_encode($delete_payment);
    }

    protected function createPayment($request){
        
        try{
            DB::beginTransaction();

            $payment_data = [
                'user_id' => $request->user_id,
                'fund_type' => $request->fund_type,
                'type' => $request->type,
                'amount' => $request->amount,
                'description' => $request->payment_description,
                'from_user' => Auth::user()->id,
                'to_user' => $request->user_name,
                'transaction_id' => rand(900000, 999999),
                'status' => 'pending'
            ];

            $current_user = User::with('reseller')->where(['id' => Auth::user()->id])->first();

            $balance_user = User::with('fund')->where(['id' => $request->user_id])->first();

            if(Auth::user()->role == 'admin'){
                $payment_data['status'] = 'active';
            }else{
                if($current_user->reseller->pin !== intval($request->pin)){
                    return ['message' => INVALID_PIN, 'status' => 'failed'];
                }
            }

            $update_data = [];

            if($request->type == 'return'){
                if($request->fund_type == 'Mobile Recharge'){
                    if($balance_user->fund->bal_mr < $request->amount){
                       return ['message' => INSUFFICIENT_FUND, 'status' => 'failed']; 
                    }else{
                        $update_data['bal_mr'] = $balance_user->fund->bal_mr - $request->amount; 
                    }
                }elseif ($request->fund_type == 'Mobile Money') {
                    if($balance_user->fund->bal_mm < $request->amount){
                       return ['message' => INSUFFICIENT_FUND, 'status' => 'failed']; 
                    }else{
                        $update_data['bal_mm'] = $balance_user->fund->bal_mm - $request->amount; 
                    }
                }elseif ($request->fund_type == 'Indian Rupee') {
                    if($balance_user->fund->ind_rp < $request->amount){
                       return ['message' => INSUFFICIENT_FUND, 'status' => 'failed']; 
                    }else{
                        $update_data['ind_rp'] = $balance_user->fund->ind_rp - $request->amount; 
                    }
                }else{
                    if($balance_user->fund->pak_rp < $request->amount){
                       return ['message' => INSUFFICIENT_FUND, 'status' => 'failed']; 
                    }else{
                        $update_data['pak_rp'] = $balance_user->fund->pak_rp - $request->amount; 
                    }
                }
            }else{
                if($request->fund_type == 'Mobile Recharge'){
                    $update_data['bal_mr'] = $balance_user->fund->bal_mr + $request->amount;
                }elseif ($request->fund_type == 'Mobile Money') {
                    $update_data['bal_mm'] = $balance_user->fund->bal_mm + $request->amount;
                }elseif ($request->fund_type == 'Indian Rupee') {
                    $update_data['ind_rp'] = $balance_user->fund->ind_rp + $request->amount;
                }else{
                    $update_data['pak_rp'] = $balance_user->fund->pak_rp + $request->amount;
                }
            }
            $fund = Fund::where('user_id', $request->user_id)->update($update_data);

            $payment = Payment::create($payment_data);

            DB::commit();

            if ($payment) {

                $this->sendNotification($request->user_id, 'Your Fund is Updated');
                return [
                    'message' => SUCCESS,
                    'payment' => $payment,
                    'status' => 'success'
                ];
            }
        }catch(\Exception $e){
            return ['message' => $message, 'status' => 'failed'];
            return ['message' => $message, 'status' => 'failed'];
        }
        
    }

    protected function deletePayment($request){
        try{
            DB::beginTransaction();

            $payment = Payment::where('id', $request->id)->first();
            $balance_user = User::with('fund')->where(['id' => $request->user_id])->first();
            
            if(!empty($payment)){
                $update_data = [];
                if($payment->type == 'return'){
                    if($payment->fund_type == 'Mobile Recharge'){
                        $update_data['bal_mr'] = $balance_user->fund->bal_mr + $payment->amount;
                    }elseif ($payment->fund_type == 'Mobile Money') {
                        $update_data['bal_mm'] = $balance_user->fund->bal_mm + $payment->amount;
                    }elseif ($payment->fund_type == 'Indian Rupee') {
                        $update_data['ind_rp'] = $balance_user->fund->ind_rp + $payment->amount;
                    }else{
                        $update_data['pak_rp'] = $balance_user->fund->pak_rp + $payment->amount;
                    }
                }else{
                    if($payment->fund_type == 'Mobile Recharge'){
                        $update_data['bal_mr'] = $balance_user->fund->bal_mr - $payment->amount;
                    }elseif ($payment->fund_type == 'Mobile Money') {
                        $update_data['bal_mm'] = $balance_user->fund->bal_mm - $payment->amount;
                    }elseif ($payment->fund_type == 'Indian Rupee') {
                        $update_data['ind_rp'] = $balance_user->fund->ind_rp - $payment->amount;
                    }else{
                        $update_data['pak_rp'] = $balance_user->fund->pak_rp - $payment->amount;
                    }
                }

                $fund = Fund::where('user_id', $request->user_id)->update($update_data);
                
                Payment::findOrFail($request->id)->delete();

                DB::commit();
                
                return ['message' => SUCCESS, 'status' => 'success'];
            }else{
                return ['message' => INVALID_RRQUEST, 'status' => 'failed']; 
            }

            

        }catch(\Exception $e){
            return ['message' => FAIL, 'status' => 'failed'];
        }
    }

    public function createTopUp(Request $request)
    {
        try{
            $fund = Fund::where('user_id', Auth::user()->id)->first();

            if(empty($fund)){
                return ['message' => INSUFFICIENT_FUND, 'status' => 'failed'];
            }
            
            $insert_data['amount'] = $request->amount;
            $insert_data['country'] = $request->country;
            $insert_data['status'] = 'pending';
            $insert_data['user_id'] = Auth::user()->id;
            $insert_data['type'] = $request->payment_type;

            if($request->country == 'bd'){
                
                $insert_data['number'] = $request->number;

                $insert_data['operator'] = getBdOperator(substr($request->number, 0, 2));
                if($insert_data['operator'] == 'invalid_number'){
                    return ['message' => 'Invalid Number', 'status' => 'failed'];
                }

                if($request->payment_type == 'top_up'){
                    if($fund->bal_mr < $request->amount){
                        return ['message' => INSUFFICIENT_FUND, 'status' => 'failed'];
                    }else{
                        
                        $fund = Fund::where('user_id', Auth::user()->id)->update([
                            'bal_mr' => $fund->bal_mr - $request->amount,
                        ]);

                        Topup::create($insert_data);

                        $this->sendNotification($this->getAdminUserId(), 'New Topup Request');

                        return ['message' => SUCCESS, 'status' => 'success'];
                        
                    }
                }else{
                    
                    if($fund->bal_mm < $request->amount){
                        return ['message' => INSUFFICIENT_FUND, 'status' => 'failed'];
                    }

                    if($request->payment_type == 'bkash'){
                        $insert_data['operator'] = 'BKash';
                    }else{
                        $insert_data['operator'] = 'Rocket';
                    }

                    $fund = Fund::where('user_id', Auth::user()->id)->update([
                        'bal_mm' => $fund->bal_mm - $request->amount,
                    ]);

                    Topup::create($insert_data);

                    $this->sendNotification($this->getAdminUserId(), 'New Topup Request');

                    return ['message' => SUCCESS, 'status' => 'success'];
                    
                }

            }elseif ($request->country == 'ind') {
                if($fund->ind_rp < $request->amount){
                    return ['message' => INSUFFICIENT_FUND, 'status' => 'failed'];
                }

                if($request->payment_type == 'top_up'){
                    $insert_data['operator'] = $request->operator;
                    $insert_data['pradesh'] = $request->pradesh;
                    $insert_data['number'] = $request->number;
                }else{
                    $insert_data['provider'] = $request->provider;
                    $insert_data['subscriber_id'] = $request->subscriber_id;
                }

                $fund = Fund::where('user_id', Auth::user()->id)->update([
                    'ind_rp' => $fund->ind_rp - $request->amount,
                ]);

                Topup::create($insert_data);

                $this->sendNotification($this->getAdminUserId(), 'New Topup Request');

                return ['message' => SUCCESS, 'status' => 'success'];

            }else{
                if($fund->pak_rp < $request->amount){
                    return ['message' => INSUFFICIENT_FUND, 'status' => 'failed'];
                }

                $insert_data['operator'] = $request->operator;
                $insert_data['number'] = $request->number;
                
                $fund = Fund::where('user_id', Auth::user()->id)->update([
                    'pak_rp' => $fund->pak_rp - $request->amount,
                ]);

                Topup::create($insert_data);

                $this->sendNotification($this->getAdminUserId(), 'New Topup Request');

                return ['message' => SUCCESS, 'status' => 'success'];
            }
        }catch(\Exception $e){
            return ['message' => FAIL, 'status' => 'failed'];
        }
        
    }

    public function updateTopUp(Request $request){
        try{
            Topup::where('id', $request->id)->update(['status' => 'active', 'topup_transaction_id' => $request->topup_transaction_id]);

            $this->sendNotification($request->topup_user_id, 'Your Topup Request is Approved.');

            return ['message' => SUCCESS, 'status' => 'success'];
        }catch(\Exception $e){
            return ['message' => FAIL, 'status' => 'failed'];
        }
    }

    public function deleteTopUp(Request $request){
        try{
            $update_data = [];
            DB::beginTransaction();
            $fund = Fund::where('user_id', $request->topup['user_id'])->first();
            if(empty($fund)){
                return ['message' => 'Invalid Request', 'status' => 'failed'];
            }

            if($request->topup['country'] == 'bd'){
                if($request->topup['type'] == 'top_up'){
                    $update_data['bal_mm'] = $fund->bal_mm + $request->topup['amount'];
                }else{
                    $update_data['bal_mr'] = $fund->bal_mr + $request->topup['amount'];
                }
            }elseif($request->topup['country'] == 'ind'){
                $update_data['ind_rp'] = $fund->ind_rp + $request->topup['amount'];
            }else{
                $update_data['pak_rp'] = $fund->pak_rp + $request->topup['amount'];
            }

            Fund::where('user_id', $request->topup['user_id'])->update($update_data);

            Topup::findOrFail($request->topup['id'])->delete();

            DB::commit();

            $this->sendNotification($request->topup['user_id'], 'Your Topup Request is deleted.');

            return ['message' => SUCCESS, 'status' => 'success'];

        }catch(\Exception $e){
            return ['message' => FAIL, 'status' => 'failed'];
        }
    }

    public function bdTopUps(){
        if(Auth::user()->role == 'superadmin'){
            $topups = Topup::with('user')->where('country', 'bd')->orderBy('created_at', 'desc')->get();
        }elseif(Auth::user()->role == 'admin'){
           $topups = Topup::with('user')->where('country', 'bd')->orderBy('created_at', 'desc')->get();
        }else{
           $topups = Topup::with('user')->where('country', 'bd')->where('user_id', Auth::user()->id)->orderBy('created_at', 'desc')->get(); 
        }

        return view('bd-topups', compact('topups'));

    }

    public function indTopUps(){
        if(Auth::user()->role == 'superadmin'){
            $topups = Topup::with('user')->where('country', 'ind')->orderBy('created_at', 'desc')->get();
        }elseif(Auth::user()->role == 'admin'){
           $topups = Topup::with('user')->where('country', 'ind')->orderBy('created_at', 'desc')->get();
        }else{
           $topups = Topup::with('user')->where('country', 'ind')->where('user_id', Auth::user()->id)->orderBy('created_at', 'desc')->get(); 
        }

        return view('ind-topups', compact('topups'));

    }
    public function pakTopUps(){
        if(Auth::user()->role == 'superadmin'){
            $topups = Topup::with('user')->where('country', 'pak')->orderBy('created_at', 'desc')->get();
        }elseif(Auth::user()->role == 'admin'){
           $topups = Topup::with('user')->where('country', 'pak')->orderBy('created_at', 'desc')->get();
        }else{
           $topups = Topup::with('user')->where('country', 'pak')->where('user_id', Auth::user()->id)->orderBy('created_at', 'desc')->get(); 
        }

        return view('pak-topups', compact('topups'));

    }

    public function sendNotification($user_id, $message, $reload = 'true'){
        $options = array(
            'cluster' => 'ap2',
            'useTLS' => true
        );
        $pusher = new Pusher\Pusher(
            'f168311b8b6cae7adac4',
            'ed4bb210bfb45f2f52ad',
            '739512',
            $options
        );

        $data['message'] = $message;
        $data['reload'] = $reload;
        $pusher->trigger('notification-channel.'.$user_id, 'my-event', $data);

        mail("monicse09ku@gmail.com","My subject",$message);

    }

    public function getAdminUserId(){
        $admin = User::where('role', 'admin')->first();
        return $admin->id;
        
    }
}
