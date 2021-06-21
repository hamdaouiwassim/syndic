<?php



namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Parrainage;
use Auth;
use Illuminate\Support\Carbon;
use Validator;
use Hash;
class AuthController extends Controller
{
    //
    
    

    public function login(Request $request){
    
        
        

       if (!Auth::attempt(['name' => $request->identifiant, 'password' => $request->password]) ){
           return response()->json([
               'message' => 'Invalid username/password',
               'status_code' => 401
           ], 401);
       }
       //$user = $request->user();
       $user = Auth::user();
    
           return response()->json($user , 200);

      
           
       

    }


        


    
    public function destroy($iduser){
        
        foreach( User::find($iduser)->comments as $c ){
            $c->delete();
        }
        foreach( User::find($iduser)->posts as $p ){
            $p->delete();
        }
        User::find($iduser)->delete();
        return response()->json(['message'=>'Utilisateur supprimer'], 200);

    }
    // public function Update(Request $request){
        
       
    //     $user = Auth::user();
    //     $user->name = $request->name ;
    //     $user->nom = $request->nom ;
    //     $user->prenom = $request->prenom ;
    //     $user->adresse = $request->adresse ;

    //     if( $request->file('avatar') ){
    //         $avatar = $request->file('avatar');
    //         $newavatarName = uniqid().'.'.$avatar->getClientOriginalExtension();
    //         //Move Uploaded File
    //         $destinationPath = 'uploads/avatars/';
    //         $avatar->move($destinationPath,$newavatarName);
    //         $user->avatar =   $newavatarName;

    //     }
    //     $user->update();


    //     return response()->json($user, 200);

    // }
    public function passwordChange(Request $request){

        Auth::user()->password = Hash::make($request->password);
        Auth::user()->update();
        return response()->json(Auth::user(), 200);

    }



}