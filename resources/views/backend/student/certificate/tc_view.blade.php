@extends('admin.admin_master')
@section('admin')

<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header d-flex justify-content-between align-items-center">
                <div>
                    <h5 class="card-title mb-1">Transfer Certificate (TC / SLC) Generation</h5>
                    <p class="text-muted small mb-0">Generate official CBSE/Board compliant School Leaving and Transfer Certificates</p>
                </div>
            </div>
            <div class="card-body">
                <form method="get" action="{{ route('certificate.tc.view') }}" class="mb-4 p-3 bg-light rounded border">
                    <div class="row align-items-end g-3">
                        <div class="col-md-5">
                            <label class="form-label font-weight-bold">Academic Session</label>
                            <select name="year_id" class="form-select">
                                @foreach($years as $yr)
                                <option value="{{ $yr->id }}" {{ $year_id == $yr->id ? 'selected' : '' }}>{{ $yr->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-5">
                            <label class="form-label font-weight-bold">Class</label>
                            <select name="class_id" class="form-select">
                                @foreach($classes as $cls)
                                <option value="{{ $cls->id }}" {{ $class_id == $cls->id ? 'selected' : '' }}>{{ $cls->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-2">
                            <button type="submit" class="btn btn-primary w-100">Find Students</button>
                        </div>
                    </div>
                </form>

                <div class="table-responsive">
                    <table class="table table-bordered table-striped align-middle">
                        <thead class="table-light">
                            <tr>
                                <th width="5%">SL</th>
                                <th>Admission / ID</th>
                                <th>Student Name</th>
                                <th>Father Name</th>
                                <th>Gender</th>
                                <th>Class</th>
                                <th width="20%">Certificate</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($students as $key => $st)
                            <tr>
                                <td>{{ $key + 1 }}</td>
                                <td><span class="badge bg-secondary">{{ $st->student->id_no ?? 'N/A' }}</span></td>
                                <td><strong>{{ $st->student->name ?? 'Student' }}</strong></td>
                                <td>{{ $st->student->fname ?? 'N/A' }}</td>
                                <td>{{ $st->student->gender ?? 'N/A' }}</td>
                                <td>{{ $st->student_class->name ?? 'N/A' }}</td>
                                <td>
                                    <a target="_blank" href="{{ route('certificate.tc.pdf', $st->student_id) }}" class="btn btn-warning btn-sm text-dark">
                                        <i class="feather icon-file-text me-1"></i> Generate TC
                                    </a>
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="7" class="text-center text-muted py-4">No enrolled students found for the selected session and class.</td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection

