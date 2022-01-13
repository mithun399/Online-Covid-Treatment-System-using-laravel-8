<!DOCTYPE html>
<html lang="en">
  <head>
  <base href="/public">
    @include('admin.css')
   
  </head>
  <body>
    <!-- top navigation bar -->
    @include('admin.navbar')
    <!-- top navigation bar -->
    <!-- offcanvas -->
    @include('admin.sidebar')
    <!-- offcanvas -->
    <main class="mt-5 pt-3">
    <div class="container-fluid">
        <div class="row">
          <div class="col-md-12">
            <h4>Dashboard</h4>
          </div>
        </div>
        <form action="{{url('editdonor',$donors->id)}}" method="POST">
    @csrf
  <div class="mb-3">
    <label  class="form-label">Name</label>
    <input type="text" name="name" value="{{$donors->name}}" class="form-control">
   
  </div>
  <div class="mb-3">
    <label  class="form-label">Blood Group</label>
    <input type="text" name="blood" value="{{$donors->blood}}" class="form-control" >
  </div>
  <div class="mb-3">
    <label  class="form-label">Address</label>
    <input type="text" name="address" value="{{$donors->address}}" class="form-control" >
  </div>
  <div class="mb-3">
    <label  class="form-label">Phone</label>
    <input type="number" name="phone" value="{{$donors->phone}}" class="form-control" >
  </div>
 
  <button type="submit" class="btn btn-primary">Submit</button>
</form>

        </div>
</div>
</main>
  @include('admin.script')
  </body>
</html>
