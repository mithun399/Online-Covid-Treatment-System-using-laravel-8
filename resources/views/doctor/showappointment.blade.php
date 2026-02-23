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
        <div align="center" style="padding-top:50px; font-size:20px;"><b> Appointment</b></div>
        <div align="center" style="padding-top:50px;">
        
            <table class="table table-bordered table-hover">
                <tr style="background-color:black;">
                    <th style="padding:10px;font-size: 20px;color:white">Patient Name</th>
                    <th style="padding:10px;font-size: 20px;color:white">Email</th>
                    <th style="padding:10px;font-size: 20px;color:white">Phone</th>
                    <th style="padding:10px;font-size: 20px;color:white">Doctor Name</th>
                    <th style="padding:10px;font-size: 20px;color:white">Date</th>
                    <th style="padding:10px;font-size: 20px;color:white">Message</th>
                    <th style="padding:10px;font-size: 20px;color:white">Status</th>
                    <th style="padding:10px;font-size: 20px;color:white">Time</th>

                    <th style="padding:10px;font-size: 20px;color:white">Approved</th>
                    <th style="padding:10px;font-size: 20px;color:white">Cancel</th>
                    <th style="padding:10px;font-size: 20px;color:white">Edit</th>


                </tr>
                @foreach($data as $show)
                <tr style="background-color:skyblue;" align="center">
                    <td style="padding:10px;font-size: 20px;color:black">{{$show->name}}</td>
                    <td style="padding:10px;font-size: 20px;color:black">{{$show->email}}</td>
                    <td style="padding:10px;font-size: 20px;color:black">{{$show->phone}}</td>
                    <td style="padding:10px;font-size: 20px;color:black">{{$show->doctor}}</td>
                    <td style="padding:10px;font-size: 20px;color:black">{{$show->date}}</td>
                    <td style="padding:10px;font-size: 20px;color:black">{{$show->message}}</td>
                    <td style="padding:10px;font-size: 20px;color:black">{{$show->status}}</td>
                    <td style="padding:10px;font-size: 20px;color:black">{{$show->time}}</td>

                    <td><a class="btn btn-success" href="{{url('doctor/approved',$show->id)}}">Approved</a></td>
                    <td><a class="btn btn-danger" href="{{url('doctor/canceled',$show->id)}}">Canceled</a></td>
                    <td><a class="btn btn-primary" href="{{url('doctor/update',$show->id)}}">Edit</a></td>
                    

                    

                </tr>  
                @endforeach
            </table>
        </div>

</main>
  @include('doctor.script')
  </body>
</html>
