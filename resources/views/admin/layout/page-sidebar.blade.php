<aside id="navigation-sidebar" class="bg-white is-radius is-drop-shadow">
    <nav class="navbar-light px-4 py-4 h-100">
        <ul class="navbar-nav flex-column">
            <li class="nav-item mb-2">
                <a class="nav-link" href="{{ route('home') }}">
                    <i class="bi bi-speedometer2 fs-5"></i>
                    <span class="nav-text text-nowrap">Dashboard</span>
                </a>
            </li>

            <li class="nav-item mb-2 dropdown">
                <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown"
                   aria-expanded="false">
                    <i class="bi bi-people fs-5"></i>
                    <span class="nav-text text-nowrap">Voters</span>
                </a>
                <ul class="dropdown-menu ms-2 px-3 border-0 border-start mt-2">
                    @can('import voters')
                        @if(setting()->get('disable_voters_import') != 1)
                            <li>
                                <a class="dropdown-item text-wrap pe-0 rounded" href="{{ route('import-voters') }}">
                                    Import
                                </a>
                            </li>
                        @endif
                    @endcan
                    @can('read voters')
                        <li>
                            <a class="dropdown-item text-wrap pe-0 rounded" href="{{ route('voter-list') }}">
                                All Voters
                            </a>
                        </li>
                        <li>
                            <a class="dropdown-item text-wrap pe-0 rounded" href="{{ route('deleted-voter-list') }}">
                                Deleted Voters
                            </a>
                        </li>
                    @endcan
                </ul>
            </li>

            <li class="nav-item mb-2 dropdown">
                <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown"
                   aria-expanded="false">
                    <i class="bi bi-archive fs-5"></i>
                    <span class="nav-text text-nowrap">Ballots</span>
                </a>
                <ul class="dropdown-menu ms-2 px-3 border-0 border-start mt-2">
                    @can('read positions')
                        <li>
                            <a class="dropdown-item text-wrap pe-0 rounded" href="{{ route('position-list') }}">
                                All Positions
                            </a>
                        </li>
                    @endcan
                    @can('read candidates')
                        <li>
                            <a class="dropdown-item text-wrap pe-0 rounded" href="{{ route('candidate-list') }}">
                                All Candidates
                            </a>
                        </li>
                    @endcan
                    @can('read ballots')
                        <li>
                            <a class="dropdown-item text-wrap pe-0 rounded" href="{{ route('ballot-papers') }}">
                                All Ballots
                            </a>
                        </li>
                    @endcan
                </ul>
            </li>
            @if(is_enable_online_voting_function())
                <li class="nav-item mb-2 dropdown">
                    <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown"
                       aria-expanded="false">
                        <i class="bi bi-app-indicator fs-5"></i>
                        <span class="nav-text text-nowrap">Online</span>
                    </a>
                    <ul class="dropdown-menu ms-2 px-3 border-0 border-start mt-2">
                        @can('create-form applications')
                            <li>
                                <a class="dropdown-item text-wrap pe-0 rounded"
                                   href="{{ route('create-application-form') }}"
                                   title="Create application submission form.">
                                    Application Form
                                </a>
                            </li>
                        @endcan
                        @can('read-submissions applications')
                            <li>
                                <a class="dropdown-item text-wrap pe-0 rounded" href="{{ route('application-list') }}"
                                   title="Submissions data">
                                    All Submissions
                                </a>
                            </li>
                        @endcan
                        @can('read-online-voters voters')
                            <li>
                                <a class="dropdown-item text-wrap pe-0 rounded" href="{{ route('online-voter-list') }}"
                                   title="Online voters">
                                    All Voters
                                </a>
                            </li>
                        @endcan
                        @can('read tokens')
                            <li>
                                <a class="dropdown-item text-wrap pe-0 rounded"
                                   href="{{ route('generated-token-list') }}"
                                   title="Online tokens">
                                    All Tokens
                                </a>
                            </li>
                        @endcan
                    </ul>
                </li>
            @endif
            @if(is_enable_offline_voting_function())
                <li class="nav-item mb-2 dropdown">
                    <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown"
                       aria-expanded="false">
                        <i class="bi bi-archive-fill fs-5"></i>
                        <span class="nav-text text-nowrap">Offline</span>
                    </a>
                    <ul class="dropdown-menu ms-2 px-3 border-0 border-start mt-2">
                        @can('read-offline-voters voters')
                            <li>
                                <a class="dropdown-item text-wrap pe-0 rounded" href="{{ route('offline-voter-list') }}"
                                   title="Offline voters">
                                    All Voters
                                </a>
                            </li>
                        @endcan
                        @can('read qr-codes')
                            <li>
                                <a class="dropdown-item text-wrap pe-0 rounded" href="{{ route('qr-code-list') }}"
                                   title="Qr-Code list">
                                    All Unique Codes
                                </a>
                            </li>
                        @endcan
                        @can('read counter-officers')
                            <li>
                                <a class="dropdown-item text-wrap pe-0 rounded"
                                   href="{{ route('counter-officer-list') }}" title="All Counter Officers">
                                    All Officers
                                </a>
                            </li>
                        @endcan
                        @can('read counters')
                            <li>
                                <a class="dropdown-item text-wrap pe-0 rounded" href="{{ route('counter-list') }}">
                                    All Counters
                                </a>
                            </li>
                        @endcan
                        @can('create offline-tokens')
                            <li>
                                <a class="dropdown-item text-wrap pe-0 rounded"
                                   href="{{ route('create-offline-token') }}" title="Create Offline Token">
                                    Create Token
                                </a>
                            </li>
                        @endcan
                        @can('read offline-tokens')
                            <li>
                                <a class="dropdown-item text-wrap pe-0 rounded"
                                   href="{{ route('offline-token-list') }}" title="All Offline Tokens">
                                    All Tokens
                                </a>
                            </li>
                        @endcan
                        @can('validate-ballots qr-codes')
                            <li>
                                <a class="dropdown-item text-wrap pe-0 rounded"
                                   href="{{ route('validate-qr-code-list') }}">
                                    Validate Ballot
                                </a>
                            </li>
                        @endcan
                        @can('verify-ballots qr-codes')
                            <li>
                                <a class="dropdown-item text-wrap pe-0 rounded"
                                   href="{{ route('verify-qr-code-list') }}">
                                    Verify Ballot
                                </a>
                            </li>
                        @endcan
                        @can('upload-voting-results voting-results')
                            <li>
                                <a class="dropdown-item text-wrap pe-0 rounded"
                                   href="{{ route('offline-result-insert-view') }}"
                                   title="Offline Voting Result Upload">
                                    Result Upload
                                </a>
                            </li>
                        @endcan
                    </ul>
                </li>
            @endif

            <li class="nav-item mb-2 dropdown">
                <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown"
                   aria-expanded="false">
                    <i class="bi bi-person fs-5"></i>
                    <span class="nav-text text-nowrap">Users</span>
                </a>
                <ul class="dropdown-menu ms-2 px-3 border-0 border-start mt-2">
                    @can('read roles')
                        <li>
                            <a class="dropdown-item text-wrap pe-0 rounded" href="{{ route('role-list') }}">
                                All Roles
                            </a>
                        </li>
                    @endcan
                    @can('read permissions')
                        <li>
                            <a class="dropdown-item text-wrap pe-0 rounded" href="{{ route('permission-list') }}">
                                All Permissions
                            </a>
                        </li>
                    @endcan
                    @can('read users')
                        <li>
                            <a class="dropdown-item text-wrap pe-0 rounded" href="{{ route('user-list') }}">
                                All Users
                            </a>
                        </li>
                    @endcan
                </ul>
            </li>

            @can('read voting-results')
                <li class="nav-item mb-2 dropdown">
                    <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown"
                       aria-expanded="false">
                        <i class="bi bi-file-bar-graph fs-5"></i>
                        <span class="nav-text text-nowrap">Result Screen</span>
                    </a>
                    <ul class="dropdown-menu ms-2 px-3 border-0 border-start mt-2">
                        @if(is_enable_online_voting_function())
                            @if(setting()->get('display_voting_result') == 1)
                                <li>
                                    <a class="dropdown-item text-wrap pe-0 rounded"
                                       href="{{ route('online-result-slideshow') }}">
                                        <span class="nav-text text-nowrap">Online Result </span>
                                    </a>
                                </li>
                            @endif
                        @endif
                        @if(is_enable_offline_voting_function())
                            @if(setting()->get('display_voting_result') == 1)
                                <li>
                                    <a class="dropdown-item text-wrap pe-0 rounded"
                                       href="{{ route('offline-result-show') }}">
                                        <span class="nav-text text-nowrap">Offline Result </span>
                                    </a>
                                </li>
                            @endif
                        @endif
                        <li>
                            <a class="dropdown-item text-wrap pe-0 rounded"
                               href="{{ route('view-printable-report') }}" target="_blank">
                                <span class="nav-text text-nowrap">Printable Report </span>
                            </a>
                        </li>
                    </ul>
                </li>
            @endcan

            @if(is_enable_online_voting_function())
                <li class="nav-item mb-2 dropdown">
                    <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown"
                       aria-expanded="false">
                        <i class="bi bi-envelope-check fs-5"></i>
                        <span class="nav-text text-nowrap">Email Templates</span>
                    </a>
                    <ul class="dropdown-menu ms-2 px-3 border-0 border-start mt-2">
                        @can('create email-templates')
                            <li>
                                <a class="dropdown-item text-wrap pe-0 rounded"
                                   href="{{ route('create-email-template') }}">
                                    Add New
                                </a>
                            </li>
                        @endcan
                        @can('read email-templates')
                            <li>
                                <a class="dropdown-item text-wrap pe-0 rounded"
                                   href="{{ route('email-template-list') }}">
                                    All Templates
                                </a>
                            </li>
                        @endcan
                        {{--<li>
                            <a class="dropdown-item text-wrap pe-0 rounded"
                               href="{{ route('email-sending-status') }}">
                                All Email Statuses
                            </a>
                        </li>--}}
                    </ul>
                </li>
            @endif

            {{--@if(optional(auth()->user())->isSuperAdmin())
                <li class="nav-item mb-2 dropdown">
                    <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown"
                       aria-expanded="false">
                        <i class="bi bi-plug fs-5"></i>
                        <span class="nav-text text-nowrap">Addons</span>
                    </a>
                    <ul class="dropdown-menu ms-2 px-3 border-0 border-start mt-2">
                        <li>
                            <a class="dropdown-item text-wrap pe-0 rounded" href="#">
                                Authentication
                            </a>
                        </li>
                        <li>
                            <a class="dropdown-item text-wrap pe-0 rounded" href="#">
                                Cloud Hosting
                            </a>
                        </li>
                        <li>
                            <a class="dropdown-item text-wrap pe-0 rounded" href="#">
                                SMTP Service
                            </a>
                        </li>
                        <li>
                            <a class="dropdown-item text-wrap pe-0 rounded" href="#">
                                Support Portal
                            </a>
                        </li>
                    </ul>
                </li>
            @endif--}}
            <li class="nav-item mb-2 dropdown">
                <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown"
                   aria-expanded="false">
                    <i class="bi bi-gear fs-5"></i>
                    <span class="nav-text text-nowrap">Settings</span>
                </a>
                <ul class="dropdown-menu ms-2 px-3 border-0 border-start mt-2">
                    @can('read settings')
                        <li>
                            <a class="dropdown-item text-wrap pe-0 rounded" href="{{ route('global-setting') }}">
                                Global Settings
                            </a>
                        </li>
                    @endcan
                    @can('update-actions settings')
                        <li>
                            <a class="dropdown-item text-wrap pe-0 rounded" href="{{ route('action-setting') }}">
                                Action Settings
                            </a>
                        </li>
                    @endcan
                    @can('update-print-config settings')
                        <li>
                            <a class="dropdown-item text-wrap pe-0 rounded" href="{{ route('print-setting') }}">
                                Print Settings
                            </a>
                        </li>
                    @endcan
                    @can('update-voting-schedule settings')
                        <li>
                            <a class="dropdown-item text-wrap pe-0 rounded" href="{{ route('voting-schedule') }}">
                                Voting Scheduler
                            </a>
                        </li>
                    @endcan
                    @if(is_enable_online_voting_function())
                        @can('update-email-config settings')
                            <li>
                                <a class="dropdown-item text-wrap pe-0 rounded" href="{{ route('email-setting') }}">
                                    Email Settings
                                </a>
                            </li>
                        @endcan
                        @can('update-sms-config settings')
                            <li>
                                <a class="dropdown-item text-wrap pe-0 rounded" href="{{ route('sms-setting') }}">
                                    SMS Settings
                                </a>
                            </li>
                        @endcan
                    @endif
                        @can('db-clean settings')
                            <li>
                                <a class="dropdown-item text-wrap pe-0 rounded text-danger font-weight-bold"
                                   href="{{ url('command/db:clean') }}" onclick="return confirm('Are you sure?');">
                                    DB CLEAN
                                </a>
                            </li>
                        @endcan
                </ul>
            </li>
            <li class="nav-item mb-2 dropdown">
                <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown"
                   aria-expanded="false">
                    <i class="bi bi-clock-history fs-5"></i>
                    <span class="nav-text text-nowrap">Logs</span>
                </a>
                <ul class="dropdown-menu ms-2 px-3 border-0 border-start mt-2">
                    @can('read activity-logs')
                        <li>
                            <a class="dropdown-item text-wrap pe-0 rounded"
                               href="{{ route('activity-log-list') }}">
                                Activity Logs
                            </a>
                        </li>
                    @endcan
                    @can('read email-logs')
                        <li>
                            <a class="dropdown-item text-wrap pe-0 rounded"
                               href="{{ route('email-log-list') }}">
                                Email Logs
                            </a>
                        </li>
                    @endcan
                </ul>
            </li>
            @can('test-devices-services settings')
                <li class="nav-item mb-5">
                    <a class="nav-link text-success font-weight-bold" href="{{ url('common/test-devices-services') }}">
                        <i class="bi bi-printer fs-5"></i>
                        Test Devices & Services
                    </a>
                </li>
            @endcan
            {{--@if(optional(auth()->user())->isSuperAdmin())
                <li class="nav-item mb-2 dropdown">
                    <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown"
                       aria-expanded="false">
                        <i class="bi bi-archive fs-5"></i>
                        <span class="nav-text text-nowrap">Archives</span>
                    </a>
                    <ul class="dropdown-menu ms-2 px-3 border-0 border-start mt-2">
                        <li>
                            <a class="dropdown-item text-wrap pe-0 rounded" href="#">
                                Add New
                            </a>
                        </li>
                        <li>
                            <a class="dropdown-item text-wrap pe-0 rounded" href="#">
                                All Archives
                            </a>
                        </li>
                    </ul>
                </li>
            @endif--}}
        </ul>
    </nav>

    <script type="text/javascript">
        $(function () {
            let dropdownElement = $('.dropdown');
            if (dropdownElement.length) {
                dropdownElement.each(function () {
                    if ($(this).find('.dropdown-item').length < 1) {
                        $(this).remove();
                    }
                });
            }
        });
    </script>
</aside>
