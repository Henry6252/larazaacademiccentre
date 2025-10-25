<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Facades\Excel;
use Barryvdh\DomPDF\Facade\Pdf;
use App\Exports\AdminGradesExport;

class GradeExportController extends Controller
{
    public function exportExcel()
    {
        return Excel::download(new AdminGradesExport, 'all_student_grades.xlsx');
    }

    public function exportPDF()
    {
        $grades = DB::table('student_grades')->get();
        $pdf = Pdf::loadView('admin.grades.export', compact('grades'));
        return $pdf->download('all_student_grades.pdf');
    }
}
