<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\DoctorController;


/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/


Route::get('/',[HomeController::class,'index']);
Route::get('/home',[HomeController::class,'redirect']);

Route::middleware(['auth:sanctum', 'verified'])->get('/dashboard', function () {
    return view('dashboard');
})->name('dashboard');

Route::post('/appointment',[HomeController::class,'appointment']);
Route::get('/myappointment',[HomeController::class,'myappointment']);
Route::get('/consult',[HomeController::class,'consult']);

Route::get('/doctors',[HomeController::class,'doctors']);
Route::get('/patients',[HomeController::class,'patients']);
Route::get('/pharmacy',[HomeController::class,'pharmacy']);
Route::get('mdetail/{id}',[HomeController::class,'mdetail']);
Route::post('/add_to_cart',[HomeController::class,'addToCart']);
Route::get('/cartlist',[HomeController::class,'cartList']);
Route::get('removecart/{id}',[HomeController::class,'removeCart']);
Route::get('/buynow',[HomeController::class,'buyNow']);
Route::post('/orderplace',[HomeController::class,'orderPlace']);
Route::get('/myorders',[HomeController::class,'myOrders']);
Route::get('removeorder/{id}',[HomeController::class,'removeOrder']);

Route::get('/ambulance',[HomeController::class,'ambulance']);
Route::get('/ourhospital',[HomeController::class,'our']);
Route::get('/dhaka',[HomeController::class,'dhaka']);
Route::get('/cha',[HomeController::class,'cha']);
Route::get('/sylhet',[HomeController::class,'syl']);
Route::get('/mymens',[HomeController::class,'mymens']);
Route::get('/rang',[HomeController::class,'rang']);
Route::get('/rajshahi',[HomeController::class,'rajshahi']);
Route::get('/khulna',[HomeController::class,'khulna']);
Route::get('/barishal',[HomeController::class,'barishal']);

Route::get('/blood',[HomeController::class,'blood']);
Route::post('/user_donor',[HomeController::class,'userDonor']);
Route::post('/plasma_donor',[HomeController::class,'plasmaDonor']);
Route::get('/plasmadonor',[HomeController::class,'plasmadono']);

Route::get('/donorlist',[HomeController::class,'donor']);
Route::get('/b_bank',[HomeController::class,'bloodBank']);

Route::get('/sample',[HomeController::class,'sample']);
Route::post('/upload_sample',[HomeController::class,'uploadSample']);

Route::get('/org',[HomeController::class,'org']);
Route::get('/oxygen',[HomeController::class,'oxygen']);

Route::get('/icu',[HomeController::class,'icu']);


Route::get('/helplines',[HomeController::class,'helplines']);

Route::post('/icuform',[HomeController::class,'icuform']);


Route::get('/payment/{id}',[HomeController::class,'payment']);

Route::post('/upload_payment',[HomeController::class,'uploadPayment']);


Route::get('/search',[HomeController::class,'search']);
Route::get('/prescription',[HomeController::class,'prescription']);
Route::post('/store',[HomeController::class,'store']);
Route::get('/show',[HomeController::class,'show']);
Route::get('/download/{file}',[HomeController::class,'download']);
Route::get('/view/{id}',[HomeController::class,'view']);







Route::get('/cancel_appoint/{id}',[HomeController::class,'cancel_appoint']);


Route::middleware(['auth:sanctum', 'verified', 'admin'])->group(function () {
Route::get('/add_doctor_view',[AdminController::class,'addDoctor']);
Route::post('/upload_doctor',[AdminController::class,'upload']);
Route::get('/showappointment',[AdminController::class,'showappointment']);
Route::get('/approved/{id}',[AdminController::class,'approved']);
Route::get('/canceled/{id}',[AdminController::class,'canceled']);
Route::get('/showdoctor',[AdminController::class,'showdoctor']);
Route::get('/deletedoctor/{id}',[AdminController::class,'deletedoctor']);
Route::get('/patient_list',[AdminController::class,'patientList']);
Route::get('/deletepatient/{id}',[AdminController::class,'deletepatient']);
Route::get('/updatepatient/{id}',[AdminController::class,'updatepatient']);
Route::get('/updatedoctor/{id}',[AdminController::class,'updatedoctor']);
Route::post('/editdoctor/{id}',[AdminController::class,'editdoctor']);
Route::get('/add_patient',[AdminController::class,'addPatient']);
Route::post('/upload_patient',[AdminController::class,'uploadPatient']);
Route::post('/editpatient/{id}',[AdminController::class,'editpatient']);
Route::get('/add_medicine',[AdminController::class,'addMedicine']);
Route::post('/upload_medicine',[AdminController::class,'uploadMedicine']);
Route::get('/medicine_list',[AdminController::class,'medicineList']);
Route::get('/deletemedicine/{id}',[AdminController::class,'deletemedicine']);
Route::get('/dhakam',[AdminController::class,'dhakam']);
Route::post('/upload_dhaka',[AdminController::class,'uploadDhaka']);
Route::get('/dhaka_list',[AdminController::class,'dhakaList']);
Route::get('/delete_dhaka/{id}',[AdminController::class,'deleteDhaka']);
Route::get('/update_dhaka/{id}',[AdminController::class,'updateDhaka']);
Route::post('/editdhaka/{id}',[AdminController::class,'editDhaka']);
Route::get('/cham',[AdminController::class,'cham']);
Route::post('/upload_cha',[AdminController::class,'uploadCha']);
Route::get('/cha_list',[AdminController::class,'chaList']);
Route::get('/delete_cha/{id}',[AdminController::class,'deleteCha']);
Route::get('/update_cha/{id}',[AdminController::class,'updateCha']);
Route::post('/editcha/{id}',[AdminController::class,'editCha']);
Route::get('/sylh',[AdminController::class,'sylh']);
Route::post('/upload_syl',[AdminController::class,'uploadSyl']);
Route::get('/syl_list',[AdminController::class,'sylList']);
Route::get('/delete_syl/{id}',[AdminController::class,'deleteSyl']);
Route::get('/update_syl/{id}',[AdminController::class,'updateSyl']);
Route::post('/editsyl/{id}',[AdminController::class,'editSyl']);
Route::get('/mymen',[AdminController::class,'mymen']);
Route::post('/upload_mymen',[AdminController::class,'uploadMymen']);
Route::get('/mymen_list',[AdminController::class,'mymenList']);
Route::get('/delete_mymen/{id}',[AdminController::class,'deleteMymen']);
Route::get('/update_mymen/{id}',[AdminController::class,'updateMymen']);
Route::post('/editmymen/{id}',[AdminController::class,'editMymen']);
Route::get('/rangp',[AdminController::class,'rangp']);
Route::post('/upload_rang',[AdminController::class,'uploadRang']);
Route::get('/rang_list',[AdminController::class,'rangList']);
Route::get('/delete_rang/{id}',[AdminController::class,'deleteRang']);
Route::get('/update_rang/{id}',[AdminController::class,'updateRang']);
Route::post('/editrang/{id}',[AdminController::class,'editRang']);
Route::get('/sahi',[AdminController::class,'sahi']);
Route::post('/upload_sahi',[AdminController::class,'uploadSahi']);
Route::get('/sahi_list',[AdminController::class,'sahiList']);
Route::get('/delete_sahi/{id}',[AdminController::class,'deleteSahi']);
Route::get('/update_sahi/{id}',[AdminController::class,'updateSahi']);
Route::post('/editsahi/{id}',[AdminController::class,'editSahi']);

Route::get('/khul',[AdminController::class,'khul']);
Route::post('/upload_khul',[AdminController::class,'uploadKhul']);
Route::get('/khul_list',[AdminController::class,'khulList']);
Route::get('/delete_khul/{id}',[AdminController::class,'deleteKhul']);
Route::get('/update_khul/{id}',[AdminController::class,'updateKhul']);
Route::post('/editkhul/{id}',[AdminController::class,'editKhul']);

Route::get('/bari',[AdminController::class,'bari']);
Route::post('/upload_bari',[AdminController::class,'uploadBari']);
Route::get('/bari_list',[AdminController::class,'bariList']);
Route::get('/delete_bari/{id}',[AdminController::class,'deleteBari']);
Route::get('/update_bari/{id}',[AdminController::class,'updateBari']);
Route::post('/editbari/{id}',[AdminController::class,'editBari']);

Route::get('/add_donor',[AdminController::class,'addDonor']);
Route::post('/upload_donor',[AdminController::class,'uploadDonor']);
Route::get('/donor_list',[AdminController::class,'donorList']);
Route::get('/delete_donors/{id}',[AdminController::class,'deleteDonors']);
Route::get('/update_donors/{id}',[AdminController::class,'updateDonors']);
Route::post('/editdonor/{id}',[AdminController::class,'editDonors']);

Route::get('/add_blood',[AdminController::class,'addBlood']);
Route::post('/upload_blood',[AdminController::class,'uploadBank']);
Route::get('/blood_list',[AdminController::class,'bloodList']);
Route::get('/delete_bank/{id}',[AdminController::class,'deleteBank']);
Route::get('/update_bank/{id}',[AdminController::class,'updateBank']);
Route::post('/editbank/{id}',[AdminController::class,'editBank']);

Route::get('/addplasma_donor',[AdminController::class,'plasmaDonor']);
Route::post('/uploadplasma_donor',[AdminController::class,'uploadplasmaDonor']);
Route::get('/plasmadonor_list',[AdminController::class,'plasmadonorList']);
Route::get('/deleteplasma_donors/{id}',[AdminController::class,'deleteplasmaDonors']);
Route::get('/updateplasma_donors/{id}',[AdminController::class,'updateplasmaDonors']);
Route::post('/editplasmadonor/{id}',[AdminController::class,'editplasmaDonors']);

Route::get('/add_org',[AdminController::class,'addOrg']);
Route::post('/upload_org',[AdminController::class,'uploadOrg']);
Route::get('/orglist',[AdminController::class,'orgList']);
Route::get('/delete_org/{id}',[AdminController::class,'deleteOrg']);
Route::get('/update_org/{id}',[AdminController::class,'updateOrg']);
Route::post('/editorg/{id}',[AdminController::class,'editOrg']);

Route::get('/add_oxygen',[AdminController::class,'addOxygen']);
Route::post('/upload_oxygen',[AdminController::class,'uploadOxygen']);
Route::get('/oxygenlist',[AdminController::class,'oxygenList']);
Route::get('/delete_oxygen/{id}',[AdminController::class,'deleteOxygen']);
Route::get('/update_oxygen/{id}',[AdminController::class,'updateOxygen']);
Route::post('/editoxygen/{id}',[AdminController::class,'editOxygen']);

Route::get('/add_helpline',[AdminController::class,'addHelpline']);
Route::post('/upload_help',[AdminController::class,'uploadHelp']);

Route::get('/add_admin',[AdminController::class,'addAdmin']);
Route::post('/upload_admin',[AdminController::class,'uploadAdmin']);
Route::get('/medicinepayment',[AdminController::class,'medicinePayment']);
Route::get('/drpayment',[AdminController::class,'drPayment']);
Route::get('/admin/sample',[AdminController::class,'sample']);
});



















Route::middleware(['auth:sanctum', 'verified', 'doctor'])->prefix('doctor')->group(function () {
Route::get('/showappointment',[DoctorController::class,'showappointment']);
Route::get('/approved/{id}',[DoctorController::class,'approved']);
Route::get('/canceled/{id}',[DoctorController::class,'canceled']);
Route::get('/deletedoctor/{id}',[DoctorController::class,'deletedoctor']);
Route::get('/updatedoctor/{id}',[DoctorController::class,'updatedoctor']);
Route::post('/editdoctor/{id}',[DoctorController::class,'editdoctor']);
Route::get('/showdoctor',[DoctorController::class,'showdoctor']);

Route::get('/add_appointment',[DoctorController::class,'addAppointment']);
Route::post('/upload_appointment',[DoctorController::class,'uploadAppoint']);
Route::get('/update/{id}',[DoctorController::class,'update']);
Route::post('/edit/{id}',[DoctorController::class,'edit']);

Route::get('/doctorpayment',[DoctorController::class,'doctorPayment']);
Route::get('/ddpayment/{id}',[DoctorController::class,'ddPayment']);
});
