<?php

namespace App\Exports;

use App\Models\Maintenance;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithStyles;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;

class MaintenanceExport implements FromCollection, WithHeadings, WithMapping, WithStyles
{
    public function collection()
    {
        return Maintenance::with(['asset', 'technician'])->get();
    }

    public function headings(): array
    {
        return ['Kode Aset', 'Nama Aset', 'Teknisi', 'Jenis', 'Jadwal', 'Status', 'Biaya'];
    }

    public function map($maintenance): array
    {
        return [
            $maintenance->asset->asset_code,
            $maintenance->asset->name,
            $maintenance->technician?->name ?? '-',
            ucfirst($maintenance->type),
            $maintenance->schedule_date->format('d/m/Y'),
            ucfirst($maintenance->status),
            $maintenance->cost,
        ];
    }

    public function styles(Worksheet $sheet): array
    {
        return [1 => ['font' => ['bold' => true]]];
    }
}
