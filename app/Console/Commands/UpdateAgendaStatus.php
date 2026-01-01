<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Agenda;
use Carbon\Carbon;

class UpdateAgendaStatus extends Command
{
    // Nama perintah yang akan dipanggil nanti
    protected $signature = 'agenda:update-status';

    // Deskripsi perintah
    protected $description = 'Mengupdate status agenda yang sudah lewat tanggal menjadi completed';

    public function handle()
    {
        // Cari agenda yang statusnya 'pending' DAN tanggalnya < hari ini
        $affected = Agenda::where('status', 'pending')
            ->whereDate('date', '<', Carbon::now())
            ->update(['status' => 'completed']);

        $this->info("Berhasil mengupdate {$affected} agenda menjadi completed.");
    }
}