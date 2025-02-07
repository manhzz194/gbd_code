<?php if($block): ?>
    <?php
        $title = $block->json_params->title->{$locale} ?? $block->title;
        $brief = $block->json_params->brief->{$locale} ?? $block->brief;
        $content = $block->json_params->content->{$locale} ?? $block->content;
        $image = $block->image != '' ? $block->image : '';
        $image_background = $block->image_background != '' ? $block->image_background : '';
        $url_link = $block->url_link != '' ? $block->url_link : '';
        $url_link_title = $block->json_params->url_link_title->{$locale} ?? $block->url_link_title;

        $block_childs = $blocks->filter(function ($item, $key) use ($block) {
            return $item->parent_id == $block->id;
        });
    ?>
    <section class="customer-talk">
        <div class="container">
            <div class="row customer-talk-title">
                <div class="col-lg-5">
                    <h3><?php echo $title; ?></h3>
                </div>
                <div class="col-lg-7">
                    <p><?php echo e($brief); ?></p>
                </div>
            </div>
            <div class="customer-talk-content">
                <div class="customer-talk-container">
                    <div class="swiper customer-talk-slide">
                        <div class="swiper-wrapper">
                            <?php if($block_childs): ?>
                                <?php $__currentLoopData = $block_childs; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <?php
                                        $title = $item->json_params->title->{$locale} ?? $item->title;
                                        $brief = $item->json_params->brief->{$locale} ?? $item->brief;
                                        $content = $item->json_params->content->{$locale} ?? $item->content;
                                        $image = $item->image != '' ? $item->image : null;
                                        $image_background = $item->image_background != '' ? $item->image_background : null;
                                        $video = $item->json_params->video ?? null;
                                        $video_background = $item->json_params->video_background ?? null;
                                        $url_link = $item->url_link != '' ? $item->url_link : '';
                                        $url_link_title = $item->json_params->url_link_title->{$locale} ?? $item->url_link_title;
                                    ?>
                                    <div class="swiper-slide">
                                        <div class="content-info">
                                            <div class="box-img-name-customer d-flex  align-items-center gap-3">
                                                <div class="img-customer">
                                                    <img src="<?php echo e($image); ?>" alt="">
                                                </div>
                                                <div class="name-customer">
                                                    <h3>Loremipsum</h3>
                                                    <span>CEO &Founder</span>
                                                </div>
                                            </div>
                                            <div class="detail-comment">
                                                <div class="star-comment">
                                                    <div class="img-star">
                                                        <img src="<?php echo e(asset('themes/frontend/watches/images/5_star.svg')); ?>" alt="">
                                                    </div>
                                                    <div class="img-comm">
                                                        <img src="<?php echo e(asset('themes/frontend/watches/images/cus-icon-com.svg')); ?>" alt="">
                                                    </div>
                                                </div>
                                                <div class="detail-comment-dets">
                                                    <p><?php echo e($content); ?></p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            <?php endif; ?>    
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
<?php endif; ?>
<?php /**PATH E:\xampp\htdocs\gbd\resources\views/frontend/blocks/customer/styles/talk.blade.php ENDPATH**/ ?>