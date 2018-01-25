<?php

namespace App;
use App\Reference;
use App\Typereport;
use App\Cadena;
use Illuminate\Database\Eloquent\Model;

class Hotel extends Model
{
    //
    public function references()
    {
      return $this->belongsToMany(Reference::class);
    }
    public function typereports()
    {
      return $this->belongsToMany(Typereport::class);
    }
    public function hotelCadena()
    {
    	return $this->belongsToMany(Cadena::class);
    }

}
