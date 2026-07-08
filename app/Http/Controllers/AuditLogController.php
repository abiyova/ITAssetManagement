<?php

namespace App\Http\Controllers;

use App\Models\AuditLog;
use Illuminate\Http\Request;

class AuditLogController extends Controller
{
    public function index(Request $request)
    {
        $logs = AuditLog::with('user')
            ->when($request->action, fn ($q, $a) => $q->where('action', $a))
            ->latest()
            ->paginate(20);

        return view('audit-logs.index', compact('logs'));
    }
}
