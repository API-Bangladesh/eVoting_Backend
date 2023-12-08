
<?php $__env->startSection('title', 'All Imported Voters'); ?>

<?php $__env->startSection('content'); ?>
    <main id="dashboard">
        <div class="container-fluid">
            <h3 class="fs-3 fw-normal mb-4">Imported Voter List</h3>
            <form class="mb-2" action="<?php echo e(route('search-voters')); ?>">
                <?php echo csrf_field(); ?>
                <div class="row justify-content-sm-between">
                    <div class="col-sm-4 col-md-6">
                        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('create voters')): ?>
                            <?php if((is_enable_offline_voting_function() && setting()->get('lock_qr_code') != 1) || (is_enable_online_voting_function() && setting()->get('lock_online_token') != 1)): ?>
                                <a href="<?php echo e(route('create-voter')); ?>" class="btn btn-sm px-3 btn-primary mb-2 mb-sm-0">
                                    <i class="bi bi-plus me-1"></i> Add New
                                </a>
                            <?php endif; ?>
                        <?php endif; ?>
                        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('delete-permanently voters')): ?>
                            <?php if(setting()->get('disable_permanently_voters_deletion') != 1): ?>
                                <a href="<?php echo e(route('voter.permanently-delete-voters')); ?>"
                                   id="btn-permanently-delete-voters"
                                   class="btn btn-sm px-3 btn-danger mb-2 mb-sm-0">
                                    <i class="bi bi-trash me-1"></i> Permanently Delete All Voters
                                </a>
                            <?php endif; ?>
                        <?php endif; ?>
                    </div>
                    <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('search voters')): ?>
                        <div class="col-sm-5 col-md-4 d-flex flex-column">
                            <div class="input-group">
                                <input type="text" class="form-control" placeholder="Search voter info" name="keyword"
                                       value="<?php echo e(request()->input('keyword')); ?>" maxlength="40"/>
                                <button type="submit" class="btn text-light btn-primary btn-sm">
                                    Search
                                </button>
                            </div>
                            <div class="form-check" title="Find uncompleted voters">
                                <input type="checkbox" name="missing" value="1" <?php if(request()->get('missing')): ?> checked
                                       <?php endif; ?> id="missing"
                                       class="form-check-input">
                                <label class="form-check-label" for="missing">
                                    Find Voters: Missing Info
                                </label>
                            </div>
                        </div>
                    <?php endif; ?>
                </div>
            </form>
            <div class="eVote-table p-4 is-drop-shadow bg-white rounded">
                <div class="d-flex align-items-center justify-content-between mb-4">
                    <div class="mb-0">
                        Total Voters:
                        <strong class="text-cyan">
                            <?php echo e($voters->total()); ?>

                        </strong>
                    </div>
                    <div class="export-data d-flex align-items-center gap-2">
                        <div class="modal fade" id="exportPDF" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalLabel">
                                            Exportable Files Pagination
                                        </h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        <?php $__currentLoopData = $filesOffsetData; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $fileData): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <a href="<?php echo e(route('download-voters-pdf', ['start' => $fileData['start'], 'end' => $fileData['end'], 'limit' => $fileData['limit']])); ?>"
                                               type="button" target="_blank"
                                               class="btn btn-danger btn-sm mb-1">
                                                <?php echo e($fileData['start']); ?> - <?php echo e($fileData['end']); ?>

                                            </a>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                                            Close
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('export voters')): ?>
                            <button type="button" class="btn btn-danger btn-sm" data-bs-toggle="modal"
                                    data-bs-target="#exportPDF">
                                <i class="bi bi-download me-1"></i>
                                Export PDF
                            </button>
                            <a href="<?php echo e(route('VotersExportExcel')); ?>" type="button" target="_blank"
                               class="btn btn-info btn-sm">
                                <i class="bi bi-file-earmark-excel me-1"></i>
                                Export Excel
                            </a>
                        <?php endif; ?>
                        <div class="modal fade" id="printablePDF" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title">
                                            Printable Files Pagination
                                        </h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        <?php $__currentLoopData = $filesOffsetData; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $fileData): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <a href="<?php echo e(route('print-voters-pdf', ['start' => $fileData['start'], 'end' => $fileData['end'], 'limit' => $fileData['limit']])); ?>"
                                               type="button" target="_blank"
                                               class="btn btn-warning btn-sm mb-1">
                                                <?php echo e($fileData['start']); ?> - <?php echo e($fileData['end']); ?>

                                            </a>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                                            Close
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('export voters')): ?>
                            <button type="button" class="btn btn-warning btn-sm" data-bs-toggle="modal"
                                    data-bs-target="#printablePDF">
                                <i class="bi bi-printer me-1"></i>
                                Printable PDF
                            </button>
                        <?php endif; ?>
                    </div>
                </div>
                <div class="voter-list table-responsive">
                    <table class="table table-sm align-middle" id="someTable">
                        <thead class="text-uppercase">
                        <div id="grpChkBox">
                            <tr>
                                <th class="sl">#ID</th>
                                <th class="name">Name</th>
                                <th class="id text-nowrap">Member ID</th>
                                <th class="category">category</th>
                                <th class="email">Email</th>
                                <th class="phone">Phone</th>
                                <th class="image">image</th>
                                <?php if(setting()->get('disable_voters_deletion') !== 1): ?>
                                    <th>Action</th>
                                <?php endif; ?>
                            </tr>
                        </div>
                        </thead>
                        <tbody>
                        <?php $__currentLoopData = $voters; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $voter): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <tr>
                                <td class="gfgusername"><?php echo e($voter->id); ?></td>
                                <td class="gfgpp"><?php echo e($voter->name); ?></td>
                                <td class="gfgscores"><?php echo e($voter->member_id); ?></td>
                                <td class="gfgarticles"><?php echo e($voter->category); ?></td>
                                <td><?php echo e($voter->email_address); ?></td>
                                <td><?php echo e($voter->contact_number); ?></td>
                                <td>
                                    <img src="<?php echo e(get_uploaded_file_url($voter->image)); ?>"
                                         alt="<?php echo e($voter->name); ?>" width="500" height="600">
                                </td>
                                <td>
                                    <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('update voters')): ?>
                                        <a href="<?php echo e(route('edit-voter', $voter->id)); ?>"
                                           class="btn btn-info text-light btn-sm">
                                            <i class="bi bi-pencil"></i>
                                        </a>
                                    <?php endif; ?>
                                    <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('trash voters')): ?>
                                        <?php if(setting()->get('disable_voters_deletion') !== 1): ?>
                                            <a href="<?php echo e(route('trash-voter', $voter->id)); ?>"
                                               class="btn btn-danger btn-sm btnTrashRecord" title="Move to Trash">
                                                <i class="bi bi-trash"></i>
                                            </a>
                                        <?php endif; ?>
                                    <?php endif; ?>
                                </td>
                            </tr>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </tbody>
                    </table>
                </div>

                <?php echo e($voters->links()); ?>


            </div>
        </div>


    </main>

    <script type="text/javascript">
        $(function () {
            $('#btn-permanently-delete-voters').on('click', function (e) {
                let confirm = prompt("Type 'DELETE' to confirm. \nPermanently delete voter list will delete all voter data permanently.");
                if (confirm !== null) {
                    if (confirm !== 'DELETE') {
                        e.preventDefault();
                        e.stopPropagation();
                        return;
                    }
                } else {
                    e.preventDefault();
                    e.stopPropagation();
                    return;
                }
            });
        });
    </script>
    <script>
        function printDiv(divName) {
            var printContents = document.getElementById(divName).innerHTML;
            var originalContents = document.body.innerHTML;

            document.body.innerHTML = printContents;

            window.print();

            document.body.innerHTML = originalContents;

        }
    </script>
    <script>
        $(function () {
            var $chk = $("#grpChkBox input:checkbox");
            var $tbl = $("#someTable");
            var $tblhead = $("#someTable th");

            $chk.prop('checked', true);

            $chk.click(function () {
                var colToHide = $tblhead.filter("." + $(this).attr("name"));
                var index = $(colToHide).index();
                $tbl.find('tr :nth-child(' + (index + 1) + ')').toggle();
            });
        });
    </script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('admin.layout.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\laragon\www\eVoting_Backend\resources\views/admin/voter/index.blade.php ENDPATH**/ ?>