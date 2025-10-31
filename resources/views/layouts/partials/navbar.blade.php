<header class="p-3 bg-bookstack-blue text-white">
    <div class="container">
        <div class="d-flex flex-wrap align-items-center justify-content-center justify-content-lg-start">
            <a href="#" class="d-flex align-items-center mb-2 mb-lg-0 text-white text-decoration-none">
                <i class="bi bi-list"></i>
            </a>

            <ul class="nav col-12 col-lg-auto me-lg-auto mb-2 justify-content-center mb-md-0">
                <li><a href="{{ route('home.index') }}" class="nav-link px-2 text-white">Home</a></li>

                @auth
                    @role('admin')
                        <li><a href="{{ route('users.index') }}" class="nav-link px-2 text-white">Users</a></li>
                        <li><a href="{{ route('roles.index') }}" class="nav-link px-2 text-white">Roles</a></li>
                        <li><a href="{{ route('permissions.index') }}" class="nav-link px-2 text-white">Permissions</a></li>

                        <!-- Advanced Options (Tutorials + Logs)
                            the javascript is in the app-master.blade.php -->
                        <li class="nav-item dropdown">
                            <button
                                class="btn bg-bookstack-blue dropdown-toggle text-white"
                                type="button"
                                id="advancedOptionsDropdown"
                                data-bs-toggle="dropdown"
                                data-bs-auto-close="outside"
                                aria-expanded="false">
                                Advanced Options
                            </button>

                            <ul class="dropdown-menu" aria-labelledby="advancedOptionsDropdown">
                                <!-- Tutorials subtree -->
                                <li class="dropend">
                                    <a class="dropdown-item dropdown-toggle"
                                    href="#"
                                    id="tutorialsSubDropdown"
                                    data-bs-toggle="dropdown"
                                    aria-expanded="false">
                                        Tutorials
                                    </a>
                                    <ul class="dropdown-menu" aria-labelledby="tutorialsSubDropdown">
                                        <li><a class="dropdown-item" href="{{ route('admin.tutorials.index') }}">Tutorials</a></li>
                                        <li><a class="dropdown-item" href="{{ route('admin.tutorials.resetProgressPage') }}">Reset Tutorial Progress</a></li>
                                    </ul>
                                </li>

                                <li><hr class="dropdown-divider"></li>

                                <!-- Logs subtree -->
                                <li class="dropend">
                                    <a class="dropdown-item dropdown-toggle"
                                    href="#"
                                    id="logsSubDropdown"
                                    data-bs-toggle="dropdown"
                                    aria-expanded="false">
                                        Logs
                                    </a>
                                    <ul class="dropdown-menu" aria-labelledby="logsSubDropdown">
                                        <li><a class="dropdown-item" href="{{ route('logs.index') }}">Logs (All)</a></li>
                                        <li><a class="dropdown-item" href="{{ route('logs.updated') }}">Updated Logs</a></li>
                                        <li><a class="dropdown-item" href="{{ route('logs.deleted') }}">Deleted Logs</a></li>
                                    </ul>
                                </li>

                                <li><hr class="dropdown-divider"></li>

                                <!-- Process Builder (single item) -->
                                <li>
                                    <a class="dropdown-item" href="{{ route('process_builder.index') }}">
                                        Process Builder
                                    </a>
                                </li>
                            </ul>
                        </li>
                    @endrole

                    <li><a href="{{ route('posts.index') }}" class="nav-link px-2 text-white">Discussion</a></li>
                    <li><a href="{{ asset('storage/Draft-Estimates-of-Development-Programme-For-the-Financial-Year-2025.pdf') }}" target="_blank" class="nav-link px-2 text-white">Resources</a></li>

                    @role('planning|admin')
                        <li class="nav-item dropdown">
                            <button class="btn bg-bookstack-blue dropdown-toggle text-white" type="button" id="planningDropdown" data-bs-toggle="dropdown" aria-expanded="false">
                                Agricultural Planning Options
                            </button>
                            <ul class="dropdown-menu" aria-labelledby="planningDropdown">
                                <li><a class="dropdown-item" href="{{ route('add.document.page.create') }}" target="_blank">Add a Document to Listing</a></li>
                                <li><a class="dropdown-item" href="{{ route('division.create') }}" target="_blank">Add a Division</a></li>
                                <li><a class="dropdown-item" href="{{ route('psip.create') }}">Add a new PSIP/Vote to a Department/Division</a></li>
                                <li><a class="dropdown-item" href="{{ route('activities.create') }}">Add a new Project Activity to a PSIP/Vote</a></li>
                                <li><a class="dropdown-item" href="{{ route('assign.create') }}">Assign/Request a document to be uploaded by a department</a></li>
                                <li><a class="dropdown-item" href="{{ route('update.psip.financials') }}">Update PSIP to Current Financial Year</a></li>
                            </ul>
                        </li>
                    @endrole
                @endauth
            </ul>

            @role('admin')
                <form id="searchform" class="col-12 col-lg-auto mb-3 mb-lg-0 me-lg-3" method="post" action="{{ route('search.autocomplete') }}" enctype="multipart/form-data">
                    @csrf
                    <input type="text" id="search" name="search" class="typeahead form-control form-control-dark" placeholder="Search..." aria-label="Search">
                    <ul id="autocomplete-list" class="list-group position-absolute w-100 mt-1"></ul>
                    <input type="submit" id="submitsearch" name="submitsearch" class="submit btn btn-outline-primary" hidden="hidden"/>
                </form>
            @endrole

            @auth
                <div class="dropdown">
                    <button class="btn bg-bookstack-blue dropdown-toggle text-white" type="button" id="userDropdown" data-bs-toggle="dropdown" aria-expanded="false">
                        {{ auth()->user()->name }}
                    </button>
                    <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="userDropdown">
                        <li><a class="dropdown-item" href="{{ route('users.password.change') }}">Change Password</a></li>
                        <li><a class="dropdown-item" href="{{ route('logout.perform') }}">Logout</a></li>
                    </ul>
                </div>
            @endauth

            @guest
                <div class="text-end">
                    <a href="{{ route('login.perform') }}" class="btn btn-outline-light me-2">Login</a>
                </div>
            @endguest
        </div>
    </div>
</header>
