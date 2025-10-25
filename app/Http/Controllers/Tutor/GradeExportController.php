<?php

namespace App\Http\Controllers\Tutor;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Facades\Excel;
use Barryvdh\DomPDF\Facade\Pdf;
use App\Exports\TutorGradesExport;
use App\Models\CourseUnit;

class GradeExportController extends Controller
{
    public function exportExcel($courseUnitId)
    {
        $unit = CourseUnit::findOrFail($courseUnitId);
        return Excel::download(new TutorGradesExport($courseUnitId), 'grades_' . $unit->name . '.xlsx');
    }

    public function exportPDF($courseUnitId)
    {
        $unit = CourseUnit::findOrFail($courseUnitId);

        $grades = DB::table('student_grades')
            ->where('tutor_id', auth()->id())
            ->where('course_unit_id', $courseUnitId)
            ->get();

        $pdf = Pdf::loadView('tutor.grades.export', compact('unit', 'grades'));
        return $pdf->download('grades_' . $unit->name . '.pdf');
    }
}
