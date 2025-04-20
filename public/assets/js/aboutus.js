document.querySelectorAll('.navbar-nav .nav-link').forEach(item => {
    item.addEventListener('click', function() {
        document.querySelectorAll('.navbar-nav .nav-link').forEach(link => {
            link.classList.remove('active'); // إزالة الفئة "active" من جميع الروابط
        });
        this.classList.add('active'); // إضافة الفئة "active" على الرابط الذي تم النقر عليه
    });
});
