@extends('admin.layout.master')
@section('title', 'Email Sending Statuses')

@section('content')
	<main id="dashboard">
        <div class="container-fluid">
            <h3 class="fs-3 fw-normal mb-4">Email Sending Status</h3>
            <div class="eVote-table p-4 is-drop-shadow bg-white rounded">
                <div class="d-flex align-items-center justify-content-between mb-4">
                    <div class="mb-0">
						<span class="d-inline-block me-3">
                            Total Voters:
                            <strong class="text-cyan">1000</strong>
                        </span>
                    </div>
                </div>
                <div class="voter-list table-responsive">
                    <table class="table table-sm align-middle">
                        <thead class="text-uppercase">
                        <tr>
                            <th>#SL</th>
                            <th>Voter ID</th>
                            <th>Voter Name</th>
                            <th>Email Address</th>
                            <th>Phone</th>
								<th>Currently Living</th>
								<th>Status</th>
								<th>Action</th>
							</tr>
						</thead>
						<tbody>
							<tr>
								<td>01</td>
								<td>9654684</td>
								<td>Kawsar Bin Siraj</td>
								<td>email@gmail.com</td>
								<td>01775686936</td>
								<td>Dhaka-1207</td>
								<td>
									<span class="text-primary">Success</span>
								</td>
								<td>
									<button class="btn btn-primary btn-sm">Resend</button>
								</td>
							</tr>
						</tbody>
					</table>
				</div>
				<nav class="pagination-nav mt-2 text-end">
					<ul class="pagination pagination-sm d-inline-flex">
						<li class="page-item disabled">
							<span class="page-link">Previous</span>
						</li>
						<li class="page-item"><a class="page-link" href="#">1</a></li>
						<li class="page-item active" aria-current="page">
							<span class="page-link">2</span>
						</li>
						<li class="page-item"><a class="page-link" href="#">3</a></li>
						<li class="page-item">
							<a class="page-link" href="#">Next</a>
						</li>
					</ul>
				</nav>
			</div>
		</div>
	</main>
@endsection
