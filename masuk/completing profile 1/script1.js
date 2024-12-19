document.addEventListener("DOMContentLoaded", function () {
    const profileForm = document.getElementById("profileForm");
    const imageInput = document.getElementById("profilePicture");
    const previewImage = document.getElementById("previewImage");
    const defaultProfilePic = document.getElementById("defaultProfilePic");

    // Trigger the file input when the label is clicked
    document.querySelector(".file-input-label").addEventListener("click", () => {
        imageInput.click();
    });

    // Show preview of selected image
    imageInput.addEventListener("change", function () {
        const file = imageInput.files[0];
        if (file) {
            previewImage.src = URL.createObjectURL(file);
            previewImage.style.display = "block";
            defaultProfilePic.style.display = "none"; // Hide the default image
        } else {
            previewImage.style.display = "none";
            defaultProfilePic.style.display = "block"; // Show the default image
        }
    });

    profileForm.addEventListener("submit", function (event) {
        event.preventDefault(); // Prevent the default form submission behavior

        // Gather form data
        const formData = new FormData(profileForm);
        const profileData = {
            fullname: formData.get("fullname"),
            dob: formData.get("dob"),
            email: formData.get("email"),
            phone: formData.get("phone"),
            gender: formData.get("gender"),
            profilePicture: formData.get("profilePicture") // Include the file
        };

        // Optionally, you can log the data to the console or handle it further
        console.log("Profile Data:", profileData);

        // Simulate form submission (e.g., to a server)
        // In a real application, you might use fetch or axios to submit the form data
        alert("Form submitted successfully!");

        // Reset the form
        profileForm.reset();
        previewImage.style.display = "none"; // Hide the image preview
        defaultProfilePic.style.display = "block"; // Show the default image
    });
});
