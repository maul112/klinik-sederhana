document.addEventListener('DOMContentLoaded', () => {
    const sidebar = document.getElementById('sidebar');
    const sidebarToggleButtons = document.querySelectorAll('.sidebar-toggle');
    const menuItems = document.querySelectorAll('.sidebar-btn');

    sidebarToggleButtons.forEach(button => {
        button.addEventListener('click', () => {
            sidebar.classList.toggle('open');
            document.body.classList.toggle('sidebar-open');
        });
    });

    menuItems.forEach(item => {
        item.addEventListener('click', () => {
            sidebar.classList.remove('open');
            document.body.classList.remove('sidebar-open');
        });
    });

    document.addEventListener('click', (event) => {
        if (!sidebar.contains(event.target) && !event.target.closest('.sidebar-toggle')) {
            sidebar.classList.remove('open');
            document.body.classList.remove('sidebar-open');
        }
    });
});

function filterCategory() {
    const filter = document.getElementById('categoryFilter').value;
    const rows = document.querySelectorAll('tbody tr');

    rows.forEach(row => {
        if (filter === 'all' || row.getAttribute('data-category') === filter) {
            row.style.display = '';
        } else {
            row.style.display = 'none';
        }
    });
}
