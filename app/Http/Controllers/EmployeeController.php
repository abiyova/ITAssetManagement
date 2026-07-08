<?php

namespace App\Http\Controllers;

use App\Models\Department;
use App\Models\Employee;
use Illuminate\Http\Request;

class EmployeeController extends Controller
{
    public function index(Request $request)
    {
        $employees = Employee::with('department')
            ->when($request->search, fn ($q, $s) => $q->where('name', 'like', "%{$s}%")->orWhere('employee_id', 'like', "%{$s}%"))
            ->latest()
            ->paginate(10);

        return view('master-data.employees.index', compact('employees'));
    }

    public function create()
    {
        $departments = Department::orderBy('name')->get();
        return view('master-data.employees.create', compact('departments'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'employee_id' => 'required|string|max:20|unique:employees,employee_id',
            'name' => 'required|string|max:255',
            'email' => 'nullable|email|max:255',
            'phone' => 'nullable|string|max:20',
            'department_id' => 'required|exists:departments,id',
            'position' => 'nullable|string|max:255',
        ]);

        Employee::create($validated);
        return redirect()->route('employees.index')->with('success', 'Karyawan berhasil ditambahkan.');
    }

    public function edit(Employee $employee)
    {
        $departments = Department::orderBy('name')->get();
        return view('master-data.employees.edit', compact('employee', 'departments'));
    }

    public function update(Request $request, Employee $employee)
    {
        $validated = $request->validate([
            'employee_id' => 'required|string|max:20|unique:employees,employee_id,' . $employee->id,
            'name' => 'required|string|max:255',
            'email' => 'nullable|email|max:255',
            'phone' => 'nullable|string|max:20',
            'department_id' => 'required|exists:departments,id',
            'position' => 'nullable|string|max:255',
        ]);

        $employee->update($validated);
        return redirect()->route('employees.index')->with('success', 'Karyawan berhasil diperbarui.');
    }

    public function destroy(Employee $employee)
    {
        $employee->delete();
        return redirect()->route('employees.index')->with('success', 'Karyawan berhasil dihapus.');
    }
}
