<div
      class="offcanvas offcanvas-start sidebar-nav bg-dark"
      tabindex="-1"
      id="sidebar"
    >
      <div class="offcanvas-body p-0">
        <nav class="navbar-dark">
          <ul class="navbar-nav">
            <li>
              <div class="text-muted small fw-bold text-uppercase px-3">
                
              </div>
            </li>
           
            <li>
              <a href="{{url('add_doctor_view')}}" class="nav-link px-3 active">
                <span class="me-2"><i class="mdi mdi-file-document-box"></i></span>
                <span>Add Doctors</span>
              </a>
            </li>

            <li>
              <a href="{{url('showappointment')}}" class="nav-link px-3 active">
                <span class="me-2"><i class="mdi mdi-file-document-box"></i></span>
                <span>Appointments</span>
              </a>
            </li>

            <li>
              <a href="{{url('showdoctor')}}" class="nav-link px-3 active">
                <span class="me-2"><i class="mdi mdi-file-document-box"></i></span>
                <span>All Doctors</span>
              </a>
            </li>
            <li>
              <a href="{{url('drpayment')}}" class="nav-link px-3 active">
                <span class="me-2"><i class="mdi mdi-file-document-box"></i></span>
                <span>Doctor Charge</span>
              </a>
            </li>
        <li>
          <div class="dropdown" style="padding:15px;">
            <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false">
             Patient
            </button>
             <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
               <li><a class="dropdown-item" href="{{url('add_patient')}}">Add Patient</a></li>
               <li><a class="dropdown-item" href="{{url('patient_list')}}">Patient List</a></li>
    
             </ul>
          </div>

        </li>
        <li>
          <div class="dropdown" style="padding:15px;">
            <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false">
             E-Pharmacy
            </button>
             <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
               <li><a class="dropdown-item" href="{{url('add_medicine')}}">Add Medicine</a></li>
               <li><a class="dropdown-item" href="{{url('medicine_list')}}">Medicine List</a></li>
               <li><a class="dropdown-item" href="{{url('medicinepayment')}}">Payment</a></li>

    
             </ul>
          </div>
        </li>

        <li>
          <div class="dropdown" style="padding:15px;">
            <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false">
             Ambulance
            </button>
             <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
               <li><a class="dropdown-item" href="{{url('dhakam')}}">Dhaka</a></li>
               <li><a class="dropdown-item" href="{{url('cham')}}">Chittagong</a></li>
               <li><a class="dropdown-item" href="{{url('sylh')}}">Sylhet</a></li>
               <li><a class="dropdown-item" href="{{url('mymen')}}">Mymensingh</a></li>
               <li><a class="dropdown-item" href="{{url('rangp')}}">Rangpur</a></li>
               <li><a class="dropdown-item" href="{{url('sahi')}}">Rajshahi</a></li>
               <li><a class="dropdown-item" href="{{url('khul')}}">Khulna</a></li>
               <li><a class="dropdown-item" href="{{url('bari')}}">Barishal</a></li>
           </ul>
          </div>

        </li>
        <li>
          <div class="dropdown" style="padding:15px;">
            <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false">
             Ambulance List
            </button>
             <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
               <li><a class="dropdown-item" href="{{url('dhaka_list')}}">Dhaka List</a></li>
               <li><a class="dropdown-item" href="{{url('cha_list')}}">Chittagong List</a></li>
               <li><a class="dropdown-item" href="{{url('syl_list')}}">Sylhet List</a></li>
               <li><a class="dropdown-item" href="{{url('mymen_list')}}">Mymensingh List</a></li>
               <li><a class="dropdown-item" href="{{url('rang_list')}}">Rangpur List</a></li>
               <li><a class="dropdown-item" href="{{url('sahi_list')}}">Rajshahi List</a></li>
               <li><a class="dropdown-item" href="{{url('khul_list')}}">Khulna List</a></li>
               <li><a class="dropdown-item" href="{{url('bari_list')}}">Barishal List</a></li>

             </ul>
          </div>

        </li>
        <li>
          <div class="dropdown" style="padding:15px;">
            <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false">
             Blood
            </button>
             <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
               <li><a class="dropdown-item" href="{{url('add_blood')}}">Add Blood Bank</a></li>
               <li><a class="dropdown-item" href="{{url('blood_list')}}">Blood Bank List</a></li>
               <li><a class="dropdown-item" href="{{url('add_donor')}}">Add Donor</a></li>
               <li><a class="dropdown-item" href="{{url('donor_list')}}">Donor List</a></li>
               <li><a class="dropdown-item" href="{{url('addplasma_donor')}}">Add Plasma Donor</a></li>
               <li><a class="dropdown-item" href="{{url('plasmadonor_list')}}">Plasma Donor List</a></li>


    
             </ul>
          </div>
        </li>
        <li>
          <div class="dropdown" style="padding:15px;">
            <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false">
             Org Helpline
            </button>
             <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
               <li><a class="dropdown-item" href="{{url('add_org')}}">Add Org</a></li>
               <li><a class="dropdown-item" href="{{url('orglist')}}">Org List</a></li>
    
             </ul>
          </div>
        </li>
        <li>
          <div class="dropdown" style="padding:15px;">
            <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false">
             Oxygen
            </button>
             <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
               <li><a class="dropdown-item" href="{{url('add_oxygen')}}">Add Oxygen</a></li>
               <li><a class="dropdown-item" href="{{url('oxygenlist')}}">Oxygen List</a></li>
    
             </ul>
          </div>
        </li>
        <li>
              <a href="{{url('admin/sample')}}" class="nav-link px-3 active">
                <span class="me-2"><i class="mdi mdi-file-document-box"></i></span>
                <span>Sample Collection</span>
              </a>
            </li>
        <li>
              <a href="{{url('add_helpline')}}" class="nav-link px-3 active">
                <span class="me-2"><i class="mdi mdi-file-document-box"></i></span>
                <span>Add Helpline</span>
              </a>
            </li>
            <li>
              <a href="{{url('add_admin')}}" class="nav-link px-3 active">
                <span class="me-2"><i class="mdi mdi-file-document-box"></i></span>
                <span>Add Admin</span>
              </a>
            </li>
       
          </ul>
        </nav>
      </div>
    </div>