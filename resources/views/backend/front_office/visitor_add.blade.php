@extends('admin.admin_master')
@section('admin')

<div class="row">
    <div class="col-md-10 offset-md-1">
        <div class="card">
            <div class="card-header d-flex justify-content-between align-items-center">
                <div>
                    <h5 class="card-title mb-1">New Visitor Entry Pass</h5>
                    <p class="text-muted small mb-0">Record identity verification and issue campus entry pass</p>
                </div>
                <a href="{{ route('visitor.view') }}" class="btn btn-outline-secondary btn-sm">
                    <i class="feather icon-arrow-left me-1"></i> Back to Visitors
                </a>
            </div>
            <div class="card-body">
                <form method="POST" action="{{ route('visitor.store') }}">
                    @csrf
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Visitor Full Name <span class="text-danger">*</span></label>
                            <input type="text" name="name" class="form-control" placeholder="e.g. Ramesh Kumar Verma" required>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Phone Number <span class="text-danger">*</span></label>
                            <input type="tel" name="phone" class="form-control" placeholder="e.g. 9876543210" required>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Person / Department to Meet <span class="text-danger">*</span></label>
                            <input type="text" name="person_to_meet" class="form-control" placeholder="e.g. Principal Office / Accounts Desk" required>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Purpose of Visit <span class="text-danger">*</span></label>
                            <input type="text" name="purpose" class="form-control" placeholder="e.g. New Admission Enquiry / Vendor Meeting" required>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-4 mb-3">
                            <label class="form-label">ID Proof Type</label>
                            <select name="id_proof_type" class="form-control">
                                <option value="Aadhaar">Aadhaar Card</option>
                                <option value="Driving License">Driving License</option>
                                <option value="PAN Card">PAN Card</option>
                                <option value="Voter ID">Voter ID</option>
                            </select>
                        </div>
                        <div class="col-md-4 mb-3">
                            <label class="form-label">ID Proof Number</label>
                            <input type="text" name="id_proof_number" class="form-control" placeholder="e.g. 1234-5678-9012">
                        </div>
                        <div class="col-md-4 mb-3">
                            <label class="form-label">Number of Persons</label>
                            <input type="number" name="number_of_persons" class="form-control" value="1" min="1">
                        </div>
                    </div>

                    <div class="text-end">
                        <button type="submit" class="btn btn-primary px-4">
                            <i class="feather icon-check me-1"></i> Issue Gate Pass & Check In
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

@endsection

