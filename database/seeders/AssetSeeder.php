<?php

namespace Database\Seeders;

use App\Models\Asset;
use App\Models\AssetAssignment;
use App\Models\AssetTimeline;
use App\Models\User;
use Illuminate\Database\Seeder;

class AssetSeeder extends Seeder
{
    public function run(): void
    {
        $assets = [
            [
                'asset_code' => 'AST-000001', 'name' => 'Laptop Dell Latitude 5540', 'category_id' => 1,
                'brand_id' => 1, 'vendor_id' => 1, 'department_id' => 1, 'location_id' => 1,
                'serial_number' => 'DL5540-001', 'model' => 'Latitude 5540', 'purchase_date' => '2024-01-15',
                'purchase_price' => 18500000, 'warranty_end_date' => '2027-01-15', 'status' => 'assigned',
                'barcode' => 'BC-AST-000001', 'qr_code' => 'QR-AST-000001',
            ],
            [
                'asset_code' => 'AST-000002', 'name' => 'Laptop Lenovo ThinkPad T14', 'category_id' => 1,
                'brand_id' => 3, 'vendor_id' => 1, 'department_id' => 1, 'location_id' => 1,
                'serial_number' => 'LTT14-001', 'model' => 'ThinkPad T14 Gen 3', 'purchase_date' => '2024-03-20',
                'purchase_price' => 17200000, 'warranty_end_date' => '2027-03-20', 'status' => 'assigned',
                'barcode' => 'BC-AST-000002', 'qr_code' => 'QR-AST-000002',
            ],
            [
                'asset_code' => 'AST-000003', 'name' => 'Desktop HP ProDesk 400', 'category_id' => 2,
                'brand_id' => 2, 'vendor_id' => 2, 'department_id' => 2, 'location_id' => 1,
                'serial_number' => 'HP400-001', 'model' => 'ProDesk 400 G7', 'purchase_date' => '2023-06-10',
                'purchase_price' => 12500000, 'warranty_end_date' => '2026-06-10', 'status' => 'available',
                'barcode' => 'BC-AST-000003', 'qr_code' => 'QR-AST-000003',
            ],
            [
                'asset_code' => 'AST-000004', 'name' => 'Monitor Dell 24 inch', 'category_id' => 3,
                'brand_id' => 1, 'vendor_id' => 1, 'department_id' => 1, 'location_id' => 1,
                'serial_number' => 'DLM24-001', 'model' => 'P2422H', 'purchase_date' => '2024-01-15',
                'purchase_price' => 3200000, 'warranty_end_date' => '2027-01-15', 'status' => 'assigned',
                'barcode' => 'BC-AST-000004', 'qr_code' => 'QR-AST-000004',
            ],
            [
                'asset_code' => 'AST-000005', 'name' => 'Printer Epson L3210', 'category_id' => 4,
                'brand_id' => 8, 'vendor_id' => 3, 'department_id' => 3, 'location_id' => 1,
                'serial_number' => 'EPL3210-001', 'model' => 'L3210', 'purchase_date' => '2024-02-20',
                'purchase_price' => 3800000, 'warranty_end_date' => '2025-02-20', 'status' => 'maintenance',
                'barcode' => 'BC-AST-000005', 'qr_code' => 'QR-AST-000005',
            ],
            [
                'asset_code' => 'AST-000006', 'name' => 'Server Dell PowerEdge R750', 'category_id' => 5,
                'brand_id' => 1, 'vendor_id' => 1, 'department_id' => 1, 'location_id' => 4,
                'serial_number' => 'DPR750-001', 'model' => 'PowerEdge R750', 'purchase_date' => '2023-09-01',
                'purchase_price' => 85000000, 'warranty_end_date' => '2028-09-01', 'status' => 'available',
                'barcode' => 'BC-AST-000006', 'qr_code' => 'QR-AST-000006',
            ],
            [
                'asset_code' => 'AST-000007', 'name' => 'Switch Cisco Catalyst 2960', 'category_id' => 6,
                'brand_id' => 7, 'vendor_id' => 1, 'department_id' => 1, 'location_id' => 4,
                'serial_number' => 'CC2960-001', 'model' => 'Catalyst 2960-L', 'purchase_date' => '2023-07-15',
                'purchase_price' => 5500000, 'warranty_end_date' => '2026-07-15', 'status' => 'available',
                'barcode' => 'BC-AST-000007', 'qr_code' => 'QR-AST-000007',
            ],
            [
                'asset_code' => 'AST-000008', 'name' => 'UPS APC 1500VA', 'category_id' => 7,
                'brand_id' => 10, 'vendor_id' => 2, 'department_id' => 1, 'location_id' => 4,
                'serial_number' => 'APC1500-001', 'model' => 'SMT1500I', 'purchase_date' => '2023-05-10',
                'purchase_price' => 4200000, 'warranty_end_date' => '2025-05-10', 'status' => 'damaged',
                'barcode' => 'BC-AST-000008', 'qr_code' => 'QR-AST-000008',
            ],
            [
                'asset_code' => 'AST-000009', 'name' => 'Laptop Asus VivoBook 14', 'category_id' => 1,
                'brand_id' => 4, 'vendor_id' => 3, 'department_id' => 4, 'location_id' => 1,
                'serial_number' => 'AVB14-001', 'model' => 'VivoBook 14 X1402', 'purchase_date' => '2024-05-01',
                'purchase_price' => 9500000, 'warranty_end_date' => '2026-05-01', 'status' => 'draft',
                'barcode' => 'BC-AST-000009', 'qr_code' => 'QR-AST-000009',
            ],
            [
                'asset_code' => 'AST-000010', 'name' => 'Projector Epson EB-X51', 'category_id' => 9,
                'brand_id' => 8, 'vendor_id' => 3, 'department_id' => 6, 'location_id' => 1,
                'serial_number' => 'EPX51-001', 'model' => 'EB-X51', 'purchase_date' => '2024-04-15',
                'purchase_price' => 7800000, 'warranty_end_date' => '2026-04-15', 'status' => 'retired',
                'barcode' => 'BC-AST-000010', 'qr_code' => 'QR-AST-000010',
            ],
        ];

        $users = User::all();

        foreach ($assets as $index => $assetData) {
            $asset = Asset::create($assetData);

            if ($asset->status === 'assigned' && $users->count() > 1) {
                $user = $users[1];
                $asset->update(['assigned_user_id' => $user->id]);

                AssetAssignment::create([
                    'asset_id' => $asset->id,
                    'assigned_to' => $user->id,
                    'assigned_by' => $users[0]->id,
                    'assign_date' => $asset->purchase_date,
                    'status' => 'active',
                ]);
            }

            AssetTimeline::create([
                'asset_id' => $asset->id,
                'user_id' => $users[0]->id,
                'action' => 'created',
                'description' => 'Aset berhasil dibuat di dalam sistem',
            ]);
        }
    }
}
