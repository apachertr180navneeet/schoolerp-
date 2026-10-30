@extends('admin.admin_master')
@section('admin')

<div class="row">
    <div class="col-12 col-lg-8">
        <div class="card">
            <div class="card-header">
                <h5 class="card-title mb-0">Edit Book — {{ $editData->title }}</h5>
            </div>
            <div class="card-body">
                <form method="post" action="{{ route('library.book.update', $editData->id) }}">
                    @csrf
                    <div class="row g-3">
                        <div class="col-md-8">
                            <label class="form-label font-weight-bold">Book Title <span class="text-danger">*</span></label>
                            <input type="text" name="title" class="form-control" value="{{ $editData->title }}" required>
                        </div>
                        <div class="col-md-4">
                            <label class="form-label font-weight-bold">ISBN / Barcode</label>
                            <input type="text" name="isbn" class="form-control" value="{{ $editData->isbn }}">
                        </div>
                        <div class="col-md-6">
                            <label class="form-label font-weight-bold">Author</label>
                            <input type="text" name="author" class="form-control" value="{{ $editData->author }}">
                        </div>
                        <div class="col-md-6">
                            <label class="form-label font-weight-bold">Publisher</label>
                            <input type="text" name="publisher" class="form-control" value="{{ $editData->publisher }}">
                        </div>
                        <div class="col-md-4">
                            <label class="form-label font-weight-bold">Edition</label>
                            <input type="text" name="edition" class="form-control" value="{{ $editData->edition }}">
                        </div>
                        <div class="col-md-4">
                            <label class="form-label font-weight-bold">Category</label>
                            <input type="text" name="category" class="form-control" value="{{ $editData->category }}">
                        </div>
                        <div class="col-md-4">
                            <label class="form-label font-weight-bold">Total Copies <span class="text-danger">*</span></label>
                            <input type="number" name="quantity" class="form-control" value="{{ $editData->quantity }}" min="1" required>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label font-weight-bold">Rack Location</label>
                            <input type="text" name="rack_no" class="form-control" value="{{ $editData->rack_no }}">
                        </div>
                    </div>

                    <div class="mt-4 pt-3 border-top">
                        <button type="submit" class="btn btn-primary px-4">Update Book</button>
                        <a href="{{ route('library.book.view') }}" class="btn btn-secondary">Cancel</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

@endsection

