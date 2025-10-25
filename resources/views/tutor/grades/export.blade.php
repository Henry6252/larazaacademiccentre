<!DOCTYPE html>
<html>
<head>
    <title>Grades Report - {{ $unit->name }}</title>
    <style>
        body { font-family: DejaVu Sans, sans-serif; }
        table { width: 100%; border-collapse: collapse; margin-top: 20px; }
        th, td { border: 1px solid #444; padding: 6px; text-align: left; }
        th { background-color: #eee; }
    </style>
</head>
<body>
    <h2>Grades Report - {{ $unit->name }}</h2>
    <table>
        <thead>
            <tr>
                <th>Student Name</th>
                <th>Average Score</th>
            </tr>
        </thead>
        <tbody>
            @foreach($grades as $g)
                <tr>
                    <td>{{ $g->student_name }}</td>
                    <td>{{ $g->average_score }}%</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>
