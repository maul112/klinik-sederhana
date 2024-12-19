document.addEventListener('DOMContentLoaded', () => {
    // Search button and input elements
    const searchButton = document.getElementById('search-button');
    const searchInput = document.getElementById('search-input');
    const searchResultsSection = document.getElementById('search-results');
    const searchResultsList = document.getElementById('search-results-list');
    const faqItems = document.querySelectorAll('.faqs li');

    // Function to display search results
    function displaySearchResults(query) {
        searchResultsList.innerHTML = ''; // Clear previous results
        let resultsFound = false;

        faqItems.forEach(item => {
            const question = item.querySelector('.faq-question').textContent.toLowerCase();
            const answer = item.querySelector('.faq-answer').textContent.toLowerCase();
            if (question.includes(query) || answer.includes(query)) {
                const resultItem = document.createElement('li');
                resultItem.innerHTML = `<strong>${item.querySelector('.faq-question').textContent}</strong><br>${item.querySelector('.faq-answer').textContent}`;
                searchResultsList.appendChild(resultItem);
                resultsFound = true;
            }
        });

        if (!resultsFound) {
            const noResultItem = document.createElement('li');
            noResultItem.textContent = 'tidak ada hasil yang ditemukan, silahkan hubungi customer service melalui email atau telp';
            searchResultsList.appendChild(noResultItem);
        }

        searchResultsSection.style.display = 'block'; // Show the results section
    }

    // Search button click event
    searchButton.addEventListener('click', () => {
        const query = searchInput.value.trim().toLowerCase();
        if (query) {
            displaySearchResults(query);
        }
    });

    // Enter key press event for search input
    searchInput.addEventListener('keypress', (event) => {
        if (event.key === 'Enter') {
            const query = searchInput.value.trim().toLowerCase();
            if (query) {
                displaySearchResults(query);
            }
        }
    });

    // Email support button functionality
    const emailSupport = document.getElementById('email-support');
    emailSupport.addEventListener('click', () => {
        window.location.href = 'mailto:support@example.com';
    });

    // Phone support button functionality
    const phoneSupport = document.getElementById('phone-support');
    phoneSupport.addEventListener('click', () => {
        window.location.href = 'tel:+1234567890';
    });

    // FAQs functionality
    faqItems.forEach(item => {
        item.addEventListener('click', () => {
            const answer = item.querySelector('.faq-answer');
            if (answer.style.display === 'block') {
                answer.style.display = 'none';
            } else {
                answer.style.display = 'block';
            }
        });
    });
});
