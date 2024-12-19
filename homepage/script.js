document.addEventListener('DOMContentLoaded', function() {
    const sidebarToggle = document.getElementById('sidebar-toggle');
    const sidebar = document.getElementById('sidebar');
    const menuItems = document.querySelectorAll('.menu-item');

    // Toggle the sidebar visibility
    sidebarToggle.addEventListener('click', function() {
        sidebar.classList.toggle('open');
        document.body.classList.toggle('sidebar-open');
    });

    // Close the sidebar when a menu item is clicked
    menuItems.forEach(function(item) {
        item.addEventListener('click', function() {
            sidebar.classList.remove('open');
            document.body.classList.remove('sidebar-open');
        });
    });

    // Close the sidebar when clicking outside of it
    document.addEventListener('click', function(event) {
        if (!sidebar.contains(event.target) && !sidebarToggle.contains(event.target)) {
            sidebar.classList.remove('open');
            document.body.classList.remove('sidebar-open');
        }
    });
});



// script.js
document.addEventListener('DOMContentLoaded', function() {
    // document.getElementById('sidebar-toggle').addEventListener('click', function() {
    //     var sidebar = document.getElementById('sidebar');
    //     if (sidebar.style.display === 'block') {
    //         sidebar.style.display = 'none';
    //     } else {
    //         sidebar.style.display = 'block';
    //     }
    // });

    // Memuat konten sidebar.html ke dalam div#sidebar
    fetch('fitur/sidebar/sidebar.html')
        .then(response => {
            if (!response.ok) {
                throw new Error('Network response was not ok');
            }
            return response.text();
        })
        .then(data => {
            document.getElementById('sidebar').innerHTML = data;
        })
        .catch(error => console.error('Error loading sidebar:', error));
});




// Tunggu sampai seluruh konten HTML dimuat
document.addEventListener('DOMContentLoaded', function() {
    const filterButton = document.getElementById('filterButton');
    const filter = document.getElementsByClassName('filter-container');
    let isFilterLoaded = false;

    // Tambahkan event listener untuk menangani klik pada tombol filter
    filterButton.addEventListener('click', function() {
        // Jika filter belum dimuat, lakukan fetch
        if (!isFilterLoaded) {
            fetch('ProjectKlinik/beranda/fitur/filtersearch/filter.html') // Sesuaikan path ini dengan path konten filter Anda
                .then(response => response.text())
                .then(data => {
                    filter.innerHTML = data;
                    filter.style.display = 'block';
                    isFilterLoaded = true;
                })
                .catch(error => console.error('Error loading filter content:', error));
        } else {
            // Toggle display property antara 'block' dan 'none'
            if (filter.style.display === 'none' || filter.style.display === '') {
                filter.style.display = 'block';
            } else {
                filter.style.display = 'none';
            }
        }
    });
});


document.addEventListener('DOMContentLoaded', () => {
    const filterButtons = document.querySelectorAll('.filter-button');
    const doctorCards = document.querySelectorAll('.doctor-card');

    filterButtons.forEach(button => {
        button.addEventListener('click', () => {
            const filter = button.getAttribute('data-filter');

            filterButtons.forEach(btn => btn.classList.remove('active'));
            button.classList.add('active');

            doctorCards.forEach(card => {
                if (filter === 'all' || card.getAttribute('data-category') === filter) {
                    card.style.display = 'block';
                } else {
                    card.style.display = 'none';
                }
            });
        });
    });
});

document.addEventListener('DOMContentLoaded', () => {
    const dots = document.querySelectorAll('.dot');
    const newsCards = document.querySelectorAll('.news-card');

    dots.forEach((dot, index) => {
        dot.addEventListener('click', () => {
            dots.forEach(d => d.classList.remove('active'));
            dot.classList.add('active');

            newsCards.forEach(card => card.style.display = 'none');
            newsCards[index].style.display = 'block';
        });
    });

    // Initialize first card as visible
    newsCards.forEach((card, index) => {
        card.style.display = index === 0 ? 'block' : 'none';
    });
});

document.addEventListener('DOMContentLoaded', function() {
    const filterIcon = document.querySelector('.filter');
    const filterContainer = document.querySelector('.filter-container');

    filterIcon.addEventListener('click', function() {
        filterContainer.classList.toggle('active');
    });
});

        // Handle active state for doctor buttons
        document.querySelectorAll('#doctors-section .filter-button').forEach(button => {
            button.addEventListener('click', () => {
                document.querySelectorAll('#doctors-section .filter-button').forEach(btn => btn.classList.remove('active'));
                button.classList.add('active');
            });
        });

        // Handle active state for medical checkup buttons
        document.querySelectorAll('#medical-checkup-section .filter-button').forEach(button => {
            button.addEventListener('click', () => {
                document.querySelectorAll('#medical-checkup-section .filter-button').forEach(btn => btn.classList.remove('active'));
                button.classList.add('active');
            });
        });

        // Handle active state for rating buttons
        document.querySelectorAll('.rating-button').forEach(button => {
            button.addEventListener('click', () => {
                document.querySelectorAll('.rating-button').forEach(btn => btn.classList.remove('active'));
                button.classList.add('active');
            });
        });

        // Reset button functionality
        document.querySelector('.action-button.reset').addEventListener('click', () => {
            // Reset doctor buttons
            document.querySelectorAll('#doctors-section .filter-button').forEach(button => {
                button.classList.remove('active');
            });
            document.querySelector('#doctors-section .filter-button:first-child').classList.add('active');

            // Reset medical checkup buttons
            document.querySelectorAll('#medical-checkup-section .filter-button').forEach(button => {
                button.classList.remove('active');
            });
            document.querySelector('#medical-checkup-section .filter-button:first-child').classList.add('active');

            // Reset rating buttons
            document.querySelectorAll('.rating-button').forEach(button => {
                button.classList.remove('active');
            });
            document.querySelector('.rating-button:first-child').classList.add('active');
        });

        document.addEventListener("DOMContentLoaded", () => {
            const searchInput = document.getElementById("search-input");
            const filterButtons = document.querySelectorAll(".filter-button");
            const doctorCards = document.querySelectorAll(".doctor-card");
        
            // Search functionality
            searchInput.addEventListener("input", () => {
                const searchTerm = searchInput.value.toLowerCase();
                doctorCards.forEach(card => {
                    const doctorName = card.querySelector("h3").innerText.toLowerCase();
                    if (doctorName.includes(searchTerm)) {
                        card.style.display = "";
                    } else {
                        card.style.display = "none";
                    }
                });
            });
        
            // Filter functionality
            filterButtons.forEach(button => {
                button.addEventListener("click", () => {
                    const filter = button.getAttribute("data-filter");
        
                    // Remove active class from all buttons
                    filterButtons.forEach(btn => btn.classList.remove("active"));
                    // Add active class to clicked button
                    button.classList.add("active");
        
                    doctorCards.forEach(card => {
                        if (filter === "all" || card.getAttribute("data-category") === filter) {
                            card.style.display = "";
                        } else {
                            card.style.display = "none";
                        }
                    });
                });
            });
        });
        
        document.addEventListener("DOMContentLoaded", function() {
            const sidebarToggle = document.getElementById("sidebar-toggle");
            const filterContainer = document.getElementById("filter-container");
        
            // Function to toggle filter visibility
            function toggleFilter() {
                filterContainer.classList.toggle("open");
            }
        
            // Event listener for the filter icon
            document.querySelector(".filter").addEventListener("click", toggleFilter);
        
            // Event listener for the close button
            document.querySelector(".close-filter").addEventListener("click", toggleFilter);
        
            // Event listener to close the filter when clicking outside of it
            window.addEventListener("click", function(event) {
                if (!filterContainer.contains(event.target) && !event.target.classList.contains("filter")) {
                    filterContainer.classList.remove("open");
                }
            });
        });