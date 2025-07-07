

<?php $__env->startSection('title', 'لوحة تحكم الإدارة'); ?>

<?php $__env->startSection('styles'); ?>
<style>
    .cursor-pointer {
        cursor: pointer;
        transition: transform 0.2s ease, box-shadow 0.2s ease;
    }
    .cursor-pointer:hover {
        transform: translateY(-5px);
        box-shadow: 0 8px 16px rgba(0,0,0,0.2);
        text-decoration: none !important;
    }
    a > .card {
        color: inherit;
    }
</style>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
<div class="container mt-5">
    <h2 class="mb-4">لوحة تحكم الإدارة - الإحصائيات</h2>

    <div class="row">
        <!-- بطاقة الأطباء مع رابط -->
        <div class="col-md-3">
            <a href="<?php echo e(route('admin.doctors.index')); ?>" style="text-decoration: none;">
                <div class="card text-white bg-primary mb-3 cursor-pointer">
                    <div class="card-body">
                        <h5 class="card-title">عدد الأطباء</h5>
                        <p class="card-text fs-2"><?php echo e($statsArray['total_doctors']); ?></p>
                    </div>
                </div>
            </a>
        </div>

        <!-- بطاقة المرضى مع رابط -->
        <div class="col-md-3">
            <a href="<?php echo e(route('admin.patients.index')); ?>" style="text-decoration: none;">
                <div class="card text-white bg-success mb-3 cursor-pointer">
                    <div class="card-body">
                        <h5 class="card-title">عدد المرضى</h5>
                        <p class="card-text fs-2"><?php echo e($statsArray['total_patients']); ?></p>
                    </div>
                </div>
            </a>
        </div>

        <!-- بطاقة المواعيد الكلي مع رابط -->
        <div class="col-md-3">
            <a href="<?php echo e(route('admin.appointments.index')); ?>" style="text-decoration: none;">
                <div class="card text-white bg-info mb-3 cursor-pointer">
                    <div class="card-body">
                        <h5 class="card-title">عدد المواعيد الكلي</h5>
                        <p class="card-text fs-2"><?php echo e($statsArray['total_appointments']); ?></p>
                    </div>
                </div>
            </a>
        </div>

        <!-- بطاقة المواعيد المحذوفة مؤقتاً مع رابط -->
        <div class="col-md-3">
            <a href="<?php echo e(route('admin.appointments.trashed')); ?>" style="text-decoration: none;">
                <div class="card text-white bg-danger mb-3 cursor-pointer">
                    <div class="card-body">
                        <h5 class="card-title">المواعيد المحذوفة مؤقتاً</h5>
                        <p class="card-text fs-2"><?php echo e($statsArray['total_appointmentsWithTrashed']); ?></p>
                    </div>
                </div>
            </a>
        </div>
    </div>

    <!-- رسم بياني دائري (Pie Chart) -->
    <div class="card mt-4">
        <div class="card-header">
            إحصائيات عامة (رسم بياني دائري)
        </div>
        <div class="card-body">
            <canvas id="pieChart" height="200"></canvas>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('scripts'); ?>
<!-- استدعاء Chart.js من CDN -->
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    const ctx = document.getElementById('pieChart').getContext('2d');
    const pieChart = new Chart(ctx, {
        type: 'pie',
        data: {
            labels: ['الأطباء', 'المرضى', 'المواعيد', 'المواعيد المحذوفة'],
            datasets: [{
                data: [
                    <?php echo e($statsArray['total_doctors']); ?>,
                    <?php echo e($statsArray['total_patients']); ?>,
                    <?php echo e($statsArray['total_appointments']); ?>,
                    <?php echo e($statsArray['total_appointmentsWithTrashed']); ?>

                ],
                backgroundColor: [
                    'rgba(13, 110, 253, 0.8)',  
                    'rgba(25, 135, 84, 0.8)',   
                    'rgba(13, 202, 240, 0.8)',  
                    'rgba(220, 53, 69, 0.8)'    
                ],
                borderColor: '#fff',
                borderWidth: 2,
            }]
        },
        options: {
            responsive: true,
            plugins: {
                legend: {
                    position: 'bottom',
                    labels: {
                        font: { size: 14 }
                    }
                },
                tooltip: {
                    enabled: true,
                    callbacks: {
                        label: function(context) {
                            const label = context.label || '';
                            const value = context.parsed || 0;
                            return label + ': ' + value;
                        }
                    }
                }
            }
        }
    });
</script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.admin', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH D:\Work_Programm\xampp\htdocs\Tamkeen_Training\Medical-center-management-center\resources\views/admin/dashboard.blade.php ENDPATH**/ ?>