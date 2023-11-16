

<?php $__env->startSection('panel_content'); ?>
<div class="aiz-titlebar text-left mt-2 mb-3">
	<div class="row align-items-center">
		<div class="col-md-6">
			<h1 class="h3"><?php echo e(translate('All uploaded files')); ?></h1>
		</div>
		<div class="col-md-6 text-md-right">
			<a href="<?php echo e(route('seller.uploads.create')); ?>" class="btn btn-primary">
				<span><?php echo e(translate('Upload New File')); ?></span>
			</a>
		</div>
	</div>
</div>

<div class="card">
    <form id="sort_uploads" action="">
        <div class="card-header row gutters-5">
            <div class="col">
                <h5 class="mb-0 h6"><?php echo e(translate('All files')); ?></h5>
            </div>
			<div class="dropdown mb-2 mb-md-0">
                <button class="btn border dropdown-toggle" type="button" data-toggle="dropdown">
                    <?php echo e(translate('Bulk Action')); ?>

                </button>
                <div class="dropdown-menu dropdown-menu-right">
                    <a class="dropdown-item confirm-alert" href="javascript:void(0)"  data-target="#bulk-delete-modal"> <?php echo e(translate('Delete selection')); ?></a>
                </div>
            </div>
            <div class="col-md-3 ml-auto mr-0">
                <select class="form-control form-control-xs aiz-selectpicker" name="sort" onchange="sort_uploads()">
                    <option value="newest" <?php if($sort_by == 'newest'): ?> selected="" <?php endif; ?>><?php echo e(translate('Sort by newest')); ?></option>
                    <option value="oldest" <?php if($sort_by == 'oldest'): ?> selected="" <?php endif; ?>><?php echo e(translate('Sort by oldest')); ?></option>
                    <option value="smallest" <?php if($sort_by == 'smallest'): ?> selected="" <?php endif; ?>><?php echo e(translate('Sort by smallest')); ?></option>
                    <option value="largest" <?php if($sort_by == 'largest'): ?> selected="" <?php endif; ?>><?php echo e(translate('Sort by largest')); ?></option>
                </select>
            </div>
            <div class="col-md-3">
                <input type="text" class="form-control form-control-xs" name="search" placeholder="<?php echo e(translate('Search your files')); ?>" value="<?php echo e($search); ?>">
            </div>
            <div class="col-auto">
                <button type="submit" class="btn btn-primary"><?php echo e(translate('Search')); ?></button>
            </div>
        </div>
    
		<div class="card-body">
			<div class="form-group">
				<div class="aiz-checkbox-inline">
					<label class="aiz-checkbox">
						<?php echo e(translate('Select All')); ?>

						<input type="checkbox" class="check-all">
						<span class="aiz-square-check"></span>
					</label>
				</div>
			</div>

			<div class="row gutters-5">
				<?php $__currentLoopData = $all_uploads; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $file): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
					<?php
						if($file->file_original_name == null){
							$file_name = translate('Unknown');
						}else{
							$file_name = $file->file_original_name;
						}
					?>
					<div class="col-auto w-140px w-lg-220px">
						<div class="aiz-file-box">
							<div class="dropdown-file" >
								<a class="dropdown-link" data-toggle="dropdown">
									<i class="la la-ellipsis-v"></i>
								</a>
								<div class="dropdown-menu dropdown-menu-right">
									<a href="javascript:void(0)" class="dropdown-item" onclick="detailsInfo(this)" data-id="<?php echo e($file->id); ?>">
										<i class="las la-info-circle mr-2"></i>
										<span><?php echo e(translate('Details Info')); ?></span>
									</a>
									<a href="<?php echo e(my_asset($file->file_name)); ?>" target="_blank" download="<?php echo e($file_name); ?>.<?php echo e($file->extension); ?>" class="dropdown-item">
										<i class="la la-download mr-2"></i>
										<span><?php echo e(translate('Download')); ?></span>
									</a>
									<a href="javascript:void(0)" class="dropdown-item" onclick="copyUrl(this)" data-url="<?php echo e(my_asset($file->file_name)); ?>">
										<i class="las la-clipboard mr-2"></i>
										<span><?php echo e(translate('Copy Link')); ?></span>
									</a>
									<a href="javascript:void(0)" class="dropdown-item confirm-delete" data-href="<?php echo e(route('seller.my_uploads.destroy', $file->id )); ?>" data-target="#delete-modal">
										<i class="las la-trash mr-2"></i>
										<span><?php echo e(translate('Delete')); ?></span>
									</a>
								</div>
							</div>

							<div class="select-box">
								<div class="aiz-checkbox-inline">
									<label class="aiz-checkbox">
										<input type="checkbox" class="check-one" name="id[]" value="<?php echo e($file->id); ?>">
										<span class="aiz-square-check"></span>
									</label>
								</div>
							</div>

							<div class="card card-file aiz-uploader-select c-default" title="<?php echo e($file_name); ?>.<?php echo e($file->extension); ?>">
								<div class="card-file-thumb">
									<?php if($file->type == 'image'): ?>
										<img src="<?php echo e(my_asset($file->file_name)); ?>" class="img-fit">
									<?php elseif($file->type == 'video'): ?>
										<i class="las la-file-video"></i>
									<?php else: ?>
										<i class="las la-file"></i>
									<?php endif; ?>
								</div>
								<div class="card-body">
									<h6 class="d-flex">
										<span class="text-truncate title"><?php echo e($file_name); ?></span>
										<span class="ext">.<?php echo e($file->extension); ?></span>
									</h6>
									<p><?php echo e(formatBytes($file->file_size)); ?></p>
								</div>
							</div>
						</div>
					</div>
				<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
			</div>
			<div class="aiz-pagination mt-3">
				<?php echo e($all_uploads->appends(request()->input())->links()); ?>

			</div>
		</div>
	</form>
</div>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('modal'); ?>
<div id="info-modal" class="modal fade">
	<div class="modal-dialog modal-dialog-right">
			<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title h6"><?php echo e(translate('File Info')); ?></h5>
				<button type="button" class="close" data-dismiss="modal">
				</button>
			</div>
			<div class="modal-body c-scrollbar-light position-relative" id="info-modal-content">
				<div class="c-preloader text-center absolute-center">
                    <i class="las la-spinner la-spin la-3x opacity-70"></i>
                </div>
			</div>
		</div>
	</div>
</div>
<!-- Delete modal -->
<?php echo $__env->make('modals.delete_modal', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<!-- Bulk Delete modal -->
<?php echo $__env->make('modals.bulk_delete_modal', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

<?php $__env->stopSection(); ?>
<?php $__env->startSection('script'); ?>
	<script type="text/javascript">
		function detailsInfo(e){
            $('#info-modal-content').html('<div class="c-preloader text-center absolute-center"><i class="las la-spinner la-spin la-3x opacity-70"></i></div>');
			var id = $(e).data('id')
			$('#info-modal').modal('show');
			$.post('<?php echo e(route('seller.my_uploads.info')); ?>', {_token: AIZ.data.csrf, id:id}, function(data){
                $('#info-modal-content').html(data);
				// console.log(data);
			});
		}
		function copyUrl(e) {
			var url = $(e).data('url');
			var $temp = $("<input>");
		    $("body").append($temp);
		    $temp.val(url).select();
		    try {
			    document.execCommand("copy");
			    AIZ.plugins.notify('success', '<?php echo e(translate('Link copied to clipboard')); ?>');
			} catch (err) {
			    AIZ.plugins.notify('danger', '<?php echo e(translate('Oops, unable to copy')); ?>');
			}
		    $temp.remove();
		}
        function sort_uploads(el){
            $('#sort_uploads').submit();
        }

		$(document).on("change", ".check-all", function() {
			if(this.checked) {
				// Iterate each checkbox
				$('.check-one:checkbox').each(function() {
					this.checked = true;
				});
			} else {
				$('.check-one:checkbox').each(function() {
					this.checked = false;
				});
			}
		});

		function bulk_delete() {
            var data = new FormData($('#sort_uploads')[0]);
            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                url: "<?php echo e(route('seller.bulk-uploaded-files-delete')); ?>",
                type: 'POST',
                data: data,
                cache: false,
                contentType: false,
                processData: false,
                success: function (response) {
                    if(response == 1) {
						location.reload();
                    }
					else{
						AIZ.plugins.notify('danger', '<?php echo e(translate('Something Went Wrong.')); ?>');
					}
                }
            });
        }
	</script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('seller.layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /Applications/XAMPP/xamppfiles/htdocs/active-ecommerce/resources/views/seller/uploads/index.blade.php ENDPATH**/ ?>