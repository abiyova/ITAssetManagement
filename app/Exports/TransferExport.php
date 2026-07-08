<?php

namespace App\Exports;

use App\Models\AssetTransfer;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithStyles;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;

class TransferExport implements FromCollection, WithHeadings, WithMapping, WithStyles
{
    public function collection()
    {
        return AssetTransfer::with(['asset', 'fromLocation', 'toLocation', 'transferredBy'])->get();
    }

    public function headings(): array
    {
        return ['Kode Aset', 'Nama Aset', 'Dari Lokasi', 'Ke Lokasi', 'Tanggal', 'Status'];
    }

    public function map($transfer): array
    {
        return [
            $transfer->asset->asset_code,
            $transfer->asset->name,
            $transfer->fromLocation->name,
            $transfer->toLocation->name,
            $transfer->transfer_date->format('d/m/Y'),
            ucfirst($transfer->status),
        ];
    }

    public function styles(Worksheet $sheet): array
    {
        return [1 => ['font' => ['bold' => true]]];
    }
}
