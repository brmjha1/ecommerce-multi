

<?php $__env->startSection('content'); ?>

<?php
    CoreComponentRepository::instantiateShopRepository();
    CoreComponentRepository::initializeCache();
?>

<div class="aiz-titlebar text-left mt-2 mb-3">
    <h5 class="mb-0 h6"><?php echo e(translate('Category Information')); ?></h5>
</div>

<div class="row">
    <div class="col-lg-8 mx-auto">
        <div class="card">
            <div class="card-body p-0">
                <ul class="nav nav-tabs nav-fill border-light">
                    <?php $__currentLoopData = get_all_active_language(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $language): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <li class="nav-item">
                        <a class="nav-link text-reset <?php if($language->code == $lang): ?> active <?php else: ?> bg-soft-dark border-light border-left-0 <?php endif; ?> py-3" href="<?php echo e(route('categories.edit', ['id'=>$category->id, 'lang'=> $language->code] )); ?>">
                            <img src="<?php echo e(static_asset('assets/img/flags/'.$language->code.'.png')); ?>" height="11" class="mr-1">
                            <span><?php echo e($language->name); ?></span>
                        </a>
                    </li>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </ul>
                <form class="p-4" action="<?php echo e(route('categories.update', $category->id)); ?>" method="POST" enctype="multipart/form-data">
                    <input name="_method" type="hidden" value="PATCH">
    	            <input type="hidden" name="lang" value="<?php echo e($lang); ?>">
                	<?php echo csrf_field(); ?>
                    <div class="form-group row">
                        <label class="col-md-3 col-form-label"><?php echo e(translate('Name')); ?> <i class="las la-language text-danger" title="<?php echo e(translate('Translatable')); ?>"></i></label>
                        <div class="col-md-9">
                            <input type="text" name="name" value="<?php echo e($category->getTranslation('name', $lang)); ?>" class="form-control" id="name" placeholder="<?php echo e(translate('Name')); ?>" required>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-md-3 col-form-label"><?php echo e(translate('Type')); ?></label>
                        <div class="col-md-9">
                            <select name="digital" onchange="categoriesByType(this.value)" required class="form-control aiz-selectpicker mb-2 mb-md-0">
                                <option value="0" <?php if($category->digital == '0'): ?> selected <?php endif; ?>><?php echo e(translate('Physical')); ?></option>
                                <option value="1" <?php if($category->digital == '1'): ?> selected <?php endif; ?>><?php echo e(translate('Digital')); ?></option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-md-3 col-form-label"><?php echo e(translate('Parent Category')); ?></label>
                        <div class="col-md-9">
                            <select class="select2 form-control aiz-selectpicker" name="parent_id" data-toggle="select2" data-placeholder="Choose ..."data-live-search="true" data-selected="<?php echo e($category->parent_id); ?>">
                                <?php echo $__env->make('backend.product.categories.categories_option', ['categories' => $categories], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                            </select>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-md-3 col-form-label">
                            <?php echo e(translate('Ordering Number')); ?>

                        </label>
                        <div class="col-md-9">
                            <input type="number" name="order_level" value="<?php echo e($category->order_level); ?>" class="form-control" id="order_level" placeholder="<?php echo e(translate('Order Level')); ?>">
                            <small><?php echo e(translate('Higher number has high priority')); ?></small>
                        </div>
                    </div>
    	            <div class="form-group row">
                        <label class="col-md-3 col-form-label" for="signinSrEmail"><?php echo e(translate('Banner')); ?> <small>(<?php echo e(translate('200x200')); ?>)</small></label>
                        <div class="col-md-9">
                            <div class="input-group" data-toggle="aizuploader" data-type="image">
                                <div class="input-group-prepend">
                                    <div class="input-group-text bg-soft-secondary font-weight-medium"><?php echo e(translate('Browse')); ?></div>
                                </div>
                                <div class="form-control file-amount"><?php echo e(translate('Choose File')); ?></div>
                                <input type="hidden" name="banner" class="selected-files" value="<?php echo e($category->banner); ?>">
                            </div>
                            <div class="file-preview box sm">
                            </div>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-md-3 col-form-label" for="signinSrEmail"><?php echo e(translate('Icon')); ?> <small>(<?php echo e(translate('32x32')); ?>)</small></label>
                        <div class="col-md-9">
                            <div class="input-group" data-toggle="aizuploader" data-type="image">
                                <div class="input-group-prepend">
                                    <div class="input-group-text bg-soft-secondary font-weight-medium"><?php echo e(translate('Browse')); ?></div>
                                </div>
                                <div class="form-control file-amount"><?php echo e(translate('Choose File')); ?></div>
                                <input type="hidden" name="icon" class="selected-files" value="<?php echo e($category->icon); ?>">
                            </div>
                            <div class="file-preview box sm">
                            </div>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-md-3 col-form-label" for="signinSrEmail"><?php echo e(translate('Cover Image')); ?> <small>(<?php echo e(translate('250x250')); ?>)</small></label>
                        <div class="col-md-9">
                            <div class="input-group" data-toggle="aizuploader" data-type="image">
                                <div class="input-group-prepend">
                                    <div class="input-group-text bg-soft-secondary font-weight-medium"><?php echo e(translate('Browse')); ?></div>
                                </div>
                                <div class="form-control file-amount"><?php echo e(translate('Choose File')); ?></div>
                                <input type="hidden" name="cover_image" class="selected-files" value="<?php echo e($category->cover_image); ?>">
                            </div>
                            <div class="file-preview box sm">
                            </div>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-md-3 col-form-label"><?php echo e(translate('Meta Title')); ?></label>
                        <div class="col-md-9">
                            <input type="text" class="form-control" name="meta_title" value="<?php echo e($category->meta_title); ?>" placeholder="<?php echo e(translate('Meta Title')); ?>">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-md-3 col-form-label"><?php echo e(translate('Meta Description')); ?></label>
                        <div class="col-md-9">
                            <textarea name="meta_description" rows="5" class="form-control"><?php echo e($category->meta_description); ?></textarea>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-md-3 col-form-label"><?php echo e(translate('Slug')); ?></label>
                        <div class="col-md-9">
                            <input type="text" placeholder="<?php echo e(translate('Slug')); ?>" id="slug" name="slug" value="<?php echo e($category->slug); ?>" class="form-control">
                        </div>
                    </div>
                    <?php if(get_setting('category_wise_commission') == 1): ?>
                        <div class="form-group row">
                            <label class="col-md-3 col-form-label"><?php echo e(translate('Commission Rate')); ?></label>
                            <div class="col-md-9 input-group">
                                <input type="number" lang="en" min="0" step="0.01" id="commision_rate" name="commision_rate" value="<?php echo e($category->commision_rate); ?>" class="form-control">
                                <div class="input-group-append">
                                    <span class="input-group-text">%</span>
                                </div>
                            </div>
                        </div>
                    <?php endif; ?>
                    <div class="form-group row">
                        <label class="col-md-3 col-form-label"><?php echo e(translate('Filtering Attributes')); ?></label>
                        <div class="col-md-9">
                            <select class="select2 form-control aiz-selectpicker" name="filtering_attributes[]" data-toggle="select2" data-placeholder="Choose ..."data-live-search="true" data-selected="<?php echo e($category->attributes->pluck('id')); ?>" multiple>
                                <?php $__currentLoopData = \App\Models\Attribute::all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $attribute): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <option value="<?php echo e($attribute->id); ?>"><?php echo e($attribute->getTranslation('name')); ?></option>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </select>
                        </div>
                    </div>
                    <div class="form-group mb-0 text-right">
                        <button type="submit" class="btn btn-primary"><?php echo e(translate('Save')); ?></button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('script'); ?>

<script type="text/javascript">
    function categoriesByType(val){
        $('select[name="parent_id"]').html('');
        AIZ.plugins.bootstrapSelect('refresh');
        $.ajax({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            type:"POST",
            url:'<?php echo e(route('categories.categories-by-type')); ?>',
            data:{
               digital: val
            },
            success: function(data) {
                $('select[name="parent_id"]').html(data);
                AIZ.plugins.bootstrapSelect('refresh');
            }
        });
    }
</script>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('backend.layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /Applications/XAMPP/xamppfiles/htdocs/active-ecommerce/resources/views/backend/product/categories/edit.blade.php ENDPATH**/ ?>