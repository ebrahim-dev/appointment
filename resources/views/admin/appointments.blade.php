

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
     <div align="center" style="padding: 70px">
        <table>
            <tr style="background-color:black; color:yellow" align="center">
                <th style="padding: 10px; font-size:20px;"> Client Name </th>
                <th style="padding: 10px; font-size:20px;"> Client Email </th>
                <th style="padding: 10px; font-size:20px;"> Client Phone </th>
                <th style="padding: 10px; font-size:20px;"> Doctor Name </th>
                <th style="padding: 10px; font-size:20px;"> Date </th>
                <th style="padding: 10px; font-size:20px;"> Message </th>
                <th style="padding: 10px; font-size:20px;"> Status </th>
                <th style="padding: 10px; font-size:20px;"> Approving </th>
                <th style="padding: 10px; font-size:20px;"> Cancel Appointment </th>
            </tr>
            @foreach ($appoint as $appoints)
                <tr style="background-color:gray; color:yellow" align="center">
                    <td style="padding: 10px; font-size:20px;">{{ $appoints->name }}</td>
                    <td style="padding: 10px; font-size:20px;">{{ $appoints->email}}</td>
                    <td style="padding: 10px; font-size:20px;">{{ $appoints->phone }}</td>
                    <td style="padding: 10px; font-size:20px;">{{ $appoints->doctor }}</td>
                    <td style="padding: 10px; font-size:20px;">{{ $appoints->date}} at: {{ $appoints->time }}</td>
                    <td style="padding: 10px; font-size:20px;">{{ $appoints->message }}</td>
                    <td style="padding: 10px; font-size:20px;">{{ $appoints->status }}</td>
                    @if ($appoints->status=='In progress')
                        <td> <a class="bt btn-success p-2 m-1" onclick="return confirm('Are you sure to approve it?')" href="{{ url('approved',$appoints->id) }}"> Approve </a></td>
                    @else
                        <td> <a class="bt btn-primary p-2 m-1" onclick="return confirm('Are you sure to approve it?')" href="{{ url('rewait',$appoints->id) }}"> Waiting </a></td>
                    @endif

                    <td> <a class="bt btn-danger p-2 m-1" onclick="return confirm('Are you sure to delete it?')" href="{{ url('edit_appointments',$appoints->id) }}"> Cancel </a></td>
                </tr>
            @endforeach
        </table>
    </div>
</div>

@include('admin.script')
  </body>
</html>


