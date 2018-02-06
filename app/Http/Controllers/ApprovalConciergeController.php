<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ApprovalConciergeController extends Controller
{
  public function index()
  {
      return view('permitted.report.view_approval_concierge');
  }
}
