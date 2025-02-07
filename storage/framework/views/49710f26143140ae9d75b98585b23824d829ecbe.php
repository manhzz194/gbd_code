
<?php if(session('errorMessage')): ?>
<script>
    Swal.fire({
        toast: true,
        icon: 'error',
        title: '<?php echo e(session('errorMessage')); ?>',
        animation: true,
        position: 'top-right',
        showConfirmButton: false,
        timer: 3000,
        timerProgressBar: true,
    })
</script>
<?php endif; ?>
<?php if(session('successMessage')): ?>
<script>
    Swal.fire({
        toast: true,
        icon: 'success',
        title: '<?php echo e(session('successMessage')); ?>',
        animation: true,
        position: 'top-right',
        showConfirmButton: false,
        timer: 3000,
        timerProgressBar: true,
    })
</script>
<?php endif; ?>
<?php if(session('warningMessage')): ?>
<script>
    Swal.fire({
        toast: true,
        icon: 'warning',
        title: '<?php echo e(session('warningMessage')); ?>',
        animation: true,
        position: 'top-right',
        showConfirmButton: false,
        timer: 3000,
        timerProgressBar: true,
    })
</script>
<?php endif; ?>
<?php if(session('successMessageCart')): ?>
    <script>
    Swal.fire({
        toast: true,
        icon: 'error',
        title: '<?php echo e(session('successMessageCart')); ?>',
        animation: true,
        position: 'top-right',
        showConfirmButton: false,
        timer: 3000,
        timerProgressBar: true,
    })
    </script>
<?php endif; ?>

<?php if($errors->any()): ?>
    <div class="alert alert-dismissible alert-danger alert-fixed">
        <?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <p><?php echo e($error); ?></p>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        <button type="button" class="close btn-close btn-sm" data-bs-dismiss="alert" aria-hidden="true"
            aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
<?php endif; ?>
<div class="content_alert"></div>
<style>
    .alert-fixed {
        position: fixed;
        top: 0px;
        right: 0px;
        margin: 1rem;
        z-index: 999999;
    }
</style>


<?php /**PATH E:\xampp\htdocs\gbd\resources\views/frontend/components/sticky/alert.blade.php ENDPATH**/ ?>