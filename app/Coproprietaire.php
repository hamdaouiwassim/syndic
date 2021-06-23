<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Coproprietaire extends Model
{
    //
    /**
     * Get the user that owns the Coproprietaire
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function admin()
    {
        return $this->belongsTo('App\User', 'admin_id', 'id');
    }
    
    /**
     * Get all of the users for the Coproprietaire
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function users()
    {
        return $this->hasMany('App\User', 'app_id', 'id');
    }
       /**
     * Get all of the users for the Coproprietaire
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function events()
    {
        return $this->hasMany('App\Event', 'app_id', 'id');
    }
    
}
