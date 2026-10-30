<!DOCTYPE html>
<html>
<head>
<title>Transfer Certificate</title>
<style>
    body {
        font-family: 'Helvetica Neue', Helvetica, Arial, sans-serif;
        color: #333;
        margin: 20px;
    }
    .cert-border {
        border: 4px double #1a365d;
        padding: 25px;
    }
    .header {
        text-align: center;
        border-bottom: 2px solid #1a365d;
        padding-bottom: 12px;
        margin-bottom: 20px;
    }
    .header h1 {
        margin: 0;
        font-size: 22px;
        color: #1a365d;
        text-transform: uppercase;
        letter-spacing: 1px;
    }
    .header p {
        margin: 3px 0;
        font-size: 11px;
        color: #555;
    }
    .cert-title {
        text-align: center;
        margin: 15px 0 25px 0;
    }
    .cert-title h2 {
        display: inline-block;
        border-bottom: 2px solid #c53030;
        padding-bottom: 5px;
        color: #c53030;
        font-size: 18px;
        letter-spacing: 1px;
        margin: 0;
    }
    .meta-table {
        width: 100%;
        margin-bottom: 20px;
        font-size: 12px;
    }
    .cert-table {
        width: 100%;
        border-collapse: collapse;
        font-size: 12px;
        line-height: 1.8;
    }
    .cert-table td {
        padding: 6px 4px;
        vertical-align: top;
    }
    .field-name {
        width: 40%;
        color: #4a5568;
    }
    .dots {
        width: 2%;
        text-align: center;
    }
    .field-val {
        width: 58%;
        font-weight: bold;
        color: #1a202c;
        border-bottom: 1px dotted #718096;
    }
    .signatures {
        margin-top: 50px;
        width: 100%;
        font-size: 12px;
    }
    .signatures td {
        text-align: center;
        padding-top: 40px;
    }
</style>
</head>
<body>

<div class="cert-border">
    <div class="header">
        <h1>{{ $school->school_name ?? 'Shiksha Mitra Public School' }}</h1>
        <p>{{ $school->address ?? 'Campus 1, Vidya Marg, Knowledge Park' }}</p>
        <p>Affiliated to {{ $school->board ?? 'CBSE' }} | Affiliation No: {{ $school->affiliation_no ?? 'CBSE/AFF/2026/8942' }} | School Code: {{ $school->school_code ?? 'SMPS-1029' }}</p>
        <p>Email: {{ $school->email ?? 'contact@shikshamitra.edu.in' }} | Tel: {{ $school->phone ?? '+91 98765 43210' }}</p>
    </div>

    <div class="cert-title">
        <h2>TRANSFER / SCHOOL LEAVING CERTIFICATE</h2>
    </div>

    <table class="meta-table">
        <tr>
            <td align="left"><strong>TC Serial No:</strong> {{ $tc_no }}</td>
            <td align="right"><strong>Admission / Scholar No:</strong> {{ $details->student->id_no ?? 'N/A' }}</td>
        </tr>
        <tr>
            <td align="left"><strong>Academic Session:</strong> {{ $details->student_year->name ?? '2026' }}</td>
            <td align="right"><strong>Date of Issue:</strong> {{ $issue_date }}</td>
        </tr>
    </table>

    <table class="cert-table">
        <tr>
            <td class="field-name">1. Name of the Pupil</td>
            <td class="dots">:</td>
            <td class="field-val">{{ strtoupper($details->student->name ?? 'Student') }}</td>
        </tr>
        <tr>
            <td class="field-name">2. Father's / Guardian's Name</td>
            <td class="dots">:</td>
            <td class="field-val">{{ strtoupper($details->student->fname ?? 'N/A') }}</td>
        </tr>
        <tr>
            <td class="field-name">3. Mother's Name</td>
            <td class="dots">:</td>
            <td class="field-val">{{ strtoupper($details->student->mname ?? 'N/A') }}</td>
        </tr>
        <tr>
            <td class="field-name">4. Nationality & Religion</td>
            <td class="dots">:</td>
            <td class="field-val">{{ $details->student->religion ?? 'Indian' }}</td>
        </tr>
        <tr>
            <td class="field-name">5. Date of Birth (in Christian Era)</td>
            <td class="dots">:</td>
            <td class="field-val">{{ !empty($details->student->dob) ? date('d-m-Y', strtotime($details->student->dob)) : 'As per record' }}</td>
        </tr>
        <tr>
            <td class="field-name">6. Class in which pupil last studied</td>
            <td class="dots">:</td>
            <td class="field-val">{{ $details->student_class->name ?? 'N/A' }}</td>
        </tr>
        <tr>
            <td class="field-name">7. School / Board Annual Exam last taken</td>
            <td class="dots">:</td>
            <td class="field-val">Promoted / Passed</td>
        </tr>
        <tr>
            <td class="field-name">8. Month up to which school dues paid</td>
            <td class="dots">:</td>
            <td class="field-val">All Dues Cleared (March 2026)</td>
        </tr>
        <tr>
            <td class="field-name">9. Reason for leaving the school</td>
            <td class="dots">:</td>
            <td class="field-val">Parents Transfer / Higher Studies</td>
        </tr>
        <tr>
            <td class="field-name">10. General Conduct & Character</td>
            <td class="dots">:</td>
            <td class="field-val">Exemplary / Good</td>
        </tr>
    </table>

    <table class="signatures">
        <tr>
            <td width="33%">Class Teacher</td>
            <td width="34%">Checked By (Admin Office)</td>
            <td width="33%">Principal / Headmaster<br><small>(Official Stamp)</small></td>
        </tr>
    </table>
</div>

</body>
</html>
