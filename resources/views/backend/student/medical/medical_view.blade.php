@extends('admin.admin_master')
@section('admin')

<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header d-flex justify-content-between align-items-center">
                <div>
                    <h5 class="card-title mb-1">Student Health & Medical Records</h5>
                    <p class="text-muted small mb-0">Track student blood group, height, weight, allergies, and emergency medical contacts</p>
                </div>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered table-striped align-middle">
                        <thead class="table-light">
                            <tr>
                                <th width="5%">#</th>
                                <th>Student ID</th>
                                <th>Student Name</th>
                                <th>Class</th>
                                <th>Blood Group</th>
                                <th>Height (cm)</th>
                                <th>Weight (kg)</th>
                                <th>Allergies / Conditions</th>
                                <th>Emergency Contact</th>
                                <th width="10%">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($students as $key => $st)
                            @php
                                $m = $medicals->get($st->student_id);
                            @endphp
                            <tr>
                                <td>{{ $key + 1 }}</td>
                                <td><span class="badge bg-secondary">{{ $st->student->id_no }}</span></td>
                                <td><strong>{{ $st->student->name }}</strong></td>
                                <td>{{ $st->student_class->name ?? '' }}</td>
                                <td>
                                    @if($m && $m->blood_group)
                                    <span class="badge bg-danger">{{ $m->blood_group }}</span>
                                    @else
                                    <span class="text-muted">-</span>
                                    @endif
                                </td>
                                <td>{{ $m->height_cm ?? '-' }}</td>
                                <td>{{ $m->weight_kg ?? '-' }}</td>
                                <td>
                                    @if($m && ($m->known_allergies || $m->medical_conditions))
                                    <span class="badge bg-warning text-dark">{{ $m->known_allergies ?? $m->medical_conditions }}</span>
                                    @else
                                    <span class="text-success small">None reported</span>
                                    @endif
                                </td>
                                <td>
                                    @if($m && $m->emergency_contact_phone)
                                    <strong>{{ $m->emergency_contact_name }}</strong>: {{ $m->emergency_contact_phone }}
                                    @else
                                    {{ $st->student->mobile ?? '-' }}
                                    @endif
                                </td>
                                <td>
                                    <a href="{{ route('student.medical.edit', $st->student_id) }}" class="btn btn-sm btn-primary">
                                        <i class="feather icon-edit-2 me-1"></i> Edit
                                    </a>
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="10" class="text-center text-muted py-4">No student records found.</td>
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

