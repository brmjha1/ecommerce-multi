

<?php $__env->startSection('content'); ?>

<div class="aiz-titlebar text-left mt-2 mb-3">
    <h5 class="mb-0 h6"><?php echo e(translate('Tax Information')); ?></h5>
</div>

<div class="row">
    <div class="col-lg-6 mx-auto">
        <div class="card">
            <div class="card-header">
                <h5 class="mb-0 h6"><?php echo e(translate('update Tax Info')); ?></h5>
            </div>
            <div class="card-body p-0">
                <form class="p-4" action="<?php echo e(route('tax.update', $tax->id)); ?>" method="POST">
                    <input name="_method" type="hidden" value="PATCH">
                    <?php echo csrf_field(); ?>
                    <div class="form-group row">
                        <div class="col-lg-3">
                            <label class="control-label"><?php echo e(translate('Name')); ?></label>
                        </div>
                        <div class="col-lg-9">
                            <input type="text" class="form-control" name="name" placeholder="<?php echo e(translate('Name')); ?>" value="<?php echo e($tax->name); ?>" required>
                        </div>
                    </div>
                    
                    <div class="form-group mb-0 text-right">
                        <button type="submit" class="btn btn-sm btn-primary"><?php echo e(translate('Save')); ?></button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('backend.layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /Applications/XAMPP/xamppfiles/htdocs/active-ecommerce/resources/views/backend/setup_configurations/tax/edit.blade.php ENDPATH**/ ?>