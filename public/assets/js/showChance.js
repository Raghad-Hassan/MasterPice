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
const csrfToken = document.querySelector('meta[name="csrf-token"]')?.content;

function register(oppId ,userId) {

    console.log(userId, oppId)

    fetch(`/opportunity/register`, {
        method: 'POST',
        headers: {
            "Content-Type": "application/json",
            "Accept": "application/json",
            "X-CSRF-Token": csrfToken
        },
        body: JSON.stringify({
            userId: userId,
            oppId: oppId
        })
    })
    .then(response => {
        if (response.ok) {
            console.log('Registration successful');

        } else {
            console.log('Error during registration');
        }
    })
    .catch(error => {
        console.error('Fetch error:', error);
    });

    window.location.reload();

}
document.addEventListener('DOMContentLoaded', function() {
    document.querySelectorAll('.rssegister-btn').forEach(button => {
        button.addEventListener('click', async function(event) {
            let userId = button.getAttribute('data-user-id')
            let oppId = button.getAttribute('data-opp-id')
            console.log(userId, oppId)
            
                console.log("form")
                const form = this.closest('form');
                const card = this.closest('.opportunity-card');
                const csrfToken = document.querySelector('meta[name="csrf-token"]')?.content;
                const originalButton = this;


        });
    });
});


// ---------------------------------------------------------navbar active link
document.querySelectorAll('.navbar-nav .nav-link').forEach(item => {
        item.addEventListener('click', function() {
            document.querySelectorAll('.navbar-nav .nav-link').forEach(link => {
                link.classList.remove('active'); 
            });
            this.classList.add('active'); 
        });
    });