<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CoverDeliveryEquipmentController extends Controller
{
  public function index()
  {
      return view('permitted.equipment.cover_delivery');
  }
}
