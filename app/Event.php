<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
    //
    /**
     * Get the coproprietaire that owns the Event
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function coproprietaire()
    {
        return $this->belongsTo("App\Coproprietaire", 'app_id', 'id');
    }
}
