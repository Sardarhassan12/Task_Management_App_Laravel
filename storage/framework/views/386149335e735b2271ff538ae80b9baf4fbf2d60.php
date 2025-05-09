<?php $__env->startSection('title'); ?>
    <?php echo app('translator')->get('translation.project-list'); ?>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>
    <?php $__env->startComponent('components.breadcrumb'); ?>
        <?php $__env->slot('li_1'); ?>
            Task
        <?php $__env->endSlot(); ?>
        <?php $__env->slot('title'); ?>
            Task List
        <?php $__env->endSlot(); ?>
    <?php echo $__env->renderComponent(); ?>
    <?php if(session('success')): ?>
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <?php echo e(session('success')); ?>

            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    <?php endif; ?>
    
    <div class="row g-4 mb-3">
        <div class="col-sm-auto">
            <div>
                <a href="/create" class="btn btn-success"><i class="ri-add-line align-bottom me-1"></i> Add
                    New</a>
            </div>
        </div>
        <div class="col-sm">
            <div class="d-flex justify-content-sm-end gap-2">
                <div class="search-box ms-2">
                    <input type="text" class="form-control" placeholder="Search...">
                    <i class="ri-search-line search-icon"></i>
                </div>

            </div>
        </div>
    </div>


    <div class="row">
        <?php $__currentLoopData = $userTasks; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $userTask): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <div class="col-xxl-3 col-sm-6 project-card">
                <div class="card">
                    <div class="card-body">
                        <div class="p-3 mt-n3 mx-n3 bg-soft-secondary rounded-top">
                            <div class="d-flex gap-1 align-items-center justify-content-end my-n2">
                                <button type="button" class="btn avatar-xs p-0 favourite-btn active">
                                    <span class="avatar-title bg-transparent fs-15">
                                        <i class="ri-star-fill"></i>
                                    </span>
                                </button>
                                <div class="dropdown">
                                    <button class="btn btn-link text-muted p-1 mt-n1 py-0 text-decoration-none fs-15"
                                        data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
                                        <i data-feather="more-horizontal" class="icon-sm"></i>
                                    </button>

                                    <div class="dropdown-menu dropdown-menu-end">
                                        <a class="dropdown-item" href="/update/<?php echo e($userTask->id); ?>"><i
                                                class="ri-pencil-fill align-bottom me-2 text-muted"></i>
                                            Edit</a>
                                        <div class="dropdown-divider"></div>
                                            <a class="dropdown-item" href="#" data-bs-toggle="modal"
                                            data-bs-target="#removeProjectModal"><i
                                                class="ri-delete-bin-fill align-bottom me-2 text-muted"></i>
                                            Remove</a>
                                        </form>
                                    </div>
                                </div>
                            </div>
                            <div class="text-center pb-3">
                                <img src="<?php echo e(URL::asset('images/tasksimages/' . $userTask->image)); ?>" alt="" height="52">
                            </div>
                        </div>

                        <div class="py-3">
                            <h5 class="fs-14 mb-3"><a href="apps-projects-overview" class="text-dark"><?php echo e($userTask->title); ?></a></h5>
                            <div class="row gy-3">
                                <div class="col-6">
                                    <div>
                                        <p class="text-muted mb-1">Status</p>
                                        <div class="badge badge-soft-warning fs-12"><?php echo e($userTask->status); ?></div>
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div>
                                        <p class="text-muted mb-1">Deadline</p>
                                        <h5 class="fs-14"><?php echo e($userTask->deadline); ?></h5>
                                    </div>
                                </div>
                            </div>

                            <div class="d-flex align-items-center mt-3">
                                <?php echo e($userTask->description); ?>

                            </div>
                        </div>
                    </div>
                    <!-- end card body -->
                </div>
                <!-- end card -->
            </div>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        <!-- end col -->
        
    </div>
    <!-- end row -->







<!-- Pagination Starts from Here.... -->
    <div class="row g-0 text-center text-sm-start align-items-center mb-4">
        <div class="col-sm-6">
            <div>
                <p class="mb-sm-0 text-muted">Showing <span class="fw-semibold">1</span> to <span
                        class="fw-semibold">10</span> of <span class="fw-semibold text-decoration-underline">12</span>
                    entries</p>
            </div>
        </div>
        <!-- end col -->
        <div class="col-sm-6">
            <ul class="pagination pagination-separated justify-content-center justify-content-sm-end mb-sm-0">
                <li class="page-item disabled">
                    <a href="#" class="page-link">Previous</a>
                </li>
                <li class="page-item active">
                    <a href="#" class="page-link">1</a>
                </li>
                <li class="page-item ">
                    <a href="#" class="page-link">2</a>
                </li>
                <li class="page-item">
                    <a href="#" class="page-link">3</a>
                </li>
                <li class="page-item">
                    <a href="#" class="page-link">4</a>
                </li>
                <li class="page-item">
                    <a href="#" class="page-link">5</a>
                </li>
                <li class="page-item">
                    <a href="#" class="page-link">Next</a>
                </li>
            </ul>
        </div><!-- end col -->
    </div><!-- end row -->

    <!-- END layout-wrapper -->


    <!-- removeProjectModal -->
    <?php $__currentLoopData = $userTasks; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $userTask): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <form action="/delete/<?php echo e($userTask->id); ?>" method="POST">
            <?php echo csrf_field(); ?>
            <?php echo method_field('DELETE'); ?>
            <div id="removeProjectModal" class="modal fade zoomIn" tabindex="-1" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"
                                id="close-modal"></button>
                        </div>
                        <div class="modal-body">
                            <div class="mt-2 text-center">
                                <lord-icon src="https://cdn.lordicon.com/gsqxdxog.json" trigger="loop"
                                    colors="primary:#f7b84b,secondary:#f06548" style="width:100px;height:100px"></lord-icon>
                                <div class="mt-4 pt-2 fs-15 mx-4 mx-sm-5">
                                    <h4>Are you Sure ?</h4>
                                    <p class="text-muted mx-4 mb-0">Are you Sure You want to Remove this Project ?</p>
                                </div>
                            </div>
                            <div class="d-flex gap-2 justify-content-center mt-4 mb-2">
                                <button type="button" class="btn w-sm btn-light" data-bs-dismiss="modal">Close</button>
                                <button type="submit" class="btn w-sm btn-danger" id="remove-project">Yes, Delete It!</button>
                            </div>
                        </div>

                    </div><!-- /.modal-content -->
                </div><!-- /.modal-dialog -->
            </div><!-- /.modal -->
        </form>
    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('script'); ?>
    <script src="<?php echo e(URL::asset('assets/js/pages/project-list.init.js')); ?>"></script>
    <script src="<?php echo e(URL::asset('/assets/js/app.min.js')); ?>"></script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\xampp\TaskApp\resources\views/Task/view.blade.php ENDPATH**/ ?>