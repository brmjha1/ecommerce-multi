<?php if(get_setting('home_categories') != null): ?>
    <?php
        $home_categories = json_decode(get_setting('home_categories'));
        $categories = get_category($home_categories);
    ?>
    <?php $__currentLoopData = $categories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $category_key => $category): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <?php
            $category_name = $category->getTranslation('name');
        ?>
        <section class="<?php if($category_key != 0): ?> mt-4 <?php endif; ?>" style="">
            <div class="container">
                <div class="row gutters-16">
                    <!-- Home category Baner & name -->
                    <div class="col-xl-3 col-lg-4 col-md-5">
                        <div class="h-200px h-sm-250px h-md-340px">
                            <div class="h-100 w-100 w-xl-auto position-relative hov-scale-img overflow-hidden">
                                <div class="position-absolute h-100 w-100 overflow-hidden">
                                    <img src="<?php echo e(isset($category->coverImage->file_name) ? my_asset($category->coverImage->file_name) : static_asset('assets/img/placeholder.jpg')); ?>"
                                        alt="<?php echo e($category_name); ?>"
                                        class="img-fit h-100 has-transition"
                                        onerror="this.onerror=null;this.src='<?php echo e(static_asset('assets/img/placeholder.jpg')); ?>';">
                                </div>
                                <div class="pb-4 px-3 absolute-bottom-left w-100 has-transition h-100 d-flex flex-column align-items-center justify-content-end"
                                    style="background: linear-gradient(to top, rgba(0,0,0,0.7) 0%,rgba(0,0,0,0) 100%) !important;">
                                    <a class="fs-16 fw-700 text-white text-center animate-underline-white home-category-name d-flex align-items-center hov-column-gap-1"
                                        href="<?php echo e(route('products.category', $category->slug)); ?>"
                                        style="width: max-content;">
                                        <?php echo e($category_name); ?>&nbsp;
                                        <i class="las la-angle-right"></i>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- Category Products -->
                    <div class="col-xl-9 col-lg-8 col-md-7">
                        <div class="aiz-carousel arrow-x-0 border-right arrow-inactive-none" data-items="5"
                            data-xxl-items="5" data-xl-items="4.5" data-lg-items="3" data-md-items="2" data-sm-items="2"
                            data-xs-items="2" data-arrows='true' data-infinite='false'>
                            <?php $__currentLoopData = get_cached_products($category->id); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $product_key => $product): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <div
                                    class="carousel-box px-3 position-relative has-transition border-right border-top border-bottom <?php if($product_key == 0): ?> border-left <?php endif; ?> hov-animate-outline">
                                    <?php echo $__env->make('frontend.partials.product_box_1', ['product' => $product], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                                </div>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
<?php endif; ?>
<?php /**PATH /Applications/XAMPP/xamppfiles/htdocs/active-ecommerce/resources/views/frontend/partials/home_categories_section.blade.php ENDPATH**/ ?>