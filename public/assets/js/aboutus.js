document.querySelectorAll('.navbar-nav .nav-link').forEach(item => {
    item.addEventListener('click', function() {
        document.querySelectorAll('.navbar-nav .nav-link').forEach(link => {
            link.classList.remove('active'); 
        });
        this.classList.add('active'); 
    });
});
