<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Agenda;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class AgendaController extends Controller
{
    public function index(Request $request)
    {
        $today = Carbon::now('Asia/Jakarta');
        
        $startDate = $request->input('start_date', $today->copy()->startOfMonth()->format('Y-m-d'));
        $endDate   = $request->input('end_date', $today->copy()->endOfMonth()->format('Y-m-d'));
        $search    = $request->input('search');

        $query = Agenda::with('user');

        if ($search) {
            $query->where(function($q) use ($search) {
                $q->where('title', 'like', "%{$search}%")
                  ->orWhere('location', 'like', "%{$search}%");
            });
        }

        $query->whereDate('date', '>=', $startDate)
              ->whereDate('date', '<=', $endDate);

        $agendas = $query->latest('date')
                         ->paginate(10)
                         ->withQueryString();

        $categories = Category::pluck('name');

        return view('admin.agenda.index', compact('agendas', 'categories', 'startDate', 'endDate'));
    }

    public function create()
    {
        $categories = Category::pluck('name');
        return view('admin.agenda.create', compact('categories'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'date' => 'required|date',
            'time' => 'required',
            'category' => 'required',
            'location' => 'nullable|string',
            'description' => 'nullable|string',
        ]);

        Agenda::create([
            'user_id' => Auth::id(),
            'title' => $request->title,
            'date' => $request->date,
            'time' => $request->time,
            'category' => $request->category,
            'location' => $request->location,
            'description' => $request->description,
            'status' => 'pending'
        ]);

        return redirect()->route('admin.agendas.index')->with('success', 'Agenda berhasil dibuat.');
    }

    public function edit(Agenda $agenda)
    {
        $categories = Category::pluck('name');
        return view('admin.agenda.edit', compact('agenda', 'categories'));
    }

    public function update(Request $request, Agenda $agenda)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'date' => 'required|date',
            'time' => 'required',
            'category' => 'required',
        ]);

        $agenda->update($request->all());

        return redirect()->route('admin.agendas.index')->with('success', 'Agenda berhasil diperbarui.');
    }

    public function show(Agenda $agenda)
    {
        $agenda->load('user');
        return view('admin.agenda.show', compact('agenda'));
    }

    public function destroy(Agenda $agenda)
    {
        $agenda->delete();

        if (request()->ajax() || request()->wantsJson()) {
            return response()->json([
                'status' => 'success',
                'message' => 'Agenda berhasil dihapus!'
            ]);
        }
        return redirect()->route('admin.agendas.index')->with('success', 'Agenda berhasil dihapus.');
    }

    public function cancel(Agenda $agenda)
    {
        $agenda->update(['status' => 'canceled']);
        
        if (request()->ajax() || request()->wantsJson()) {
            return response()->json(['message' => 'Agenda berhasil dibatalkan.']);
        }
        return redirect()->back()->with('success', 'Agenda berhasil dibatalkan.');
    }
}