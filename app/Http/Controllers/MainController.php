<?php

namespace App\Http\Controllers;

use App\Models\Pegawai;
use App\Models\Pekerjaan;

class MainController extends Controller
{
    public function index() {
        $genderData = Pegawai::select('gender') -> selectRaw('COUNT(*) as count') -> groupBy('gender') -> pluck('count', 'gender');
        $topJobs = Pekerjaan::withCount('pegawai') -> orderByDesc('pegawai_count') -> take(5) -> get();

        return view('index', [
            'genderLabels' => $genderData->keys(),
            'genderTotals' => $genderData->values(),

            'jobLabels' => $topJobs->pluck('nama'),
            'jobTotals' => $topJobs->pluck('pegawai_count'),
        ]);
    }
}