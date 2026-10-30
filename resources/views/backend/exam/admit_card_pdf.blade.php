<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Admit Card - {{ $assignStudent->student->id_no }}</title>
    <style>
        body { font-family: 'DejaVu Sans', sans-serif; font-size: 11px; margin: 15px; color: #222; }
        .border-box { border: 2px solid #002147; padding: 20px; border-radius: 6px; }
        .header { text-align: center; border-bottom: 2px solid #002147; padding-bottom: 8px; margin-bottom: 12px; }
        .school-name { font-size: 18px; font-weight: bold; color: #002147; text-transform: uppercase; }
        .sub-header { font-size: 10px; color: #555; }
        .doc-title { font-size: 14px; font-weight: bold; margin-top: 6px; color: #d9534f; text-transform: uppercase; }
        .info-table { width: 100%; margin-bottom: 15px; border-collapse: collapse; }
        .info-table td { padding: 4px 6px; font-size: 11px; }
        .schedule-table { width: 100%; border-collapse: collapse; margin-top: 10px; }
        .schedule-table th, .schedule-table td { border: 1px solid #333; padding: 6px 8px; text-align: left; }
        .schedule-table th { background-color: #f2f2f2; font-weight: bold; }
        .footer { margin-top: 35px; width: 100%; }
        .footer td { text-align: center; font-size: 11px; padding-top: 30px; }
        .instructions { margin-top: 15px; font-size: 9px; color: #555; }
    </style>
</head>
<body>

<div class="border-box">
    <div class="header">
        <div class="school-name">{{ $school->school_name ?? 'SHIKSHA MITRA PUBLIC SCHOOL' }}</div>
        <div class="sub-header">Affiliated to Central Board of Secondary Education (CBSE) | Affiliation No: 2130892</div>
        <div class="doc-title">EXAMINATION ADMIT CARD / HALL TICKET - {{ $examType->name }}</div>
    </div>

    <table class="info-table">
        <tr>
            <td width="20%"><strong>Student Name:</strong></td>
            <td width="30%">{{ $assignStudent->student->name }}</td>
            <td width="20%"><strong>Admission / Roll:</strong></td>
            <td width="30%">{{ $assignStudent->student->id_no }} / {{ $assignStudent->roll ?? 'N/A' }}</td>
        </tr>
        <tr>
            <td><strong>Class & Section:</strong></td>
            <td>{{ $assignStudent->student_class->name ?? '' }}</td>
            <td><strong>Academic Session:</strong></td>
            <td>{{ $assignStudent->year->name ?? '2026-2027' }}</td>
        </tr>
        <tr>
            <td><strong>Father's Name:</strong></td>
            <td>{{ $assignStudent->student->fname ?? 'N/A' }}</td>
            <td><strong>Emergency Mobile:</strong></td>
            <td>{{ $assignStudent->student->mobile ?? 'N/A' }}</td>
        </tr>
    </table>

    <table class="schedule-table">
        <thead>
            <tr>
                <th width="8%">#</th>
                <th width="32%">Subject Paper</th>
                <th width="20%">Date</th>
                <th width="22%">Timing</th>
                <th width="18%">Room / Hall</th>
            </tr>
        </thead>
        <tbody>
            @forelse($schedules as $key => $slot)
            <tr>
                <td>{{ $key + 1 }}</td>
                <td><strong>{{ $slot->school_subject->name ?? 'Subject' }}</strong></td>
                <td>{{ date('d-M-Y', strtotime($slot->exam_date)) }}</td>
                <td>{{ $slot->start_time }} - {{ $slot->end_time }}</td>
                <td>{{ $slot->room_no }}</td>
            </tr>
            @empty
            <tr>
                <td colspan="5" style="text-align: center;">No timetable slots published yet for this class.</td>
            </tr>
            @endforelse
        </tbody>
    </table>

    <div class="instructions">
        <strong>Important Instructions:</strong>
        <ol style="margin-top: 4px; padding-left: 20px;">
            <li>Candidate must carry this Admit Card to every examination session. No entry permitted without admit card.</li>
            <li>Entry to examination hall closes 15 minutes prior to scheduled start time.</li>
            <li>Electronic gadgets, smartwatches, and programmable calculators are strictly prohibited.</li>
        </ol>
    </div>

    <table class="footer">
        <tr>
            <td width="33%">_____________________<br>Student Signature</td>
            <td width="33%">_____________________<br>Class Teacher</td>
            <td width="33%">_____________________<br>Controller of Examinations</td>
        </tr>
    </table>
</div>

</body>
</html>
