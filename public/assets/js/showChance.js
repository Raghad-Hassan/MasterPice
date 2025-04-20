document.addEventListener("DOMContentLoaded", function () {
    const categories = document.querySelectorAll(".category");

    categories.forEach(category => {
        category.addEventListener("click", function () {
            // إزالة الفئة "active" من جميع العناصر
            categories.forEach(cat => cat.classList.remove("active"));

            // إضافة الفئة "active" للعنصر الذي تم النقر عليه
            this.classList.add("active");
        });
    });
});
// -------------------------------------------------------- سجل الان \ عرض التفاصيل 

document.querySelectorAll('.register-btn').forEach(button => {
    button.addEventListener('click', function(event) {
        // 🛑 أوقف تفعيل الرابط
        event.stopPropagation();  
        event.preventDefault();  

        let card = this.closest('.opportunity-card');
        let currentCountElement = card.querySelector('.current-participants');
        let totalCountElement = card.querySelector('.total-participants');
        let progressBar = card.querySelector('.progress');

        let currentCount = parseInt(currentCountElement.textContent);
        let totalCount = parseInt(totalCountElement.textContent);

        if (currentCount < totalCount) {
            currentCount += 1;
            currentCountElement.textContent = currentCount;

            let percentage = (currentCount / totalCount) * 100;
            progressBar.style.width = percentage + '%';

            if (currentCount === totalCount) {
                this.textContent = "ممتلئ";
                this.disabled = true;
                this.style.backgroundColor = "#999";
            }
        }
    });
});



// ---------------------------------------------------------navbar active link
document.querySelectorAll('.navbar-nav .nav-link').forEach(item => {
        item.addEventListener('click', function() {
            document.querySelectorAll('.navbar-nav .nav-link').forEach(link => {
                link.classList.remove('active'); // إزالة الفئة "active" من جميع الروابط
            });
            this.classList.add('active'); // إضافة الفئة "active" على الرابط الذي تم النقر عليه
        });
    });