

<?php $__env->startSection('content'); ?>

    <div class="card">
        <form class="" id="" action="" method="GET">
            <div class="card-header row gutters-5">
                <div class="col text-center text-md-left">
                    <h5 class="mb-md-0 h6"><?php echo e(translate('Countries')); ?></h5>
                </div>
                <div class="col-md-3">
                    <input type="text" class="form-control" id="sort_country" name="sort_country" <?php if(isset($sort_country)): ?> value="<?php echo e($sort_country); ?>" <?php endif; ?> placeholder="<?php echo e(translate('Type country name')); ?>">
                </div>
                <div class="col-md-1">
                    <button class="btn btn-primary" type="submit"><?php echo e(translate('Filter')); ?></button>
                </div>
            </div>
        </form>
        <div class="card-body">
            <table class="table aiz-table table-striped table-bordered" cellspacing="0" width="100%">
                <thead>
                    <tr>
                        <th width="10%">#</th>
                        <th><?php echo e(translate('Name')); ?></th>
                        <th data-breakpoints="lg"><?php echo e(translate('Code')); ?></th>
                        <th><?php echo e(translate('Show/Hide')); ?></th>
                    </tr>
                </thead>
                <tbody>
                    <?php $__currentLoopData = $countries; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $country): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <tr>
                            <td><?php echo e(($key+1) + ($countries->currentPage() - 1)*$countries->perPage()); ?></td>
                            <td><?php echo e($country->name); ?></td>
                            <td><?php echo e($country->code); ?></td>
                            <td>
                              <label class="aiz-switch aiz-switch-success mb-0">
                                <input onchange="update_status(this)" value="<?php echo e($country->id); ?>" type="checkbox" <?php if($country->status == 1) echo "checked";?> >
                                <span class="slider round"></span>
                              </label>
                            </td>
                        </tr>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </tbody>
            </table>
            <div class="aiz-pagination">
                <?php echo e($countries->appends(request()->input())->links()); ?>

            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('script'); ?>
    <script type="text/javascript">

        function update_status(el){
            if(el.checked){
                var status = 1;
            }
            else{
                var status = 0;
            }
            $.post('<?php echo e(route('countries.status')); ?>', {_token:'<?php echo e(csrf_token()); ?>', id:el.value, status:status}, function(data){
                if(data == 1){
                    AIZ.plugins.notify('success', '<?php echo e(translate('Country status updated successfully')); ?>');
                }
                else{
                    AIZ.plugins.notify('danger', '<?php echo e(translate('Something went wrong')); ?>');
                }
            });
        }

    </script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('backend.layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /Applications/XAMPP/xamppfiles/htdocs/active-ecommerce/resources/views/backend/setup_configurations/countries/index.blade.php ENDPATH**/ ?>