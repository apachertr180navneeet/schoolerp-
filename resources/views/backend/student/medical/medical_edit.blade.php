@extends('admin.admin_master')
@section('admin')

<div class="row">
    <div class="col-md-8 offset-md-2">
        <div class="card">
            <div class="card-header d-flex justify-content-between align-items-center">
                <div>
                    <h5 class="card-title mb-1">Update Health Profile: {{ $student->name }}</h5>
                    <p class="text-muted small mb-0">Admission ID: <strong>{{ $student->id_no }}</strong></p>
                </div>
                <a href="{{ route('student.medical.view') }}" class="btn btn-outline-secondary btn-sm">
                    <i class="feather icon-arrow-left me-1"></i> Back to Medical List
                </a>
            </div>
            <div class="card-body">
                <form method="POST" action="{{ route('student.medical.update', $student->id) }}">
                    @csrf
                    <div class="row">
                        <div class="col-md-4 mb-3">
                            <label class="form-label">Blood Group</label>
                            <select name="blood_group" class="form-control">
                                <option value="">Select Blood Group</option>
                                @foreach(['A+', 'A-', 'B+', 'B-', 'AB+', 'AB-', 'O+', 'O-'] as $bg)
                                <option value="{{ $bg }}" {{ ($medical && $medical->blood_group == $bg) ? 'selected' : '' }}>{{ $bg }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-4 mb-3">
                            <label class="form-label">Height (cm)</label>
                            <input type="number" step="0.1" name="height_cm" class="form-control" value="{{ $medical->height_cm ?? '' }}" placeholder="e.g. 152.5">
                        </div>
                        <div class="col-md-4 mb-3">
                            <label class="form-label">Weight (kg)</label>
                            <input type="number" step="0.1" name="weight_kg" class="form-control" value="{{ $medical->weight_kg ?? '' }}" placeholder="e.g. 45.0">
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Emergency Contact Name</label>
                            <input type="text" name="emergency_contact_name" class="form-control" value="{{ $medical->emergency_contact_name ?? $student->fname }}" placeholder="Parent / Guardian Name">
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Emergency Contact Phone</label>
                            <input type="tel" name="emergency_contact_phone" class="form-control" value="{{ $medical->emergency_contact_phone ?? $student->mobile }}" placeholder="Emergency Phone Number">
                        </div>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Known Allergies</label>
                        <input type="text" name="known_allergies" class="form-control" value="{{ $medical->known_allergies ?? '' }}" placeholder="e.g. Peanuts, Penicillin, Dust allergy, None">
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Chronic Conditions / Medical Notes</label>
                        <textarea name="medical_conditions" class="form-control" rows="3" placeholder="Asthma, spectacles power, dietary restrictions, etc.">{{ $medical->medical_conditions ?? '' }}</textarea>
                    </div>

                    <div class="text-end">
                        <button type="submit" class="btn btn-primary px-4">
                            <i class="feather icon-save me-1"></i> Save Health Record
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

@endsection

