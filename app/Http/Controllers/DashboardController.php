<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\Agenda;
use Carbon\Carbon;

class DashboardController extends Controller
{
    public function adminIndex()
    {
        $stats = [
            'total_user'      => User::where('role', 'user')->count(),
            'total_agenda'    => Agenda::count(),
            'agenda_today'    => Agenda::whereDate('date', Carbon::today())->count(),
            'agenda_canceled' => Agenda::where('status', 'canceled')->count(),
        ];

        $recent_agendas = Agenda::with('user')->latest('date')->take(5)->get();

        return view('admin.dashboard', compact('stats', 'recent_agendas'));
    }

    public function userIndex()
    {
        $user_id = Auth::id();

        $my_agendas = Agenda::where('user_id', $user_id)
                            ->orderBy('date', 'desc')
                            ->get();

        return view('user.dashboard', compact('my_agendas'));
    }
}