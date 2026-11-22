<?php

namespace App\Http\Controllers;

use App\Models\KasusPenyakit;

class DashboardController extends Controller
{
    public function index()
    {
        $penyakit = KasusPenyakit::all();
        $totalKasus = $penyakit->sum(fn($item) => $item->total);
        $totalAgustus = $penyakit->sum('agu');

        return view('karhutla.dashboard', compact('penyakit', 'totalKasus', 'totalAgustus'));
    }
}