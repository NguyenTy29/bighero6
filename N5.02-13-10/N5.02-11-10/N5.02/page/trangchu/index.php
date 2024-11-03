<title>Trang chủ</title>
<div class="container">
    <!-- Banner hình ảnh slideshow -->
    <div class="banner-slideshow">
        <div class="slides">
            <img src="img/Khám phá công nghệ AI đỉnh cao (4).png" alt="Banner Image 3">
            <img src="img/Khám phá công nghệ AI đỉnh cao (1).png" alt="Banner Image 1">
            <img src="img/Khám phá công nghệ AI đỉnh cao (2).png" alt="Banner Image 2">
        </div>
    </div>

    <h1>Giải Pháp Steganography: Lưu Trữ Thông Tin Bí Mật Một Cách An Toàn</h1>
    <div class="feature">
        <i class="fas fa-lock"></i>
        <label>Bảo mật cao</label>
        <p>Ứng dụng của chúng tôi đảm bảo an toàn cho thông tin của bạn với các công nghệ mã hóa tiên tiến.</p>
    </div>
    <div class="feature">
        <i class="fas fa-image"></i>
        <label>Chất lượng hình ảnh</label>
        <p>Giữ nguyên chất lượng hình ảnh trong khi ẩn thông điệp của bạn một cách hiệu quả.</p>
    </div>
    <div class="feature">
        <i class="fas fa-user-friends"></i>
        <label>Dễ sử dụng</label>
        <p>Giao diện thân thiện với người dùng giúp bạn dễ dàng thao tác và sử dụng.</p>
    </div>
</div>

<style>
    .banner-slideshow {
        width: 100%;
        overflow: hidden;
        height: auto; /* Điều chỉnh chiều cao tự động theo ảnh */
        position: relative;
        aspect-ratio: 3 / 1; /* Tỷ lệ xấp xỉ 6912 x 3456, giúp hiển thị toàn bộ ảnh */
    }

    .slides {
        display: flex;
        animation: slide 15s infinite; /* Tạo hiệu ứng chuyển động cho tất cả các ảnh */
        width: 100%;
    }

    .slides img {
        width: 100%;
        height: 100%;
        flex-shrink: 0;
        object-fit: contain; /* Đảm bảo ảnh không bị cắt */
    }

    /* CSS Animation */
    @keyframes slide {
        0% { transform: translateX(0); }
        33% { transform: translateX(-100%); }
        66% { transform: translateX(-200%); }
        100% { transform: translateX(0); }
    }

    h1{
        margin-top:20px;
    }
</style>
