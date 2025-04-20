document.getElementById('volunteerExperience').addEventListener('change', function() {
    var experienceDetails = document.getElementById('experienceDetails');
    experienceDetails.style.display = this.value === 'نعم' ? 'block' : 'none';
});