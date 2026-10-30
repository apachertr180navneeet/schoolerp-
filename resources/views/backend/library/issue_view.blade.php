@extends('admin.admin_master')
@section('admin')

<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header d-flex justify-content-between align-items-center">
                <div>
                    <h5 class="card-title mb-1">Library Circulation & Book Issues</h5>
                    <p class="text-muted small mb-0">Track active book loans, return dates, overdue fines, and borrowing history</p>
                </div>
                <div class="d-flex gap-2">
                    <a href="{{ route('library.book.view') }}" class="btn btn-outline-secondary btn-sm">Catalog</a>
                    <a href="{{ route('library.issue.add') }}" class="btn btn-primary btn-sm">
                        <i class="feather icon-plus me-1"></i> Issue Book
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
                                <th>Borrower (Student / Staff)</th>
                                <th>Issue Date</th>
                                <th>Due Date</th>
                                <th>Return Date</th>
                                <th>Status</th>
                                <th>Late Fine</th>
                                <th width="15%">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($allData as $key => $issue)
                            <tr>
                                <td>{{ $key + 1 }}</td>
                                <td><strong>{{ $issue->book->title ?? 'N/A' }}</strong></td>
                                <td>{{ $issue->user->name ?? 'User' }} <small class="text-muted">({{ $issue->user->usertype ?? '' }})</small></td>
                                <td>{{ date('d-m-Y', strtotime($issue->issue_date)) }}</td>
                                <td>{{ date('d-m-Y', strtotime($issue->due_date)) }}</td>
                                <td>{{ $issue->return_date ? date('d-m-Y', strtotime($issue->return_date)) : '—' }}</td>
                                <td>
                                    @if($issue->status == 'Returned')
                                        <span class="badge bg-success">Returned</span>
                                    @elseif(strtotime(date('Y-m-d')) > strtotime($issue->due_date))
                                        <span class="badge bg-danger">Overdue</span>
                                    @else
                                        <span class="badge bg-primary">Active Loan</span>
                                    @endif
                                </td>
                                <td>{{ $issue->fine_amount > 0 ? '₹' . $issue->fine_amount : '₹0' }}</td>
                                <td>
                                    @if($issue->status != 'Returned')
                                    <a href="{{ route('library.issue.return', $issue->id) }}" class="btn btn-success btn-sm">
                                        Mark Returned
                                    </a>
                                    @else
                                    <span class="text-muted small">Completed</span>
                                    @endif
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="9" class="text-center text-muted py-4">No circulation or issue records found.</td>
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

