<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class attendance extends Model
{
    protected $fillable=['paciente','prioridade','chamado'];


    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
