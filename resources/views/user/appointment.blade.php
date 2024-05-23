<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Make an Appointment</title>
    <!-- Include any necessary CSS files -->
    <style>
        .unavailable {
            text-decoration: line-through !important;
            color: #db0a0a; /* Optionally change the color */
        }
    </style>
</head>
<body>
    <div class="page-section">
        <div class="container">
            <h1 class="text-center wow fadeInUp">Make an Appointment</h1>
            <form id="appointmentForm" class="main-form" action="{{ url('appointment') }}" method="post">
                @csrf
                <div class="row mt-5">
                    <div class="col-12 col-sm-6 py-2 wow fadeInLeft">
                        <input type="text" class="form-control" placeholder="Full name" name="name" required>
                    </div>
                    <div class="col-12 col-sm-6 py-2 wow fadeInRight">
                        <input type="email" class="form-control" placeholder="Email address.." name="email" required>
                    </div>
                    <div class="col-12 col-sm-6 py-2 wow fadeInRight" data-wow-delay="300ms">
                        <select name="doctor" id="doctor" class="custom-select" required>
                            <option value="">--Select a Doctor--</option>
                            @foreach ($doctor as $doctors)
                                <option value="{{ $doctors->name }}">{{ $doctors->name }} --speciality-- {{ $doctors->speciality }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-12 py-2 wow fadeInUp" data-wow-delay="300ms">
                        <input type="date" class="form-control" name="date" id="appointmentDate" min="{{ date('Y-m-d') }}" required>
                    </div>
                    <div class="col-12 py-2 wow fadeInUp" data-wow-delay="300ms">
                        <select name="time" id="appointmentTime" class="form-control" required>
                            <!-- Options will be dynamically updated based on selected date -->
                        </select>
                    </div>
                    <div class="col-12 py-2 wow fadeInUp" data-wow-delay="300ms">
                        <input type="text" class="form-control" placeholder="Number.." name="number" required>
                    </div>
                    <div class="col-12 py-2 wow fadeInUp" data-wow-delay="300ms">
                        <textarea name="message" id="message" class="form-control" rows="6" placeholder="Enter message.." required></textarea>
                    </div>
                </div>
                <button type="submit" class="btn btn-primary mt-3 wow zoomIn">Submit Request</button>
            </form>
        </div>
    </div> <!-- .page-section -->

<script>
document.addEventListener('DOMContentLoaded', function() {
    const dateInput = document.getElementById('appointmentDate');
    const timeSelect = document.getElementById('appointmentTime');
    const doctorSelect = document.getElementById('doctor');
    const durationSelect = document.getElementById('duration');

    // Function to update available times based on the selected date
    function updateAvailableTimes() {
        const selectedDate = new Date(dateInput.value);
        const today = new Date();
        today.setHours(0, 0, 0, 0);

        // Ensure the selected date is today or in the future
        if (selectedDate < today) {
            alert('The appointment date must be today or in the future.');
            dateInput.value = '';
            return;
        }

        const dayOfWeek = selectedDate.getDay(); // 0 (Sunday) to 6 (Saturday)
        let startTime, endTime;

        // Define available time ranges based on the day of the week
        if (dayOfWeek >= 1 && dayOfWeek <= 5) { // Monday to Friday
            startTime = '09:00';
            endTime = '18:30';
        } else if (dayOfWeek === 6) { // Saturday
            startTime = '09:00';
            endTime = '17:30';
        } else {
            // No appointments on Sundays
            return;
        }

        const timeOptions = [];
        let currentTime = new Date();
        const startHour = parseInt(startTime.substr(0, 2));
        const startMinute = parseInt(startTime.substr(3, 2));

        // Ensure the current time is after the start time
        if (currentTime.getHours() < startHour || (currentTime.getHours() === startHour && currentTime.getMinutes() < startMinute)) {
            currentTime.setHours(startHour);
            currentTime.setMinutes(startMinute);
        } else {
            currentTime.setMinutes(currentTime.getMinutes() + 30 - (currentTime.getMinutes() % 30));
        }

        // Generate time options within the selected range
        while (currentTime.getHours() < parseInt(endTime.substr(0, 2)) || (currentTime.getHours() === parseInt(endTime.substr(0, 2)) && currentTime.getMinutes() <= parseInt(endTime.substr(3, 2)))) {
            const option = document.createElement('option');
            option.text = currentTime.toLocaleTimeString([], { hour: '2-digit', minute: '2-digit' });
            option.value = currentTime.toISOString().substr(11, 5);
            timeOptions.push(option);
            currentTime.setMinutes(currentTime.getMinutes() + 30); // Increment by 30 minutes
        }

        // Append time options to select element
        timeSelect.innerHTML = ''; // Clear existing options
        timeOptions.forEach(option => {
            timeSelect.add(option);
        });

        // Disable reserved time slots
        disableReservedTimeSlots();
    }

    // Function to disable reserved time slots
    async function disableReservedTimeSlots() {
        const selectedDate = dateInput.value;
        const selectedDoctor = doctorSelect.value;

        if (!selectedDate || !selectedDoctor) {
            return;
        }

        const timeOptions = timeSelect.options;
        for (let i = 0; i < timeOptions.length; i++) {
            const time = timeOptions[i].value;
            const isAvailable = await checkTimeAvailability(selectedDate, time, selectedDoctor);
            timeOptions[i].disabled = !isAvailable;
            if (!isAvailable) {
            timeOptions[i].classList.add('unavailable');
        }
        }
    }

    // Function to check if the selected time slot is available
    async function checkTimeAvailability(selectedDate, selectedTime, selectedDoctor) {
        const response = await fetch(`/check-availability?date=${selectedDate}&time=${selectedTime}&doctor=${selectedDoctor}`);
        const data = await response.json();
        return data.available;
    }

    // Function to update appointment duration based on the selected doctor
    async function updateAppointmentDuration() {
        const selectedDoctor = doctorSelect.value;

        if (!selectedDoctor) {
            return;
        }

        const response = await fetch(`/get-doctor-duration?doctor=${selectedDoctor}`);
        const data = await response.json();

        // Clear existing options
        durationSelect.innerHTML = '';

        // Add new options based on the doctor's appointment duration
        data.durations.forEach(duration => {
            const option = document.createElement('option');
            option.text = `${duration} minutes`;
            option.value = duration;
            durationSelect.add(option);
        });
    }

    // Function to handle form submission
    async function handleSubmit(event) {
        event.preventDefault();

        const selectedDate = dateInput.value;
        const selectedTime = timeSelect.value;
        const selectedDoctor = doctorSelect.value;

        if (!selectedDate || !selectedTime || !selectedDoctor) {
            alert('Please fill in all fields.');
            return;
        }

        const isAvailable = await checkTimeAvailability(selectedDate, selectedTime, selectedDoctor);
        if (!isAvailable) {
            alert('The selected time slot is not available. Please choose a different time.');
            return;
        }

        // Form submission logic here
        // You can submit the form using AJAX or redirect to another URL
        // Example:
        document.getElementById('appointmentForm').submit();
    }

    // Attach event listeners
    dateInput.addEventListener('change', updateAvailableTimes);
    doctorSelect.addEventListener('change', () => {
        updateAvailableTimes();
        updateAppointmentDuration();
    });
    timeSelect.addEventListener('change', disableReservedTimeSlots);
    document.getElementById('appointmentForm').addEventListener('submit', handleSubmit);

    // Initial calls to set available times and appointment duration
    updateAvailableTimes();
    updateAppointmentDuration();
});

</script>
