<?php

namespace App\Http\Controllers;

use Inertia\Inertia;
use Inertia\Response;

class ReturnExchangeController extends Controller
{
    public function index(): Response
    {
        return Inertia::render('ReturnExchangePage');
    }
}
