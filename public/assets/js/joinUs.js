let exp = document.getElementById('volunteerExperience') 
if(exp) {

    exp.addEventListener('change', function() {
        var experienceDetails = document.getElementById('experienceDetails');
        experienceDetails.style.display = this.value === 'نعم' ? 'block' : 'none';
    });
}