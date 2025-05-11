<?php

namespace App\Http\Controllers;

use Inertia\Inertia;
use Inertia\Response;

class DataProcessingController extends Controller
{
    public function index(): Response
    {
        return Inertia::render('DataProcessingPage');
    }
}
