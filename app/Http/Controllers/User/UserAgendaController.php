<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Agenda;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class UserAgendaController extends Controller
{
    public function index(Request $request)
    {
        $today = Carbon::now('Asia/Jakarta');
        
        $startDate = $request->input('start_date', $today->copy()->startOfMonth()->format('Y-m-d'));
        $endDate   = $request->input('end_date', $today->copy()->endOfMonth()->format('Y-m-d'));

        $query = Agenda::with('user');

        if ($request->filled('search')) {
            $query->where(function($q) use ($request) {
                $q->where('title', 'like', '%' . $request->search . '%')
                  ->orWhere('location', 'like', '%' . $request->search . '%');
            });
        }

        $query->whereDate('date', '>=', $startDate)
              ->whereDate('date', '<=', $endDate);

        $agendas = $query->orderBy('date', 'asc')
                         ->paginate(10)
                         ->withQueryString();

        return view('user.agendas.index', compact('agendas', 'startDate', 'endDate'));
    }

    public function myAgendas(Request $request)
    {
        $query = Agenda::where('user_id', Auth::id())->latest('date');
        if ($request->filled('search')) {
            $query->where('title', 'like', '%' . $request->search . '%');
        }
        $agendas = $query->paginate(10)->withQueryString();
        return view('user.my_agendas.index', compact('agendas'));
    }

    public function create()
    {
        $categories = Category::pluck('name');
        return view('user.my_agendas.create', compact('categories'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required',
            'date' => 'required|date',
            'time' => 'required',
            'category' => 'required',
            'description' => 'nullable'
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

        return redirect()->route('user.agendas.my')->with('success', 'Agenda berhasil dibuat.');
    }

    public function show(Agenda $agenda)
    {
        $agenda->load('user');
        return view('admin.agenda.show', compact('agenda'));
    }

    public function edit(Agenda $agenda)
    {
        if ($agenda->user_id != Auth::id()) abort(403);
        $categories = Category::pluck('name');
        return view('user.my_agendas.edit', compact('agenda', 'categories'));
    }

    public function update(Request $request, Agenda $agenda)
    {
        if ($agenda->user_id != Auth::id()) abort(403);
        $agenda->update($request->all());
        return redirect()->route('user.agendas.my')->with('success', 'Agenda diperbarui.');
    }

    public function destroy(Agenda $agenda)
    {
        if ($agenda->user_id != Auth::id()) abort(403);
        $agenda->delete();
        if (request()->ajax()) {
            return response()->json(['message' => 'Agenda dihapus.']);
        }
        return back()->with('success', 'Agenda dihapus.');
    }
}