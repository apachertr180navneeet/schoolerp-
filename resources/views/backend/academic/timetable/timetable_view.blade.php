@extends('admin.admin_master')
@section('admin')

<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header d-flex justify-content-between align-items-center">
                <div>
                    <h5 class="card-title mb-1">Class Timetable & Schedule Matrix</h5>
                    <p class="text-muted small mb-0">Weekly class periods, assigned faculty, room allocations, and timing</p>
                </div>
                <a href="{{ route('academic.timetable.add') }}" class="btn btn-success btn-sm">
                    <i class="feather icon-plus me-1"></i> Add Period Slot
                </a>
            </div>
            <div class="card-body">
                <form method="get" action="{{ route('academic.timetable.view') }}" class="mb-4 p-3 bg-light rounded border">
                    <div class="row align-items-end g-3">
                        <div class="col-md-5">
                            <label class="form-label font-weight-bold">Select Class</label>
                            <select name="class_id" class="form-select">
                                @foreach($classes as $cls)
                                <option value="{{ $cls->id }}" {{ $selected_class == $cls->id ? 'selected' : '' }}>{{ $cls->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-5">
                            <label class="form-label font-weight-bold">Select Section (Optional)</label>
                            <select name="section_id" class="form-select">
                                <option value="">All Sections</option>
                                @foreach($sections as $sec)
                                <option value="{{ $sec->id }}" {{ $selected_section == $sec->id ? 'selected' : '' }}>Section {{ $sec->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-2">
                            <button type="submit" class="btn btn-primary w-100">Filter</button>
                        </div>
                    </div>
                </form>

                @foreach($days as $day)
                @php
                    $daySlots = $allData->where('day', $day);
                @endphp
                <div class="card mb-3 border">
                    <div class="card-header bg-light py-2">
                        <h6 class="mb-0 font-weight-bold text-primary">{{ $day }}</h6>
                    </div>
                    <div class="card-body p-0">
                        @if($daySlots->count() > 0)
                        <div class="table-responsive">
                            <table class="table table-bordered mb-0 align-middle">
                                <thead class="table-light">
                                    <tr>
                                        <th width="15%">Time Slot</th>
                                        <th>Subject</th>
                                        <th>Teacher / Faculty</th>
                                        <th>Section</th>
                                        <th>Room</th>
                                        <th width="10%">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($daySlots as $slot)
                                    <tr>
                                        <td><strong>{{ date('h:i A', strtotime($slot->start_time)) }} - {{ date('h:i A', strtotime($slot->end_time)) }}</strong></td>
                                        <td><span class="badge bg-secondary fs-6">{{ $slot->subject->name ?? 'Subject' }}</span></td>
                                        <td>{{ $slot->teacher->name ?? 'Unassigned' }}</td>
                                        <td>{{ $slot->section ? 'Section ' . $slot->section->name : 'All' }}</td>
                                        <td><span class="badge bg-light text-dark">{{ $slot->room_no }}</span></td>
                                        <td>
                                            <a href="{{ route('academic.timetable.delete', $slot->id) }}" class="btn btn-danger btn-sm" id="delete">Remove</a>
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                        @else
                        <div class="p-3 text-muted text-center small">No periods scheduled for {{ $day }}.</div>
                        @endif
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </div>
</div>

@endsection
