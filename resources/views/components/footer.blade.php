<footer class="bg-card pt-16 pb-8 border-t border-border/50">
    <div class="container mx-auto px-4">
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-12 mb-16">
            <!-- Brand Info -->
            <div class="space-y-6">
                <a href="{{ url('/') }}" class="flex items-center gap-3">
                    <div class="w-10 h-10 rounded-lg bg-primary flex items-center justify-center">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="text-primary-foreground">
                            <path d="M19 17h2c.6 0 1-.4 1-1v-3c0-.9-.7-1.7-1.5-1.9C18.7 10.6 16 10 16 10s-1.3-1.4-2.2-2.3c-.5-.4-1.1-.7-1.8-.7H5c-.6 0-1.1.4-1.4.9l-1.4 2.9A3.7 3.7 0 0 0 2 13.1v2.9c0 .6.4 1 1 1h2"/><circle cx="7" cy="17" r="2"/><path d="M9 17h6"/><circle cx="17" cy="17" r="2"/>
                        </svg>
                    </div>
                    <span class="text-xl font-bold">AutoLux</span>
                </a>
                <p class="text-muted-foreground leading-relaxed">
                    Nơi hội tụ những dòng xe sang đẳng cấp, cam kết chất lượng và dịch vụ hậu mãi chu đáo nhất Việt Nam.
                </p>
                <div class="flex items-center gap-4">
                    <a href="#" class="w-10 h-10 rounded-full bg-secondary flex items-center justify-center hover:bg-primary transition-colors group">
                        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="group-hover:text-white"><path d="M18 2h-3a5 5 0 0 0-5 5v3H7v4h3v8h4v-8h3l1-4h-4V7a1 1 0 0 1 1-1h3z"/></svg>
                    </a>
                    <a href="#" class="w-10 h-10 rounded-full bg-secondary flex items-center justify-center hover:bg-primary transition-colors group">
                        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="group-hover:text-white"><rect width="20" height="20" x="2" y="2" rx="5" ry="5"/><path d="M16 11.37A4 4 0 1 1 12.63 8 4 4 0 0 1 16 11.37z"/><line x1="17.5" x2="17.51" y1="6.5" y2="6.5"/></svg>
                    </a>
                    <a href="#" class="w-10 h-10 rounded-full bg-secondary flex items-center justify-center hover:bg-primary transition-colors group">
                        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="group-hover:text-white"><path d="M22 4s-.7 2.1-2 3.4c1.6 10-9.4 17.3-18 11.6 2.2.1 4.4-.6 6-2C3 15.5.5 9.6 3 5c2.2 2.6 5.6 4.1 9 4-.9-4.2 4-6.6 7-3.8 1.1 0 3-1.2 3-1.2z"/></svg>
                    </a>
                </div>
            </div>

            <!-- Quick Links -->
            <div class="space-y-6">
                <h3 class="text-sm font-bold uppercase tracking-wider text-muted-foreground">Liên kết nhanh</h3>
                <ul class="space-y-3">
                    <li><a href="{{ url('/') }}" class="text-muted-foreground hover:text-primary transition-colors">Trang chủ</a></li>
                    <li><a href="{{ url('/cars') }}" class="text-muted-foreground hover:text-primary transition-colors">Danh sách xe</a></li>
                    <li><a href="{{ url('/about') }}" class="text-muted-foreground hover:text-primary transition-colors">Giới thiệu</a></li>
                    <li><a href="{{ url('/contact') }}" class="text-muted-foreground hover:text-primary transition-colors">Liên hệ</a></li>
                </ul>
            </div>

            <!-- Contact Info -->
            <div class="space-y-6">
                <h3 class="text-sm font-bold uppercase tracking-wider text-muted-foreground">Thông tin liên hệ</h3>
                <ul class="space-y-4">
                    <li class="flex items-start gap-3 text-muted-foreground">
                        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="mt-1 flex-shrink-0 text-primary"><path d="M20 10c0 6-8 12-8 12s-8-6-8-12a8 8 0 0 1 16 0Z"/><circle cx="12" cy="10" r="3"/></svg>
                        <span>Đại Học Phenikaa, Yên Nghĩa, Hà Đông, Hà Nội</span>
                    </li>
                    <li class="flex items-center gap-3 text-muted-foreground">
                        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="flex-shrink-0 text-primary"><path d="M22 16.92v3a2 2 0 0 1-2.18 2 19.79 19.79 0 0 1-8.63-3.07 19.5 19.5 0 0 1-6-6 19.79 19.79 0 0 1-3.07-8.67A2 2 0 0 1 4.11 2h3a2 2 0 0 1 2 1.72 12.84 12.84 0 0 0 .7 2.81 2 2 0 0 1-.45 2.11L8.09 9.91a16 16 0 0 0 6 6l1.27-1.27a2 2 0 0 1 2.11-.45 12.84 12.84 0 0 0 2.81.7A2 2 0 0 1 22 16.92z"/></svg>
                        <span>024 6291 8118</span>
                    </li>
                    <li class="flex items-center gap-3 text-muted-foreground">
                        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="flex-shrink-0 text-primary"><rect width="20" height="16" x="2" y="4" rx="2"/><path d="m22 7-8.97 5.7a1.94 1.94 0 0 1-2.06 0L2 7"/></svg>
                        <span>contact@autolux.vn</span>
                    </li>
                </ul>
            </div>

            <!-- Newsletter -->
            <div class="space-y-6">
                <h3 class="text-sm font-bold uppercase tracking-wider text-muted-foreground">Bản tin</h3>
                <p class="text-sm text-muted-foreground">Đăng ký nhận thông tin về những mẫu xe mới nhất và ưu đãi đặc biệt.</p>
                <form class="flex gap-2">
                    <input type="email" placeholder="Email của bạn" class="flex-grow bg-secondary border border-border rounded-lg px-4 py-2 text-sm focus:outline-none focus:ring-1 focus:ring-primary transition-all">
                    <button type="submit" class="bg-primary text-primary-foreground px-4 py-2 rounded-lg text-sm font-bold hover:opacity-90 transition-opacity">Gửi</button>
                </form>
            </div>
        </div>

        <div class="pt-8 border-t border-border/50 flex flex-col md:flex-row justify-between items-center gap-4 text-sm text-muted-foreground">
            <p>© {{ date('Y') }} AutoLux Luxury Motors. Tất cả quyền được bảo lưu.</p>
            <div class="flex gap-8">
                <a href="#" class="hover:text-primary transition-colors">Điều khoản dịch vụ</a>
                <a href="#" class="hover:text-primary transition-colors">Chính sách bảo mật</a>
            </div>
        </div>
    </div>
</footer>
