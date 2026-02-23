<!DOCTYPE html>
<html lang="en">
  <head>
    
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
  </head>
  <body>
 
    <main class="mt-5 pt-3">
     <div class="container-fluid">
        <div class="row">
          <div class="col-md-12">
            <a class="btn btn-primary" href="{{url('doctor/doctorpayment')}}">Go Back</a>
          </div>
          <div align="center" style="padding-top:10px;">
            <b style=" font-size: 40px;">Doctor Payment View</b>
        </div>
          <div align="center" style="padding-top:10px;">
        <table>
                <tr style="background-color:black;" align="center">
                
                    <th style="padding:10px;font-size: 20px;color:white">Bkash</th>
                    <th style="padding:10px;font-size: 20px;color:white">Amount</th>

                    <th style="padding:10px;font-size: 20px;color:white">Transaction ID</th>



                </tr>
               
                <tr style="background-color:skyblue;" align="center">
               
                   <td style="padding:10px;font-size: 20px;color:black">{{$dd->bkash}}</td>
                    <td style="padding:10px;font-size: 20px;color:black">{{$dd->amount-($dd->amount*10)/100}}</td>

                    <td style="padding:10px;font-size: 20px;color:black">{{$dd->trxID}}</td>



                    
                </tr>
               
</table>
        </div>
        </div>
</div>
</main>
  @include('doctor.script')
  </body>
</html>