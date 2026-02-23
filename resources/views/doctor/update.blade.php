<!DOCTYPE html>
<html lang="en">
  <head>
    @include('doctor.css')
  </head>
  <body>
    <!-- top navigation bar -->
    @include('doctor.navbar')
    <!-- top navigation bar -->
    <!-- offcanvas -->
    @include('doctor.sidebar')
    <!-- offcanvas -->
    <main class="mt-5 pt-3">
    <div class="container-fluid">
        <div class="row">
          <div class="col-md-12">
            <h4>Dashboard</h4>
          </div>
        </div>
        <div align="center" style="padding-top:50px;">
    <div class="page-section">
    <div class="container">
      <h1 class="text-center wow fadeInUp">Make an Appointment</h1>

      <form class="main-form" method="POST" action="{{url('doctor/edit',$data->id)}}">
        @csrf
        
         
          
          <div class="col-12 col-sm-6 py-2 wow fadeInRight" data-wow-delay="300ms">
          <input type="text" name="time" class="form-control" value="{{$data->time}}" placeholder="time">
           
          </div>
          
        

        <button type="submit" class="btn btn-primary mt-3 wow zoomIn">Submit Request</button>
      </form>
    </div>
  </div> 
</div>
</main>




  @include('doctor.script')
  </body>
</html>