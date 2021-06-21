<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password', 'role',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    
        /**
         * Get all of the coproprietaires for the User
         *
         * @return \Illuminate\Database\Eloquent\Relations\HasMany
         */
        public function coproprietaires()
        {
            return $this->hasMany('App\Coproprietaire', 'admin_id', 'id');
        }
        /**
         * Get the coproprietaire that owns the User
         *
         * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
         */
        public function coproprietaire()
        {
            return $this->belongsTo('App\Coproprietaire', 'app_id', 'id');
        }
    

}
