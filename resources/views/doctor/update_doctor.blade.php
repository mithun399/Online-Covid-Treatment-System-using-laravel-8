<!DOCTYPE html>
<html lang="en">
  <head>
  <base href="/public">
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
        <div class="container" align="center" style="padding-top:50px;">
        <form action="{{url('doctor/editdoctor',$data->id)}}" method="POST" enctype="multipart/form-data">
          @csrf
        <div class="form-group">
    <label>Doctor Name</label>
    <input type="text" name="name" class="form-control" value="{{$data->name}}"  placeholder="Doctor Name" required>
  </div>
  <div class="form-group">
    <label>Email address</label>
    <input type="email" name="email" value="{{$data->email}}" class="form-control"   placeholder="Enter email" required>
    
  </div>
  <div class="form-group">
    <label>Phone Number</label>
    <input type="number" name="phone" value="{{$data->phone}}" class="form-control"  placeholder="Phone Number" required>
  </div>
  <div class="form-group">
    <label>Speciality</label>
    <input type="text" name="speciality" value="{{$data->speciality}}" class="form-control"  placeholder="Phone Number" required>
  </div>
  <div class="form-group">
    <label>Room Number</label>
    <input type="number" name="room" value="{{$data->room}}" class="form-control"  placeholder="Room Number" required>
  </div>
  <div class="form-group">
    <label>Old Image</label>
    <img height="100px;" width="100px;" src="doctor/{{$data->image}}" alt="">
  </div><br>
  <div class="form-group">
    <label>New Image</label>
    <input type="file" name="image" class="form-control-file">
  </div>
  <div class="form-group">
    <label>Time</label>
    <input type="text" name="time" value="{{$data->time}}" class="form-control"  placeholder="Time" required>
  </div>
  <div class="form-group">
    <label>Fees</label>
    <input type="text" name="fee" value="{{$data->fee}}" class="form-control"  placeholder="Fees" required>
  </div><br>
  <button type="submit" class="btn btn-primary">Update</button>
        </form>

        </div>
</div>
</main>
  @include('doctor.script')
  </body>
</html>
