<?php

namespace App\Http\Controllers;

use App\Models\Job;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Artisan;

class JobController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): View
    {
        $jobs = Job::query()
            ->paginate(30);

        return view('jobs.index', compact('jobs'));
    }

    /**
     * Provider üzerinden jobların tekrar çekilmesini tetikler
     *
     * @return RedirectResponse
     */
    public function reImport(): RedirectResponse
    {
        Artisan::call('app:fetch-jobs');

        return redirect()->route('jobs.index');
    }
}
