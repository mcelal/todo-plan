<?php

namespace App\Http\Controllers;

use App\Repos\PlanningRepo;
use Illuminate\Contracts\View\View;

class HomeController extends Controller
{
    /**
     * Show the application dashboard.
     *
     * @return View
     */
    public function index(): View
    {
        $repo = new PlanningRepo();
        $report = $repo->calculate();

        return view('home', compact('report'));
    }
}
