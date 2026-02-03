<section class="relative min-h-screen flex items-center overflow-hidden">
    <!-- Background Image -->
    <div class="absolute inset-0">
        <img src="https://images.unsplash.com/photo-1492144534655-ae79c964c9d7?w=1920&q=80"
             alt="Luxury car" class="w-full h-full object-cover">
        <div class="absolute inset-0 bg-gradient-to-r from-background via-background/95 to-background/60"></div>
        <div class="absolute inset-0 bg-gradient-to-t from-background via-transparent to-background/50"></div>
    </div>

    <!-- Content -->
    <div class="container relative z-10 mx-auto px-4 pt-32 pb-20">
        <div class="max-w-3xl">

            <!-- Badge -->
            <div class="inline-flex items-center gap-2 px-4 py-2 bg-primary/10 border border-primary/20 rounded-full mb-8">
                <span class="w-2 h-2 bg-primary rounded-full animate-pulse"></span>
                <span class="text-sm text-primary font-medium">
                    Showroom xe sang số 1 Việt Nam
                </span>
            </div>

            <!-- Heading -->
            <h1 class="text-4xl md:text-6xl lg:text-7xl font-bold leading-tight mb-6">
                Khám phá
                <span class="block text-gradient-accent">Đẳng cấp</span>
                <span class="text-gradient">Xe hơi hạng sang</span>
            </h1>

            <!-- Description -->
            <p class="text-lg md:text-xl text-muted-foreground mb-10 max-w-xl">
                Chúng tôi mang đến bộ sưu tập xe cao cấp từ các thương hiệu hàng đầu thế giới.
                Trải nghiệm dịch vụ 5 sao ngay hôm nay.
            </p>

            <!-- CTA Buttons -->
            <div class="flex flex-wrap gap-4 mb-16">
                <a href="{{ url('/cars') }}"
                   class="bg-primary text-primary-foreground px-8 py-3 rounded-xl text-lg font-medium flex items-center gap-2 transition-all hover:scale-105">
                    Xem danh sách xe
                </a>

                <button id="openVideo"
                    class="bg-transparent border border-muted-foreground/30 hover:border-primary px-8 py-3 rounded-xl text-lg font-medium transition-all flex items-center gap-2">
                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24"
                        fill="none" stroke="currentColor" stroke-width="2">
                        <polygon points="5 3 19 12 5 21 5 3"/>
                    </svg>
                    Xem video showroom
                </button>
            </div>
        </div>
    </div>

    <!-- MODAL VIDEO -->
    <div id="videoModal"
         class="fixed inset-0 bg-black/80 hidden items-center justify-center z-50">

        <div class="relative w-full max-w-sm aspect-[9/16] bg-black rounded-2xl overflow-hidden">
            <!-- Close button -->
            <button id="closeVideo"
                class="absolute top-3 right-3 text-white text-2xl z-10">
                ✕
            </button>

            <!-- YouTube Shorts Video -->
            <iframe
                class="w-full h-full"
                src="https://www.youtube.com/embed/UvP_k-1MKT0"
                allow="autoplay; encrypted-media"
                allowfullscreen>
            </iframe>
        </div>
    </div>
</section>

<!-- JAVASCRIPT -->
<script>
document.addEventListener('DOMContentLoaded', function () {
    const openBtn = document.getElementById('openVideo');
    const modal = document.getElementById('videoModal');
    const closeBtn = document.getElementById('closeVideo');

    openBtn.addEventListener('click', () => {
        modal.classList.remove('hidden');
        modal.classList.add('flex');
    });

    closeBtn.addEventListener('click', () => {
        modal.classList.add('hidden');
        modal.classList.remove('flex');
    });

    modal.addEventListener('click', (e) => {
        if (e.target === modal) {
            modal.classList.add('hidden');
            modal.classList.remove('flex');
        }
    });
});
</script>
