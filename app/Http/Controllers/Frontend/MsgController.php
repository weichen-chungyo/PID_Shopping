<?php

namespace App\Http\Controllers\Frontend;

use Illuminate\Http\Request;
use App\User;
use App\MsgData;
use App\ReMsgData;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
class MsgController extends Controller
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
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $msgData = DB::table('msgData')->paginate(3);
        $reMsgData=DB::table('reMsgData')->get();
        return view('frontend.msgBoard')
            ->with('msgData',$msgData)
            ->with('reMsgData',$reMsgData);
    }

    public function store(Request $request)
    {
        $user = Auth::user();
        MsgData::updateOrCreate(['id' => $request->id],
            [
                'email' => $user->email,
                'content' => $request->content
            ]);
        

        return response()->json(['success' => '留言成功']);
    }
    public function destroy($id)
    {

        MsgData::find($id)->delete();

        return response()->json(['success' => '成功刪除回覆']);

    }
    public function edit($id)
    {
        $msgData = MsgData::find($id);

        return response()->json($msgData);
    }
}
