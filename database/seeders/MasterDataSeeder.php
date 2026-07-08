<?php

namespace Database\Seeders;

use App\Models\Brand;
use App\Models\Category;
use App\Models\Department;
use App\Models\Employee;
use App\Models\Location;
use App\Models\Vendor;
use Illuminate\Database\Seeder;

class MasterDataSeeder extends Seeder
{
    public function run(): void
    {
        $categories = [
            ['name' => 'Laptop'],
            ['name' => 'Desktop'],
            ['name' => 'Monitor'],
            ['name' => 'Printer'],
            ['name' => 'Server'],
            ['name' => 'Network Equipment'],
            ['name' => 'UPS'],
            ['name' => 'Scanner'],
            ['name' => 'Projector'],
            ['name' => 'Telephone'],
        ];

        foreach ($categories as $category) {
            Category::create($category);
        }

        $brands = [
            ['name' => 'Dell'],
            ['name' => 'HP'],
            ['name' => 'Lenovo'],
            ['name' => 'Asus'],
            ['name' => 'Acer'],
            ['name' => 'Samsung'],
            ['name' => 'Cisco'],
            ['name' => 'Epson'],
            ['name' => 'Canon'],
            ['name' => 'APC'],
        ];

        foreach ($brands as $brand) {
            Brand::create($brand);
        }

        $vendors = [
            ['name' => 'PT Teknologi Maju', 'contact_person' => 'Budi Santoso', 'email' => 'budi@tekmaju.com', 'phone' => '021-5551234', 'address' => 'Jl. Sudirman No. 100, Jakarta'],
            ['name' => 'CV Komputer Plus', 'contact_person' => 'Andi Wijaya', 'email' => 'andi@komplus.com', 'phone' => '021-5555678', 'address' => 'Jl. Gatot Subroto No. 50, Jakarta'],
            ['name' => 'PT Sumber Daya Komputer', 'contact_person' => 'Siti Rahayu', 'email' => 'siti@sdk.co.id', 'phone' => '021-5559012', 'address' => 'Jl. Thamrin No. 25, Jakarta'],
        ];

        foreach ($vendors as $vendor) {
            Vendor::create($vendor);
        }

        $departments = [
            ['name' => 'IT', 'code' => 'IT'],
            ['name' => 'Finance', 'code' => 'FIN'],
            ['name' => 'Human Resources', 'code' => 'HRD'],
            ['name' => 'Marketing', 'code' => 'MKT'],
            ['name' => 'Operations', 'code' => 'OPS'],
            ['name' => 'General Affairs', 'code' => 'GA'],
        ];

        foreach ($departments as $department) {
            Department::create($department);
        }

        $locations = [
            ['name' => 'Head Office Jakarta', 'code' => 'HQ-JKT', 'address' => 'Jl. Jendral Sudirman Kav. 52-53', 'city' => 'Jakarta Selatan', 'province' => 'DKI Jakarta'],
            ['name' => 'Branch Office Bandung', 'code' => 'BR-BDG', 'address' => 'Jl. Asia Afrika No. 100', 'city' => 'Bandung', 'province' => 'Jawa Barat'],
            ['name' => 'Warehouse', 'code' => 'WH-01', 'address' => 'Jl. Raya Bogor Km. 30', 'city' => 'Jakarta Timur', 'province' => 'DKI Jakarta'],
            ['name' => 'Data Center', 'code' => 'DC-01', 'address' => 'Jl. Sudirman Kav. 52-53 Lantai 5', 'city' => 'Jakarta Selatan', 'province' => 'DKI Jakarta'],
        ];

        foreach ($locations as $location) {
            Location::create($location);
        }

        $employees = [
            ['employee_id' => 'EMP001', 'name' => 'Ahmad Fauzi', 'email' => 'ahmad@company.com', 'phone' => '0812300001', 'department_id' => 1, 'position' => 'IT Manager'],
            ['employee_id' => 'EMP002', 'name' => 'Dewi Lestari', 'email' => 'dewi@company.com', 'phone' => '0812300002', 'department_id' => 1, 'position' => 'System Administrator'],
            ['employee_id' => 'EMP003', 'name' => 'Rizki Pratama', 'email' => 'rizki@company.com', 'phone' => '0812300003', 'department_id' => 1, 'position' => 'Network Engineer'],
            ['employee_id' => 'EMP004', 'name' => 'Sari Indah', 'email' => 'sari@company.com', 'phone' => '0812300004', 'department_id' => 2, 'position' => 'Finance Manager'],
            ['employee_id' => 'EMP005', 'name' => 'Budi Hartono', 'email' => 'budi@company.com', 'phone' => '0812300005', 'department_id' => 3, 'position' => 'HR Manager'],
            ['employee_id' => 'EMP006', 'name' => 'Rina Susanti', 'email' => 'rina@company.com', 'phone' => '0812300006', 'department_id' => 4, 'position' => 'Marketing Manager'],
            ['employee_id' => 'EMP007', 'name' => 'Eko Nugroho', 'email' => 'eko@company.com', 'phone' => '0812300007', 'department_id' => 5, 'position' => 'Operations Manager'],
            ['employee_id' => 'EMP008', 'name' => 'Maya Putri', 'email' => 'maya@company.com', 'phone' => '0812300008', 'department_id' => 6, 'position' => 'GA Staff'],
        ];

        foreach ($employees as $employee) {
            Employee::create($employee);
        }
    }
}
