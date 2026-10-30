@extends('admin.admin_master')
@section('admin')

<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header d-flex justify-content-between align-items-center">
                <h5 class="card-title mb-0">Student Section Master (CBSE / State Board)</h5>
                <a href="{{ route('student.section.add') }}" class="btn btn-success btn-sm">
                    <i class="feather icon-plus me-1"></i> Add New Section
                </a>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered table-striped align-middle">
                        <thead class="table-light">
                            <tr>
                                <th width="8%">SL</th>
                                <th>Section Name</th>
                                <th>Max Capacity</th>
                                <th width="20%">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($allData as $key => $section)
                            <tr>
                                <td>{{ $key + 1 }}</td>
                                <td><span class="badge bg-info fs-6">Section {{ $section->name }}</span></td>
                                <td>{{ $section->capacity }} Students</td>
                                <td>
                                    <a href="{{ route('student.section.edit', $section->id) }}" class="btn btn-info btn-sm">Edit</a>
                                    <a href="{{ route('student.section.delete', $section->id) }}" class="btn btn-danger btn-sm" id="delete">Delete</a>
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="4" class="text-center text-muted py-4">No sections configured yet.</td>
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

