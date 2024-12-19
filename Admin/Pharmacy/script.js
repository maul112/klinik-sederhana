document.addEventListener('DOMContentLoaded', () => {
    const sidebar = document.getElementById('sidebar');
    const sidebarToggle = document.querySelector('.sidebar-toggle');
    const menuItems = document.querySelectorAll('.sidebar-btn');

    sidebarToggle.addEventListener('click', () => {
        sidebar.classList.toggle('open');
        document.body.classList.toggle('sidebar-open');
    });

    menuItems.forEach(item => {
        item.addEventListener('click', () => {
            sidebar.classList.remove('open');
            document.body.classList.remove('sidebar-open');
        });
    });

    document.addEventListener('click', (event) => {
        if (!sidebar.contains(event.target) && !sidebarToggle.contains(event.target)) {
            sidebar.classList.remove('open');
            document.body.classList.remove('sidebar-open');
        }
    });

    const actionButtons = document.querySelectorAll('.action-btn');
    actionButtons.forEach(button => {
        button.addEventListener('click', () => {
            const patientName = button.parentNode.parentNode.children[1].textContent;
            alert(`Action button clicked for ${patientName}!`);
        });
    });

    const searchInput = document.querySelector('.search-bar');
    searchInput.addEventListener('input', () => {
        const searchValue = searchInput.value.toLowerCase();
        const rows = document.querySelectorAll('.requests-table tbody tr');
        rows.forEach(row => {
            const patientName = row.children[1].textContent.toLowerCase();
            if (patientName.includes(searchValue)) {
                row.style.display = '';
            } else {
                row.style.display = 'none';
            }
        });
    });

    const assignButtons = document.querySelectorAll('.assign-btn');
    assignButtons.forEach(button => {
        button.addEventListener('click', () => {
            alert('Assign button clicked!');
        });
    });

    const statusButtons = document.querySelectorAll('.status-btn');
    statusButtons.forEach(button => {
        button.addEventListener('click', () => {
            alert('Status button clicked!');
        });
    });

    const filterRemove = document.querySelector('.filter-remove');
    filterRemove.addEventListener('click', () => {
        alert('Filter removed!');
    });
});

function openForm() {
    document.getElementById('obatForm').style.display = 'block';
}

function closeForm() {
    document.getElementById('obatForm').style.display = 'none';
}

function addMedicine() {
    const obatName = document.getElementById('obatName').value;
    const obatCategory = document.getElementById('obatCategory').value;
    const stock = document.getElementById('stock').value;

    if (obatName && obatCategory && stock) {
        const tbody = document.getElementById('tableBody');
        const newRow = document.createElement('tr');
        newRow.setAttribute('data-category', obatCategory);

        newRow.innerHTML = `
            <td><input type="checkbox"></td>
            <td>${obatName}</td>
            <td>${obatCategory}</td>
            <td>${stock}</td>
            <td>
                <a href="#" class="btn btn-save">Save</a>
                <a href="#" class="btn btn-delete">Delete</a>
            </td>
        `;

        tbody.appendChild(newRow);

        closeForm();
        document.getElementById('newobatForm').reset();
    } else {
        alert('Please fill all fields');
    }
}


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
