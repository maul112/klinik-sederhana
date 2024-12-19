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
    document.getElementById('packetForm').style.display = 'block';
}

function closeForm() {
    document.getElementById('packetForm').style.display = 'none';
}

function addPacket() {
    const packetName = document.getElementById('packetName').value;
    const packetDescription = document.getElementById('packetDescription').value;
    const packetCategory = document.getElementById('packetCategory').value;
    const packetPrice = document.getElementById('packetPrice').value;

    if (packetName && packetDescription && packetCategory && packetPrice) {
        const tbody = document.getElementById('tableBody');
        const newRow = document.createElement('tr');
        newRow.setAttribute('data-category', packetCategory);

        newRow.innerHTML = `
            <td><input type="checkbox"></td>
            <td>${packetName}</td>
            <td class="description"><ul>${packetDescription.split('\n').map(item => `<li>${item}</li>`).join('')}</ul></td>
            <td>${packetCategory}</td>
            <td>${packetPrice}</td>
        `;

        tbody.appendChild(newRow);

        closeForm();
        document.getElementById('newPacketForm').reset();
    } else {
        alert('Please fill all fields');
    }
}

// script.js

// Fungsi untuk membuka modal
function openForm() {
    document.getElementById("packetForm").style.display = "block";
}

// Fungsi untuk menutup modal
function closeForm() {
    document.getElementById("packetForm").style.display = "none";
}

// Fungsi untuk memfilter kategori
function filterCategory() {
    var filter = document.getElementById("categoryFilter").value;
    var rows = document.querySelectorAll("#tableBody tr");

    rows.forEach(function(row) {
        if (filter === "all" || row.getAttribute("data-category") === filter) {
            row.style.display = "";
        } else {
            row.style.display = "none";
        }
    });
}

