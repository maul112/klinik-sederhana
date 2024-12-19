document.addEventListener('DOMContentLoaded', () => {
    const addReviewBtn = document.getElementById('add-review-btn');
    const reviewForm = document.getElementById('review-form');

    addReviewBtn.addEventListener('click', () => {
        console.log('Add Review button clicked');
        reviewForm.classList.toggle('hidden');
    });
});