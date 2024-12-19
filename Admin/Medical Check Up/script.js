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

function filterCategory() {
    const filter = document.getElementById('categoryFilter').value;
    const tableBody = document.getElementById('tableBody');
    const rows = tableBody.getElementsByTagName('tr');

    for (let i = 0; i < rows.length; i++) {
        const category = rows[i].getAttribute('data-category');
        if (filter === 'all' || category === filter) {
            rows[i].style.display = '';
        } else {
            rows[i].style.display = 'none';
        }
    }
}

function openForm() {
    document.getElementById('packetForm').style.display = 'block';
}

function closeForm() {
    document.getElementById('packetForm').style.display = 'none';
}

