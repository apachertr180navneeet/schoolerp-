@extends('admin.admin_master')
@section('admin')

<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header d-flex justify-content-between align-items-center">
                <div>
                    <h5 class="card-title mb-1">School Profile & Configuration</h5>
                    <p class="text-muted small mb-0">Manage institution master credentials, CBSE/Board affiliation details, and campus contact records</p>
                </div>
                <span class="badge bg-primary fs-6">{{ $setting->board ?? 'CBSE' }} Affiliated</span>
            </div>
            <div class="card-body">
                <form method="post" action="{{ route('school.profile.update') }}" enctype="multipart/form-data">
                    @csrf
                    <div class="row g-3">
                        <div class="col-md-6">
                            <label class="form-label font-weight-bold">School / Institution Name <span class="text-danger">*</span></label>
                            <input type="text" name="school_name" class="form-control" value="{{ $setting->school_name ?? '' }}" required>
                        </div>
                        <div class="col-md-3">
                            <label class="form-label font-weight-bold">School Code</label>
                            <input type="text" name="school_code" class="form-control" value="{{ $setting->school_code ?? '' }}">
                        </div>
                        <div class="col-md-3">
                            <label class="form-label font-weight-bold">Affiliation Board</label>
                            <select name="board" class="form-select">
                                <option value="CBSE" {{ ($setting->board ?? '') == 'CBSE' ? 'selected' : '' }}>CBSE (Central Board)</option>
                                <option value="ICSE" {{ ($setting->board ?? '') == 'ICSE' ? 'selected' : '' }}>ICSE / CISCE</option>
                                <option value="State Board" {{ ($setting->board ?? '') == 'State Board' ? 'selected' : '' }}>State Board</option>
                                <option value="IB / Cambridge" {{ ($setting->board ?? '') == 'IB / Cambridge' ? 'selected' : '' }}>IB / Cambridge</option>
                            </select>
                        </div>

                        <div class="col-md-6">
                            <label class="form-label font-weight-bold">Affiliation Number</label>
                            <input type="text" name="affiliation_no" class="form-control" value="{{ $setting->affiliation_no ?? '' }}">
                        </div>
                        <div class="col-md-3">
                            <label class="form-label font-weight-bold">Academic Session</label>
                            <input type="text" name="academic_session" class="form-control" value="{{ $setting->academic_session ?? '2026-2027' }}">
                        </div>
                        <div class="col-md-3">
                            <label class="form-label font-weight-bold">Principal / Headmaster Name</label>
                            <input type="text" name="principal_name" class="form-control" value="{{ $setting->principal_name ?? '' }}">
                        </div>

                        <div class="col-md-6">
                            <label class="form-label font-weight-bold">Campus Contact Phone</label>
                            <input type="text" name="phone" class="form-control" value="{{ $setting->phone ?? '' }}">
                        </div>
                        <div class="col-md-6">
                            <label class="form-label font-weight-bold">Official Email Address</label>
                            <input type="email" name="email" class="form-control" value="{{ $setting->email ?? '' }}">
                        </div>

                        <div class="col-md-12">
                            <label class="form-label font-weight-bold">Campus Address</label>
                            <textarea name="address" class="form-control" rows="2">{{ $setting->address ?? '' }}</textarea>
                        </div>

                        <div class="col-md-6">
                            <label class="form-label font-weight-bold">School Official Logo</label>
                            <input type="file" name="logo" class="form-control">
                            @if(!empty($setting->logo))
                            <div class="mt-2">
                                <img src="{{ asset('upload/school/' . $setting->logo) }}" alt="Logo" style="height: 60px; object-fit: contain;">
                            </div>
                            @endif
                        </div>
                        <div class="col-md-6">
                            <label class="form-label font-weight-bold">Official Stamp / Seal</label>
                            <input type="file" name="school_seal" class="form-control">
                            @if(!empty($setting->school_seal))
                            <div class="mt-2">
                                <img src="{{ asset('upload/school/' . $setting->school_seal) }}" alt="Seal" style="height: 60px; object-fit: contain;">
                            </div>
                            @endif
                        </div>
                    </div>

                    <div class="mt-4 pt-3 border-top d-flex justify-content-end">
                        <button type="submit" class="btn btn-primary px-4">
                            <i class="feather icon-save me-1"></i> Save Configuration
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

@endsection
