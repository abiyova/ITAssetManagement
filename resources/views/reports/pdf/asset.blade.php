<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <title>Laporan Aset - {{ config('app.name') }}</title>
    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; }
        body { font-family: sans-serif; font-size: 12px; color: #333; }
        .header { text-align: center; margin-bottom: 20px; }
        .header h1 { font-size: 18px; margin-bottom: 5px; }
        .header p { font-size: 12px; color: #666; }
        table { width: 100%; border-collapse: collapse; margin-bottom: 20px; }
        th, td { border: 1px solid #ddd; padding: 8px; text-align: left; }
        th { background-color: #f5f5f5; font-weight: bold; }
        tr:nth-child(even) { background-color: #f9f9f9; }
        .footer { text-align: center; font-size: 10px; color: #999; margin-top: 30px; }
    </style>
</head>
<body>
    <div class="header">
        <h1>LAPORAN ASET</h1>
        <p>{{ config('app.name') }} - Dicetak pada {{ now()->format('d/m/Y H:i') }}</p>
    </div>

    <table>
        <thead>
            <tr>
                <th>No</th>
                <th>Kode Aset</th>
                <th>Nama</th>
                <th>Kategori</th>
                <th>Merek</th>
                <th>Lokasi</th>
                <th>Departemen</th>
                <th>Harga</th>
                <th>Status</th>
            </tr>
        </thead>
        <tbody>
            @forelse($assets as $index => $asset)
                <tr>
                    <td>{{ $index + 1 }}</td>
                    <td>{{ $asset->asset_code }}</td>
                    <td>{{ $asset->name }}</td>
                    <td>{{ $asset->category->name ?? '-' }}</td>
                    <td>{{ $asset->brand->name ?? '-' }}</td>
                    <td>{{ $asset->location->name ?? '-' }}</td>
                    <td>{{ $asset->department->name ?? '-' }}</td>
                    <td>Rp {{ number_format($asset->purchase_price ?? 0, 0, ',', '.') }}</td>
                    <td>{{ ucfirst($asset->status) }}</td>
                </tr>
            @empty
                <tr>
                    <td colspan="9" style="text-align: center;">Tidak ada data</td>
                </tr>
            @endforelse
        </tbody>
    </table>

    <div class="footer">
        <p>Dokumen ini dihasilkan secara otomatis oleh {{ config('app.name') }}</p>
    </div>
</body>
</html>
