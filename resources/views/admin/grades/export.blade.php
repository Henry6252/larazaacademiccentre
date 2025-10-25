<!DOCTYPE html>
<html>
<head>
    <title>All Student Grades</title>
    <style>
        body { font-family: DejaVu Sans, sans-serif; }
        table { width: 100%; border-collapse: collapse; margin-top: 20px; }
        th, td { border: 1px solid #444; padding: 6px; text-align: left; font-size: 12px; }
        th { background-color: #eee; }
    </style>
</head>
<body>
    <h2>All Students Grade Report</h2>
    <table>
        <thead>
            <tr>
                <th>Student</th>
                <th>Course</th>
                <th>Unit</th>
                <th>Tutor</th>
                <th>Average</th>
            </tr>
        </thead>
        <tbody>
            @foreach($grades as $g)
                <tr>
                    <td>{{ $g->student_name }}</td>
                    <td>{{ $g->course_title }}</td>
                    <td>{{ $g->unit_name }}</td>
                    <td>{{ $g->tutor_name }}</td>
                    <td>{{ $g->average_score }}%</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>
