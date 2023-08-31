<?php

namespace App\Http\Controllers\Frontend\HelpDesk;

use App\Http\Controllers\Controller;
use App\Models\Helpdesk;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class HelpDeskController extends Controller
{
    public function Index()
    {  
        $user=Auth::user();
        $results=Helpdesk::where('user_id',$user->id)->orderBy('id','Desc')->get();
        return view('FrontendDashboard.pages.help_desk.index',compact('results'));
    }

    public function Store(Request $request)
    {
        $request->validate([
            'subject'=>'required|string',
            'email'=>'required|email',
            'image'=>'nullable|mimes:jpeg,png,jpg',
            'message'=>'required|string'
        ]);
        try
        {  DB::beginTransaction();

            $user=Auth::user();

            if(isset($request->image) && !empty($request->image))
              $image=$this->uploadDocuments($request->image,public_path('assets/images/helpdesk/'));

             Helpdesk::create([
               'user_id'=>$user->id,
               'subject'=>$request->subject,
               'email'=>$request->email,
               'image'=>isset($image)?$image:null,
               'message'=>$request->message
            ]);
             DB::commit();
            return redirect()->back()->with('success','Submit successfully.');
        }
        catch(\Exception $e)
        {
            DB::rollBack();
            return $this->ErrorMessage($e);
        }

    }
}
