<form action="<?php echo e(route('currency.store')); ?>" method="POST">
    <?php echo csrf_field(); ?>
    <div class="modal-header">
    	<h5 class="modal-title h6"><?php echo e(translate('Add New Currency')); ?></h5>
    	<button type="button" class="close" data-dismiss="modal">
    	</button>
    </div>
    <div class="modal-body">
        <div class="form-group row">
            <label class="col-sm-2 col-from-label" for="name"><?php echo e(translate('Name')); ?></label>
            <div class="col-sm-10">
                <input type="text" placeholder="<?php echo e(translate('Name')); ?>" id="name" name="name" class="form-control" required>
            </div>
        </div>
        <div class="form-group row">
            <label class="col-sm-2 col-from-label" for="symbol"><?php echo e(translate('Symbol')); ?></label>
            <div class="col-sm-10">
                <input type="text" placeholder="<?php echo e(translate('Symbol')); ?>" id="symbol" name="symbol" class="form-control" required>
            </div>
        </div>
        <div class="form-group row">
            <label class="col-sm-2 col-from-label" for="code"><?php echo e(translate('Code')); ?></label>
            <div class="col-sm-10">
                <input type="text" placeholder="<?php echo e(translate('Code')); ?>" id="code" name="code" class="form-control" required>
            </div>
        </div>
        <div class="form-group row">
            <label class="col-sm-2 col-from-label" for="exchange_rate"><?php echo e(translate('Exchange Rate')); ?></label>
            <div class="col-sm-10">
                <input type="number" lang="en" step="0.01" min="0" placeholder="<?php echo e(translate('Exchange Rate')); ?>" id="exchange_rate" name="exchange_rate" class="form-control" required>
            </div>
        </div>
    </div>
    <div class="modal-footer">
        <button type="submit" class="btn btn-sm btn-primary"><?php echo e(translate('Save')); ?></button>
        <button type="button" class="btn btn-sm btn-light" data-dismiss="modal"><?php echo e(translate('Cancel')); ?></button>
    </div>
</form>
<?php /**PATH /Applications/XAMPP/xamppfiles/htdocs/active-ecommerce/resources/views/backend/setup_configurations/currencies/create.blade.php ENDPATH**/ ?>