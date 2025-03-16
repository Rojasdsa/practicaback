<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Retal;
use Illuminate\View\View;

class RetalesAdminController extends Controller
{
    public function index(): View
    {
        // Pasamos las constantes del modelo Retal a la vista
        return view('admin.panel', [
            'tejidos' => Retal::TEJIDOS,
            'subcategorias' => Retal::SUBCATEGORIAS,
            'gamas' => Retal::GAMAS,
            'estados' => Retal::ESTADOS,
        ]);
    }
}