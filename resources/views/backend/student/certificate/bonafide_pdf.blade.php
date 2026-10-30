<!DOCTYPE html>
<html>
<head>
<title>Bonafide Certificate</title>
<style>
    body {
        font-family: 'Georgia', serif;
        color: #2d3748;
        margin: 30px;
    }
    .cert-frame {
        border: 5px solid #2b6cb0;
        outline: 2px solid #cbd5e0;
        outline-offset: -12px;
        padding: 40px;
    }
    .header {
        text-align: center;
        border-bottom: 2px solid #2b6cb0;
        padding-bottom: 15px;
        margin-bottom: 30px;
    }
    .header h1 {
        margin: 0;
        font-size: 24px;
        color: #2b6cb0;
        letter-spacing: 1px;
    }
    .header p {
        margin: 4px 0;
        font-size: 11px;
        font-family: 'Helvetica Neue', Arial, sans-serif;
        color: #4a5568;
    }
    .cert-title {
        text-align: center;
        margin: 30px 0;
    }
    .cert-title h2 {
        display: inline-block;
        font-size: 20px;
        color: #1a202c;
        text-transform: uppercase;
        letter-spacing: 2px;
        border-bottom: 2px solid #2b6cb0;
        padding-bottom: 8px;
    }
    .cert-body {
        font-size: 14px;
        line-height: 2.2;
        text-align: justify;
        margin: 30px 10px;
    }
    .highlight {
        font-weight: bold;
        text-decoration: underline;
        color: #1a202c;
    }
    .footer {
        margin-top: 60px;
        width: 100%;
        font-size: 13px;
        font-family: 'Helvetica Neue', Arial, sans-serif;
    }
    .footer td {
        vertical-align: bottom;
    }
</style>
</head>
<body>

<div class="cert-frame">
    <div class="header">
        <h1>{{ $school->school_name ?? 'Shiksha Mitra Public School' }}</h1>
        <p>{{ $school->address ?? 'Campus 1, Vidya Marg, Knowledge Park' }}</p>
        <p>Affiliated to {{ $school->board ?? 'CBSE' }} | Affiliation No: {{ $school->affiliation_no ?? 'CBSE/AFF/2026/8942' }}</p>
    </div>

    <table width="100%" style="font-size: 12px; margin-bottom: 20px;">
        <tr>
            <td align="left"><strong>Ref No:</strong> {{ $cert_no }}</td>
            <td align="right"><strong>Date:</strong> {{ $issue_date }}</td>
        </tr>
    </table>

    <div class="cert-title">
        <h2>BONAFIDE CERTIFICATE</h2>
    </div>

    <div class="cert-body">
        This is to certify that <span class="highlight">{{ strtoupper($details->student->name ?? 'Student') }}</span>, 
        Son / Daughter of Shri <span class="highlight">{{ strtoupper($details->student->fname ?? 'N/A') }}</span>, 
        bearing Scholar / Admission Number <span class="highlight">{{ $details->student->id_no ?? 'N/A' }}</span>, 
        is a bonafide student of this institution studying in Class <span class="highlight">{{ $details->student_class->name ?? 'N/A' }}</span> 
        during the academic year <span class="highlight">{{ $details->student_year->name ?? '2026' }}</span>.
        <br><br>
        To the best of our school records, his/her date of birth is 
        <span class="highlight">{{ !empty($details->student->dob) ? date('d-m-Y', strtotime($details->student->dob)) : 'recorded in admission register' }}</span>. 
        He / She bears a good moral character and conduct.
        <br><br>
        This certificate is issued on the request of the parent for official verification purposes.
    </div>

    <table class="footer">
        <tr>
            <td align="left" width="50%">
                <br><br><br>
                <strong>Admin Officer / In-Charge</strong>
            </td>
            <td align="right" width="50%">
                <br><br><br>
                <strong>Principal / Headmaster</strong><br>
                <small>Shiksha Mitra Public School</small>
            </td>
        </tr>
    </table>
</div>

</body>
</html>
