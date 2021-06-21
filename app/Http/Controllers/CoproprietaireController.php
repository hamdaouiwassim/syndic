<?php

namespace App\Http\Controllers;

use App\Coproprietaire;
use Illuminate\Http\Request;
use App\User;
use Hash;
class CoproprietaireController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
        $cp = new Coproprietaire();
        $cp->nom = $request->nom;
        $cp->adresse = $request->adresse;
        $cp->ville = $request->ville;

        $cp->zip = $request->zip;
        $cp->region = $request->region;
        $cp->nb_app = $request->nb_app;


        $cp->nb_bloc = $request->nb_bloc;
        $cp->nb_p = $request->nb_p;
        $cp->nb_lc = $request->nb_lc;

        $cp->nb_log = $request->nb_log;
        $cp->admin_id = $request->admin_id;

        if ( $cp->save() ) {
           // dd($cp->id);

                      $user = new User();
                      $user->name= $request->identifiant;
                      $user->role= 'SYNDIC';
                      $user->app_id= $cp->id;
                      $user->password= Hash::make($request->password);
                      $user->save();
                   
            
                    for($i=1;$i<=$request->nb_app;$i++){

                      $user = new User();
                      $user->name= $request->nom."".$i;
                      $user->role= 'USER';
                      $user->app_id= $cp->id;
                      $user->password= Hash::make($request->nom."".$i);
                      $user->save();
                        
            
                    }
                    return response()->json(["message" => "Appartement ajoutee avec success" ], 200);
        }
        return response()->json(["message" => "Impossible  d'\ajoutee l'\appatement" ], 400);
        

     


    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Coproprietaire  $coproprietaire
     * @return \Illuminate\Http\Response
     */
    public function show(Coproprietaire $coproprietaire)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Coproprietaire  $coproprietaire
     * @return \Illuminate\Http\Response
     */
    public function edit(Coproprietaire $coproprietaire)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Coproprietaire  $coproprietaire
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Coproprietaire $coproprietaire)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Coproprietaire  $coproprietaire
     * @return \Illuminate\Http\Response
     */
    public function destroy($idcoproprietaire)
    {
        //
        if ( Coproprietaire::find($idcoproprietaire)->delete() ){
            $users = User::where('app_id',$idcoproprietaire)->get();
            foreach($users as $u){
                $u->delete();
            }

            return response()->json(["message" => "Appartement supprimer avec success" ], 200);
            
        }else{
            return response()->json(["message" => "Impossible  d'\supprimer l'\appatement" ], 400);
        }
        
    }
}
