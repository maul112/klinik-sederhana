document.addEventListener('DOMContentLoaded', () => {
    const addReviewBtn = document.getElementById('add-review-btn');
    const reviewForm = document.getElementById('review-form');
    const reviewFormElement = document.getElementById('reviewForm');

    addReviewBtn.addEventListener('click', () => {
        reviewForm.classList.toggle('hidden');
    });

    reviewFormElement.addEventListener('submit', (e) => {
        e.preventDefault();

        const name = document.getElementById('reviewer-name').value;
        const rating = document.getElementById('review-rating').value;
        const reviewText = document.getElementById('review-text').value;

        const reviewContainer = document.createElement('div');
        reviewContainer.classList.add('review');

        const reviewHeader = document.createElement('div');
        reviewHeader.classList.add('review-header');

        const reviewer = document.createElement('div');
        reviewer.classList.add('reviewer');
        const reviewerImg = document.createElement('img');
        reviewerImg.src = 'default-avatar.png'; // Path to a default avatar image
        reviewerImg.alt = `Reviewer ${name}`;
        const reviewerName = document.createElement('span');
        reviewerName.textContent = name;
        reviewer.appendChild(reviewerImg);
        reviewer.appendChild(reviewerName);

        const reviewRating = document.createElement('span');
        reviewRating.classList.add('rating');
        for (let i = 0; i < rating; i++) {
            const star = document.createElementNS('http://www.w3.org/2000/svg', 'svg');
            star.setAttribute('class', 'star');
            star.setAttribute('xmlns', 'http://www.w3.org/2000/svg');
            star.setAttribute('viewBox', '0 0 24 24');
            star.setAttribute('fill', '#f39c12');
            star.setAttribute('width', '20px');
            star.setAttribute('height', '20px');
            const path = document.createElementNS('http://www.w3.org/2000/svg', 'path');
            path.setAttribute('d', 'M0 0h24v24H0z');
            path.setAttribute('fill', 'none');
            const path2 = document.createElementNS('http://www.w3.org/2000/svg', 'path');
            path2.setAttribute('d', 'M12 17.27L18.18 21l-1.64-7.03L22 9.24l-7.19-.61L12 2 9.19 8.63 2 9.24l5.46 4.73L5.82 21z');
            star.appendChild(path);
            star.appendChild(path2);
            reviewRating.appendChild(star);
        }

        reviewHeader.appendChild(reviewer);
        reviewHeader.appendChild(reviewRating);

        const reviewParagraph = document.createElement('p');
        reviewParagraph.textContent = reviewText;

        reviewContainer.appendChild(reviewHeader);
        reviewContainer.appendChild(reviewParagraph);

        document.querySelector('.reviews').appendChild(reviewContainer);

        reviewForm.classList.add('hidden');
        reviewFormElement.reset();
    });
});
