<div class="container py-5">
    <div class="mb-5 text-center">
        <h1 class="fw-bold text-primary">Concession Application Hub</h1>
        <p class="text-muted mb-0">Review your recent submissions and start a fresh application when you're ready.</p>
    </div>

    <div class="row g-4">
        <div class="col-12 col-lg-7">
            <div class="card shadow-sm border-0 h-100">
                <div class="card-body p-4">
                    <div class="d-flex justify-content-between align-items-center mb-3">
                        <div>
                            <h2 class="h5 fw-bold mb-1">Submitted Concession Applications</h2>
                            <p class="text-muted mb-0">Here are your three most recent submissions.</p>
                        </div>
                        <a href="#" class="btn btn-sm btn-outline-primary">
                            View All
                        </a>
                        {{-- TODO: Replace placeholder link with route to the full applications list. --}}
                    </div>

                    <ul class="list-group list-group-flush">
                        <li class="list-group-item px-0 py-3">
                            <div class="d-flex justify-content-between align-items-start">
                                <div>
                                    <h3 class="h6 mb-1">Application #2024-001</h3>
                                    <p class="text-muted small mb-0">Submitted on March 12, 2024 • Status: Under Review</p>
                                </div>
                                <span class="badge bg-warning text-dark">Pending</span>
                            </div>
                        </li>
                        <li class="list-group-item px-0 py-3">
                            <div class="d-flex justify-content-between align-items-start">
                                <div>
                                    <h3 class="h6 mb-1">Application #2024-002</h3>
                                    <p class="text-muted small mb-0">Submitted on February 01, 2024 • Status: Approved</p>
                                </div>
                                <span class="badge bg-success">Approved</span>
                            </div>
                        </li>
                        <li class="list-group-item px-0 py-3">
                            <div class="d-flex justify-content-between align-items-start">
                                <div>
                                    <h3 class="h6 mb-1">Application #2023-112</h3>
                                    <p class="text-muted small mb-0">Submitted on December 17, 2023 • Status: More Information Required</p>
                                </div>
                                <span class="badge bg-info text-dark">Action Needed</span>
                            </div>
                        </li>
                        {{-- TODO: Replace placeholder submissions with dynamic data when backend integration is ready. --}}
                    </ul>
                </div>
            </div>
        </div>

        <div class="col-12 col-lg-5">
            <div class="card shadow-sm border-0 h-100">
                <div class="card-body p-4">
                    <h2 class="h5 fw-bold mb-3">Start a New Concession Application</h2>
                    <p class="text-muted">Before you begin, make sure you:</p>
                    <ul class="text-muted ps-3 mb-4">
                        <li>Meet the eligibility criteria for concessions.</li>
                        <li>Have supporting documentation ready for upload.</li>
                        <li>Understand the submission deadlines and review timelines.</li>
                        <li>Confirm contact details are up-to-date for follow-up.</li>
                    </ul>
                    {{-- TODO: Replace placeholder action with link or modal trigger for new concession form. --}}
                    <button type="button" class="btn btn-primary btn-lg w-100">New Application</button>
                </div>
            </div>
        </div>
    </div>
</div>
