<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Citta extends Model
{
    protected $table = "citta";
    public $timestamps = false;
    
    protected $fillable = ['nome', 'id'];
    
    public function users() {
        return $this->hasMany('App\LibUser');
    }
    
    public function sentieri() {
        return $this->hasMany('App\Sentiero');
    }
   
}
