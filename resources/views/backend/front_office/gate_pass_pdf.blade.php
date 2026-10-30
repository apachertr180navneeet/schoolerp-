<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Visitor Gate Pass - {{ $visitor->pass_number }}</title>
    <style>
        body { font-family: 'DejaVu Sans', sans-serif; font-size: 12px; margin: 20px; color: #222; }
        .pass-box { border: 2px dashed #002147; padding: 25px; border-radius: 8px; width: 500px; margin: 0 auto; }
        .header { text-align: center; border-bottom: 2px solid #002147; padding-bottom: 12px; margin-bottom: 15px; }
        .school-name { font-size: 18px; font-weight: bold; color: #002147; text-transform: uppercase; }
        .pass-title { font-size: 14px; font-weight: bold; margin-top: 5px; color: #d9534f; }
        .table-data { width: 100%; margin-top: 10px; border-collapse: collapse; }
        .table-data td { padding: 6px 4px; }
        .label { font-weight: bold; width: 35%; color: #555; }
        .footer { margin-top: 25px; text-align: right; }
        .signature-line { display: inline-block; width: 180px; border-top: 1px solid #333; text-align: center; padding-top: 4px; font-size: 11px; }
    </style>
</head>
<body>

<div class="pass-box">
    <div class="header">
        <div class="school-name">SHIKSHA MITRA PUBLIC SCHOOL</div>
        <div style="font-size: 10px; color: #666;">CBSE Affiliated Senior Secondary School</div>
        <div class="pass-title">OFFICIAL VISITOR GATE PASS</div>
    </div>

    <table class="table-data">
        <tr>
            <td class="label">Pass Number:</td>
            <td><strong>{{ $visitor->pass_number }}</strong></td>
        </tr>
        <tr>
            <td class="label">Visitor Name:</td>
            <td><strong>{{ $visitor->name }}</strong></td>
        </tr>
        <tr>
            <td class="label">Contact Phone:</td>
            <td>{{ $visitor->phone }}</td>
        </tr>
        <tr>
            <td class="label">Person to Meet:</td>
            <td><strong>{{ $visitor->person_to_meet }}</strong></td>
        </tr>
        <tr>
            <td class="label">Purpose of Visit:</td>
            <td>{{ $visitor->purpose }}</td>
        </tr>
        <tr>
            <td class="label">Check-in Time:</td>
            <td>{{ date('d-M-Y H:i:s', strtotime($visitor->check_in)) }}</td>
        </tr>
        <tr>
            <td class="label">No. of Persons:</td>
            <td>{{ $visitor->number_of_persons }}</td>
        </tr>
        <tr>
            <td class="label">ID Proof:</td>
            <td>{{ $visitor->id_proof_type }} ({{ $visitor->id_proof_number ?? 'Verified' }})</td>
        </tr>
    </table>

    <div class="footer">
        <div class="signature-line">
            Security Gate Officer
        </div>
    </div>
</div>

</body>
</html>
