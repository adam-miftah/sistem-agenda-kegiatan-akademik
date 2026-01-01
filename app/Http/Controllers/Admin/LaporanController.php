<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Agenda;
use App\Models\Category;
use Illuminate\Http\Request;
use Carbon\Carbon;

class LaporanController extends Controller
{
    public function index(Request $request)
    {
        $today = Carbon::now('Asia/Jakarta');
        
        $startDate = $request->input('start_date', $today->copy()->startOfMonth()->format('Y-m-d'));
        $endDate   = $request->input('end_date', $today->copy()->endOfMonth()->format('Y-m-d'));

        $query = Agenda::with('user')
            ->whereDate('date', '>=', $startDate)
            ->whereDate('date', '<=', $endDate);

        if ($request->filled('category')) {
            $query->where('category', $request->category);
        }
        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        $agendas = $query->latest('date')->paginate(10)->withQueryString();
        $categories = Category::pluck('name');

        return view('admin.laporan.index', compact('agendas', 'categories', 'startDate', 'endDate'));
    }

    public function printPdf(Request $request)
    {
        $today = Carbon::now('Asia/Jakarta');
        
        $startDate = $request->input('start_date', $today->copy()->startOfMonth()->format('Y-m-d'));
        $endDate   = $request->input('end_date', $today->copy()->endOfMonth()->format('Y-m-d'));

        $query = Agenda::with('user')
            ->whereDate('date', '>=', $startDate)
            ->whereDate('date', '<=', $endDate);

        if ($request->filled('category')) {
            $query->where('category', $request->category);
        }
        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        $agendas = $query->latest('date')->get();

        $pdf = \Barryvdh\DomPDF\Facade\Pdf::loadView('admin.laporan.pdf', compact('agendas', 'startDate', 'endDate'));
        return $pdf->stream('laporan-kegiatan.pdf');
    }
}