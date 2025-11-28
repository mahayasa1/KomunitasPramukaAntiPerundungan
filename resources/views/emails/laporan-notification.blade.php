<!DOCTYPE html>
<html>
<body style="font-family: Arial">

    <h2>Halo {{ $data['name'] }},</h2>

    @if($statusUpdate ?? false)
        <p>Status laporan <strong>{{ $jenis }}</strong> Anda telah berubah.</p>
        <p><strong>Status baru:</strong> {{ $data['status'] }}</p>
    @else
        <p>Laporan <strong>{{ $jenis }}</strong> Anda telah berhasil diterima.</p>
    @endif

    <p><strong>Judul:</strong> {{ $data['judul'] ?? '-' }}</p>

    <p><strong>Tanggal:</strong>
        {{ \Carbon\Carbon::parse($data['created_at'])->translatedFormat('d F Y') }}
    </p>

    <br>
    <p>Terima kasih,</p>
    <p><strong>SKYNUSA TECH</strong></p>

</body>
</html>
