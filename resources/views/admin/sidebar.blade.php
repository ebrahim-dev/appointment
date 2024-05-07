      <nav class="sidebar sidebar-offcanvas" id="sidebar">
        <div class="sidebar-brand-wrapper d-none d-lg-flex align-items-center justify-content-center fixed-top">
          <a class="sidebar-brand brand-logo" href="index.html"><img src="assets/images/logo.svg" alt="logo" /></a>
          <a class="sidebar-brand brand-logo-mini" href="index.html"><img src="assets/images/logo-mini.svg" alt="logo" /></a>
        </div>
        <ul class="nav">

          <li class="nav-item menu-items">
            <a class="nav-link" href="{{ url('add_doctor_view') }}">
              <span class="menu-icon">
                <i class="mdi mdi-file-document-box"></i>
              </span>
              <span class="menu-title">Add Doctors</span>
            </a>
          </li>
            <li class="nav-item menu-items">
                <a class="nav-link" href="{{ url('appointments') }}">
                <span class="menu-icon">
                    <i class="mdi mdi-file-document-box"></i>
                </span>
                <span class="menu-title">Appointments</span>
                </a>
            </li>
             <li class="nav-item menu-items">
                <a class="nav-link" href="{{ url('show_doctors') }}">
                <span class="menu-icon">
                    <i class="mdi mdi-file-document-box"></i>
                </span>
                <span class="menu-title">Show Doctors</span>
                </a>
            </li>
        </ul>
      </nav>
<style>
    .min-h-screen {
        min-height: 0vh !important;
    }
</style>
