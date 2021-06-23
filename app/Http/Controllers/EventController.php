<?php

namespace App\Http\Controllers;
use App\Coproprietaire;
use App\Event;
use Illuminate\Http\Request;

class EventController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($app_id)
    {
        $stack=array();
        if ($trans = Coproprietaire::find($app_id)->events){
            foreach($trans as $t){
                array_push($stack, $t);

            }
            return response()->json($trans, 200);
            
        }else{
            return response()->json([], 200);
        }
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
        $tr = new Event();
        $tr->nom = $request->nom;
        $tr->description = $request->description;
        $tr->app_id = $request->app_id;

      if ( $tr->save() ){
            return response()->json(["message"=>"Event ajoutee avec success"], 200);
      }else{
        return response()->json(["message"=>"Impossible d'ajoutee le Event"], 400);
      }
        

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Event  $Event
     * @return \Illuminate\Http\Response
     */
    public function show(Event $Event)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Event  $Event
     * @return \Illuminate\Http\Response
     */
    public function edit(Event $Event)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Event  $Event
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        
                    $tr = Event::find($request->id);
                    $tr->nom = $request->nom;
                    $tr->description = $request->description;
        
              
                 

           
                if ( $tr->update() ){
                        return response()->json(["message"=>"Event modifiee avec success"], 200);
                }else{
                    return response()->json(["message"=>"Impossible de modifiee le Event"], 400);
                }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Event  $Event
     * @return \Illuminate\Http\Response
     */
    public function destroy($idtr)
    {
        //
        $tr = Event::find($idtr);
        if ( $tr->delete() ){
            return response()->json(["message"=>"Event supprimer avec success"], 200);
        }else{
            return response()->json(["message"=>"Impossible de supprimer le Event"], 400);
        }
        
        
    }
}
