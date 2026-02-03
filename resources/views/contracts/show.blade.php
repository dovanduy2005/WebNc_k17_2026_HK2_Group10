@extends('layouts.app')

@section('title', 'Hợp đồng ' . $contract->contract_number . ' - AutoLux')

@section('content')
<div class="min-h-screen bg-secondary/30 pt-32 pb-20">
    <div class="container mx-auto px-4">
        <!-- Back Button -->
        <div class="max-w-4xl mx-auto mb-6">
            <a href="{{ route('contracts') }}" class="inline-flex items-center gap-2 text-muted-foreground hover:text-primary transition-colors">
                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="m12 19-7-7 7-7"/><path d="M19 12H5"/></svg>
                Quay lại danh sách
            </a>
        </div>

        <!-- Document Container -->
        <div class="max-w-4xl mx-auto bg-white text-slate-900 shadow-2xl rounded-sm overflow-hidden p-12 md:p-20 relative font-serif">
            <!-- Official Watermark (Optional) -->
            <div class="absolute inset-0 flex items-center justify-center opacity-[0.03] pointer-events-none rotate-[-45deg]">
                <span class="text-[120px] font-bold border-8 border-slate-900 px-10">AUTOLUX</span>
            </div>

            <!-- Header Section -->
            <div class="flex justify-between items-start mb-12 relative z-10">
                <div>
                    <h1 class="text-3xl font-bold uppercase tracking-wider text-primary mb-2">AUTOLUX LUXURY MOTORS</h1>
                    <p class="text-xs text-slate-500 uppercase font-sans tracking-widest">Premium Car Showroom & Services</p>
                </div>
                <div class="text-right">
                    <h2 class="text-xl font-bold uppercase mb-1">CỘNG HÒA XÃ HỘI CHỦ NGHĨA VIỆT NAM</h2>
                    <p class="text-xs font-bold mb-4">Độc lập - Tự do - Hạnh phúc</p>
                    <div class="h-px bg-slate-300 w-32 ml-auto mb-4"></div>
                    <p class="text-sm italic">Hà Nội, ngày {{ $contract->created_at->format('d') }} tháng {{ $contract->created_at->format('m') }} năm {{ $contract->created_at->format('Y') }}</p>
                </div>
            </div>

            <!-- Title -->
            <div class="text-center mb-12 relative z-10">
                <h3 class="text-2xl font-bold uppercase mb-2">HỢP ĐỒNG THỎA THUẬN ĐẶT CỌC</h3>
                <p class="text-sm font-bold">Số: {{ $contract->contract_number }}</p>
            </div>

            <!-- Main Content -->
            <div class="space-y-8 text-sm leading-relaxed relative z-10">
                <!-- Parties -->
                <section>
                    <h4 class="font-bold border-b border-slate-200 pb-1 mb-4 uppercase">BÊN BÁN (BÊN A): CÔNG TY CỔ PHẦN AUTOLUX VIỆT NAM</h4>
                    <ul class="grid grid-cols-2 gap-4">
                        <li><strong>Đại diện:</strong> Ông Đỗ Văn Duy</li>
                        <li><strong>Chức vụ:</strong> Giám đốc Showroom</li>
                        <li><strong>Mã số thuế:</strong> 0101234567</li>
                        <li><strong>Số điện thoại:</strong> 0x xxx xxx</li>
                        <li class="col-span-2"><strong>Địa chỉ:</strong> {{ $contract->store_address }}</li>
                    </ul>
                </section>

                <section>
                    <h4 class="font-bold border-b border-slate-200 pb-1 mb-4 uppercase">BÊN MUA (BÊN B): THÔNG TIN KHÁCH HÀNG</h4>
                    <ul class="grid grid-cols-2 gap-4">
                        <li><strong>Họ và tên:</strong> {{ $contract->user->name }}</li>
                        <li><strong>Số CCCD:</strong> {{ $contract->cccd }}</li>
                        <li><strong>Số điện thoại:</strong> {{ $contract->phone }}</li>
                        <li><strong>Email:</strong> {{ $contract->user->email }}</li>
                        <li class="col-span-2"><strong>Địa chỉ thường trú:</strong> {{ $contract->buyer_address }}</li>
                    </ul>
                </section>

                <!-- Subject -->
                <section>
                    <h4 class="font-bold border-b border-slate-200 pb-1 mb-4 uppercase">NỘI DUNG THỎA THUẬN</h4>
                    <div class="mb-4">Bên B đồng ý đặt cọc cho Bên A để mua phương tiện giao thông với các đặc điểm sau:</div>
                    <div class="bg-slate-50 border border-slate-200 p-6 rounded-md">
                        <div class="grid grid-cols-2 gap-y-3">
                            <div><strong>Tên xe:</strong> {{ $contract->car->name }}</div>
                            <div><strong>Nhãn hiệu:</strong> {{ $contract->car->brand }}</div>
                            <div><strong>Phân khúc:</strong> {{ $contract->car->type }}</div>
                            <div><strong>Năm sản xuất:</strong> {{ $contract->car->year }}</div>
                            <div><strong>Tình trạng:</strong> Mới 100% (Chưa lăn bánh)</div>
                        </div>
                    </div>
                </section>

                <!-- Deposit -->
                <section>
                    <h4 class="font-bold border-b border-slate-200 pb-1 mb-4 uppercase">GIÁ TRỊ VÀ PHƯƠNG THỨC ĐẶT CỌC</h4>
                    <ul class="space-y-2">
                        <li><strong>1. Tổng giá trị xe:</strong> {{ number_format($contract->car->price) }} VNĐ</li>
                        <li><strong>2. Số tiền đặt cọc:</strong> <span class="text-lg font-bold text-red-600">{{ number_format($contract->deposit_amount) }} VNĐ</span></li>
                        <li><strong>3. Bằng chữ:</strong> (Ba trăm triệu đồng chẵn)</li>
                        <li><strong>4. Phương thức:</strong> Chuyển khoản qua hệ thống ngân hàng</li>
                    </ul>
                </section>

                <!-- Receipt Image Section -->
                <section class="mt-12 non-printable">
                    <h4 class="font-bold border-b border-slate-200 pb-1 mb-4 uppercase text-xs text-slate-400">Ảnh chứng từ đặt cọc</h4>
                    <div class="border-2 border-dashed border-slate-200 rounded-xl p-4 flex justify-center bg-slate-50/50">
                        @if($contract->deposit_image)
                            <img src="{{ asset('storage/' . $contract->deposit_image) }}" alt="Receipt" class="max-h-80 rounded-lg shadow-md">
                        @else
                            <div class="flex flex-col items-center gap-4 py-8">
                                <div class="w-16 h-16 rounded-full bg-slate-100 flex items-center justify-center text-slate-400">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><rect width="18" height="18" x="3" y="3" rx="2" ry="2"/><circle cx="9" cy="9" r="2"/><path d="m21 15-3.086-3.086a2 2 0 0 0-2.828 0L6 21"/></svg>
                                </div>
                                <p class="text-xs text-slate-400 font-sans">Ảnh chụp biên lai chuyển khoản / tiền mặt đã được đối soát</p>
                            </div>
                        @endif
                    </div>
                </section>

                <!-- Execution -->
                <div class="grid grid-cols-2 pt-12 pb-20">
                    <div class="text-center">
                        <p class="font-bold uppercase mb-20">ĐẠI DIỆN BÊN MUA</p>
                        <p class="font-bold">{{ $contract->user->name }}</p>
                    </div>
                    <div class="text-center relative">
                        <p class="font-bold uppercase mb-8">ĐẠI DIỆN BÊN BÁN</p>
                        
                        <!-- Official Red Stamp Simulation -->
                        <div class="absolute top-12 left-1/2 -translate-x-1/2 w-40 opacity-80 pointer-events-none select-none">
                            <svg viewBox="0 0 200 200" xmlns="http://www.w3.org/2000/svg">
                                <circle cx="100" cy="100" r="90" fill="none" stroke="#dc2626" stroke-width="4" stroke-dasharray="8 4"/>
                                <circle cx="100" cy="100" r="75" fill="none" stroke="#dc2626" stroke-width="2"/>
                                <text x="100" y="60" text-anchor="middle" fill="#dc2626" font-family="Arial" font-weight="bold" font-size="14">CÔNG TY CỔ PHẦN</text>
                                <text x="100" y="80" text-anchor="middle" fill="#dc2626" font-family="Arial" font-weight="bold" font-size="18">AUTOLUX</text>
                                <text x="100" y="100" text-anchor="middle" fill="#dc2626" font-family="Arial" font-weight="bold" font-size="14">VIỆT NAM</text>
                                <path d="M60 110 L140 110" stroke="#dc2626" stroke-width="2" opacity="0.5"/>
                                <text x="100" y="130" text-anchor="middle" fill="#dc2626" font-family="Arial" font-style="italic" font-size="12">ĐÃ KÝ</text>
                                <text x="100" y="160" text-anchor="middle" fill="#dc2626" font-family="Arial" font-weight="bold" font-size="12">GIÁM ĐỐC CHI NHÁNH</text>
                            </svg>
                        </div>
                        
                        <div class="mt-32">
                            <p class="font-bold text-red-700">Đỗ Văn Duy</p>
                            <p class="text-xs text-slate-500 font-sans italic mt-1">(Đã ký bằng chữ ký số)</p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Footer Section -->
            <div class="border-t border-slate-100 pt-6 text-[10px] text-slate-400 font-sans flex justify-between">
                <p>Hợp đồng này được lập thành 02 bản có giá trị pháp lý như nhau.</p>
                <p>AutoLux Security Code: AL-{{ strtoupper(Str::random(8)) }}</p>
            </div>
        </div>

        <!-- Action Buttons -->
        <div class="max-w-4xl mx-auto mt-8 flex justify-center gap-4 non-printable">
            <button onclick="window.print()" class="bg-slate-900 text-white px-8 py-3 rounded-xl font-bold flex items-center gap-2 hover:bg-black transition-all">
                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><polyline points="6 9 6 2 18 2 18 9"/><path d="M6 18H4a2 2 0 0 1-2-2v-5a2 2 0 0 1 2-2h16a2 2 0 0 1 2 2v5a2 2 0 0 1-2 2h-2"/><rect width="12" height="8" x="6" y="14"/></svg>
                Tải xuống & In hợp đồng
            </button>
        </div>
    </div>
</div>

<style>
@media print {
    .non-printable, nav, header, footer, .pt-32, .pb-20, .mb-6, .mt-8 {
        display: none !important;
    }
    body {
        background-color: white !important;
    }
    .min-h-screen {
        padding: 0 !important;
        margin: 0 !important;
    }
    .container {
        max-width: none !important;
        width: 100% !important;
        padding: 0 !important;
    }
    .card-luxury {
        box-shadow: none !important;
        border: none !important;
    }
}
</style>
@endsection
