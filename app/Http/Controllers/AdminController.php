<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

use App\Models\Doctor;
use App\Models\Appointment;
use App\Models\Patient;
use App\Models\Pharmacy;
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
use App\Models\Bank;
use App\Models\Plasma;
use App\Models\Organisation;
use App\Models\Oxygen;
use App\Models\Helpline;
use App\Models\Order;
use App\Models\Payment;
use App\Models\Sample;
use Illuminate\Support\Facades\Hash;


class AdminController extends Controller
{
    public function addDoctor(){
        return view('admin.add_doctor');
    }
    public function upload(Request $req){
   $doctor=new Doctor;

    //$file->file=$req->file('image')->getClientOriginalExtension();
    $doctor->name=$req->name;
    $doctor->email=$req->email;
    $doctor->phone=$req->phone;
    $doctor->speciality=$req->speciality;
    $doctor->room=$req->room;

   if($req->hasfile('image')){
        $file=$req->file('image');
        $extension=$file->getClientOriginalExtension();
        $filename= time().'.'.$extension;
        $file->move('doctor',$filename);
        $doctor->image=$filename;
    }
    $doctor->time=$req->time;
    $doctor->fee=$req->fee;
    $doctor->save();
    return redirect()->back()->with('message','Doctor Added Successfully');
    }
    public function showappointment(){
        $data=Appointment::all();
        return view('admin.showappointment',compact('data'));
    }
    public function approved($id){
        $data=Appointment::find($id);
        $data->status='approved';
        $data->save();
        return redirect()->back();
    }
    public function canceled($id) {
        $data=Appointment::find($id);
        $data->status='canceled';
        $data->save();
        return redirect()->back();
    }
    public function showdoctor(){
        $data=Doctor::all();
        return view('admin.showdoctor',compact('data'));
    }
    public function deletedoctor($id){
        $data= Doctor::find($id);
        $data->delete();
        return redirect()->back();
    }
    public function updatedoctor($id)
    {
        $data= Doctor::find($id);
        return view('admin.update_doctor',compact('data'));
    }
    public function editdoctor(Request $req ,$id){
        $doctor= Doctor::find($id);
        $doctor->name=$req->name;
        $doctor->email=$req->email;
        $doctor->phone=$req->phone;
        $doctor->speciality=$req->speciality;
        $doctor->room=$req->room;
        if($req->hasfile('image')){
            $file=$req->file('image');
            $extension=$file->getClientOriginalExtension();
            $filename= time().'.'.$extension;
            $file->move('doctor',$filename);
            $doctor->image=$filename;
        }
        $doctor->time=$req->time;
        $doctor->save();
        return redirect()->back();

    }
    function addPatient(){
        return view('admin.add_patient');
    }
    public function uploadPatient(Request $req){
        $patient=new Patient;
        $patient->name=$req->name;
        $patient->email=$req->email;
        $patient->phone=$req->phone;
        $patient->blood=$req->blood;
        $patient->gender=$req->gender;
        $patient->dob=$req->dob;
        
        if($req->hasfile('image')){
            $file=$req->file('image');
            $extension=$file->getClientOriginalExtension();
            $filename= time().'.'.$extension;
            $file->move('patient',$filename);
            $patient->image=$filename;
        }
        $patient->address=$req->address;
        $patient->save();
        return redirect()->back()->with('message','Patient Added Successfully');


    }
    public function patientList(){
        $data=Patient::all();
        return view('admin.patient_list',compact('data'));
    }
    public function deletepatient($id){
        $data= Patient::find($id);
        $data->delete();
        return redirect()->back();
    }
    public function updatepatient($id)
    {
        $data= Patient::find($id);
        return view('admin.update_patient',compact('data'));
    }
    public function editpatient(Request $req ,$id){
        $patient= Patient::find($id);
        $patient->name=$req->name;
        $patient->email=$req->email;
        $patient->phone=$req->phone;
        $patient->blood=$req->blood;
        $patient->gender=$req->gender;
        $patient->dob=$req->dob;
        if($req->hasfile('image')){
            $file=$req->file('image');
            $extension=$file->getClientOriginalExtension();
            $filename= time().'.'.$extension;
            $file->move('patient',$filename);
            $patient->image=$filename;
        }
        $patient->address=$req->address;
        $patient->save();
        return redirect()->back();

    }
    public function addMedicine(){
        return view('admin.add_medicine');
    }
    public function uploadMedicine(Request $req){
        $medicine=new Pharmacy;
        $medicine->name=$req->name;
        $medicine->cname=$req->cname;
        $medicine->description=$req->description;
        $medicine->price=$req->price;
        $medicine->mname=$req->mname;
        if($req->hasfile('image')){
            $file=$req->file('image');
            $extension=$file->getClientOriginalExtension();
            $filename= time().'.'.$extension;
            $file->move('medicine',$filename);
            $medicine->image=$filename;
        }
        $medicine->save();
        return redirect()->back();



    }
    function medicineList(){
        $data=Pharmacy::all();
        return view('admin.medicine_list',compact('data'));

    }
    public function deletemedicine($id){
        $data= Pharmacy::find($id);
        $data->delete();
        return redirect()->back();
    }
    function ourhospital(){
        return view('admin.ours');
    }
    function uploadour(Request $req){
        $ours= new Our;
        $ours->name=$req->name;
        $ours->address=$req->address;
        $ours->phone=$req->phone;
        $ours->save();
        return redirect()->back()->with('message','Ambulance Added Successfully');
    }
    function ourList(){
        $dhaka=Dhaka::all();
     return view('admin.dhaka_list',compact('dhaka'));
    }
    function deleteOur($id){
        $dhaka= Dhaka::find($id);
        $dhaka->delete();
        return redirect()->back();
    }
    function updateOur($id){
        $dhaka=Dhaka::find($id);
        return view('admin.update_dhaka',compact('dhaka'));
     
    }
    function editOur(Request $req,$id){
        $dhaka=Dhaka::find($id);
        $dhaka->name=$req->name;
        $dhaka->address=$req->address;
        $dhaka->phone=$req->phone;
        $dhaka->save();
        return redirect()->back();
    }



    function dhakam(){
        return view('admin.dhakam');
    }
    function uploadDhaka(Request $req){
        $dhaka= new Dhaka;
        $dhaka->name=$req->name;
        $dhaka->address=$req->address;
        $dhaka->phone=$req->phone;
        $dhaka->save();
        return redirect()->back()->with('message','Ambulance Added Successfully');
    }
    function dhakaList(){
        $dhaka=Dhaka::all();
     return view('admin.dhaka_list',compact('dhaka'));
    }
    function deleteDhaka($id){
        $dhaka= Dhaka::find($id);
        $dhaka->delete();
        return redirect()->back();
    }
    function updateDhaka($id){
        $dhaka=Dhaka::find($id);
        return view('admin.update_dhaka',compact('dhaka'));
     
    }
    function editDhaka(Request $req,$id){
        $dhaka=Dhaka::find($id);
        $dhaka->name=$req->name;
        $dhaka->address=$req->address;
        $dhaka->phone=$req->phone;
        $dhaka->save();
        return redirect()->back();
    }
    function cham(){
        return view('admin.cham');
    }
    function uploadCha(Request $req){
        $cha= new Chittagong;
        $cha->name=$req->name;
        $cha->address=$req->address;
        $cha->phone=$req->phone;
        $cha->save();
        return redirect()->back()->with('message','Ambulance Added Successfully');
    }
    function chaList(){
        $cha=Chittagong::all();
     return view('admin.cha_list',compact('cha'));
    }
    function deleteCha($id){
        $cha= Chittagong::find($id);
        $cha->delete();
        return redirect()->back();
    }
    function updateCha($id){
        $cha=Chittagong::find($id);
        return view('admin.update_cha',compact('cha'));
      
    }
    function editCha(Request $req,$id){
        $cha=Chittagong::find($id);
        $cha->name=$req->name;
        $cha->address=$req->address;
        $cha->phone=$req->phone;
        $cha->save();
        return redirect()->back();
    }
    function sylh(){
        return view('admin.sylh');
    }
    function uploadSyl(Request $req){
        $syl= new Sylhet;
        $syl->name=$req->name;
        $syl->address=$req->address;
        $syl->phone=$req->phone;
        $syl->save();
        return redirect()->back()->with('message','Ambulance Added Successfully');
    }
    function sylList(){
        $syl=Sylhet::all();
     return view('admin.syl_list',compact('syl'));
    }
    function deleteSyl($id){
        $syl= Sylhet::find($id);
        $syl->delete();
        return redirect()->back();
    }
    function updateSyl($id){
        $syl=Sylhet::find($id);
        return view('admin.update_syl',compact('syl'));
      
    }
    function editSyl(Request $req,$id){
        $syl=Sylhet::find($id);
        $syl->name=$req->name;
        $syl->address=$req->address;
        $syl->phone=$req->phone;
        $syl->save();
        return redirect()->back();
    }
    function mymen(){
        return view('admin.mymen');
    }
    function uploadMymen(Request $req){
        $mymen= new Mymensingh;
        $mymen->name=$req->name;
        $mymen->address=$req->address;
        $mymen->phone=$req->phone;
        $mymen->save();
        return redirect()->back()->with('message','Ambulance Added Successfully');
    }
    function mymenList(){
        $mymen=Mymensingh::all();
     return view('admin.mymen_list',compact('mymen'));
    }
    function deleteMymen($id){
        $mymen= Mymensingh::find($id);
        $mymen->delete();
        return redirect()->back();
    }
    function updateMymen($id){
        $mymen=Mymensingh::find($id);
        return view('admin.update_mymen',compact('mymen'));
      
    }
    function editMymen(Request $req,$id){
        $mymen=Mymensingh::find($id);
        $mymen->name=$req->name;
        $mymen->address=$req->address;
        $mymen->phone=$req->phone;
        $mymen->save();
        return redirect()->back();
    }
    function rangp(){
        return view('admin.rangp');
    }
    function uploadRang(Request $req){
        $rang= new Rangpur;
        $rang->name=$req->name;
        $rang->address=$req->address;
        $rang->phone=$req->phone;
        $rang->save();
        return redirect()->back()->with('message','Ambulance Added Successfully');
    }
    function rangList(){
        $rang=Rangpur::all();
     return view('admin.rang_list',compact('rang'));
    }
    function deleteRang($id){
        $rang= Rangpur::find($id);
        $rang->delete();
        return redirect()->back();
    }
    function updateRang($id){
        $rang=Rangpur::find($id);
        return view('admin.update_rang',compact('rang'));
      
    }
    function editRang(Request $req,$id){
        $rang=Rangpur::find($id);
        $rang->name=$req->name;
        $rang->address=$req->address;
        $rang->phone=$req->phone;
        $rang->save();
        return redirect()->back();
    }

    function sahi(){
        return view('admin.sahi');
    }
    function uploadSahi(Request $req){
        $sahi= new Rajshahi;
        $sahi->name=$req->name;
        $sahi->address=$req->address;
        $sahi->phone=$req->phone;
        $sahi->save();
        return redirect()->back()->with('message','Ambulance Added Successfully');
    }
  function sahiList(){
        $sahi=Rajshahi::all();
     return view('admin.sahi_list',compact('sahi'));
    }
    function deleteSahi($id){
        $sahi= Rajshahi::find($id);
        $sahi->delete();
        return redirect()->back();
    }
    function updateSahi($id){
        $sahi=Rajshahi::find($id);
        return view('admin.update_sahi',compact('sahi'));
      
    }
    function editSahi(Request $req,$id){
        $sahi=Rajshahi::find($id);
        $sahi->name=$req->name;
        $sahi->address=$req->address;
        $sahi->phone=$req->phone;
        $sahi->save();
        return redirect()->back();
    }

    function khul(){
        return view('admin.khul');
    }
    function uploadKhul(Request $req){
        $khul= new Khulna;
        $khul->name=$req->name;
        $khul->address=$req->address;
        $khul->phone=$req->phone;
        $khul->save();
        return redirect()->back()->with('message','Ambulance Added Successfully');
    }
  function khulList(){
        $khul=Khulna::all();
     return view('admin.khul_list',compact('khul'));
    }
    function deleteKhul($id){
        $khul= Khulna::find($id);
        $khul->delete();
        return redirect()->back();
    }
    function updateKhul($id){
        $khul=Khulna::find($id);
        return view('admin.update_khul',compact('khul'));
      
    }
    function editKhul(Request $req,$id){
        $khul=Khulna::find($id);
        $khul->name=$req->name;
        $khul->address=$req->address;
        $khul->phone=$req->phone;
        $khul->save();
        return redirect()->back();
    }

    function bari(){
        return view('admin.bari');
    }
    function uploadBari(Request $req){
        $bari= new Barishal;
        $bari->name=$req->name;
        $bari->address=$req->address;
        $bari->phone=$req->phone;
        $bari->save();
        return redirect()->back()->with('message','Ambulance Added Successfully');
    }
  function bariList(){
        $bari=Barishal::all();
     return view('admin.bari_list',compact('bari'));
    }
    function deleteBari($id){
        $bari= Barishal::find($id);
        $bari->delete();
        return redirect()->back();
    }
    function updateBari($id){
        $bari=Barishal::find($id);
        return view('admin.update_bari',compact('bari'));
      
    }
    function editBari(Request $req,$id){
        $bari=Barishal::find($id);
        $bari->name=$req->name;
        $bari->address=$req->address;
        $bari->phone=$req->phone;
        $bari->save();
        return redirect()->back();
    }
    function addDonor(){
        return view('admin.add_donor');
    }
    function uploadDonor(Request $req){
        $donor=new Donor;
        $donor->name=$req->name;
        $donor->blood=$req->blood;
        $donor->address=$req->address;
        $donor->phone=$req->phone;
        $donor->save();
        return redirect()->back()->with('message','Donor Added Successfully');
        
    }
    function donorList(){
        $donors=Donor::all();
     return view('admin.donor_list',compact('donors'));
    }
    function deleteDonors($id){
        $donors= Donor::find($id);
        $donors->delete();
        return redirect()->back();
    }
    function updateDonors($id){
        $donors=Donor::find($id);
        return view('admin.update_donors',compact('donors'));
      
    }
    function editDonors(Request $req,$id){
        $donors=Donor::find($id);
        $donors->name=$req->name;
        $donors->blood=$req->blood;
        $donors->address=$req->address;
        $donors->phone=$req->phone;
        $donors->save();
        return redirect()->back();
    }
    public function addBlood(){
        return view('admin.add_blood');
    }

    function uploadBank(Request $req){
        $bank=new Bank;
        $bank->name=$req->name;
        $bank->address=$req->address;
        $bank->phone=$req->phone;
        $bank->save();
        return redirect()->back()->with('message','Blood Bank Added Successfully');
        
    }
    function bloodList(){
        $bank=Bank::all();
        return view('admin.blood_list',compact('bank'));
    }
    function deleteBank($id){
        $bank= Bank::find($id);
        $bank->delete();
        return redirect()->back();
    }
    function updateBank($id){
        $bank=Bank::find($id);
        return view('admin.update_bank',compact('bank'));
      
    }
    function editBank(Request $req,$id){
        $bank=Bank::find($id);
        $bank->name=$req->name;
      
        $bank->address=$req->address;
        $bank->phone=$req->phone;
        $bank->save();
        return redirect()->back();
    }
    function plasmaDonor(){
        return view('admin.addplasma_donor');
    }
    function uploadplasmaDonor(Request $req){
        $donor=new Plasma;
        $donor->name=$req->name;
        $donor->blood=$req->blood;
        $donor->address=$req->address;
        $donor->phone=$req->phone;
        $donor->save();
        return redirect()->back()->with('message','Donor Added Successfully');
        
    }
    function plasmadonorList(){
        $donors=Plasma::all();
     return view('admin.plasmadonor_list',compact('donors'));
    }
    function deleteplasmaDonors($id){
        $donors= Plasma::find($id);
        $donors->delete();
        return redirect()->back();
    }
    function updateplasmaDonors($id){
        $donors=Plasma::find($id);
        return view('admin.updateplasma_donors',compact('donors'));
      
    }
    function editplasmaDonors(Request $req,$id){
        $donors=Plasma::find($id);
        $donors->name=$req->name;
        $donors->blood=$req->blood;
        $donors->address=$req->address;
        $donors->phone=$req->phone;
        $donors->save();
        return redirect()->back();
    }


    function addOrg(){
        return view('admin.add_org');
    }
    function uploadOrg(Request $req){
        $org=new Organisation;
        $org->name=$req->name;
        $org->type=$req->type;
        $org->address=$req->address;
        $org->phone=$req->phone;
        $org->webaddress=$req->webaddress;
        $org->save();
        return redirect()->back()->with('message','Org Added Successfully');
    }
    function orgList(){
        $org=Organisation::all();
        return view('admin.orglist',compact('org'));
    }
    function deleteOrg($id){
        $org=Organisation::find($id);
        $org->delete();
        return redirect()->back();
    }
    function updateOrg($id){
        $org=Organisation::find($id);
        return view('admin.update_org',compact('org'));
    }
    function editOrg(Request $req,$id){
        $org=Organisation::find($id);
        $org->name=$req->name;
        $org->type=$req->type;
        $org->address=$req->address;
        $org->phone=$req->phone;
        $org->webaddress=$req->webaddress;
        $org->save();
        return redirect('orglist');
    }
    function addOxygen(){
        return view('admin.add_oxygen');
    }
    function uploadOxygen(Request $req){
        $oxygen=new Oxygen;
        $oxygen->name=$req->name;
        $oxygen->types=$req->types;
        $oxygen->address=$req->address;
        $oxygen->phone=$req->phone;
        $oxygen->source=$req->source;
        $oxygen->save();
        return redirect()->back()->with('message','Oxygen Added Successfully');
    }
    function oxygenList(){
        $oxygen=Oxygen::all();
        return view('admin.oxygenlist',compact('oxygen'));
    }
    function deleteOxygen($id){
        $oxygen=Oxygen::find($id);
        $oxygen->delete();
        return redirect()->back();
    }
    function updateOxygen($id){
        $oxygen=Oxygen::find($id);
        return view('admin.update_oxygen',compact('oxygen'));
    }
    function editOxygen(Request $req,$id){
        $oxygen=Oxygen::find($id);
        $oxygen->name=$req->name;
        $oxygen->types=$req->types;
        $oxygen->address=$req->address;
        $oxygen->phone=$req->phone;
        $oxygen->source=$req->source;
        $oxygen->save();
        return redirect('oxygenlist');
    }
    function addHelpline(){
        return view('admin.add_helpline');
    }
    function uploadHelp(Request $req){
        $help=new Helpline;
        $help->number=$req->number;
        $help->for_help=$req->for_help;
        $help->save();
        return redirect()->back()->with('message','Add helpline Successfully');

    }
    function addAdmin(){
        return view('admin.add_admin');
    }
    function uploadAdmin(Request $req){
        $admin=new User;
        $admin->name=$req->name;
        $admin->email=$req->email;
        $admin->phone=$req->phone;
        $admin->address=$req->address;
        $admin->usertype=$req->usertype;
        $admin->password=Hash::make($req->password);
        $admin->save();
        return redirect()->back()->with('message','Admin added Successfully');
    }
    function medicinePayment(){
        $medicinepayment=Order::all();
        return view('admin.medicinepayment',compact('medicinepayment'));
    }
    function drPayment(){
        $drpayment=Payment::all();
        return view('admin.drpayment',compact('drpayment'));
    }
    function sample(){
        $sample= Sample::all();
        return view('admin.sample',compact('sample'));
    }
}
