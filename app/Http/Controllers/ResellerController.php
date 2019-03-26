<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Reseller;
use App\Models\User;
use App\Models\Fund;
use DB, Auth;

class ResellerController extends Controller
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
            $resellers = User::with('reseller', 'fund')->get();
        }elseif(Auth::user()->role == 'admin'){
           $resellers = User::with('reseller', 'fund')->where(['role' => 'reseller'])->get(); 
        }else{
           $resellers = User::with('reseller', 'fund')->where(['status'=>'active', 'role' => 'reseller'])->get(); 
        }
        
        return view('reseller', compact('resellers'));
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
            DB::beginTransaction();

            if(!empty($request->id)){
                $update_data = [
                    'name' => $request->username,
                    'email' => $request->email,
                    'status' => !empty($request->status) ? $request->status : 'pending',
                    'role' => !empty($request->role) ? $request->role : 'reseller',
                ];

                if(!empty($request->password)){
                    $update_data['password'] = bcrypt($request->password);
                }
                $user = User::where('id', $request->id)->update($update_data);
                $user = Reseller::where('user_id', $request->id)->update([
                    'pin' => $request->pin,
                ]);

            }else{
                $user = User::create([
                    'name' => $request->username,
                    'email' => $request->email,
                    'password' => bcrypt($request->password),
                    'status' => !empty($request->status) ? $request->status : 'pending',
                    'role' => !empty($request->role) ? $request->role : 'reseller',
                ]);

                $reseller = Reseller::create([
                    'user_id' => $user->id,
                    'parent_user' => Auth::user()->id,
                    'pin' => $request->pin,
                ]);

                $fund = Fund::create([
                    'user_id' => $user->id,
                ]);
            }

            DB::commit();

            if ($user) {
                return json_encode([
                    'message' => SUCCESS,
                    'user' => $user,
                    'status' => 'success'
                ]);
            }
            
            return json_encode(['message' => FAIL, 'status' => 'failed'], 500);
        } catch (\Exception $e) {
            DB::rollBack();

            return json_encode(['message' => $e->getMessage(), 'status' => 'failed'], 500);
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
        try {
            if (User::findOrFail($id)->delete()) {
                return json_encode(['message' => SUCCESS]);
            }
        } catch (\Exception $e) {
            return json_encode(['message' => $e->getMessage()]);
            return json_encode(['message' => SUCCESS]);
        }
    }
}
