<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Retal;
use Illuminate\View\View;

class RetalesAdminController extends Controller
{
    public function index(): View
    {
        $retales = Retal::with('imagenes')->get();
        $retalesJson = json_encode($retales); // Convertimos los datos a JSON

        return view('admin.panel', compact('retalesJson'));
    }
}
