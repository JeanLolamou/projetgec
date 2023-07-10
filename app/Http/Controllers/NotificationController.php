<?php

namespace App\Http\Controllers;
use App\Models\Notification;
use App\User;
use Illuminate\Support\Facades\Auth;

use DB;
use App\Affectation;
use App\Courrier;
use App\Reponse;

use Illuminate\Http\Request;

class NotificationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    { if(isset(Auth::user()->id))
        {
            $notifications= DB::table('users')
       ->join('notifications','users.id', "=",'notifications.id_users')
       ->select('notifications.*', 'name')
       ->where('notifications.actif', 1)
       ->get();
        
           return view('notifications.index',['notifications'=>$notifications]);
       

    }
    else
        {
          return view('auth.login'); 
        }   

    }
    

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if(isset(Auth::user()->id))
        { 
            $users = User::where('user_statut', 1)->get();
            
         return view('notifications.create', ['users'=>$users]);
    }
    else
        {
          return view('auth.login'); 
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    { if(isset(Auth::user()->id))
        {
        $notification = new Notification();
       $notification->notifier = $request->get('notifier');
       $notification->annoter = $request->get('annoter');
       $notification->id_users = $request->get('id_users');
      
       $notification->save();

        return redirect()->route('addnotification')->with('success', 'Notification Enregistrée avec succès');
         }
    else
        {
          return view('auth.login'); 
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
       if(isset(Auth::user()->id))
        {
            
         $editnotifications = Notification::findOrFail($id);
        return view('notifications.edit',['editnotifications'=>$editnotifications]);
          }
    else
        {
          return view('auth.login'); 
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {  
        
        if(isset(Auth::user()->id))
        {
          $notification = Notification::findOrFail($request->id);
          $notification->update(['notifier' => $request->nom]);
          $notification->update(['annoter' => $request->nom]);

         return redirect()->route('listenotification')->with('success', 'Information Notification Modifier avec succès');
           }
    else
        {
          return view('auth.login'); 
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
