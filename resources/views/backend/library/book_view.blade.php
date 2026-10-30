@extends('admin.admin_master')
@section('admin')

<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header d-flex justify-content-between align-items-center">
                <div>
                    <h5 class="card-title mb-1">Library Book Catalog & Inventory</h5>
                    <p class="text-muted small mb-0">Manage books, editions, rack locations, and real-time inventory count</p>
                </div>
                <div class="d-flex gap-2">
                    <a href="{{ route('library.issue.view') }}" class="btn btn-outline-primary btn-sm">
                        <i class="feather icon-book-open me-1"></i> Issue Counter
                    </a>
                    <a href="{{ route('library.book.add') }}" class="btn btn-success btn-sm">
                        <i class="feather icon-plus me-1"></i> Add New Book
                    </a>
                </div>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered table-striped align-middle">
                        <thead class="table-light">
                            <tr>
                                <th width="5%">SL</th>
                                <th>Book Title</th>
                                <th>Author</th>
                                <th>ISBN / Acc No</th>
                                <th>Category</th>
                                <th>Rack Location</th>
                                <th>Stock Qty</th>
                                <th>Available</th>
                                <th width="15%">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($allData as $key => $book)
                            <tr>
                                <td>{{ $key + 1 }}</td>
                                <td><strong>{{ $book->title }}</strong></td>
                                <td>{{ $book->author ?? 'N/A' }}</td>
                                <td><span class="badge bg-secondary">{{ $book->isbn }}</span></td>
                                <td><span class="badge bg-light text-dark">{{ $book->category }}</span></td>
                                <td>{{ $book->rack_no ?? 'Main Shelf' }}</td>
                                <td>{{ $book->quantity }}</td>
                                <td>
                                    @if($book->available > 0)
                                    <span class="badge bg-success">{{ $book->available }} Available</span>
                                    @else
                                    <span class="badge bg-danger">All Issued</span>
                                    @endif
                                </td>
                                <td>
                                    <a href="{{ route('library.book.edit', $book->id) }}" class="btn btn-info btn-sm">Edit</a>
                                    <a href="{{ route('library.book.delete', $book->id) }}" class="btn btn-danger btn-sm" id="delete">Delete</a>
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="9" class="text-center text-muted py-4">No books catalogued in the library yet.</td>
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

