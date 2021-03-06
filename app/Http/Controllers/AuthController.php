<?php



namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Parrainage;
use Auth;
use Illuminate\Support\Carbon;
use Validator;
use Hash;
use App\Coproprietaire;
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

    public function passwordChange(Request $request){

        Auth::user()->password = Hash::make($request->password);
        Auth::user()->update();
        return response()->json(Auth::user(), 200);

    }

    public function ChangePaiment($iduser){

        $user = User::find($iduser);

        if ( $user->paid ){
            $user->paid = false;

        }else{
            $user->paid = true;
        }

        if ( $user->update() ){
            return response()->json(["message"=>"Modification de paiment"], 200);
        }else{
            return response()->json(["message"=>"Impossible de modifier le paiment"], 400);
        }

    }

    public function Update(Request $request){

        $user = User::find($request->id);

        $user->nom = $request->nom ;
        $user->prenom = $request->prenom ;
        $user->telephone = $request->telephone ;

        if ( $user->update() ){
            return response()->json(["message"=>"Modification d'utilisateur"], 200);
        }else{
            return response()->json(["message"=>"Impossible de modifier l'utilisateur"], 400);
        }

    }

    public function get($id){

        $user = User::find($id);

        if ( $user ){
            return response()->json([$user], 200);
        }else{
            return response()->json(["message"=>"Impossible de recuperer l'utilisateur"], 400);
        }

    }


    public function getusers($idapp){
        //
        $stack = array();
        if ($trans = Coproprietaire::find($idapp)->users->where('role','USER')){
            foreach($trans as $t){
                array_push($stack, $t);

            }
            return response()->json($stack, 200);

        }else{
            return response()->json([], 200);
        }


    }





}
