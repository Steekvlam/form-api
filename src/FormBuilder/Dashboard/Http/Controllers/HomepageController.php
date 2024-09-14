<?php

namespace FormBuilder\Dashboard\Http\Controllers;

use App\Http\Controllers\Controller;
use Inertia\Inertia;

class HomepageController extends Controller
{
    public function index()
    {
        return Inertia::render('Homepage/Index');
    }
}
