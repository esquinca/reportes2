<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ApprovalAdminController extends Controller
{
  public function index()
  {
      return view('permitted.report.view_approval_admin');
  }
}
