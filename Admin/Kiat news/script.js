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

function triggerFileInput() {
    document.getElementById('fileInput').click();
}

function addPDF() {
    const fileInput = document.getElementById('fileInput');
    const file = fileInput.files[0];

    if (file && file.type === 'application/pdf') {
        const pdfTableBody = document.getElementById('pdfTableBody');
        const newRow = document.createElement('tr');

        const currentDate = new Date().toLocaleString('en-US', {
            year: 'numeric',
            month: 'short',
            day: 'numeric',
            hour: 'numeric',
            minute: 'numeric',
            hour12: true
        });

        newRow.innerHTML = `
            <td><input type="checkbox"></td>
            <td>${file.name}</td>
            <td>${currentDate}</td>
        `;

        pdfTableBody.appendChild(newRow);

        // Clear the file input value to allow re-upload of the same file if needed
        fileInput.value = '';
    } else {
        alert('Please upload a valid PDF file.');
    }
}
