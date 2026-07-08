<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cetak Aset - {{ $asset->asset_code }}</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            font-size: 12px;
            color: #000;
            margin: 20px;
        }
        .header {
            text-align: center;
            border-bottom: 2px solid #000;
            padding-bottom: 10px;
            margin-bottom: 20px;
        }
        .header h1 {
            font-size: 18px;
            margin: 0;
        }
        .header p {
            margin: 5px 0 0;
            font-size: 11px;
        }
        .content {
            margin-bottom: 20px;
        }
        .info-table {
            width: 100%;
            border-collapse: collapse;
        }
        .info-table td {
            padding: 4px 8px;
            border: 1px solid #ccc;
            vertical-align: top;
        }
        .info-table td.label {
            width: 30%;
            background-color: #f5f5f5;
            font-weight: bold;
        }
        .codes {
            display: flex;
            justify-content: space-around;
            margin-top: 20px;
            padding-top: 10px;
            border-top: 1px solid #ccc;
        }
        .code-box {
            text-align: center;
        }
        .code-box .label {
            font-size: 10px;
            color: #666;
            margin-bottom: 5px;
        }
        .code-box code {
            font-size: 10px;
            display: block;
            padding: 5px;
            border: 1px solid #ccc;
            background: #f9f9f9;
        }
        .footer {
            text-align: center;
            font-size: 10px;
            color: #666;
            margin-top: 30px;
            border-top: 1px solid #ccc;
            padding-top: 10px;
        }
        @media print {
            body {
                margin: 0;
                padding: 10mm;
            }
            .no-print {
                display: none;
            }
        }
    </style>
</head>
<body>
    <div class="no-print" style="text-align: right; margin-bottom: 10px;">
        <button onclick="window.print()" style="padding: 5px 15px; cursor: pointer;">Cetak</button>
    </div>

    <div class="header">
        <h1>DATA ASET</h1>
        <p>PT. Nama Perusahaan</p>
    </div>

    <div class="content">
        <table class="info-table">
            <tr>
                <td class="label">Kode Aset</td>
                <td><strong>{{ $asset->asset_code }}</strong></td>
            </tr>
            <tr>
                <td class="label">Nama Aset</td>
                <td>{{ $asset->name }}</td>
            </tr>
            <tr>
                <td class="label">Kategori</td>
                <td>{{ $asset->category->name ?? '-' }}</td>
            </tr>
            <tr>
                <td class="label">Merek</td>
                <td>{{ $asset->brand->name ?? '-' }}</td>
            </tr>
            <tr>
                <td class="label">Model</td>
                <td>{{ $asset->model ?? '-' }}</td>
            </tr>
            <tr>
                <td class="label">Nomor Seri</td>
                <td>{{ $asset->serial_number ?? '-' }}</td>
            </tr>
            <tr>
                <td class="label">Vendor</td>
                <td>{{ $asset->vendor->name ?? '-' }}</td>
            </tr>
            <tr>
                <td class="label">Departemen</td>
                <td>{{ $asset->department->name ?? '-' }}</td>
            </tr>
            <tr>
                <td class="label">Lokasi</td>
                <td>{{ $asset->location->name ?? '-' }}</td>
            </tr>
            <tr>
                <td class="label">Tanggal Pembelian</td>
                <td>{{ $asset->purchase_date ? $asset->purchase_date->format('d/m/Y') : '-' }}</td>
            </tr>
            <tr>
                <td class="label">Harga Pembelian</td>
                <td>Rp {{ number_format($asset->purchase_price ?? 0, 0, ',', '.') }}</td>
            </tr>
            <tr>
                <td class="label">Akhir Garansi</td>
                <td>{{ $asset->warranty_end_date ? $asset->warranty_end_date->format('d/m/Y') : '-' }}</td>
            </tr>
            <tr>
                <td class="label">Status</td>
                <td><strong>{{ ucfirst($asset->status) }}</strong></td>
            </tr>
            <tr>
                <td class="label">Deskripsi</td>
                <td>{{ $asset->description ?? '-' }}</td>
            </tr>
        </table>

        <div class="codes">
            <div class="code-box">
                <div class="label">BARCODE</div>
                <code>{{ $asset->barcode ?? '-' }}</code>
            </div>
            <div class="code-box">
                <div class="label">QR CODE</div>
                <code>{{ $asset->qr_code ?? '-' }}</code>
            </div>
        </div>
    </div>

    <div class="footer">
        <p>Dicetak pada: {{ now()->format('d/m/Y H:i') }}</p>
    </div>
</body>
</html>
