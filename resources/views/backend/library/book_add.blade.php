@extends('admin.admin_master')
@section('admin')

<div class="row">
    <div class="col-12 col-lg-8">
        <div class="card">
            <div class="card-header">
                <h5 class="card-title mb-0">Add Book to Library Inventory</h5>
            </div>
            <div class="card-body">
                <form method="post" action="{{ route('library.book.store') }}">
                    @csrf
                    <div class="row g-3">
                        <div class="col-md-8">
                            <label class="form-label font-weight-bold">Book Title <span class="text-danger">*</span></label>
                            <input type="text" name="title" class="form-control" placeholder="e.g. NCERT Science Class 10" required>
                        </div>
                        <div class="col-md-4">
                            <label class="form-label font-weight-bold">ISBN / Barcode</label>
                            <input type="text" name="isbn" class="form-control" placeholder="e.g. 978-0132350884">
                        </div>
                        <div class="col-md-6">
                            <label class="form-label font-weight-bold">Author</label>
                            <input type="text" name="author" class="form-control" placeholder="Author name">
                        </div>
                        <div class="col-md-6">
                            <label class="form-label font-weight-bold">Publisher</label>
                            <input type="text" name="publisher" class="form-control" placeholder="Publisher name">
                        </div>
                        <div class="col-md-4">
                            <label class="form-label font-weight-bold">Edition</label>
                            <input type="text" name="edition" class="form-control" placeholder="e.g. 3rd Edition">
                        </div>
                        <div class="col-md-4">
                            <label class="form-label font-weight-bold">Subject / Category</label>
                            <select name="category" class="form-select">
                                <option value="Mathematics">Mathematics</option>
                                <option value="Science">Science & Technology</option>
                                <option value="Social Studies">Social Studies & History</option>
                                <option value="Languages">Languages & Literature</option>
                                <option value="Computer Science">Computer Science</option>
                                <option value="General Reference">General Reference / Encyclopedia</option>
                            </select>
                        </div>
                        <div class="col-md-4">
                            <label class="form-label font-weight-bold">Total Copies (Stock) <span class="text-danger">*</span></label>
                            <input type="number" name="quantity" class="form-control" value="5" min="1" required>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label font-weight-bold">Rack / Shelf Location</label>
                            <input type="text" name="rack_no" class="form-control" placeholder="e.g. Shelf A-3, Bay 2">
                        </div>
                    </div>

                    <div class="mt-4 pt-3 border-top">
                        <button type="submit" class="btn btn-primary px-4">Save Book</button>
                        <a href="{{ route('library.book.view') }}" class="btn btn-secondary">Cancel</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

@endsection
