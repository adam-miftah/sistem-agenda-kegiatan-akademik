<!DOCTYPE html>
<html lang="id">

<head>
  <meta charset="UTF-8">
  <title>Laporan Kegiatan Akademik</title>
  <style>
    body {
      font-family: 'Helvetica', 'Arial', sans-serif;
      font-size: 10pt;
      color: #333;
      margin: 0;
      padding: 0;
    }

    .header {
      text-align: center;
      margin-bottom: 25px;
      padding-bottom: 10px;
      border-bottom: 3px double #444;
      position: relative;
    }

    .header h1 {
      margin: 0;
      font-size: 16pt;
      font-weight: bold;
      text-transform: uppercase;
      color: #2c3e50;
    }

    .header h2 {
      margin: 5px 0;
      font-size: 12pt;
      font-weight: normal;
      color: #555;
    }

    .header p {
      margin: 0;
      font-size: 9pt;
      color: #777;
      font-style: italic;
    }

    .meta-info {
      margin-bottom: 15px;
      font-size: 9pt;
      width: 100%;
      border-collapse: collapse;
    }

    .meta-info td {
      padding: 2px 0;
    }

    .meta-label {
      font-weight: bold;
      width: 100px;
      color: #555;
    }

    .table-data {
      width: 100%;
      border-collapse: collapse;
      margin-bottom: 30px;
    }

    .table-data th,
    .table-data td {
      border: 1px solid #ddd;
      padding: 8px;
      text-align: left;
      vertical-align: top;
    }

    .table-data th {
      background-color: #2c3e50;
      color: #ffffff;
      font-weight: bold;
      text-transform: uppercase;
      font-size: 8pt;
      text-align: center;
    }

    .table-data tr:nth-child(even) {
      background-color: #f9f9f9;
    }

    .table-data td {
      font-size: 9pt;
    }

    .center {
      text-align: center;
    }

    .badge {
      font-weight: bold;
      font-size: 8pt;
      text-transform: uppercase;
    }

    .status-completed {
      color: #198754;
    }

    .status-canceled {
      color: #dc3545;
      font-style: italic;
    }

    .status-pending {
      color: #fd7e14;
    }

    .footer-signature {
      width: 100%;
      margin-top: 40px;
      page-break-inside: avoid;
    }

    .signature-box {
      float: right;
      width: 270px;
      text-align: center;
    }

    .signature-box p {
      margin: 5px 0;
    }

    .space-sign {
      height: 70px;
    }

    .page-number {
      position: fixed;
      bottom: -20px;
      left: 0;
      right: 0;
      text-align: center;
      font-size: 8pt;
      color: #999;
    }
  </style>
</head>

<body>

  <div class="header">
    <h1>Laporan Agenda Kegiatan Akademik</h1>
    <h2>Universitas Pamulang - Prodi Teknik Informatika</h2>
    <p>Jl. Raya Puspitek, Buaran, Kec. Pamulang, Kota Tangerang Selatan, Banten 15310</p>
  </div>

  <table class="meta-info">
    <tr>
      <td class="meta-label">Periode</td>
      <td>
        : {{ \Carbon\Carbon::parse($startDate)->isoFormat('D MMMM Y') }}
        s/d
        {{ \Carbon\Carbon::parse($endDate)->isoFormat('D MMMM Y') }}
      </td>
    </tr>
    <tr>
      <td class="meta-label">Kategori</td>
      <td>: {{ request('category') ?: 'Semua Kategori' }}</td>
    </tr>
    <tr>
      <td class="meta-label">Dicetak Oleh</td>
      <td>: {{ Auth::user()->name }} ({{ date('d/m/Y H:i') }})</td>
    </tr>
  </table>

  <table class="table-data">
    <thead>
      <tr>
        <th width="5%">No</th>
        <th width="12%">Tanggal</th>
        <th width="10%">Jam</th>
        <th width="28%">Kegiatan</th>
        <th width="12%">Kategori</th>
        <th width="18%">Pelaksana</th>
        <th width="15%">Status</th>
      </tr>
    </thead>
    <tbody>
      @forelse($agendas as $index => $agenda)
        <tr>
          <td class="center">{{ $index + 1 }}</td>
          <td class="center">{{ \Carbon\Carbon::parse($agenda->date)->format('d/m/Y') }}</td>
          <td class="center">{{ \Carbon\Carbon::parse($agenda->time)->format('H:i') }}</td>
          <td>
            <strong>{{ $agenda->title }}</strong><br>
            <span style="font-size: 8pt; color: #666;">Lokasi: {{ $agenda->location ?? '-' }}</span>
          </td>
          <td class="center">{{ $agenda->category }}</td>
          <td>{{ $agenda->user->name }}</td>
          <td class="center">
            @if($agenda->status == 'completed')
              <span class="badge status-completed">Selesai</span>
            @elseif($agenda->status == 'canceled')
              <span class="badge status-canceled">Batal</span>
            @else
              <span class="badge status-pending">Pending</span>
            @endif
          </td>
        </tr>
      @empty
        <tr>
          <td colspan="7" class="center" style="padding: 20px; color: #777;">
            Tidak ada data yang ditemukan untuk periode ini.
          </td>
        </tr>
      @endforelse
    </tbody>
  </table>

  <div class="footer-signature">
    <div class="signature-box">
      <p>Tangerang Selatan, {{ date('d F Y') }}</p>
      <p>a.n Dekan,</p>
      <p><strong>Ketua Program Studi</strong></p>
      <div class="space-sign"></div>
      <p style="border-bottom: 1px solid #333; display: inline-block; width: 100%;">
        Dr. Eng. Ahmad Musyafa, S.Kom., M.Kom.
      </p>
      <p style="margin-top: -4px; font-weight: bold;">NIDN. 0425018609</p>
    </div>
  </div>

  <script type="text/php">
        if (isset($pdf)) {
            $text = "Halaman {PAGE_NUM} dari {PAGE_COUNT}";
            $font = $fontMetrics->get_font("Arial, Helvetica, sans-serif", "normal");
            $size = 8;
            $color = array(0.5, 0.5, 0.5);
            $word_space = 0.0;
            $char_space = 0.0;
            $angle = 0.0;
            $pdf->page_text(270, 820, $text, $font, $size, $color, $word_space, $char_space, $angle);
        }
    </script>

</body>

</html>