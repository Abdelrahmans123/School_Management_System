<?php

namespace App\Repository\Classes\Admin;

use App\Models\Attendance;
use App\Models\Student;
use App\Repository\Interfaces\Admin\AdminRepositoryInterface;
use Illuminate\Support\Facades\Lang;

class AdminRepository implements AdminRepositoryInterface
{
    public function index()
    {
        // Attendance summary
        $summary = Attendance::selectRaw('status, COUNT(*) as count')
            ->groupBy('status')
            ->get();

        // Enrollment data
        $enrollmentData = Student::selectRaw('YEAR(created_at) as year, MONTH(created_at) as month, COUNT(id) as count')
            ->groupBy('year', 'month')
            ->orderBy('year', 'asc')
            ->orderBy('month', 'asc')
            ->get()
            ->map(function ($item) {
                // Format the date as "Month Year" (e.g., "January 2023")
                $item->formatted_date = date('F Y', mktime(0, 0, 0, $item->month, 1, $item->year));
                return $item;
            });
        $langFile = 'datatables'; // Language file name without the language prefix
        $translations = Lang::get($langFile);
        return view('pages.admin.Dashboard.dashboard', compact('summary', 'enrollmentData', 'translations'));
    }
}
