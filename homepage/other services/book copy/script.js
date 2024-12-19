document.addEventListener('DOMContentLoaded', function() {
    const hours = document.querySelectorAll('.hour');
    hours.forEach(hour => {
        hour.addEventListener('click', function() {
            hours.forEach(h => h.classList.remove('selected'));
            this.classList.add('selected');
        });
    });

    document.getElementById('next-button').addEventListener('click', function() {
        const selectedDate = document.getElementById('appointment-date').value;
        const selectedHour = document.querySelector('.hour.selected')?.textContent;
        const complaint = document.getElementById('complaint').value;

        if (selectedDate && selectedHour) {
            alert(`Appointment booked on ${selectedDate} at ${selectedHour}\nComplaint: ${complaint}`);
        } else {
            alert('Please select a date and hour for the appointment.');
        }
    });
});
