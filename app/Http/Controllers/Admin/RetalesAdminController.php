<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Retal;
use Illuminate\View\View;

class RetalesAdminController extends Controller
{
    public function index(): View
    {
        return view('admin.panel');
    }
}
