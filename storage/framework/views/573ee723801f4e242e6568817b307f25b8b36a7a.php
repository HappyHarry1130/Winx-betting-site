<?php $__env->startSection('title'); ?>
    <?php echo app('translator')->get($page_title); ?>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>
    <div class="page-header card card-primary m-0 m-md-4 my-4 m-md-0 p-5 shadow">
        <form action="<?php echo e(route('admin.payout-log.search')); ?>" method="get">
            <div class="row justify-content-between align-items-center">
                <div class="col-md-4">
                    <div class="form-group">
                        <input type="text" name="name" value="<?php echo e(@request()->name); ?>" class="form-control"
                               placeholder="<?php echo app('translator')->get('Email/ Username/ Trx'); ?>">
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="form-group">
                        <select name="status" class="form-control">
                            <option value=""><?php echo app('translator')->get('All Payment'); ?></option>
                            <option value="1"
                                    <?php if(@request()->status == '1'): ?> selected <?php endif; ?>><?php echo app('translator')->get('Pending Payment'); ?></option>
                            <option value="2"
                                    <?php if(@request()->status == '2'): ?> selected <?php endif; ?>><?php echo app('translator')->get('Complete Payment'); ?></option>
                            <option value="3"
                                    <?php if(@request()->status == '3'): ?> selected <?php endif; ?>><?php echo app('translator')->get('Cancel Payment'); ?></option>
                        </select>
                    </div>
                </div>

                <div class="col-md-3">
                    <div class="form-group">
                        <input type="date" class="form-control" name="date_time" id="datepicker"/>
                    </div>
                </div>


                <div class="col-md-2">
                    <div class="form-group">
                        <button type="submit" class="btn waves-effect waves-light btn-primary"><i
                                class="fas fa-search"></i> <?php echo app('translator')->get('Search'); ?></button>
                    </div>
                </div>
            </div>
        </form>

    </div>


    <div class="card card-primary m-0 m-md-4 my-4 m-md-0 shadow">
        <div class="card-body">

            <div class="table-responsive">
                <table class="categories-show-table table table-hover table-striped table-bordered">
                    <thead class="thead-dark">
                    <tr>
                        <th scope="col"><?php echo app('translator')->get('Date'); ?></th>
                        <th scope="col"><?php echo app('translator')->get('Trx Number'); ?></th>
                        <th scope="col"><?php echo app('translator')->get('Username'); ?></th>
                        <th scope="col"><?php echo app('translator')->get('Method'); ?></th>
                        <th scope="col"><?php echo app('translator')->get('Amount'); ?></th>
                        <th scope="col"><?php echo app('translator')->get('Charge'); ?></th>
                        <th scope="col"><?php echo app('translator')->get('Net Amount'); ?></th>
                        <th scope="col"><?php echo app('translator')->get('Status'); ?></th>
                        <?php if(adminAccessRoute(config('role.payout_manage.access.edit'))): ?>
                            <th scope="col"><?php echo app('translator')->get('More'); ?></th>
                        <?php endif; ?>
                    </tr>
                    </thead>
                    <tbody>
                    <?php $__empty_1 = true; $__currentLoopData = $records; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                        <tr>
                            <td data-label="<?php echo app('translator')->get('Date'); ?>"> <?php echo e(dateTime($item->created_at,'d M,Y H:i')); ?></td>
                            <td data-label="<?php echo app('translator')->get('Trx Number'); ?>"
                                class="font-weight-bold text-uppercase"><?php echo e($item->trx_id); ?></td>
                            <td data-label="<?php echo app('translator')->get('Username'); ?>">
                                <a href="<?php echo e(route('admin.user-edit',[$item->user_id])); ?>">
                                    <div class="d-lg-flex d-block align-items-center ">
                                        <div class="mr-3"><img
                                                src="<?php echo e(getFile(config('location.user.path').optional($item->user)->image)); ?>"
                                                alt="user" class="rounded-circle" width="45"
                                                height="45"></div>


                                        <div class="">
                                            <h5 class="text-dark mb-0 font-16 font-weight-medium"><?php echo e(optional($item->user)->username); ?></h5>
                                            <span class="text-muted font-14"><?php echo e(optional($item->user)->email); ?></span>
                                        </div>
                                    </div>
                                </a>

                            </td>
                            <td data-label="<?php echo app('translator')->get('Method'); ?>"><?php echo e(optional($item->method)->name); ?></td>
                            <td data-label="<?php echo app('translator')->get('Amount'); ?>"
                                class="font-weight-bold"><?php echo e(getAmount($item->amount )); ?> <?php echo e($basic->currency); ?></td>
                            <td data-label="<?php echo app('translator')->get('Charge'); ?>"
                                class="text-success"><?php echo e(getAmount($item->charge)); ?> <?php echo e($basic->currency); ?></td>
                            <td data-label="<?php echo app('translator')->get('Net Amount'); ?>"
                                class="font-weight-bold"><?php echo e(getAmount($item->net_amount)); ?> <?php echo e($basic->currency); ?></td>

                            <td data-label="<?php echo app('translator')->get('Status'); ?>" class="text-lg-center text-right">
                                <?php if($item->status == 2): ?>
                                    <span class="badge badge-light"><i class="fa fa-circle text-success font-12"></i> <?php echo app('translator')->get('Approved'); ?></span>
                                <?php elseif($item->status == 1): ?>
                                    <span class="badge badge-light"><i class="fa fa-circle text-warning font-12"></i> <?php echo app('translator')->get('Pending'); ?></span>
                                <?php elseif($item->status == 3): ?>
                                    <span class="badge badge-light"><i class="fa fa-circle text-danger font-12"></i> <?php echo app('translator')->get('Rejected'); ?></span>
                                <?php endif; ?>
                            </td>

                            <?php if(adminAccessRoute(config('role.payout_manage.access.edit'))): ?>
                                <td data-label="<?php echo app('translator')->get('More'); ?>">
                                    <a href="<?php echo e(route('admin.payout-view',$item->id)); ?>"
                                       class="btn btn-primary btn-icon edit_button"><i class="fa fa-eye"></i></a>
                                </td>
                            <?php endif; ?>

                        </tr>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                        <tr>
                            <td colspan="100%">
                                <p class="text-dark"><?php echo app('translator')->get('No Data Found'); ?></p>
                            </td>
                        </tr>

                    <?php endif; ?>
                    </tbody>
                </table>
                <?php echo e($records->appends($_GET)->links('partials.pagination')); ?>

            </div>
        </div>
    </div>




    <!-- Modal for Edit button -->
    <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
         aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content ">
                <div class="modal-header modal-colored-header bg-primary">
                    <h4 class="modal-title" id="myModalLabel"><?php echo app('translator')->get('Payout Information'); ?></h4>
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                </div>

                <form role="form" method="POST" class="actionRoute" action="" enctype="multipart/form-data">
                    <?php echo csrf_field(); ?>
                    <?php echo method_field('put'); ?>
                    <div class="modal-body">
                        <ul class="list-group withdraw-detail">
                        </ul>

                        <?php if(Request::routeIs('admin.payout-request')): ?>

                            <div class="form-group addForm">

                            </div>
                        <?php endif; ?>

                    </div>
                    <div class="modal-footer">

                        <button type="button" class="btn btn-secondary" data-dismiss="modal"><?php echo app('translator')->get('Close'); ?>
                        </button>
                        <?php if(Request::routeIs('admin.payout-request')): ?>
                            <input type="hidden" class="action_id" name="id">
                            <button type="submit" class="btn btn-primary" name="status"
                                    value="2"><?php echo app('translator')->get('Approve'); ?></button>
                            <button type="submit" class="btn btn-danger" name="status"
                                    value="3"><?php echo app('translator')->get('Reject'); ?></button>
                        <?php endif; ?>
                    </div>

                </form>


            </div>
        </div>
    </div>

<?php $__env->stopSection(); ?>
<?php $__env->startPush('js'); ?>
    <script>
        (function ($) {
            "use strict";

            $(document).ready(function () {
                $(document).on("click", '.edit_button', function (e) {
                    var id = $(this).data('id');
                    $(".action_id").val(id);
                    $(".actionRoute").attr('action', $(this).data('route'));
                    var details = Object.entries($(this).data('info'));
                    var list = [];
                    var ImgPath = "<?php echo e(asset(config('location.withdrawLog.path'))); ?>";
                    details.map(function (item, i) {
                        if (item[1].type == 'file') {
                            var singleInfo = `<br><img src="${ImgPath}/${item[1].field_name}" alt="..." class="w-50">`;
                        } else {
                            var singleInfo = `<span class="font-weight-bold ml-3">${item[1].field_name}</span>  `;
                        }
                        list[i] = ` <li class="list-group-item"><span class="font-weight-bold "> ${item[0].replace('_', " ")} </span> : ${singleInfo}</li>`
                    });


                    if ($(this).data('status') != '1') {
                        list[details.length + 1] = `<li class="list-group-item"><span class="font-weight-bold"><?php echo app('translator')->get('Admin Feedback'); ?></span> : <span">${$(this).data('feedback')}</span></li>`;
                        $('.addForm').html(``)
                    } else {
                        list[details.length + 1] = ``;
                        $('.addForm').html(`
                                <div class="form-group">
                                <label for="feedback"><?php echo app('translator')->get('feedback'); ?></label>
                                <textarea class="form-control" name="feedback"></textarea>
                                </div>
                        `);
                    }

                    $('.withdraw-detail').html(list);
                });
            });
        })(jQuery);


        $(document).ready(function () {
            $('select').select2({
                selectOnClose: true
            });
        });
    </script>
<?php $__env->stopPush(); ?>


<?php echo $__env->make('admin.layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\server\htdocs\prophect-2.0\project\resources\views/admin/payout/logs.blade.php ENDPATH**/ ?>