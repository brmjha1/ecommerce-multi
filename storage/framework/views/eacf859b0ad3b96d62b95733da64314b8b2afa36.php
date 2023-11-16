

<?php $__env->startSection('content'); ?>

<div class="aiz-titlebar text-left mt-2 mb-3">
    <div class="row align-items-center">
        <div class="col-md-6">
            <h1 class="h3"><?php echo e(translate('All Sellers')); ?></h1>
        </div>
    </div>
</div>

<div class="card">
    <form class="" id="sort_sellers" action="" method="GET">
        <div class="card-header row gutters-5">
            <div class="col">
                <h5 class="mb-md-0 h6"><?php echo e(translate('Sellers')); ?></h5>
            </div>
            
            <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('delete_seller')): ?>
                <div class="dropdown mb-2 mb-md-0">
                    <button class="btn border dropdown-toggle" type="button" data-toggle="dropdown">
                        <?php echo e(translate('Bulk Action')); ?>

                    </button>
                    <div class="dropdown-menu dropdown-menu-right">
                        <a class="dropdown-item confirm-alert" href="javascript:void(0)"  data-target="#bulk-delete-modal"><?php echo e(translate('Delete selection')); ?></a>
                    </div>
                </div>
            <?php endif; ?>
            
            <div class="col-md-3 ml-auto">
                <select class="form-control aiz-selectpicker" name="approved_status" id="approved_status" onchange="sort_sellers()">
                    <option value=""><?php echo e(translate('Filter by Approval')); ?></option>
                    <option value="1"  <?php if(isset($approved)): ?> <?php if($approved == '1'): ?> selected <?php endif; ?> <?php endif; ?>><?php echo e(translate('Approved')); ?></option>
                    <option value="0"  <?php if(isset($approved)): ?> <?php if($approved == '0'): ?> selected <?php endif; ?> <?php endif; ?>><?php echo e(translate('Non-Approved')); ?></option>
                </select>
            </div>
            <div class="col-md-3">
                <div class="form-group mb-0">
                  <input type="text" class="form-control" id="search" name="search"<?php if(isset($sort_search)): ?> value="<?php echo e($sort_search); ?>" <?php endif; ?> placeholder="<?php echo e(translate('Type name or email & Enter')); ?>">
                </div>
            </div>
        </div>
    
        <div class="card-body">
            <table class="table aiz-table mb-0">
                <thead>
                <tr>
                    
                    <th>
                        <?php if(auth()->user()->can('delete_seller')): ?>
                            <div class="form-group">
                                <div class="aiz-checkbox-inline">
                                    <label class="aiz-checkbox">
                                        <input type="checkbox" class="check-all">
                                        <span class="aiz-square-check"></span>
                                    </label>
                                </div>
                            </div>
                        <?php else: ?>
                            #
                        <?php endif; ?>
                    </th>
                    <th><?php echo e(translate('Name')); ?></th>
                    <th data-breakpoints="lg"><?php echo e(translate('Phone')); ?></th>
                    <th data-breakpoints="lg"><?php echo e(translate('Email Address')); ?></th>
                    <th data-breakpoints="lg"><?php echo e(translate('Verification Info')); ?></th>
                    <th data-breakpoints="lg"><?php echo e(translate('Approval')); ?></th>
                    <th data-breakpoints="lg"><?php echo e(translate('Num. of Products')); ?></th>
                    <th data-breakpoints="lg"><?php echo e(translate('Due to seller')); ?></th>
                    <th data-breakpoints="lg"><?php echo e(translate('Status')); ?></th>
                    <th width="10%"><?php echo e(translate('Options')); ?></th>
                </tr>
                </thead>
                <tbody>
                <?php $__currentLoopData = $shops; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $shop): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <tr>
                        <td>
                            <?php if(auth()->user()->can('delete_seller')): ?>
                                <div class="form-group">
                                    <div class="aiz-checkbox-inline">
                                        <label class="aiz-checkbox">
                                            <input type="checkbox" class="check-one" name="id[]" value="<?php echo e($shop->id); ?>">
                                            <span class="aiz-square-check"></span>
                                        </label>
                                    </div>
                                </div>
                            <?php else: ?>
                                <?php echo e(($key+1) + ($shops->currentPage() - 1)*$shops->perPage()); ?>

                            <?php endif; ?>
                        </td>
                        <td><?php if($shop->user->banned == 1): ?> <i class="fa fa-ban text-danger" aria-hidden="true"></i> <?php endif; ?> <?php echo e($shop->name); ?></td>
                        <td><?php echo e($shop->user->phone); ?></td>
                        <td><?php echo e($shop->user->email); ?></td>
                        <td>
                            <?php if($shop->verification_status != 1 && $shop->verification_info != null): ?>
                                <a href="<?php echo e(route('sellers.show_verification_request', $shop->id)); ?>">
                                    <span class="badge badge-inline badge-info"><?php echo e(translate('Show')); ?></span>
                                </a>
                            <?php endif; ?>
                        </td>
                        <td>
                            <label class="aiz-switch aiz-switch-success mb-0">
                                <input 
                                    <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('approve_seller')): ?> onchange="update_approved(this)" <?php endif; ?>
                                    value="<?php echo e($shop->id); ?>" type="checkbox" 
                                    <?php if($shop->verification_status == 1) echo "checked";?> 
                                    <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->denies('approve_seller')): ?> disabled <?php endif; ?>
                                >
                                <span class="slider round"></span>
                            </label>
                        </td>
                        <td><?php echo e($shop->user->products->count()); ?></td>
                        <td>
                            <?php if($shop->admin_to_pay >= 0): ?>
                                <?php echo e(single_price($shop->admin_to_pay)); ?>

                            <?php else: ?>
                                <?php echo e(single_price(abs($shop->admin_to_pay))); ?> (<?php echo e(translate('Due to Admin')); ?>)
                            <?php endif; ?>
                        </td>
                        <td>
                            <?php if($shop->user->banned): ?>
                                <span class="badge badge-inline badge-danger"><?php echo e(translate('Ban')); ?></span>
                            <?php else: ?>
                                <span class="badge badge-inline badge-success"><?php echo e(translate('Regular')); ?></span>
                            <?php endif; ?>
                        </td>
                        <td>
                            <div class="dropdown">
                                <button type="button" class="btn btn-sm btn-circle btn-soft-primary btn-icon dropdown-toggle no-arrow" data-toggle="dropdown" href="javascript:void(0);" role="button" aria-haspopup="false" aria-expanded="false">
                                    <i class="las la-ellipsis-v"></i>
                                </button>
                                <div class="dropdown-menu dropdown-menu-right dropdown-menu-xs">
                                    <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('view_seller_profile')): ?>
                                        <a href="#" onclick="show_seller_profile('<?php echo e($shop->id); ?>');"  class="dropdown-item">
                                            <?php echo e(translate('Profile')); ?>

                                        </a>
                                    <?php endif; ?>
                                    <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('login_as_seller')): ?>
                                        <a href="<?php echo e(route('sellers.login', encrypt($shop->id))); ?>" class="dropdown-item">
                                            <?php echo e(translate('Log in as this Seller')); ?>

                                        </a>
                                    <?php endif; ?>
                                    <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('pay_to_seller')): ?>
                                        <a href="#" onclick="show_seller_payment_modal('<?php echo e($shop->id); ?>');" class="dropdown-item">
                                            <?php echo e(translate('Go to Payment')); ?>

                                        </a>
                                    <?php endif; ?>
                                    <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('seller_payment_history')): ?>
                                        <a href="<?php echo e(route('sellers.payment_history', encrypt($shop->user_id))); ?>" class="dropdown-item">
                                            <?php echo e(translate('Payment History')); ?>

                                        </a>
                                    <?php endif; ?>
                                    <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('edit_seller')): ?>
                                        <a href="<?php echo e(route('sellers.edit', encrypt($shop->id))); ?>" class="dropdown-item">
                                            <?php echo e(translate('Edit')); ?>

                                        </a>
                                    <?php endif; ?>
                                    <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('ban_seller')): ?>
                                        <?php if($shop->user->banned != 1): ?>
                                            <a href="#" onclick="confirm_ban('<?php echo e(route('sellers.ban', $shop->id)); ?>');" class="dropdown-item">
                                                <?php echo e(translate('Ban this seller')); ?>

                                                <i class="fa fa-ban text-danger" aria-hidden="true"></i>
                                            </a>
                                        <?php else: ?>
                                            <a href="#" onclick="confirm_unban('<?php echo e(route('sellers.ban', $shop->id)); ?>');" class="dropdown-item">
                                                <?php echo e(translate('Unban this seller')); ?>

                                                <i class="fa fa-check text-success" aria-hidden="true"></i>
                                            </a>
                                        <?php endif; ?>
                                    <?php endif; ?>
                                    <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('delete_seller')): ?>
                                        <a href="#" class="dropdown-item confirm-delete" data-href="<?php echo e(route('sellers.destroy', $shop->id)); ?>" class="">
                                            <?php echo e(translate('Delete')); ?>

                                        </a>
                                    <?php endif; ?>
                                </div>
                            </div>
                        </td>
                    </tr>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </tbody>
            </table>
            <div class="aiz-pagination">
              <?php echo e($shops->appends(request()->input())->links()); ?>

            </div>
        </div>
    </form>
</div>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('modal'); ?>
	<!-- Delete Modal -->
	<?php echo $__env->make('modals.delete_modal', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    <!-- Bulk Delete modal -->
    <?php echo $__env->make('modals.bulk_delete_modal', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

	<!-- Seller Profile Modal -->
	<div class="modal fade" id="profile_modal">
		<div class="modal-dialog">
			<div class="modal-content" id="profile-modal-content">

			</div>
		</div>
	</div>

	<!-- Seller Payment Modal -->
	<div class="modal fade" id="payment_modal">
	    <div class="modal-dialog">
	        <div class="modal-content" id="payment-modal-content">

	        </div>
	    </div>
	</div>

	<!-- Ban Seller Modal -->
	<div class="modal fade" id="confirm-ban">
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header">
					<h5 class="modal-title h6"><?php echo e(translate('Confirmation')); ?></h5>
					<button type="button" class="close" data-dismiss="modal">
					</button>
				</div>
				<div class="modal-body">
                    <p><?php echo e(translate('Do you really want to ban this seller?')); ?></p>
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-light" data-dismiss="modal"><?php echo e(translate('Cancel')); ?></button>
					<a class="btn btn-primary" id="confirmation"><?php echo e(translate('Proceed!')); ?></a>
				</div>
			</div>
		</div>
	</div>

	<!-- Unban Seller Modal -->
	<div class="modal fade" id="confirm-unban">
			<div class="modal-dialog">
				<div class="modal-content">
					<div class="modal-header">
						<h5 class="modal-title h6"><?php echo e(translate('Confirmation')); ?></h5>
						<button type="button" class="close" data-dismiss="modal">
						</button>
					</div>
					<div class="modal-body">
							<p><?php echo e(translate('Do you really want to unban this seller?')); ?></p>
					</div>
					<div class="modal-footer">
						<button type="button" class="btn btn-light" data-dismiss="modal"><?php echo e(translate('Cancel')); ?></button>
						<a class="btn btn-primary" id="confirmationunban"><?php echo e(translate('Proceed!')); ?></a>
					</div>
				</div>
			</div>
		</div>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('script'); ?>
    <script type="text/javascript">
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
        
        function show_seller_payment_modal(id){
            $.post('<?php echo e(route('sellers.payment_modal')); ?>',{_token:'<?php echo e(@csrf_token()); ?>', id:id}, function(data){
                $('#payment_modal #payment-modal-content').html(data);
                $('#payment_modal').modal('show', {backdrop: 'static'});
                $('.demo-select2-placeholder').select2();
            });
        }

        function show_seller_profile(id){
            $.post('<?php echo e(route('sellers.profile_modal')); ?>',{_token:'<?php echo e(@csrf_token()); ?>', id:id}, function(data){
                $('#profile_modal #profile-modal-content').html(data);
                $('#profile_modal').modal('show', {backdrop: 'static'});
            });
        }

        function update_approved(el){
            if(el.checked){
                var status = 1;
            }
            else{
                var status = 0;
            }
            $.post('<?php echo e(route('sellers.approved')); ?>', {_token:'<?php echo e(csrf_token()); ?>', id:el.value, status:status}, function(data){
                if(data == 1){
                    AIZ.plugins.notify('success', '<?php echo e(translate('Approved sellers updated successfully')); ?>');
                }
                else{
                    AIZ.plugins.notify('danger', '<?php echo e(translate('Something went wrong')); ?>');
                }
            });
        }

        function sort_sellers(el){
            $('#sort_sellers').submit();
        }

        function confirm_ban(url)
        {
            $('#confirm-ban').modal('show', {backdrop: 'static'});
            document.getElementById('confirmation').setAttribute('href' , url);
        }

        function confirm_unban(url)
        {
            $('#confirm-unban').modal('show', {backdrop: 'static'});
            document.getElementById('confirmationunban').setAttribute('href' , url);
        }
        
        function bulk_delete() {
            var data = new FormData($('#sort_sellers')[0]);
            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                url: "<?php echo e(route('bulk-seller-delete')); ?>",
                type: 'POST',
                data: data,
                cache: false,
                contentType: false,
                processData: false,
                success: function (response) {
                    if(response == 1) {
                        location.reload();
                    }
                }
            });
        }

    </script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('backend.layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /Applications/XAMPP/xamppfiles/htdocs/active-ecommerce/resources/views/backend/sellers/index.blade.php ENDPATH**/ ?>