<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
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
use App\Services\ValidationService;

class HomeController extends Controller
{
    protected ValidationService $validationService;

    public function __construct(ValidationService $validationService)
    {
        $this->validationService = $validationService;
    }

    public function redirect(){
        if(Auth::id()){
            if(Auth::user()->usertype==0)
            {
                $doctor=Doctor::fetchAll();
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

        $doctor=Doctor::fetchAll();
        return view('user.home',compact('doctor'));
    }

    public function appointment(Request $req){
        $validated = $this->validationService->validateAppointment($req);

        Appointment::createForUser($validated, Auth::id());

        return redirect()->back()->with('message','Appointment Request Successful.Pay and we will contact with you soon...');
    }

    public function myappointment(){
        if(Auth::id()){
            $appointment=Appointment::forUser(Auth::id());
            return view('user.my_appointment',compact('appointment'));
        }

        return redirect()->back();
    }

    public function cancel_appoint($id) {
        if (!Auth::id()) {
            return redirect('/login');
        }

        Appointment::cancelForUserWithStatuses((int) $id, Auth::id(), ['In Progress', 'canceled']);

        return redirect()->back();
    }

    public function doctors(){
        $doctor=Doctor::fetchAll();
        return view('user.doctors',compact('doctor'));
    }

    public function patients(){
        $patient=Patient::fetchAll();
        return view('user.patients',compact('patient'));
    }

    public function pharmacy(){
        $medicine=Pharmacy::fetchAll();
        return view('user.pharmacy',['pharmacies'=>$medicine]);
    }

    public function mdetail($id){
        $medicine=Pharmacy::findById((int) $id);
        return view('user.mdetail',['medicine'=>$medicine]);
    }

    public function addTOCart(Request $req){
        if(Auth::id()){
            $validated = $this->validationService->validateCart($req);
            Cart::addForUser(Auth::id(), (int) $validated['product_id']);

            return redirect()->back();
        }

        return redirect('/login');
    }

    public static function cartItem(){
        if(Auth::id()){
            return Cart::countForUser(Auth::id());
        }

        return 0;
    }

    public function cartList(){
        if(Auth::id()){
            $products = Cart::productsForUser(Auth::id());
            return view('user.cartlist',['products'=>$products]);
        }
    }

    public function removeCart($id){
        Cart::destroy($id);
        return redirect('cartlist');
    }

    public function buyNow()
    {
        if(Auth::id()){
            $total = Cart::totalForUser(Auth::id());
            return view('user.buynow',['total'=>$total]);
        }
    }

    public function orderPlace(Request $req){
        if(Auth::id()){
            $validated = $this->validationService->validateOrderPlacement($req);
            $allcart = Cart::forUser(Auth::id());
            Order::createFromCarts($allcart, $validated);
        }

        return redirect('/');
    }

    public function myOrders(){
        if(Auth::id()){
            $orders = Order::productsForUser(Auth::id());
            return view('user.myorders',['orders'=>$orders]);
        }
    }

    public function removeOrder($id){
        Order::removeForUser((int) $id, Auth::id());

        return redirect('myorders');
    }

    public function ambulance(){
        return view('user.ambulance');
    }

    public function our(){
        $our = Our::paginateList(10);
        return view('user.ourhospital',compact('our'));
    }

    public function dhaka(){
        $dha = Dhaka::paginateList(10);
        return view('user.dhaka',compact('dha'));
    }

    public function cha(){
        $cha = Chittagong::paginateList(10);
        return view('user.cha',compact('cha'));
    }

    public function syl(){
        $syl = Sylhet::paginateList(10);
        return view('user.sylhet',compact('syl'));
    }

    public function mymens(){
        $mymen = Mymensingh::paginateList(10);
        return view('user.mymens',compact('mymen'));
    }

    public function rang(){
        $rang = Rangpur::paginateList(10);
        return view('user.rang',compact('rang'));
    }

    public function rajshahi(){
        $shahi = Rajshahi::paginateList(10);
        return view('user.rajshahi',compact('shahi'));
    }

    public function khulna(){
        $khul = Khulna::paginateList(10);
        return view('user.khulna',compact('khul'));
    }

    public function barishal(){
        $bari = Barishal::paginateList(10);
        return view('user.barishal',compact('bari'));
    }

    public function blood(){
        return view('user.blood');
    }

    public function userDonor(Request $req){
        Donor::createFromArray($req->all());
        return redirect()->back();
    }

    public function donor(){
        $donor = Donor::paginateList(12);
        return view('user.donorlist',compact('donor'));
    }

    public function bloodBank(){
        $bank = Bank::paginateList(12);
        return view('user.b_bank',compact('bank'));
    }

    public function plasmaDonor(Request $req){
        Plasma::createFromArray($req->all());
        return redirect()->back();
    }

    public function plasmadono(){
        $donor = Plasma::paginateList(12);
        return view('user.plasmadonor',compact('donor'));
    }

    public function sample(){
        return view('user.sample');
    }

    public function uploadSample(Request $req){
        Sample::createFromArray($req->all());
        return redirect()->back()->with('message','Request Successful.We will contact you within 30 minutes...');
    }

    public function org(){
        $org = Organisation::paginateList(10);
        return view('user.org',compact('org'));
    }

    public function consult(){
        $doctor = Doctor::fetchAll();
        return view('user.consult',compact('doctor'));
    }

    public function oxygen(){
        $oxygen = Oxygen::paginateList(10);
        return view('user.oxygen',compact('oxygen'));
    }

    public function icu(){
        $total = Icu::totalCount();

        return view('user.icu',compact('total'));
    }

    public function helplines(){
        $helplines = Helpline::fetchAll();
        return view('user.helplines',compact('helplines'));
    }

    public function icuform(Request $req){
        Icu::createFromArray($req->all());
        return redirect()->back()->with('message','Request Successfull,We will contact with you within 10 minutes');
    }

    public function payment($id){
        $doctors = Doctor::findById((int) $id);
        return view('user.payment',compact('doctors'));
    }

    public function uploadPayment(Request $req){
        Payment::createFromArray($req->all());
        return redirect()->back()->with('message','Payment Successfull');
    }

    public function search(Request $req){
        $doctor = Doctor::searchByName((string) $req->input('query'));

        return view('user.search',compact('doctor'));
    }

    public function prescription(){
        return view('user.prescription');
    }

    public function store(Request $req){
        $file=$req->file;
        $filename=time().'.'.$file->getClientOriginalExtension();
        $req->file->move('assets',$filename);

        Prescription::createFromArray([
            'name' => $req->name,
            'dname' => $req->dname,
            'age' => $req->age,
            'file' => $filename,
        ]);

        return redirect()->back()->with('message','Prescription Successfully Uploaded');
    }

    public function show(){
        $show = Prescription::fetchAll();
        return view('user.show',compact('show'));
    }

    public function download(Request $req,$file){
        return response()->download(public_path('assets/'.$file));
    }

    public function view($id){
        $view = Prescription::findById((int) $id);
        return view('user.view',compact('view'));
    }
}
