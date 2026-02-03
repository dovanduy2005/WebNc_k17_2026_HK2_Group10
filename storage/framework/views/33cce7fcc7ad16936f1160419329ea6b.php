<?php
    // Fetch latest available cars from Database
    $featuredCars = \App\Models\Car::with(['brand', 'category'])
                    ->where('status', 'available')
                    ->latest()
                    ->take(4)
                    ->get();
?>

<section class="py-24 bg-secondary/30">
    <div class="container mx-auto px-4">
        <!-- Header -->
        <div class="flex flex-col md:flex-row md:items-end justify-between gap-6 mb-12">
            <div>
                <span class="text-primary font-medium mb-2 block">Xe nổi bật</span>
                <h2 class="text-3xl md:text-4xl font-bold mb-4">
                    Dòng xe <span class="text-gradient-accent">hot</span> nhất
                </h2>
                <p class="text-muted-foreground max-w-lg">
                    Khám phá những mẫu xe được khách hàng yêu thích và đánh giá cao nhất tại showroom
                </p>
            </div>
            <a href="<?php echo e(url('/cars')); ?>" class="group border border-muted-foreground/30 hover:border-primary px-6 py-2 rounded-lg transition-all flex items-center gap-2">
                Xem tất cả xe
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="group-hover:translate-x-1 transition-transform"><line x1="5" x2="19" y1="12" y2="12"/><polyline points="12 5 19 12 12 19"/></svg>
            </a>
        </div>

        <!-- Cars Grid -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
            <?php $__currentLoopData = $featuredCars; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $car): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <?php if (isset($component)) { $__componentOriginalddff77940a067fc12b4449e98aa924a9 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginalddff77940a067fc12b4449e98aa924a9 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.car-card','data' => ['car' => $car]] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('car-card'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['car' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($car)]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginalddff77940a067fc12b4449e98aa924a9)): ?>
<?php $attributes = $__attributesOriginalddff77940a067fc12b4449e98aa924a9; ?>
<?php unset($__attributesOriginalddff77940a067fc12b4449e98aa924a9); ?>
<?php endif; ?>
<?php if (isset($__componentOriginalddff77940a067fc12b4449e98aa924a9)): ?>
<?php $component = $__componentOriginalddff77940a067fc12b4449e98aa924a9; ?>
<?php unset($__componentOriginalddff77940a067fc12b4449e98aa924a9); ?>
<?php endif; ?>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </div>
    </div>
</section>
<?php /**PATH C:\Users\DUY\Downloads\WebNC_K17_2026_HK2_Nhom10.-main\WebNC_K17_2026_HK2_Nhom10.-main\resources\views/components/featured-cars.blade.php ENDPATH**/ ?>