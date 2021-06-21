<?php

namespace App\Http\Controllers;

use App\Transaction;
use Illuminate\Http\Request;
use App\Coproprietaire;
class TransactionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($app_id)
    {
        if ($trans = Coproprietaire::find($app_id)->users[0]->transactions){
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
        $tr = new Transaction();
        $tr->description = $request->description;
        $tr->montant = $request->montant;
        $tr->type = $request->type;
        $tr->syndic_id = $request->syndic_id;

        if( $file = $request->file('recue')){
              //Move Uploaded File
      $destinationPath = 'uploads';
      $filename = uniqid().".".$file->getClientOriginalExtension();
      $file->move($destinationPath,$filename);
            $tr->recue = $filename;
      }
      if ( $tr->save() ){
            return response()->json(["message"=>"Transaction ajoutee avec success"], 200);
      }else{
        return response()->json(["message"=>"Impossible d'ajoutee le transaction"], 400);
      }
        

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Transaction  $transaction
     * @return \Illuminate\Http\Response
     */
    public function show(Transaction $transaction)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Transaction  $transaction
     * @return \Illuminate\Http\Response
     */
    public function edit(Transaction $transaction)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Transaction  $transaction
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        
                    $tr = Transaction::find($request->transaction_id);
                    $tr->description = $request->description;
                    $tr->montant = $request->montant;
                    $tr->type = $request->type;
                 

                    if( $file = $request->file('recue')){
                        //Move Uploaded File
                $destinationPath = 'uploads';
                $filename = uniqid().".".$file->getClientOriginalExtension();
                $file->move($destinationPath,$filename);
                        $tr->recue = $filename;
                }
                if ( $tr->update() ){
                        return response()->json(["message"=>"Transaction modifiee avec success"], 200);
                }else{
                    return response()->json(["message"=>"Impossible de modifiee le transaction"], 400);
                }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Transaction  $transaction
     * @return \Illuminate\Http\Response
     */
    public function destroy($idtr)
    {
        //
        $tr = Transaction::find($idtr);
        if ( $tr->delete() ){
            return response()->json(["message"=>"Transaction supprimer avec success"], 200);
        }else{
            return response()->json(["message"=>"Impossible de supprimer le transaction"], 400);
        }
        
        
    }
}
