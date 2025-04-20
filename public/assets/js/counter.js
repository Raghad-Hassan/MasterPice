document.addEventListener("DOMContentLoaded", function () {
   
    let counterElement = document.getElementById("volunteerCounter");
    let count = 0;
    let target = 1000000; 
    let duration = 2000; 
    let steps = 150; 
    let stepIncrease = Math.floor(target / steps); 
    let stepTime = Math.abs(Math.floor(duration / steps)); 

    
    const observer = new IntersectionObserver((entries, observer) => {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
               
                let timer = setInterval(() => {
                    count += stepIncrease; 
                    if (count >= target) {
                        count = target;
                        clearInterval(timer);
                    }
                    counterElement.textContent = count.toLocaleString(); 
                }, stepTime);
                observer.unobserve(entry.target); 
            }
        });
    }, { threshold: 0.5 });

   
    observer.observe(document.querySelector('.container.mt-5'));
});
// ------------




    function setIdeaDetails(title, author, description, location, field, duration, authority) {
        document.getElementById('modal-title').innerText = title;
        document.getElementById('idea-description').innerText = description;
        document.getElementById('idea-location').innerText = location;
        document.getElementById('idea-field').innerText = field;
        document.getElementById('idea-duration').innerText = duration;
        document.getElementById('idea-authority').innerText = authority;
    }




    document.querySelectorAll('.navbar-nav .nav-link').forEach(item => {
        item.addEventListener('click', function() {
            document.querySelectorAll('.navbar-nav .nav-link').forEach(link => {
                link.classList.remove('active'); // إزالة الفئة "active" من جميع الروابط
            });
            this.classList.add('active'); // إضافة الفئة "active" على الرابط الذي تم النقر عليه
        });
    });
