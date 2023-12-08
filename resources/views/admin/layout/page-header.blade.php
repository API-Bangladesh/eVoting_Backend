<header class="header">
    <div class="container-fluid">
        <div class="row header-row align-items-center">
            <div class="col-6">
                <div class="header-left d-flex align-items-center">
                    <div class="theme-logo ps-sm-1 flex-grow-1">
                        <a href="{{ route('home') }}"
                           class="logo text-decoration-none text-cyan fs-5 lh-base fw-bold d-inline-block">
                            @if(setting()->get('icon') !== Null && setting()->get('logo_type') == 'img-logo')
                                <img src="{{ get_uploaded_file_url(setting()->get('icon')) }}" alt="Logo"
                                     class="img-fluid" style="max-height: 50px"/>
                            @else
                                {{ setting()->get('organization_name') }}
                            @endif
                        </a>
                    </div>
                </div>
            </div>
            <div class="col-6">
                <div class="header-right">
                    <ul class="list-unstyled d-flex align-items-center justify-content-end mb-0">
                        <li class="header-right-catalog">
                            <div class="dropdown authInfo-dropdown">
                                <a class="btn btn-authInfo is-dropdown-toggle dropdown-toggle d-flex align-items-center text-start gap-2 gap-xxl-3"
                                   href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                    <h6 class="user-name fw-semi-bold d-none d-lg-block mb-0">{{ optional(auth()->user())->name }}</h6>
                                    <div class="user-img flex-shrink-0">
                                        <img src="{{ get_uploaded_file_url(optional(auth()->user())->image) }}"
                                             alt="image"
                                             class="img-fluid"/>
                                        <svg class="circle-shape" width="24" height="24" viewBox="0 0 24 24"
                                             fill="none" xmlns="http://www.w3.org/2000/svg">
                                            <circle cx="12" cy="12" r="10" fill="#FFEBF2" stroke="white"
                                                    stroke-width="4"/>
                                            <path
                                                    d="M15.3333 11.3333H12.6667V8.66667C12.6667 8.48986 12.5964 8.32029 12.4714 8.19526C12.3464 8.07024 12.1768 8 12 8C11.8232 8 11.6536 8.07024 11.5286 8.19526C11.4036 8.32029 11.3333 8.48986 11.3333 8.66667V11.3333H8.66667C8.48986 11.3333 8.32029 11.4036 8.19526 11.5286C8.07024 11.6536 8 11.8232 8 12C8 12.1768 8.07024 12.3464 8.19526 12.4714C8.32029 12.5964 8.48986 12.6667 8.66667 12.6667H11.3333V15.3333C11.3333 15.5101 11.4036 15.6797 11.5286 15.8047C11.6536 15.9298 11.8232 16 12 16C12.1768 16 12.3464 15.9298 12.4714 15.8047C12.5964 15.6797 12.6667 15.5101 12.6667 15.3333V12.6667H15.3333C15.5101 12.6667 15.6797 12.5964 15.8047 12.4714C15.9298 12.3464 16 12.1768 16 12C16 11.8232 15.9298 11.6536 15.8047 11.5286C15.6797 11.4036 15.5101 11.3333 15.3333 11.3333Z"
                                                    fill="#FB2B76"/>
                                        </svg>
                                    </div>
                                </a>
                                <div class="notify-dropdown-menu authInfo-dropdown-menu dropdown-menu px-0 py-0">
                                    <div class="current-user bg-cyan d-flex align-items-center py-3 px-4">
                                        <div class="authInfo-profile">
                                            <h6 class="user-name fs-6 text-light fw-normal mb-0">{{ optional(auth()->user())->name }}</h6>
                                            @if(optional(auth()->user())->isOfficer())
                                                <h6 class="user-name fs-6 text-light fw-normal mb-0">
                                                    Counter
                                                    No.: {{ optional(optional(optional(auth()->user())->counterOfficer)->counter)->counter_number }}
                                                </h6>
                                            @endif

                                            <p class="user-email text-light fw-normal mb-0">
                                                <small>{{ optional(auth()->user())->email }}</small>
                                            </p>
                                        </div>
                                    </div>
                                    <div class="authInfo-actions px-2 py-3">
                                        <ul class="authInfo-dropdown-menu-list list-unstyled px-0 my-0">
                                            <li>
                                                <a class="dropdown-item d-flex align-items-center py-1"
                                                   href="{{ route('profile', optional(auth()->user())->id) }}">
                                                    View Profile
                                                </a>
                                            </li>
                                            <li>
                                                <a class="dropdown-item d-flex align-items-center py-1"
                                                   href="{{ route('logout') }}"
                                                   onclick="event.preventDefault();
                                                document.getElementById('logout-form').submit();">
                                                    Log Out
                                                </a>
                                                <form id="logout-form" action="{{ route('logout') }}" method="POST"
                                                      class="d-none">
                                                    @csrf
                                                    @method('POST')
                                                </form>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</header>
