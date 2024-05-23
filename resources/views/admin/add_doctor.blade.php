

<!DOCTYPE html>
<html lang="en">
  <head>
    <base href="/admin/">
@include('admin.css')
  </head>
  <body>
    <div class="container-scroller">
      <div class="row p-0 m-0 proBanner" id="proBanner">
        <div class="col-md-12 p-0 m-0">
          <div class="card-body card-body-padding d-flex align-items-center justify-content-between">
            <div class="ps-lg-1">
              <div class="d-flex align-items-center justify-content-between">
                <p class="mb-0 font-weight-medium me-3 buy-now-text">Free 24/7 customer support, updates, and more with this template!</p>
                <a href="https://www.bootstrapdash.com/product/corona-free/?utm_source=organic&utm_medium=banner&utm_campaign=buynow_demo" target="_blank" class="btn me-2 buy-now-btn border-0">Get Pro</a>
              </div>
            </div>
            <div class="d-flex align-items-center justify-content-between">
              <a href="https://www.bootstrapdash.com/product/corona-free/"><i class="mdi mdi-home me-3 text-white"></i></a>
              <button id="bannerClose" class="btn border-0 p-0">
                <i class="mdi mdi-close text-white me-0"></i>
              </button>
            </div>
          </div>
        </div>
      </div>
      <!-- partial:partials/_sidebar.html -->
@include('admin.sidebar')
      <!-- partial nav-->

@include('admin.navbar');
<div class="container-fluid page-body-wrapper">
    @if (session()->has('message'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
            {{ session()->get('message') }}
        </div>
    @endif
    <div class="container" align="center" style="padding-top: 50px;">
       <form action="{{ url('upload_doctor') }}" method="post" enctype="multipart/form-data">
    @csrf
    <div style="padding: 15px;">
        <label for="name"> Doctor's Name</label>
        <input type="text" name="name" id="name" placeholder="Write the name" style="color: black">
    </div>
    <div style="padding: 15px;">
        <label for="phone"> Phone number</label>
        <input type="number" name="phone" id="phone" placeholder="Write the phone number" style="color: black">
    </div>
    <div style="padding: 15px;">
        <label for="speciality"> Speciality</label>
        <select name="speciality" id="speciality" style="color: black; width:200px;" >
            <option value="selected">--Select--</option>
            <option value="skin">Skin</option>
            <option value="heart">Heart</option>
            <option value="eye">Eye</option>
            <option value="nose">Nose</option>
        </select>
    </div>
    <div style="padding: 15px;">
        <label for="room"> Doctor's Room No</label>
        <input type="text" name="room" id="room" placeholder="Write the Room Number" style="color: black">
    </div>
    <div style="padding: 15px;">
        <label for="duration"> Appointment Duration (minutes)</label>
        <select name="duration" id="duration" style="color: black; width:200px;" >
            <option value="15">15 minutes</option>
            <option value="20">20 minutes</option>
            <option value="30">30 minutes</option>
            <option value="45">45 minutes</option>
            <option value="60">60 minutes</option>
            <option value="75">75 minutes</option>
        </select>
    </div>
    <div style="padding: 15px;">
        <label for="room"> Doctor's Image</label>
        <input type="file" name="file" id="file">
    </div>
    <div style="padding: 15px;">
        <input type="submit" class="btn btn-success">
    </div>
</form>

    </div>

</div>

@include('admin.script')
  </body>
</html>


