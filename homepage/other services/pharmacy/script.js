document.getElementById('uploadForm').addEventListener('submit', function(e) {
    e.preventDefault();

    const fileInput = document.getElementById('prescription');
    const status = document.getElementById('status');
    const file = fileInput.files[0];

    if (!file) {
        status.textContent = 'Please select a file to upload.';
        status.style.color = 'red';
        return;
    }

    const formData = new FormData();
    formData.append('prescription', file);

    fetch('/upload', {
        method: 'POST',
        body: formData
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            status.textContent = 'File uploaded successfully!';
            status.style.color = 'green';
        } else {
            status.textContent = 'File upload failed. Please try again.';
            status.style.color = 'red';
        }
    })
    .catch(error => {
        console.error('Error:', error);
        status.textContent = 'An error occurred while uploading the file.';
        status.style.color = 'red';
    });
});


document.addEventListener("DOMContentLoaded", function() {
    // Get the modal
    var modal = document.getElementById("uploadModal");

    // Get the button that opens the modal
    var btn = document.querySelector(".upload-card");

    // Get the <span> element that closes the modal
    var span = document.getElementsByClassName("close")[0];

    // Get the file input and the label
    var fileInput = document.getElementById("prescription");
    var fileLabel = document.querySelector(".custom-file-upload");
    var fileNameDisplay = document.createElement("span");
    fileNameDisplay.className = "file-name";
    fileLabel.appendChild(fileNameDisplay);

    // When the user clicks the button, open the modal 
    btn.onclick = function() {
        modal.style.display = "flex"; // Change from block to flex
    }

    // When the user clicks on <span> (x), close the modal
    span.onclick = function() {
        modal.style.display = "none";
    }

    // When the user clicks anywhere outside of the modal, close it
    window.onclick = function(event) {
        if (event.target == modal) {
            modal.style.display = "none";
        }
    }

    // Handle file input change
    fileInput.onchange = function(event) {
        var fileName = event.target.files[0].name;
        fileNameDisplay.textContent = fileName;
    }

    // Handle form submission
    var form = document.getElementById("uploadForm");
    form.onsubmit = function(event) {
        event.preventDefault();
        // Handle the file upload here
        alert("Form submitted!");
        // Close the modal
        modal.style.display = "none";
    }
});
