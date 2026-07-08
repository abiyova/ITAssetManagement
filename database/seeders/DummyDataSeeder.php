<?php

namespace Database\Seeders;

use App\Models\Asset;
use App\Models\AssetAssignment;
use App\Models\AssetTimeline;
use App\Models\AssetTransfer;
use App\Models\AuditLog;
use App\Models\Brand;
use App\Models\Category;
use App\Models\Department;
use App\Models\Employee;
use App\Models\Location;
use App\Models\Maintenance;
use App\Models\User;
use App\Models\Vendor;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class DummyDataSeeder extends Seeder
{
    private array $categoriesData = [
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
        ['name' => 'Tablet'],
        ['name' => 'Webcam'],
        ['name' => 'Headset'],
        ['name' => 'Storage (HDD/SSD)'],
        ['name' => 'Software License'],
    ];

    private array $brandsData = [
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
        ['name' => 'Apple'],
        ['name' => 'Logitech'],
        ['name' => 'Synology'],
        ['name' => 'Intel'],
        ['name' => 'Western Digital'],
    ];

    private array $vendorsData = [
        ['name' => 'PT Teknologi Maju', 'contact_person' => 'Budi Santoso', 'email' => 'budi@tekmaju.com', 'phone' => '021-5551234', 'address' => 'Jl. Sudirman No. 100, Jakarta'],
        ['name' => 'CV Komputer Plus', 'contact_person' => 'Andi Wijaya', 'email' => 'andi@komplus.com', 'phone' => '021-5555678', 'address' => 'Jl. Gatot Subroto No. 50, Jakarta'],
        ['name' => 'PT Sumber Daya Komputer', 'contact_person' => 'Siti Rahayu', 'email' => 'siti@sdk.co.id', 'phone' => '021-5559012', 'address' => 'Jl. Thamrin No. 25, Jakarta'],
        ['name' => 'PT Mitra Solusi', 'contact_person' => 'Dedi Kurniawan', 'email' => 'dedi@mitrasolusi.co.id', 'phone' => '021-5561234', 'address' => 'Jl. Kuningan No. 88, Jakarta'],
        ['name' => 'CV Digital Nusantara', 'contact_person' => 'Rina Marlina', 'email' => 'rina@digitalnusantara.com', 'phone' => '021-5562345', 'address' => 'Jl. Casablanca No. 12, Jakarta'],
        ['name' => 'PT Infra Teknologi', 'contact_person' => 'Hendra Wijaya', 'email' => 'hendra@infratekno.co.id', 'phone' => '021-5563456', 'address' => 'Jl. Panjang No. 5, Jakarta Barat'],
        ['name' => 'CV Berkah Komputer', 'contact_person' => 'Agus Setiawan', 'email' => 'agus@berkahkomputer.com', 'phone' => '021-5564567', 'address' => 'Jl. Raya Bekasi Km. 5, Jakarta Timur'],
        ['name' => 'PT Cloud Sinergi', 'contact_person' => 'Maya Oktaviani', 'email' => 'maya@cloudsinergi.co.id', 'phone' => '021-5565678', 'address' => 'Jl. TB Simatupang No. 22, Jakarta Selatan'],
    ];

    private array $departmentsData = [
        ['name' => 'IT', 'code' => 'IT'],
        ['name' => 'Finance', 'code' => 'FIN'],
        ['name' => 'Human Resources', 'code' => 'HRD'],
        ['name' => 'Marketing', 'code' => 'MKT'],
        ['name' => 'Operations', 'code' => 'OPS'],
        ['name' => 'General Affairs', 'code' => 'GA'],
        ['name' => 'Legal', 'code' => 'LGL'],
        ['name' => 'Research & Development', 'code' => 'RND'],
        ['name' => 'Customer Service', 'code' => 'CSV'],
        ['name' => 'Procurement', 'code' => 'PRC'],
    ];

    private array $locationsData = [
        ['name' => 'Head Office Jakarta', 'code' => 'HQ-JKT', 'address' => 'Jl. Jendral Sudirman Kav. 52-53', 'city' => 'Jakarta Selatan', 'province' => 'DKI Jakarta'],
        ['name' => 'Branch Office Bandung', 'code' => 'BR-BDG', 'address' => 'Jl. Asia Afrika No. 100', 'city' => 'Bandung', 'province' => 'Jawa Barat'],
        ['name' => 'Warehouse', 'code' => 'WH-01', 'address' => 'Jl. Raya Bogor Km. 30', 'city' => 'Jakarta Timur', 'province' => 'DKI Jakarta'],
        ['name' => 'Data Center', 'code' => 'DC-01', 'address' => 'Jl. Sudirman Kav. 52-53 Lantai 5', 'city' => 'Jakarta Selatan', 'province' => 'DKI Jakarta'],
        ['name' => 'Branch Office Surabaya', 'code' => 'BR-SBY', 'address' => 'Jl. Basuki Rahmat No. 50', 'city' => 'Surabaya', 'province' => 'Jawa Timur'],
        ['name' => 'Branch Office Medan', 'code' => 'BR-MDN', 'address' => 'Jl. Pemuda No. 75', 'city' => 'Medan', 'province' => 'Sumatera Utara'],
        ['name' => 'Branch Office Makassar', 'code' => 'BR-MKS', 'address' => 'Jl. Jendral Sudirman No. 30', 'city' => 'Makassar', 'province' => 'Sulawesi Selatan'],
        ['name' => 'Co-Working Space', 'code' => 'CWS-01', 'address' => 'Jl. Sudirman Kav. 52-53 Lantai 3', 'city' => 'Jakarta Selatan', 'province' => 'DKI Jakarta'],
    ];

    private array $employeesData = [
        ['employee_id' => 'EMP001', 'name' => 'Ahmad Fauzi', 'email' => 'ahmad@company.com', 'phone' => '0812300001', 'department_id' => 1, 'position' => 'IT Manager'],
        ['employee_id' => 'EMP002', 'name' => 'Dewi Lestari', 'email' => 'dewi@company.com', 'phone' => '0812300002', 'department_id' => 1, 'position' => 'System Administrator'],
        ['employee_id' => 'EMP003', 'name' => 'Rizki Pratama', 'email' => 'rizki@company.com', 'phone' => '0812300003', 'department_id' => 1, 'position' => 'Network Engineer'],
        ['employee_id' => 'EMP004', 'name' => 'Sari Indah', 'email' => 'sari@company.com', 'phone' => '0812300004', 'department_id' => 2, 'position' => 'Finance Manager'],
        ['employee_id' => 'EMP005', 'name' => 'Budi Hartono', 'email' => 'budi@company.com', 'phone' => '0812300005', 'department_id' => 3, 'position' => 'HR Manager'],
        ['employee_id' => 'EMP006', 'name' => 'Rina Susanti', 'email' => 'rina@company.com', 'phone' => '0812300006', 'department_id' => 4, 'position' => 'Marketing Manager'],
        ['employee_id' => 'EMP007', 'name' => 'Eko Nugroho', 'email' => 'eko@company.com', 'phone' => '0812300007', 'department_id' => 5, 'position' => 'Operations Manager'],
        ['employee_id' => 'EMP008', 'name' => 'Maya Putri', 'email' => 'maya@company.com', 'phone' => '0812300008', 'department_id' => 6, 'position' => 'GA Staff'],
        ['employee_id' => 'EMP009', 'name' => 'Fajar Ramadhan', 'email' => 'fajar@company.com', 'phone' => '0812300009', 'department_id' => 1, 'position' => 'Junior Developer'],
        ['employee_id' => 'EMP010', 'name' => 'Lestari Wulandari', 'email' => 'lestari@company.com', 'phone' => '0812300010', 'department_id' => 2, 'position' => 'Accounting Staff'],
        ['employee_id' => 'EMP011', 'name' => 'Andri Kurniawan', 'email' => 'andri@company.com', 'phone' => '0812300011', 'department_id' => 3, 'position' => 'Recruitment Specialist'],
        ['employee_id' => 'EMP012', 'name' => 'Putri Ayu', 'email' => 'putri@company.com', 'phone' => '0812300012', 'department_id' => 4, 'position' => 'Content Creator'],
        ['employee_id' => 'EMP013', 'name' => 'Hendra Prasetyo', 'email' => 'hendra@company.com', 'phone' => '0812300013', 'department_id' => 5, 'position' => 'Warehouse Supervisor'],
        ['employee_id' => 'EMP014', 'name' => 'Nina Sari', 'email' => 'nina@company.com', 'phone' => '0812300014', 'department_id' => 7, 'position' => 'Legal Counsel'],
        ['employee_id' => 'EMP015', 'name' => 'Rudi Hermawan', 'email' => 'rudi@company.com', 'phone' => '0812300015', 'department_id' => 8, 'position' => 'R&D Lead'],
        ['employee_id' => 'EMP016', 'name' => 'Siti Nurhaliza', 'email' => 'siti@company.com', 'phone' => '0812300016', 'department_id' => 9, 'position' => 'CS Supervisor'],
        ['employee_id' => 'EMP017', 'name' => 'Tommy Prayogo', 'email' => 'tommy@company.com', 'phone' => '0812300017', 'department_id' => 10, 'position' => 'Procurement Officer'],
        ['employee_id' => 'EMP018', 'name' => 'Angga Saputra', 'email' => 'angga@company.com', 'phone' => '0812300018', 'department_id' => 1, 'position' => 'DevOps Engineer'],
        ['employee_id' => 'EMP019', 'name' => 'Citra Dewi', 'email' => 'citra@company.com', 'phone' => '0812300019', 'department_id' => 4, 'position' => 'Digital Marketing'],
        ['employee_id' => 'EMP020', 'name' => 'Bayu Firmansyah', 'email' => 'bayu@company.com', 'phone' => '0812300020', 'department_id' => 5, 'position' => 'Logistics Staff'],
        ['employee_id' => 'EMP021', 'name' => 'Ratna Sari', 'email' => 'ratna@company.com', 'phone' => '0812300021', 'department_id' => 2, 'position' => 'Tax Specialist'],
        ['employee_id' => 'EMP022', 'name' => 'Dimas Aditya', 'email' => 'dimas@company.com', 'phone' => '0812300022', 'department_id' => 1, 'position' => 'Data Analyst'],
        ['employee_id' => 'EMP023', 'name' => 'Winda Oktavia', 'email' => 'winda@company.com', 'phone' => '0812300023', 'department_id' => 9, 'position' => 'CS Agent'],
        ['employee_id' => 'EMP024', 'name' => 'Ari Setiawan', 'email' => 'ari@company.com', 'phone' => '0812300024', 'department_id' => 8, 'position' => 'Researcher'],
        ['employee_id' => 'EMP025', 'name' => 'Lia Anggraeni', 'email' => 'lia@company.com', 'phone' => '0812300025', 'department_id' => 7, 'position' => 'Compliance Officer'],
    ];

    private array $usersData = [
        ['name' => 'Super Admin', 'email' => 'admin@assetinsight.com', 'role' => 'super-admin'],
        ['name' => 'IT Staff', 'email' => 'itstaff@assetinsight.com', 'role' => 'it-staff'],
        ['name' => 'Manager', 'email' => 'manager@assetinsight.com', 'role' => 'manager'],
        ['name' => 'Auditor', 'email' => 'auditor@assetinsight.com', 'role' => 'auditor'],
        ['name' => 'Rendi SAP', 'email' => 'rendi@assetinsight.com', 'role' => 'it-staff'],
        ['name' => 'Vina Oktavia', 'email' => 'vina@assetinsight.com', 'role' => 'it-staff'],
        ['name' => 'Galih Prasetyo', 'email' => 'galih@assetinsight.com', 'role' => 'manager'],
        ['name' => 'Nanda Pratama', 'email' => 'nanda@assetinsight.com', 'role' => 'it-staff'],
        ['name' => 'Sinta Maharani', 'email' => 'sinta@assetinsight.com', 'role' => 'manager'],
        ['name' => 'Aditya Firmansyah', 'email' => 'aditya@assetinsight.com', 'role' => 'it-staff'],
        ['name' => 'Dian Permata', 'email' => 'dian@assetinsight.com', 'role' => 'auditor'],
        ['name' => 'Farhan Maulana', 'email' => 'farhan@assetinsight.com', 'role' => 'it-staff'],
        ['name' => 'Gita Sari', 'email' => 'gita@assetinsight.com', 'role' => 'manager'],
        ['name' => 'Hadi Nugroho', 'email' => 'hadi@assetinsight.com', 'role' => 'it-staff'],
        ['name' => 'Indah Permata', 'email' => 'indah@assetinsight.com', 'role' => 'it-staff'],
    ];

    // Asset templates by category
    private array $assetTemplates = [
        1 => [ // Laptop
            ['model' => 'Dell Latitude 5540', 'brand_id' => 1, 'price_range' => [16000000, 22000000]],
            ['model' => 'Dell Latitude 5530', 'brand_id' => 1, 'price_range' => [14000000, 18000000]],
            ['model' => 'HP EliteBook 840 G9', 'brand_id' => 2, 'price_range' => [17000000, 23000000]],
            ['model' => 'HP ProBook 440 G9', 'brand_id' => 2, 'price_range' => [12000000, 16000000]],
            ['model' => 'Lenovo ThinkPad T14 Gen 3', 'brand_id' => 3, 'price_range' => [16000000, 21000000]],
            ['model' => 'Lenovo ThinkPad L14', 'brand_id' => 3, 'price_range' => [11000000, 15000000]],
            ['model' => 'Asus VivoBook 14', 'brand_id' => 4, 'price_range' => [8000000, 12000000]],
            ['model' => 'Asus ZenBook 14', 'brand_id' => 4, 'price_range' => [13000000, 18000000]],
            ['model' => 'Acer Swift 3', 'brand_id' => 5, 'price_range' => [9000000, 13000000]],
            ['model' => 'Apple MacBook Air M2', 'brand_id' => 11, 'price_range' => [18000000, 25000000]],
        ],
        2 => [ // Desktop
            ['model' => 'Dell OptiPlex 7010', 'brand_id' => 1, 'price_range' => [12000000, 16000000]],
            ['model' => 'HP ProDesk 400 G9', 'brand_id' => 2, 'price_range' => [11000000, 15000000]],
            ['model' => 'Lenovo ThinkCentre M70s', 'brand_id' => 3, 'price_range' => [10000000, 14000000]],
            ['model' => 'Acer Veriton X4670G', 'brand_id' => 5, 'price_range' => [9000000, 13000000]],
        ],
        3 => [ // Monitor
            ['model' => 'Dell P2422H 24 inch', 'brand_id' => 1, 'price_range' => [2800000, 3500000]],
            ['model' => 'Dell P2723QE 27 inch', 'brand_id' => 1, 'price_range' => [5500000, 7000000]],
            ['model' => 'HP E243m 24 inch', 'brand_id' => 2, 'price_range' => [2500000, 3200000]],
            ['model' => 'Samsung Odyssey G5 27 inch', 'brand_id' => 6, 'price_range' => [3500000, 4500000]],
            ['model' => 'LG 24MP400 24 inch', 'brand_id' => 6, 'price_range' => [2200000, 2800000]],
        ],
        4 => [ // Printer
            ['model' => 'Epson L3210', 'brand_id' => 8, 'price_range' => [3500000, 4200000]],
            ['model' => 'Epson L5290', 'brand_id' => 8, 'price_range' => [4800000, 5500000]],
            ['model' => 'HP LaserJet Pro M404dn', 'brand_id' => 2, 'price_range' => [5000000, 6500000]],
            ['model' => 'Canon imageCLASS MF269dw', 'brand_id' => 9, 'price_range' => [5500000, 7000000]],
        ],
        5 => [ // Server
            ['model' => 'Dell PowerEdge R750', 'brand_id' => 1, 'price_range' => [75000000, 120000000]],
            ['model' => 'Dell PowerEdge R650', 'brand_id' => 1, 'price_range' => [55000000, 85000000]],
            ['model' => 'HP ProLiant DL380 Gen10', 'brand_id' => 2, 'price_range' => [65000000, 100000000]],
        ],
        6 => [ // Network Equipment
            ['model' => 'Cisco Catalyst 2960-L', 'brand_id' => 7, 'price_range' => [4500000, 6500000]],
            ['model' => 'Cisco Catalyst 9200', 'brand_id' => 7, 'price_range' => [8000000, 12000000]],
            ['model' => 'MikroTik RB4011iGS+', 'brand_id' => 7, 'price_range' => [3500000, 5000000]],
            ['model' => 'Ubiquiti UniFi AP AC Pro', 'brand_id' => 7, 'price_range' => [2500000, 3500000]],
        ],
        7 => [ // UPS
            ['model' => 'APC SMT1500I', 'brand_id' => 10, 'price_range' => [3800000, 4800000]],
            ['model' => 'APC SMT2200I', 'brand_id' => 10, 'price_range' => [6500000, 8000000]],
            ['model' => 'Eaton 5P1500', 'brand_id' => 10, 'price_range' => [4200000, 5500000]],
        ],
        8 => [ // Scanner
            ['model' => 'Canon CanoScan 9000F', 'brand_id' => 9, 'price_range' => [4000000, 5500000]],
            ['model' => 'Epson Perfection V600', 'brand_id' => 8, 'price_range' => [3500000, 4800000]],
        ],
        9 => [ // Projector
            ['model' => 'Epson EB-X51', 'brand_id' => 8, 'price_range' => [7000000, 8500000]],
            ['model' => 'Epson EB-FH52', 'brand_id' => 8, 'price_range' => [9500000, 12000000]],
            ['model' => 'BenQ MS550', 'brand_id' => 4, 'price_range' => [5500000, 7000000]],
        ],
        10 => [ // Telephone
            ['model' => 'Cisco IP Phone 8845', 'brand_id' => 7, 'price_range' => [3000000, 4500000]],
            ['model' => 'Yealink T54W', 'brand_id' => 7, 'price_range' => [2500000, 3800000]],
        ],
        11 => [ // Tablet
            ['model' => 'Apple iPad 10th Gen', 'brand_id' => 11, 'price_range' => [7500000, 10000000]],
            ['model' => 'Samsung Galaxy Tab S9', 'brand_id' => 6, 'price_range' => [8000000, 12000000]],
            ['model' => 'Lenovo Tab P12 Pro', 'brand_id' => 3, 'price_range' => [6000000, 9000000]],
        ],
        12 => [ // Webcam
            ['model' => 'Logitech C920 HD Pro', 'brand_id' => 12, 'price_range' => [800000, 1200000]],
            ['model' => 'Logitech Brio 4K', 'brand_id' => 12, 'price_range' => [2200000, 3000000]],
        ],
        13 => [ // Headset
            ['model' => 'Logitech H390', 'brand_id' => 12, 'price_range' => [400000, 600000]],
            ['model' => 'Jabra Evolve2 40', 'brand_id' => 12, 'price_range' => [1500000, 2200000]],
        ],
        14 => [ // Storage
            ['model' => 'Samsung 980 PRO 1TB', 'brand_id' => 6, 'price_range' => [1800000, 2500000]],
            ['model' => 'WD Black SN850X 2TB', 'brand_id' => 15, 'price_range' => [3000000, 4000000]],
            ['model' => 'Synology DS223 NAS', 'brand_id' => 13, 'price_range' => [6500000, 8500000]],
        ],
        15 => [ // Software License
            ['model' => 'Microsoft Office 365 Business', 'brand_id' => 14, 'price_range' => [2500000, 3500000]],
            ['model' => 'Windows 11 Pro License', 'brand_id' => 14, 'price_range' => [2000000, 2800000]],
            ['model' => 'Adobe Creative Cloud', 'brand_id' => 14, 'price_range' => [3000000, 4500000]],
        ],
    ];

    private array $statuses = ['draft', 'available', 'assigned', 'maintenance', 'damaged', 'lost', 'retired', 'disposed'];
    private array $statusWeights = [2, 25, 45, 10, 5, 1, 8, 4]; // approximate distribution per 100

    public function run(): void
    {
        $this->command->info('Seeding additional master data...');

        // Seed master data (only if not already seeded)
        $this->seedCategories();
        $this->seedBrands();
        $this->seedVendors();
        $this->seedDepartments();
        $this->seedLocations();
        $this->seedEmployees();
        $users = $this->seedUsers();

        $categories = Category::all();
        $brands = Brand::all();
        $vendors = Vendor::all();
        $departments = Department::all();
        $locations = Location::all();

        $this->command->info('Creating 100 assets with related data...');

        $assetCounter = 0;
        $years = [2023, 2024, 2025, 2026];
        $assetsPerYear = 25;

        foreach ($years as $year) {
            $this->command->info("Creating {$assetsPerYear} assets for year {$year}...");

            for ($i = 0; $i < $assetsPerYear; $i++) {
                $assetCounter++;
                $categoryId = $categories->random()->id;
                $template = $this->assetTemplates[$categoryId][$this->getRandomIndex($this->assetTemplates[$categoryId])];

                $month = rand(1, 12);
                $day = rand(1, 28);
                $purchaseDate = "{$year}-{$month}-{$day}";

                $warrantyYears = rand(1, 3);
                $warrantyEndDate = date('Y-m-d', strtotime($purchaseDate . " +{$warrantyYears} years"));

                $price = rand($template['price_range'][0], $template['price_range'][1]);
                $price = round($price / 100000) * 100000; // round to nearest 100k

                $status = $this->getWeightedStatus();
                $categoryName = $categories->find($categoryId)->name;
                $brandName = $brands->find($template['brand_id'])->name;

                $assetData = [
                    'asset_code' => 'AST-' . str_pad($assetCounter, 6, '0', STR_PAD_LEFT),
                    'name' => "{$categoryName} {$brandName} {$template['model']}",
                    'category_id' => $categoryId,
                    'brand_id' => $template['brand_id'],
                    'vendor_id' => $vendors->random()->id,
                    'department_id' => $departments->random()->id,
                    'location_id' => $locations->random()->id,
                    'assigned_user_id' => null,
                    'serial_number' => $this->generateSerialNumber($categoryName, $brandName, $assetCounter),
                    'model' => $template['model'],
                    'purchase_date' => $purchaseDate,
                    'purchase_price' => $price,
                    'warranty_end_date' => $warrantyEndDate,
                    'status' => $status,
                    'barcode' => 'BC-' . str_pad($assetCounter, 6, '0', STR_PAD_LEFT),
                    'qr_code' => 'QR-' . str_pad($assetCounter, 6, '0', STR_PAD_LEFT),
                    'description' => $this->generateDescription($categoryName, $brandName, $template['model']),
                ];

                $asset = Asset::create($assetData);

                // Create assignment if status is assigned
                if ($status === 'assigned') {
                    $assignedUser = $users->random();
                    $assignDate = date('Y-m-d', strtotime($purchaseDate . ' +' . rand(0, 30) . ' days'));

                    $asset->update(['assigned_user_id' => $assignedUser->id]);

                    AssetAssignment::create([
                        'asset_id' => $asset->id,
                        'assigned_to' => $assignedUser->id,
                        'assigned_by' => $users->random()->id,
                        'assign_date' => $assignDate,
                        'return_date' => rand(0, 1) ? date('Y-m-d', strtotime($assignDate . ' +' . rand(90, 365) . ' days')) : null,
                        'notes' => $this->randomNotes(),
                        'status' => rand(0, 1) ? 'active' : 'returned',
                    ]);
                }

                // Create timeline
                AssetTimeline::create([
                    'asset_id' => $asset->id,
                    'user_id' => $users->random()->id,
                    'action' => 'created',
                    'description' => 'Aset berhasil dibuat di dalam sistem',
                ]);

                // Add additional timeline entries for some assets
                if (rand(0, 1)) {
                    $this->createAdditionalTimelines($asset, $users);
                }

                // Create transfer for some assets
                if (rand(0, 5) === 0) {
                    $this->createTransfer($asset, $locations, $departments, $users, $year);
                }

                // Create maintenance for some assets
                if (in_array($status, ['maintenance', 'damaged']) || rand(0, 3) === 0) {
                    $this->createMaintenance($asset, $users, $year);
                }
            }
        }

        // Create audit logs
        $this->command->info('Creating audit logs...');
        $this->createAuditLogs($users);

        $this->command->info('Dummy data seeding completed!');
    }

    private function seedCategories(): void
    {
        foreach ($this->categoriesData as $data) {
            Category::firstOrCreate(['name' => $data['name']], $data);
        }
    }

    private function seedBrands(): void
    {
        foreach ($this->brandsData as $data) {
            Brand::firstOrCreate(['name' => $data['name']], $data);
        }
    }

    private function seedVendors(): void
    {
        foreach ($this->vendorsData as $data) {
            Vendor::firstOrCreate(['name' => $data['name']], $data);
        }
    }

    private function seedDepartments(): void
    {
        foreach ($this->departmentsData as $data) {
            Department::firstOrCreate(['name' => $data['name']], $data);
        }
    }

    private function seedLocations(): void
    {
        foreach ($this->locationsData as $data) {
            Location::firstOrCreate(['name' => $data['name']], $data);
        }
    }

    private function seedEmployees(): void
    {
        foreach ($this->employeesData as $data) {
            Employee::firstOrCreate(['employee_id' => $data['employee_id']], $data);
        }
    }

    private function seedUsers(): \Illuminate\Support\Collection
    {
        $users = collect();

        foreach ($this->usersData as $data) {
            $user = User::firstOrCreate(
                ['email' => $data['email']],
                [
                    'name' => $data['name'],
                    'password' => bcrypt('password'),
                    'phone' => '081' . rand(10000000, 99999999),
                ]
            );

            if ($user->hasRole($data['role'])) {
                $user->assignRole($data['role']);
            }

            $users->push($user);
        }

        return $users;
    }

    private function getRandomIndex(array $array): int
    {
        return array_rand($array);
    }

    private function getWeightedStatus(): string
    {
        $totalWeight = array_sum($this->statusWeights);
        $random = rand(1, $totalWeight);
        $cumulative = 0;

        for ($i = 0; $i < count($this->statuses); $i++) {
            $cumulative += $this->statusWeights[$i];
            if ($random <= $cumulative) {
                return $this->statuses[$i];
            }
        }

        return 'available';
    }

    private function generateSerialNumber(string $category, string $brand, int $counter): string
    {
        $prefix = strtoupper(substr($brand, 0, 3));
        $categoryCode = strtoupper(substr($category, 0, 3));
        return "{$prefix}{$categoryCode}-" . str_pad($counter, 5, '0', STR_PAD_LEFT);
    }

    private function generateDescription(string $category, string $brand, string $model): string
    {
        $descriptions = [
            "{$category} {$brand} {$model} untuk penggunaan kantor sehari-hari.",
            "Unit {$category} {$brand} {$model} baru untuk departemen.",
            "{$category} {$brand} {$model} dengan spesifikasi standar kantor.",
            "Pengadaan {$category} {$brand} {$model} tahun berjalan.",
            "{$category} {$brand} {$model} untuk mendukung operasional.",
        ];

        return $descriptions[array_rand($descriptions)];
    }

    private function randomNotes(): ?string
    {
        $notes = [
            'Peminjaman untuk proyek Q1',
            'Digunakan untuk presentasi client',
            'Peminjaman jangka panjang untuk divisi',
            'Untuk keperluan training',
            'Peminjaman untuk work from home',
            null,
        ];

        return $notes[array_rand($notes)];
    }

    private function createAdditionalTimelines(Asset $asset, \Illuminate\Support\Collection $users): void
    {
        $actions = ['updated', 'photo_added', 'status_changed', 'location_changed'];
        $action = $actions[array_rand($actions)];

        $descriptions = [
            'updated' => 'Data aset diperbarui',
            'photo_added' => 'Foto aset ditambahkan',
            'status_changed' => 'Status aset diubah',
            'location_changed' => 'Lokasi aset dipindahkan',
        ];

        AssetTimeline::create([
            'asset_id' => $asset->id,
            'user_id' => $users->random()->id,
            'action' => $action,
            'description' => $descriptions[$action],
            'old_values' => $action === 'status_changed' ? ['status' => 'available'] : null,
            'new_values' => $action === 'status_changed' ? ['status' => $asset->status] : null,
        ]);
    }

    private function createTransfer(Asset $asset, $locations, $departments, \Illuminate\Support\Collection $users, int $year): void
    {
        $fromLocation = $locations->random();
        $toLocation = $locations->where('id', '!=', $fromLocation->id)->random();

        $reasons = [
            'Relokasi kantor',
            'Pemindahan divisi',
            'Permintaan cabang baru',
            'Optimasi ruang',
            'Penggantian unit lama',
        ];

        $transferDate = "{$year}-" . str_pad(rand(1, 12), 2, '0', STR_PAD_LEFT) . '-' . str_pad(rand(1, 28), 2, '0', STR_PAD_LEFT);

        AssetTransfer::create([
            'asset_id' => $asset->id,
            'from_location_id' => $fromLocation->id,
            'to_location_id' => $toLocation->id,
            'from_department_id' => $departments->random()->id,
            'to_department_id' => $departments->random()->id,
            'transferred_by' => $users->random()->id,
            'transfer_date' => $transferDate,
            'reason' => $reasons[array_rand($reasons)],
            'status' => 'completed',
        ]);
    }

    private function createMaintenance(Asset $asset, \Illuminate\Support\Collection $users, int $year): void
    {
        $types = ['preventive', 'corrective'];
        $statuses = ['scheduled', 'in_progress', 'completed', 'cancelled'];

        $scheduleDate = "{$year}-" . str_pad(rand(1, 12), 2, '0', STR_PAD_LEFT) . '-' . str_pad(rand(1, 28), 2, '0', STR_PAD_LEFT);

        $notes = [
            'Pengecekan berkala',
            'Penggantian komponen',
            'Perbaikan ringan',
            'Upgrade firmware',
            'Pembersihan unit',
            'Penggantian baterai',
            'Perbaikan hardware',
        ];

        $status = $statuses[array_rand($statuses)];

        Maintenance::create([
            'asset_id' => $asset->id,
            'technician_id' => rand(0, 1) ? $users->random()->id : null,
            'type' => $types[array_rand($types)],
            'schedule_date' => $scheduleDate,
            'start_date' => in_array($status, ['in_progress', 'completed']) ? $scheduleDate : null,
            'end_date' => $status === 'completed' ? date('Y-m-d', strtotime($scheduleDate . ' +' . rand(1, 7) . ' days')) : null,
            'cost' => rand(50000, 5000000),
            'status' => $status,
            'notes' => $notes[array_rand($notes)],
        ]);
    }

    private function createAuditLogs(\Illuminate\Support\Collection $users): void
    {
        $actions = ['created', 'updated', 'deleted', 'assigned', 'transferred', 'maintained'];
        $subjects = [
            ['type' => 'App\Models\Asset', 'model' => Asset::class],
            ['type' => 'App\Models\User', 'model' => User::class],
            ['type' => 'App\Models\Category', 'model' => Category::class],
        ];

        $ips = [
            '192.168.1.100', '192.168.1.101', '192.168.1.102',
            '10.0.0.50', '10.0.0.51', '10.0.0.52',
        ];

        for ($i = 0; $i < 75; $i++) {
            $year = rand(2023, 2026);
            $month = rand(1, 12);
            $day = rand(1, 28);
            $hour = rand(8, 17);
            $minute = rand(0, 59);

            $subject = $subjects[array_rand($subjects)];
            $subjectModel = $subject['model'];
            $subjectId = $subjectModel::inRandomOrder()->first()?->id;

            AuditLog::create([
                'user_id' => $users->random()->id,
                'action' => $actions[array_rand($actions)],
                'subject_type' => $subject['type'],
                'subject_id' => $subjectId,
                'old_values' => rand(0, 1) ? ['name' => 'Old Name'] : null,
                'new_values' => rand(0, 1) ? ['name' => 'New Name'] : null,
                'ip_address' => $ips[array_rand($ips)],
                'user_agent' => 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36',
                'created_at' => "{$year}-{$month}-{$day} {$hour}:{$minute}:00",
                'updated_at' => "{$year}-{$month}-{$day} {$hour}:{$minute}:00",
            ]);
        }
    }
}
