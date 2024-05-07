  <div class="page-section">
    <div class="container">
      <h1 class="text-center wow fadeInUp">Make an Appointment</h1>

      <form class="main-form" action="{{ url('appointment') }}" method="post">
        @csrf
        <div class="row mt-5 ">
          <div class="col-12 col-sm-6 py-2 wow fadeInLeft">
            <input type="text" class="form-control" placeholder="Full name" name="name">
          </div>
          <div class="col-12 col-sm-6 py-2 wow fadeInRight">
            <input type="text" class="form-control" placeholder="Email address.." name="email">
          </div>
           <div class="col-12 py-2 wow fadeInUp" data-wow-delay="300ms">
            <input type="date" class="form-control" name="date" id="appointmentDate" >
        </div>
        <div class="col-12 py-2 wow fadeInUp" data-wow-delay="300ms">
            <select name="time" id="appointmentTime" class="form-control" >
                <!-- Options will be dynamically updated based on selected date -->
            </select>
        </div>
          <div class="col-12 col-sm-6 py-2 wow fadeInRight" data-wow-delay="300ms">
            <select name="doctor" id="doctor" class="custom-select">
                <option value="">--Select a Doctor--</option>
                @foreach ($doctor as $doctors )
                    <option value="{{ $doctors->name }}">{{ $doctors->name }} --speciality-- {{ $doctors->speciality }}</option>
                @endforeach

            </select>
          </div>
          <div class="col-12 py-2 wow fadeInUp" data-wow-delay="300ms">
            <input type="text" class="form-control" placeholder="Number.." name="number">
          </div>
          <div class="col-12 py-2 wow fadeInUp" data-wow-delay="300ms">
            <textarea name="message" id="message" class="form-control" rows="6" placeholder="Enter message.."></textarea>
          </div>
        </div>

        <button type="submit" class="btn btn-primary mt-3 wow zoomIn">Submit Request</button>
      </form>
    </div>
  </div> <!-- .page-section -->
  <script>
    // Function to update available time slots based on selected date
    function updateAvailableTimes() {
        const dateInput = document.getElementById('appointmentDate');
        const timeSelect = document.getElementById('appointmentTime');
        const selectedDate = new Date(dateInput.value);
        const dayOfWeek = selectedDate.getDay(); // 0 (Sunday) to 6 (Saturday)
        let startTime, endTime;

        // Clear existing options
        timeSelect.innerHTML = '';

        // Define available time ranges based on day of the week
        if (dayOfWeek >= 1 && dayOfWeek <= 5) { // Monday to Friday
            startTime = '09:00';
            endTime = '18:30';
        } else if (dayOfWeek === 6) { // Saturday
            startTime = '09:00';
            endTime = '17:30';
        }

        // Generate time options within the selected range
        const timeOptions = [];
        let currentTime = new Date(`2000-01-01T${startTime}`);
        const endTimeObj = new Date(`2000-01-01T${endTime}`);
        while (currentTime <= endTimeObj) {
            const option = document.createElement('option');
            option.text = currentTime.toLocaleTimeString([], { hour: '2-digit', minute: '2-digit' });
            option.value = currentTime.toISOString().substr(11, 5);
            timeOptions.push(option);
            currentTime.setMinutes(currentTime.getMinutes() + 30); // Increment by 30 minutes
        }

        // Append time options to select element
        timeOptions.forEach(option => {
            timeSelect.add(option);
        });
    }

    // Attach event listener to date input for updating available times
    const dateInput = document.getElementById('appointmentDate');
    dateInput.addEventListener('change', updateAvailableTimes);

    // Initial call to set available times based on current date
    updateAvailableTimes();
</script>
