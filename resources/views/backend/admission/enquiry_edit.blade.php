@extends('admin.admin_master')
@section('admin')

<div class="row">
    <div class="col-12 col-lg-8">
        <div class="card">
            <div class="card-header">
                <h5 class="card-title mb-0">Update Admission Enquiry #{{ $editData->enquiry_no }}</h5>
            </div>
            <div class="card-body">
                <form method="post" action="{{ route('admission.enquiry.update', $editData->id) }}">
                    @csrf
                    <div class="row g-3">
                        <div class="col-md-6">
                            <label class="form-label font-weight-bold">Candidate / Student Name <span class="text-danger">*</span></label>
                            <input type="text" name="student_name" class="form-control" value="{{ $editData->student_name }}" required>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label font-weight-bold">Parent / Guardian Name <span class="text-danger">*</span></label>
                            <input type="text" name="parent_name" class="form-control" value="{{ $editData->parent_name }}" required>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label font-weight-bold">Mobile / Phone Number <span class="text-danger">*</span></label>
                            <input type="text" name="mobile" class="form-control" value="{{ $editData->mobile }}" required>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label font-weight-bold">Email Address</label>
                            <input type="email" name="email" class="form-control" value="{{ $editData->email }}">
                        </div>
                        <div class="col-md-4">
                            <label class="form-label font-weight-bold">Applying For Class <span class="text-danger">*</span></label>
                            <select name="class_id" class="form-select" required>
                                @foreach($classes as $cls)
                                <option value="{{ $cls->id }}" {{ $editData->class_id == $cls->id ? 'selected' : '' }}>{{ $cls->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-4">
                            <label class="form-label font-weight-bold">Lead Source</label>
                            <select name="source" class="form-select">
                                <option value="Walk-in" {{ $editData->source == 'Walk-in' ? 'selected' : '' }}>Walk-in Campus</option>
                                <option value="Website Online Form" {{ $editData->source == 'Website Online Form' ? 'selected' : '' }}>Website Online Form</option>
                                <option value="Social Media Campaign" {{ $editData->source == 'Social Media Campaign' ? 'selected' : '' }}>Social Media Campaign</option>
                                <option value="Referral" {{ $editData->source == 'Referral' ? 'selected' : '' }}>Word of Mouth / Referral</option>
                                <option value="Newspaper Ad" {{ $editData->source == 'Newspaper Ad' ? 'selected' : '' }}>Newspaper Ad</option>
                            </select>
                        </div>
                        <div class="col-md-4">
                            <label class="form-label font-weight-bold">Enquiry Date</label>
                            <input type="date" name="enquiry_date" class="form-control" value="{{ $editData->enquiry_date }}">
                        </div>
                        <div class="col-md-6">
                            <label class="form-label font-weight-bold">Pipeline Status</label>
                            <select name="status" class="form-select">
                                <option value="New" {{ $editData->status == 'New' ? 'selected' : '' }}>New Lead</option>
                                <option value="Contacted" {{ $editData->status == 'Contacted' ? 'selected' : '' }}>Contacted / Call Completed</option>
                                <option value="Assessment Scheduled" {{ $editData->status == 'Assessment Scheduled' ? 'selected' : '' }}>Assessment / Interview Scheduled</option>
                                <option value="Admitted" {{ $editData->status == 'Admitted' ? 'selected' : '' }}>Admitted</option>
                                <option value="Cancelled" {{ $editData->status == 'Cancelled' ? 'selected' : '' }}>Cancelled / Not Interested</option>
                            </select>
                        </div>
                        <div class="col-md-12">
                            <label class="form-label font-weight-bold">Counselor Notes / Remarks</label>
                            <textarea name="notes" class="form-control" rows="3">{{ $editData->notes }}</textarea>
                        </div>
                    </div>

                    <div class="mt-4 pt-3 border-top">
                        <button type="submit" class="btn btn-primary px-4">Update Enquiry</button>
                        <a href="{{ route('admission.enquiry.view') }}" class="btn btn-secondary">Cancel</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

@endsection

