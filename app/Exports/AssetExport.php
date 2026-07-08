<?php

namespace App\Exports;

use App\Models\Asset;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithStyles;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;

class AssetExport implements FromCollection, WithHeadings, WithMapping, WithStyles
{
    public function collection()
    {
        return Asset::with(['category', 'brand', 'department', 'location'])->get();
    }

    public function headings(): array
    {
        return [
            'Kode Aset', 'Nama Aset', 'Kategori', 'Merek', 'Vendor',
            'Departemen', 'Lokasi', 'Serial Number', 'Model',
            'Tanggal Pembelian', 'Harga Pembelian', 'Akhir Garansi', 'Status',
        ];
    }

    public function map($asset): array
    {
        return [
            $asset->asset_code,
            $asset->name,
            $asset->category->name,
            $asset->brand->name,
            $asset->vendor->name,
            $asset->department->name,
            $asset->location->name,
            $asset->serial_number,
            $asset->model,
            $asset->purchase_date?->format('d/m/Y'),
            $asset->purchase_price,
            $asset->warranty_end_date?->format('d/m/Y'),
            ucfirst($asset->status),
        ];
    }

    public function styles(Worksheet $sheet): array
    {
        return [
            1 => ['font' => ['bold' => true]],
        ];
    }
}
