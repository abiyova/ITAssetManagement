<?php

namespace App\Exports;

use App\Models\AssetAssignment;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithStyles;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;

class AssignmentExport implements FromCollection, WithHeadings, WithMapping, WithStyles
{
    public function collection()
    {
        return AssetAssignment::with(['asset', 'assignedTo', 'assignedBy'])->get();
    }

    public function headings(): array
    {
        return ['Kode Aset', 'Nama Aset', 'Peminjam', 'Peminjam Oleh', 'Tanggal Pinjam', 'Tanggal Kembali', 'Status'];
    }

    public function map($assignment): array
    {
        return [
            $assignment->asset->asset_code,
            $assignment->asset->name,
            $assignment->assignedTo->name,
            $assignment->assignedBy->name,
            $assignment->assign_date->format('d/m/Y'),
            $assignment->return_date?->format('d/m/Y') ?? '-',
            ucfirst($assignment->status),
        ];
    }

    public function styles(Worksheet $sheet): array
    {
        return [1 => ['font' => ['bold' => true]]];
    }
}
