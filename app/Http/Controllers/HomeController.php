<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\Rule;
use App\Models\User;
use App\Models\Doctor;
use App\Models\Appointment;
use App\Models\Patient;
use App\Models\Pharmacy;
use App\Models\Cart;
use App\Models\Order;
use App\Models\Our;
use App\Models\Dhaka;
use App\Models\Chittagong;
use App\Models\Sylhet;
use App\Models\Mymensingh;
use App\Models\Rangpur;
use App\Models\Rajshahi;
use App\Models\Khulna;
use App\Models\Barishal;
use App\Models\Donor;
use App\Models\Plasma;
use App\Models\Bank;
use App\Models\Sample;
use App\Models\Organisation;
use App\Models\Oxygen;
use App\Models\Helpline;
use App\Models\Icu;
use App\Models\Payment;
use App\Models\Prescription;


class HomeController extends Controller
{
    public function redirect(){
        if(Auth::id()){
            if(Auth::user()->usertype==0)
            {
                $doctor=Doctor::all();
                return view('user.home',compact('doctor'));
            }
            elseif(Auth::user()->usertype==1)
            {
                return view('admin.home');
            }
            else
            {
                return view('doctor.home');
            }
        }
        else {
            return redirect()->back();
        }
    }
    public function index(){
        if(Auth::id()){
            return redirect('home');
        }
        else {
        $doctor=Doctor::all();
        return view('user.home',compact('doctor'));
        }
    }
    public function appointment(Request $req){
        $validated = $req->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'email', 'max:255'],
            'date' => ['required', 'date'],
            'phone' => ['required', 'string', 'max:20'],
            'message' => ['nullable', 'string', 'max:1000'],
            'doctor' => ['required', 'string', 'max:255'],
            'time' => ['required', 'string', 'max:50'],
        ]);

        $appointment = new Appointment;
        $appointment->name=$validated['name'];
        $appointment->email=$validated['email'];
        $appointment->date=$validated['date'];
        $appointment->phone=$validated['phone'];
        $appointment->message=$validated['message'] ?? null;
        $appointment->doctor=$validated['doctor'];
        $appointment->status='In Progress';
        $appointment->time=$validated['time'];
        if(Auth::id()){
            $appointment->user_id=Auth::user()->id;
        }
        $appointment->save();
        return redirect()->back()->with('message','Appointment Request Successful.Pay and we will contact with you soon...');
        

    }
    public function myappointment(){
        if(Auth::id()){
            $userid=Auth::user()->id;
            $appointment=appointment::where('user_id',$userid)->get();
        return view('user.my_appointment',compact('appointment'));
    } 
    else {
        return redirect()->back();
    }
}
    public function cancel_appoint($id) {
        if (!Auth::id()) {
            return redirect('/login');
        }

        Appointment::where('id', $id)
            ->where('user_id', Auth::id())
            ->whereIn('status', ['In Progress', 'canceled'])
            ->delete();

        return redirect()->back();
        //$appointment->delete();
       
        /*if($appointment=="In Progress"){
        $appointment->delete();
        }
        elseif($appointment=="canceled"){
        $appointment->delete();
        }
        else {
        return redirect()->back();}*/
    }
    public function doctors(){
        $doctor=Doctor::all();
        return view('user.doctors',compact('doctor'));
    }
    public function patients(){
        $patient=Patient::all();
        return view('user.patients',compact('patient'));
    }
    public function pharmacy(){
        $medicine=Pharmacy::all();
        return view('user.pharmacy',['pharmacies'=>$medicine]);
    }
    public function mdetail($id){
        $medicine=Pharmacy::find($id);
        return view('user.mdetail',['medicine'=>$medicine]);
    }
    public function addTOCart(Request $req){
        $cart= new Cart;
        if(Auth::id()){
           $validated = $req->validate([
                'product_id' => ['required', 'integer', Rule::exists('pharmacies', 'id')],
            ]);
          
           $cart->user_id=Auth::id();
           $cart->product_id=$validated['product_id'];
           $cart->save();
           return redirect()->back();
          
        }
       else {
            return redirect('/login');
       }
        
      }
     static function cartItem(){
          if(Auth::id()){
          return Cart::where('user_id', Auth::id())->count();
        }

        return 0;
      }
     function cartList(){
        if(Auth::id()){
             $products=DB::table('carts')
              ->join('pharmacies','carts.product_id','=','pharmacies.id')
              ->where('carts.user_id', Auth::id())
              ->select('pharmacies.*','carts.id as cart_id')
              ->get();
              return view('user.cartlist',['products'=>$products]);
        }
      }
      function removeCart($id){
        Cart::destroy($id);
        return redirect('cartlist');
      }
      public function buyNow()
      {
        if(Auth::id()){
            $total= DB::table('carts')
              ->join('pharmacies','carts.product_id','=','pharmacies.id')
              ->where('carts.user_id', Auth::id())
             
              ->sum('pharmacies.price');
             return view('user.buynow',['total'=>$total]);
        }
      }
      function orderPlace(Request $req){
        if(Auth::id()){
            $validated = $req->validate([
                'payment' => ['required', 'string', 'max:50'],
                'address' => ['required', 'string', 'max:500'],
                'bkash' => ['nullable', 'string', 'max:30'],
                'transaction_id' => ['nullable', 'string', 'max:100'],
            ]);

            $allcart=Cart::where('user_id', Auth::id())->get();

            DB::transaction(function () use ($allcart, $validated) {
                foreach($allcart as $cart){
                    $order=new Order;
                    $order->product_id=$cart['product_id'];
                    $order->user_id=$cart['user_id'];
                    $order->status="pending";
                    $order->payment_method=$validated['payment'];
                    $order->payment_status="pending";
                    $order->address=$validated['address'];
                    $order->bkash=$validated['bkash'] ?? null;
                    $order->transaction_id=$validated['transaction_id'] ?? null;
                    $order->save();
                }

                Cart::where('user_id', Auth::id())->delete();
            });
            
            }
        $req->input();
        return redirect('/');
      }
      function myOrders(){
        if(Auth::id()){
             $orders= DB::table('orders')
              ->join('pharmacies','orders.product_id','=','pharmacies.id')
              ->where('orders.user_id', Auth::id())
             // ->select('orders.*','orders.id as order_id')
             
              ->get();
             return view('user.myorders',['orders'=>$orders]);
        }
      }
    function removeOrder($id){
        Order::where('id', $id)
            ->where('user_id', Auth::id())
            ->delete();

        return redirect('myorders');
    }
    function ambulance(){
        return view('user.ambulance');
    }
    function our(){
        $our=Our::paginate(10);
        return view('user.ourhospital',compact('our'));
    }
    function dhaka(){
        $dha=Dhaka::paginate(10);
        return view('user.dhaka',compact('dha'));
    }
    function cha(){
        $cha=Chittagong::paginate(10);
        return view('user.cha',compact('cha'));
    }
    function syl(){
        $syl=Sylhet::paginate(10);
        return view('user.sylhet',compact('syl'));
    }
    function mymens(){
        $mymen=Mymensingh::paginate(10);
        return view('user.mymens',compact('mymen'));
    }
    function rang(){
        $rang=Rangpur::paginate(10);
        return view('user.rang',compact('rang'));
    }
    function rajshahi(){
        $shahi=Rajshahi::paginate(10);
        return view('user.rajshahi',compact('shahi'));
    }
    function khulna(){
        $khul=Khulna::paginate(10);
        return view('user.khulna',compact('khul'));
    }
    function barishal(){
        $bari=Barishal::paginate(10);
        return view('user.barishal',compact('bari'));
    }
    function blood(){
        return view('user.blood');
    }
    function userDonor(Request $req){
        $donor=new Donor;
        $donor->name=$req->name;
        $donor->blood=$req->blood;
        $donor->address=$req->address;
        $donor->phone=$req->phone;
        $donor->save();
        return redirect()->back();
    }
    function donor(){
        $donor=Donor::paginate(12);
        return view('user.donorlist',compact('donor'));
    }
    function bloodBank(){
        $bank=Bank::paginate(12);
        return view('user.b_bank',compact('bank'));
    }
    function plasmaDonor(Request $req){
        $donor=new Plasma;
        $donor->name=$req->name;
        $donor->blood=$req->blood;
        $donor->address=$req->address;
        $donor->phone=$req->phone;
        $donor->save();
        return redirect()->back();
    }
    function plasmadono(){
        $donor=Plasma::paginate(12);
        return view('user.plasmadonor',compact('donor'));
    }
   function sample(){
       return view('user.sample');
   }
  function uploadSample(Request $req){
      $sample=new Sample;
      $sample->name=$req->name;
      $sample->email=$req->email;
      $sample->number=$req->phone;
      $sample->date=$req->date;
      $sample->address=$req->address;
      $sample->message=$req->message;
      $sample->save();
      return redirect()->back()->with('message','Request Successful.We will contact you within 30 minutes...');

   }
   function org(){
       $org=Organisation::paginate(10);
       return view('user.org',compact('org'));
   }
   function consult(){
    $doctor=Doctor::all();
       return view('user.consult',compact('doctor'));
   }
   function oxygen(){
    $oxygen=Oxygen::paginate(10);
    return view('user.oxygen',compact('oxygen'));
    }
    function icu(){
        $total=DB::table('icus')->count();
        
        return view('user.icu',compact('total'));
    }
    function helplines(){
        $helplines=Helpline::all();
        return view('user.helplines',compact('helplines'));
    }
    function icuform(Request $req){
        $icu=new Icu;
        $icu->name=$req->name;
        $icu->reference=$req->reference;
        $icu->date=$req->date;
        $icu->address=$req->address;
        $icu->phone=$req->phone;
        $icu->message=$req->message;
        $icu->save();
        return redirect()->back()->with('message','Request Successfull,We will contact with you within 10 minutes');
        
    }
    function payment($id){
       $doctors=Doctor::find($id);
        return view('user.payment',compact('doctors'));
    }
    function uploadPayment(Request $req){
        $payment=new Payment;
        $payment->doctor=$req->doctor;
        $payment->bkash=$req->bkash;
        $payment->amount=$req->amount;
        $payment->trxID=$req->trxID;
        $payment->save();
        return redirect()->back()->with('message','Payment Successfull');

    }
    function search(Request $req){
        
        $doctor=Doctor::
       where('name','like','%'.$req->input('query').'%')
       ->get();
      
       return view('user.search',compact('doctor'));
       
    }
    function prescription(){
        return view('user.prescription');
    }
    function store(Request $req){
        $data=new Prescription;
        $data->name=$req->name;
        $data->dname=$req->dname;
        $data->age=$req->age;
        $file=$req->file;
        $filename=time().'.'.$file->getClientOriginalExtension();
        $req->file->move('assets',$filename);
        $data->file=$filename;
        $data->save();
        return redirect()->back()->with('message','Prescription Successfully Uploaded');

    }
    function show(){
        $show=Prescription::all();
        return view('user.show',compact('show'));
    }
    function download(Request $req,$file){

        return response()->download(public_path('assets/'.$file));
    }
    function view($id){
        $view=Prescription::find($id);
        return view('user.view',compact('view'));

    }

    }
