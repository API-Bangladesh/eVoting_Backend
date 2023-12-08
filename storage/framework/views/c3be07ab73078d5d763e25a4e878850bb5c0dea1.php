<aside id="navigation-sidebar" class="bg-white is-radius is-drop-shadow">
    <nav class="navbar-light px-4 py-4 h-100">
        <ul class="navbar-nav flex-column">
            <li class="nav-item mb-2">
                <a class="nav-link" href="<?php echo e(route('home')); ?>">
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
                    <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('import voters')): ?>
                        <?php if(setting()->get('disable_voters_import') != 1): ?>
                            <li>
                                <a class="dropdown-item text-wrap pe-0 rounded" href="<?php echo e(route('import-voters')); ?>">
                                    Import
                                </a>
                            </li>
                        <?php endif; ?>
                    <?php endif; ?>
                    <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('read voters')): ?>
                        <li>
                            <a class="dropdown-item text-wrap pe-0 rounded" href="<?php echo e(route('voter-list')); ?>">
                                All Voters
                            </a>
                        </li>
                        <li>
                            <a class="dropdown-item text-wrap pe-0 rounded" href="<?php echo e(route('deleted-voter-list')); ?>">
                                Deleted Voters
                            </a>
                        </li>
                    <?php endif; ?>
                </ul>
            </li>

            <li class="nav-item mb-2 dropdown">
                <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown"
                   aria-expanded="false">
                    <i class="bi bi-archive fs-5"></i>
                    <span class="nav-text text-nowrap">Ballots</span>
                </a>
                <ul class="dropdown-menu ms-2 px-3 border-0 border-start mt-2">
                    <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('read positions')): ?>
                        <li>
                            <a class="dropdown-item text-wrap pe-0 rounded" href="<?php echo e(route('position-list')); ?>">
                                All Positions
                            </a>
                        </li>
                    <?php endif; ?>
                    <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('read candidates')): ?>
                        <li>
                            <a class="dropdown-item text-wrap pe-0 rounded" href="<?php echo e(route('candidate-list')); ?>">
                                All Candidates
                            </a>
                        </li>
                    <?php endif; ?>
                    <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('read ballots')): ?>
                        <li>
                            <a class="dropdown-item text-wrap pe-0 rounded" href="<?php echo e(route('ballot-papers')); ?>">
                                All Ballots
                            </a>
                        </li>
                    <?php endif; ?>
                </ul>
            </li>
            <?php if(is_enable_online_voting_function()): ?>
                <li class="nav-item mb-2 dropdown">
                    <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown"
                       aria-expanded="false">
                        <i class="bi bi-app-indicator fs-5"></i>
                        <span class="nav-text text-nowrap">Online</span>
                    </a>
                    <ul class="dropdown-menu ms-2 px-3 border-0 border-start mt-2">
                        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('create-form applications')): ?>
                            <li>
                                <a class="dropdown-item text-wrap pe-0 rounded"
                                   href="<?php echo e(route('create-application-form')); ?>"
                                   title="Create application submission form.">
                                    Application Form
                                </a>
                            </li>
                        <?php endif; ?>
                        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('read-submissions applications')): ?>
                            <li>
                                <a class="dropdown-item text-wrap pe-0 rounded" href="<?php echo e(route('application-list')); ?>"
                                   title="Submissions data">
                                    All Submissions
                                </a>
                            </li>
                        <?php endif; ?>
                        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('read-online-voters voters')): ?>
                            <li>
                                <a class="dropdown-item text-wrap pe-0 rounded" href="<?php echo e(route('online-voter-list')); ?>"
                                   title="Online voters">
                                    All Voters
                                </a>
                            </li>
                        <?php endif; ?>
                        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('read tokens')): ?>
                            <li>
                                <a class="dropdown-item text-wrap pe-0 rounded"
                                   href="<?php echo e(route('generated-token-list')); ?>"
                                   title="Online tokens">
                                    All Tokens
                                </a>
                            </li>
                        <?php endif; ?>
                    </ul>
                </li>
            <?php endif; ?>
            <?php if(is_enable_offline_voting_function()): ?>
                <li class="nav-item mb-2 dropdown">
                    <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown"
                       aria-expanded="false">
                        <i class="bi bi-archive-fill fs-5"></i>
                        <span class="nav-text text-nowrap">Offline</span>
                    </a>
                    <ul class="dropdown-menu ms-2 px-3 border-0 border-start mt-2">
                        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('read-offline-voters voters')): ?>
                            <li>
                                <a class="dropdown-item text-wrap pe-0 rounded" href="<?php echo e(route('offline-voter-list')); ?>"
                                   title="Offline voters">
                                    All Voters
                                </a>
                            </li>
                        <?php endif; ?>
                        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('read qr-codes')): ?>
                            <li>
                                <a class="dropdown-item text-wrap pe-0 rounded" href="<?php echo e(route('qr-code-list')); ?>"
                                   title="Qr-Code list">
                                    All Unique Codes
                                </a>
                            </li>
                        <?php endif; ?>
                        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('read counter-officers')): ?>
                            <li>
                                <a class="dropdown-item text-wrap pe-0 rounded"
                                   href="<?php echo e(route('counter-officer-list')); ?>" title="All Counter Officers">
                                    All Officers
                                </a>
                            </li>
                        <?php endif; ?>
                        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('read counters')): ?>
                            <li>
                                <a class="dropdown-item text-wrap pe-0 rounded" href="<?php echo e(route('counter-list')); ?>">
                                    All Counters
                                </a>
                            </li>
                        <?php endif; ?>
                        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('create offline-tokens')): ?>
                            <li>
                                <a class="dropdown-item text-wrap pe-0 rounded"
                                   href="<?php echo e(route('create-offline-token')); ?>" title="Create Offline Token">
                                    Create Token
                                </a>
                            </li>
                        <?php endif; ?>
                        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('read offline-tokens')): ?>
                            <li>
                                <a class="dropdown-item text-wrap pe-0 rounded"
                                   href="<?php echo e(route('offline-token-list')); ?>" title="All Offline Tokens">
                                    All Tokens
                                </a>
                            </li>
                        <?php endif; ?>
                        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('validate-ballots qr-codes')): ?>
                            <li>
                                <a class="dropdown-item text-wrap pe-0 rounded"
                                   href="<?php echo e(route('validate-qr-code-list')); ?>">
                                    Validate Ballot
                                </a>
                            </li>
                        <?php endif; ?>
                        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('verify-ballots qr-codes')): ?>
                            <li>
                                <a class="dropdown-item text-wrap pe-0 rounded"
                                   href="<?php echo e(route('verify-qr-code-list')); ?>">
                                    Verify Ballot
                                </a>
                            </li>
                        <?php endif; ?>
                        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('upload-voting-results voting-results')): ?>
                            <li>
                                <a class="dropdown-item text-wrap pe-0 rounded"
                                   href="<?php echo e(route('offline-result-insert-view')); ?>"
                                   title="Offline Voting Result Upload">
                                    Result Upload
                                </a>
                            </li>
                        <?php endif; ?>
                    </ul>
                </li>
            <?php endif; ?>

            <li class="nav-item mb-2 dropdown">
                <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown"
                   aria-expanded="false">
                    <i class="bi bi-person fs-5"></i>
                    <span class="nav-text text-nowrap">Users</span>
                </a>
                <ul class="dropdown-menu ms-2 px-3 border-0 border-start mt-2">
                    <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('read roles')): ?>
                        <li>
                            <a class="dropdown-item text-wrap pe-0 rounded" href="<?php echo e(route('role-list')); ?>">
                                All Roles
                            </a>
                        </li>
                    <?php endif; ?>
                    <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('read permissions')): ?>
                        <li>
                            <a class="dropdown-item text-wrap pe-0 rounded" href="<?php echo e(route('permission-list')); ?>">
                                All Permissions
                            </a>
                        </li>
                    <?php endif; ?>
                    <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('read users')): ?>
                        <li>
                            <a class="dropdown-item text-wrap pe-0 rounded" href="<?php echo e(route('user-list')); ?>">
                                All Users
                            </a>
                        </li>
                    <?php endif; ?>
                </ul>
            </li>

            <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('read voting-results')): ?>
                <li class="nav-item mb-2 dropdown">
                    <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown"
                       aria-expanded="false">
                        <i class="bi bi-file-bar-graph fs-5"></i>
                        <span class="nav-text text-nowrap">Result Screen</span>
                    </a>
                    <ul class="dropdown-menu ms-2 px-3 border-0 border-start mt-2">
                        <?php if(is_enable_online_voting_function()): ?>
                            <?php if(setting()->get('display_voting_result') == 1): ?>
                                <li>
                                    <a class="dropdown-item text-wrap pe-0 rounded"
                                       href="<?php echo e(route('online-result-slideshow')); ?>">
                                        <span class="nav-text text-nowrap">Online Result </span>
                                    </a>
                                </li>
                            <?php endif; ?>
                        <?php endif; ?>
                        <?php if(is_enable_offline_voting_function()): ?>
                            <?php if(setting()->get('display_voting_result') == 1): ?>
                                <li>
                                    <a class="dropdown-item text-wrap pe-0 rounded"
                                       href="<?php echo e(route('offline-result-show')); ?>">
                                        <span class="nav-text text-nowrap">Offline Result </span>
                                    </a>
                                </li>
                            <?php endif; ?>
                        <?php endif; ?>
                        <li>
                            <a class="dropdown-item text-wrap pe-0 rounded"
                               href="<?php echo e(route('view-printable-report')); ?>" target="_blank">
                                <span class="nav-text text-nowrap">Printable Report </span>
                            </a>
                        </li>
                    </ul>
                </li>
            <?php endif; ?>

            <?php if(is_enable_online_voting_function()): ?>
                <li class="nav-item mb-2 dropdown">
                    <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown"
                       aria-expanded="false">
                        <i class="bi bi-envelope-check fs-5"></i>
                        <span class="nav-text text-nowrap">Email Templates</span>
                    </a>
                    <ul class="dropdown-menu ms-2 px-3 border-0 border-start mt-2">
                        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('create email-templates')): ?>
                            <li>
                                <a class="dropdown-item text-wrap pe-0 rounded"
                                   href="<?php echo e(route('create-email-template')); ?>">
                                    Add New
                                </a>
                            </li>
                        <?php endif; ?>
                        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('read email-templates')): ?>
                            <li>
                                <a class="dropdown-item text-wrap pe-0 rounded"
                                   href="<?php echo e(route('email-template-list')); ?>">
                                    All Templates
                                </a>
                            </li>
                        <?php endif; ?>
                        
                    </ul>
                </li>
            <?php endif; ?>

            
            <li class="nav-item mb-2 dropdown">
                <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown"
                   aria-expanded="false">
                    <i class="bi bi-gear fs-5"></i>
                    <span class="nav-text text-nowrap">Settings</span>
                </a>
                <ul class="dropdown-menu ms-2 px-3 border-0 border-start mt-2">
                    <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('read settings')): ?>
                        <li>
                            <a class="dropdown-item text-wrap pe-0 rounded" href="<?php echo e(route('global-setting')); ?>">
                                Global Settings
                            </a>
                        </li>
                    <?php endif; ?>
                    <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('update-actions settings')): ?>
                        <li>
                            <a class="dropdown-item text-wrap pe-0 rounded" href="<?php echo e(route('action-setting')); ?>">
                                Action Settings
                            </a>
                        </li>
                    <?php endif; ?>
                    <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('update-print-config settings')): ?>
                        <li>
                            <a class="dropdown-item text-wrap pe-0 rounded" href="<?php echo e(route('print-setting')); ?>">
                                Print Settings
                            </a>
                        </li>
                    <?php endif; ?>
                    <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('update-voting-schedule settings')): ?>
                        <li>
                            <a class="dropdown-item text-wrap pe-0 rounded" href="<?php echo e(route('voting-schedule')); ?>">
                                Voting Scheduler
                            </a>
                        </li>
                    <?php endif; ?>
                    <?php if(is_enable_online_voting_function()): ?>
                        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('update-email-config settings')): ?>
                            <li>
                                <a class="dropdown-item text-wrap pe-0 rounded" href="<?php echo e(route('email-setting')); ?>">
                                    Email Settings
                                </a>
                            </li>
                        <?php endif; ?>
                        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('update-sms-config settings')): ?>
                            <li>
                                <a class="dropdown-item text-wrap pe-0 rounded" href="<?php echo e(route('sms-setting')); ?>">
                                    SMS Settings
                                </a>
                            </li>
                        <?php endif; ?>
                    <?php endif; ?>
                        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('db-clean settings')): ?>
                            <li>
                                <a class="dropdown-item text-wrap pe-0 rounded text-danger font-weight-bold"
                                   href="<?php echo e(url('command/db:clean')); ?>" onclick="return confirm('Are you sure?');">
                                    DB CLEAN
                                </a>
                            </li>
                        <?php endif; ?>
                </ul>
            </li>
            <li class="nav-item mb-2 dropdown">
                <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown"
                   aria-expanded="false">
                    <i class="bi bi-clock-history fs-5"></i>
                    <span class="nav-text text-nowrap">Logs</span>
                </a>
                <ul class="dropdown-menu ms-2 px-3 border-0 border-start mt-2">
                    <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('read activity-logs')): ?>
                        <li>
                            <a class="dropdown-item text-wrap pe-0 rounded"
                               href="<?php echo e(route('activity-log-list')); ?>">
                                Activity Logs
                            </a>
                        </li>
                    <?php endif; ?>
                    <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('read email-logs')): ?>
                        <li>
                            <a class="dropdown-item text-wrap pe-0 rounded"
                               href="<?php echo e(route('email-log-list')); ?>">
                                Email Logs
                            </a>
                        </li>
                    <?php endif; ?>
                </ul>
            </li>
            <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('test-devices-services settings')): ?>
                <li class="nav-item mb-5">
                    <a class="nav-link text-success font-weight-bold" href="<?php echo e(url('common/test-devices-services')); ?>">
                        <i class="bi bi-printer fs-5"></i>
                        Test Devices & Services
                    </a>
                </li>
            <?php endif; ?>
            
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
<?php /**PATH D:\laragon\www\eVoting_Backend\resources\views/admin/layout/page-sidebar.blade.php ENDPATH**/ ?>