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
        <div align="center" style="padding-top:10px; font-size:20px;"><b>Doctor List</b></div>
        <div align="center" style="padding-top:10px;">
        <table>
                <tr style="background-color:black;">
                    <th style="padding:10px;font-size: 20px;color:white">Doctor Name</th>
                    <th style="padding:10px;font-size: 20px;color:white">Email</th>
                    <th style="padding:10px;font-size: 20px;color:white">Phone</th>
                    <th style="padding:10px;font-size: 20px;color:white">Speciality</th>
                    <th style="padding:10px;font-size: 20px;color:white">Room</th>
                    <th style="padding:10px;font-size: 20px;color:white">Image</th>
                    <th style="padding:10px;font-size: 20px;color:white">Time</th>
                    <th style="padding:10px;font-size: 20px;color:white">Fees</th>

                    <th style="padding:10px;font-size: 20px;color:white">Delete</th>
                    <th style="padding:10px;font-size: 20px;color:white">Update</th>
                </tr>
                @foreach($data as $doctor)
                <tr style="background-color:skyblue;" align="center">
                    <td style="padding:10px;font-size: 20px;color:black">{{$doctor->name}}</td>
                    <td style="padding:10px;font-size: 20px;color:black">{{$doctor->email}}</td>
                    <td style="padding:10px;font-size: 20px;color:black">{{$doctor->phone}}</td>
                    <td style="padding:10px;font-size: 20px;color:black">{{$doctor->speciality}}</td>
                    <td style="padding:10px;font-size: 20px;color:black">{{$doctor->room}}</td>
                    <td style="padding:10px;font-size: 20px;color:black"><img height="100px;" width="100px;" src="doctor/{{$doctor->image}}" alt=""></td>
                    <td style="padding:10px;font-size: 20px;color:black">{{$doctor->time}}</td>
                    <td style="padding:10px;font-size: 20px;color:black">{{$doctor->fee}}</td>

                    <td><a class="btn btn-danger" onclick="return confirm('Are You Sure to Delte This?')" href="{{url('doctor/deletedoctor',$doctor->id)}}">Delete</a></td>
                    <td><a class="btn btn-primary" href="{{url('doctor/updatedoctor',$doctor->id)}}">Edit</a></td>
                </tr>
                @endforeach
</table>
        </div>
    </div>
</main>
  @include('doctor.script')
  </body>
</html>
