@extends('admin.admin_master')
@section('admin')

<div class="row">
    <div class="col-12 col-lg-8">
        <div class="card">
            <div class="card-header">
                <h5 class="card-title mb-0">Record New Admission Enquiry</h5>
            </div>
            <div class="card-body">
                <form method="post" action="{{ route('admission.enquiry.store') }}">
                    @csrf
                    <div class="row g-3">
                        <div class="col-md-6">
                            <label class="form-label font-weight-bold">Candidate / Student Name <span class="text-danger">*</span></label>
                            <input type="text" name="student_name" class="form-control" placeholder="Full name of candidate" required>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label font-weight-bold">Parent / Guardian Name <span class="text-danger">*</span></label>
                            <input type="text" name="parent_name" class="form-control" placeholder="Parent or guardian name" required>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label font-weight-bold">Mobile / Phone Number <span class="text-danger">*</span></label>
                            <input type="text" name="mobile" class="form-control" placeholder="+91 98765 00000" required>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label font-weight-bold">Email Address</label>
                            <input type="email" name="email" class="form-control" placeholder="parent@example.com">
                        </div>
                        <div class="col-md-4">
                            <label class="form-label font-weight-bold">Applying For Class <span class="text-danger">*</span></label>
                            <select name="class_id" class="form-select" required>
                                <option value="" disabled selected>Select Class</option>
                                @foreach($classes as $cls)
                                <option value="{{ $cls->id }}">{{ $cls->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-4">
                            <label class="form-label font-weight-bold">Lead Source</label>
                            <select name="source" class="form-select">
                                <option value="Walk-in">Walk-in Campus</option>
                                <option value="Website Online Form">Website Online Form</option>
                                <option value="Social Media Campaign">Social Media Campaign</option>
                                <option value="Referral">Word of Mouth / Referral</option>
                                <option value="Newspaper Ad">Newspaper Ad</option>
                            </select>
                        </div>
                        <div class="col-md-4">
                            <label class="form-label font-weight-bold">Enquiry Date</label>
                            <input type="date" name="enquiry_date" class="form-control" value="{{ date('Y-m-d') }}">
                        </div>
                        <div class="col-md-6">
                            <label class="form-label font-weight-bold">Initial Pipeline Status</label>
                            <select name="status" class="form-select">
                                <option value="New">New Lead</option>
                                <option value="Contacted">Contacted / Call Completed</option>
                                <option value="Assessment Scheduled">Assessment / Interview Scheduled</option>
                                <option value="Admitted">Admitted</option>
                                <option value="Cancelled">Cancelled / Not Interested</option>
                            </select>
                        </div>
                        <div class="col-md-12">
                            <label class="form-label font-weight-bold">Counselor Notes / Remarks</label>
                            <textarea name="notes" class="form-control" rows="3" placeholder="Key notes from counseling session or parent queries..."></textarea>
                        </div>
                    </div>

                    <div class="mt-4 pt-3 border-top">
                        <button type="submit" class="btn btn-primary px-4">Save Enquiry</button>
                        <a href="{{ route('admission.enquiry.view') }}" class="btn btn-secondary">Cancel</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

@endsection

