<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Config;
use App\Models\User;
use Illuminate\Validation\Rule;
use Validator;
use App\Models\Job;
use App\Models\Market;
use Illuminate\Http\File;
use Illuminate\Support\Facades\Storage;
use App\Models\VehicleType;
use App\Models\Vehicle;
use App\Exports\ExportUser;
use App\Exports\ExportLoginUser;
use App\Models\Transaction;
use App\Models\Notification;
use App\Models\SaveCard;
use App\Models\FcmToken;
use Maatwebsite\Excel\Facades\Excel;
use PDF;
use DB;
use DataTables;
use Haruncpi\LaravelIdGenerator\IdGenerator;
use Illuminate\Support\Facades\Hash;
class UserController extends Controller
{
/**
* Display a listing of the resource.
*
* @return \Illuminate\Http\Response
*/
/*public function index(Request $request)
{

$users=User::where('role_id',Config::get('variables.User'))->withCount('booking')->orderBy('id','DESC')->get();

return view('user.index',compact('users'));
}*/


public function index(Request $request)
{

    if ($request->ajax()) { 

        $data = User::select('*')->where('role_id',Config::get('variables.User'))->withCount('booking')->orderBy('id','DESC');
        if (!empty($request->date_range[0])) {
            $date_range = $request->date_range; 
            $data->whereDate('created_at','>=',date('Y-m-d',strtotime($date_range[0])))
            ->whereDate('created_at','<=',date('Y-m-d',strtotime($date_range[1])));
        }

        $getData=$data->get();

        return Datatables::of($getData)
        ->addIndexColumn()

        ->addColumn('account_type', function($row){

          //  $btn =  $row->account_type=='1'? 'User Business':$row->account_type=='0'?'User Personal':'' ;
          //  $btn =  $row->account_type=='1'? 'Business':'' .''. $row->account_type=='0'? 'Personal':'' ;


            $account_type  ='Personal';
            if ($row->account_type=='1') {

                $account_type="Business";
                
            }

            return $account_type;
        })
        ->addColumn('created_at', function($row){

            $btn =  date('d/m/Y',strtotime($row->created_at)) ;

            return $btn;
        }) ->addColumn('status', function($row){

            $checked = $row->status==1?'checked':'';
            $status = $row->status==1?'0':'1';

            if(auth()->user()->can('edit_user'))
            {
                $btn = '<label class="switch">
                <input type="checkbox"  '.$checked.'  id="demo'.$row->id.'" onchange="updateStatus('.$row->id.','.$status.')" /  >
                <span class="slider round"></span>
                </label>' ;


                return $btn;

            }
            

            
        })
        ->addColumn('action', function($row){

            $btn1=$btn2=$btn3='';

            if(auth()->user()->can('view_user'))
            {
                $btn1=  '<a class="action-button" title="View" href='.route('users.show',$row->id).'><i class="text-info fa fa-eye"></i></a>';
            }
            if(auth()->user()->can('edit_user'))
            {
                $btn2=  '<a class="action-button" title="Edit" href='.route('users.edit',$row->id).'><i class="text-warning fa fa-edit"></i></a>';
            }
            if(auth()->user()->can('delete_user'))
            {
                $btn3=  '<a class="action-button delete-button "   id="'.$row->id.'"  onclick="userDelete('.$row->id.')" title="Delete" href="javascript:void(0)" data-id=""><i class="text-danger fa fa-trash-alt"></i></a>';
            }



            return $btn1.$btn2.$btn3;
        })
        ->rawColumns(['status','created_at','account_type', 'action'])
        ->make(true);
    }

    return view('user.index');
}

/**
* Show the form for creating a new resource.
*
* @return \Illuminate\Http\Response
*/
public function create()
{
    return view('user.create');
}

public function market()
{
    return view('user.market_create');
}



public function add(Request $request)
{    
    $unique_id = IdGenerator::generate([
                'table' => 'users',
                'field'=>'unique_ID', 
                'length' =>12, 
                'prefix'=>'USER-'
            ]);
    $referrere_id=NULL;
    if(!empty($request->referrer_code)){
        $referrere = User::where('referrer_code',$request->referrer_code)->first();
        if(!empty($referrere)){
            $referrere_id=$referrere->id;
        }else{
            $referrere_id=NULL;
        }
        
    }

    $data['unique_ID']=$unique_id;
    $data['profile_image']='storage/user_profile.jpg';
    $data['role_id']=Config::get('variables.User');
    $data['name']=$request->name;
    $data['email']=$request->email;
    $data['company_name']=$request->company_name;
    $data['phone_number']=$request->phone_number;
    $data['city']=$request->city;
    $data['country_code']='+966';
    $data['ip_address']=$_SERVER['REMOTE_ADDR'];
    $data['password']=Hash::make($request->password);
    $data['referrer_id']=$referrere_id;
    $data['commission']=$request->commission;
    $data['login_with']='email'; 
    $data['is_approve']=1;
    $data['created_by']='Admin';
    $data['is_email_verified']='1';
    $data['email_verified_at']=date('Y-m-d H:i:s');
    $data['created_at']=date('Y-m-d H:i:s');
    $data['updated_at']=date('Y-m-d H:i:s');
    

    User::insert($data);
    return redirect()->route('users.index')->with('success','User Added successfully');
}



public function addMarket(Request $request)
{
    echo storage_path('app');
    // Validate the incoming request
    $request->validate([
        'heading' => 'required|string',
        'text' => 'required|string',
        'image' => 'nullable|image', // Allow image uploads without size limitation
        'media' => 'nullable|file', // Allow video and image uploads without size limitation
    ]);
        
    $imagePath = null; // Initialize image path variable

    // Store the uploaded image if present
    if ($request->hasFile('image')) {
        $image = $request->file('image');
        $imagePath = 'storage/' . $image->store('market', 'public');
    }

     $mediaPath = null; // Initialize media path variable

    // Store the uploaded media file if present
    if ($request->hasFile('media')) {
        $media = $request->file('media');
        $mediaPath = 'storage/' . $media->store('market', 'public');
    }
    
    // Create a new Market instance
    $market = new Market();
    $market->heading = $request->heading;
    $market->text = $request->text;
    $market->image = $imagePath; // Save the image path to the database
    $market->media = $mediaPath; // Save the image path to the database
    $market->address = $request->address; // Save the image path to the database


    $market->created_at = now();
    $market->updated_at = now();

    // Save the Market instance to the database
    $market->save();

    // Redirect back with success message
    return redirect()->route('create-market')->with('success', 'Market added successfully');
}


 public function showMarket()
    {
        $markets = Market::all(); // Fetch all market data

        return view('user.show_market', compact('markets'));
    }



public function editMarket($id)
    {
        $market = Market::findOrFail($id);
        
        //dd($market);
        return view('user.edit_market', compact('market'));
    }

   public function updateMarket(Request $request, $id)
{
    // Validate the incoming request
    $request->validate([
        'heading' => 'required|string',
        'text' => 'required|string',
        'image' => 'nullable|image|mimes:jpeg,png,jpg,gif', // Updated validation for image upload
        'media' => 'nullable|file|mimes:mp4,mov,avi,wmv', // Updated validation for video upload
    ]);

    $market = Market::findOrFail($id);

    $imagePath = $market->image; // Preserve existing image path

    // Store the uploaded image if present
    if ($request->hasFile('image')) {
        $image = $request->file('image');
        $imagePath = 'storage/' . $image->store('Market', 'public');
    }

    $mediaPath = $market->media; // Preserve existing media path

    // Store the uploaded media file if present
    if ($request->hasFile('media')) {
        $media = $request->file('media');
        $mediaPath = 'storage/' . $media->store('Market', 'public');
    }

    // Update market information
    $market->heading = $request->heading;
    $market->text = $request->text;
    $market->image = $imagePath; // Save the image path to the database
    $market->media = $mediaPath; // Save the media path to the database
    $market->address = $request->address;

    // Save the updated market instance
    $market->save();

    // Redirect back with success message
    return redirect()->route('edit-market', $id)->with('success', 'Market updated successfully');
}

public function deleteMarket(Request $request, $id)
{
    $market = Market::findOrFail($id);
    $market->delete();

    return redirect()->route('show_market')->with('success', 'Market deleted successfully.');
}


/**
* Store a newly created resource in storage.
*
* @param  \Illuminate\Http\Request  $request
* @return \Illuminate\Http\Response
*/
public function store(Request $request)
{
//
}

/**
* Display the specified resource.
*
* @param  int  $id
* @return \Illuminate\Http\Response
*/
public function show($id)
{
    $user  =  User::where('id',$id)->where('role_id',Config::get('variables.User'))->first();

    $total_jobs        =  User:: withCount('totalJobs')->where('id',$id)->first();
    $current_jobs      =  User::withCount('currentJobs')->where('id',$id)->first();
    $upcomming_jobs    =  User::withCount('upcomingJobs')->where('id',$id)->first();
    $completed_jobs    =  User::withCount('completedJobs')->where('id',$id)->first();

    $transactions=Transaction::where('user_id',$id)->with('driver','user','booking','job')->get();
    $getsaveCard=SaveCard::where('user_id',$id)->get();
    $getnotification=Notification::where('receiver_id',$id)->paginate(10);





    return view('user.view',compact('current_jobs','total_jobs','user','upcomming_jobs','completed_jobs','transactions','getsaveCard','getnotification'));
}



/**
* Show the form for editing the specified resource.
*
* @param  int  $id
* @return \Illuminate\Http\Response
*/
public function edit($id)
{
    
    $user=User::where('id',$id)->where('role_id',Config::get('variables.User'))->first();
    return view('user.edit',compact('user'));
}

/**
* Update the specified resource in storage.
*
* @param  \Illuminate\Http\Request  $request
* @param  int  $id
* @return \Illuminate\Http\Response
*/
public function update(Request $request, $id)
{
    
    $user=User::find($id);
    $data                       =  $request->except(['_token','_method','full','confirm_password','password']);
    $data['password']           =  $request->password!=null?bcrypt($request->password):$user->password; 
    $data['country_code']       =  str_replace(str_replace(' ', '', $request->phone_number), '', $request->full);  


    if ($request->hasFile('profile_image')) {
        $image              = Storage::disk('public')->putFile('ProfileImage',$request->profile_image);
        $data['profile_image']      ='storage/'.$image;
    }


    User::where('id',$id)->update($data);
    return redirect()->route('users.index')->with('success','updated successfully');
}

/**
* Remove the specified resource from storage.
*
* @param  int  $id
* @return \Illuminate\Http\Response
*/
public function destroy($id)
{
    User::where('id',$id)->delete();
    return response()->json([
        'message'=>'Delete successfully',
        'success'=>1,

    ]);
}

public function emailCheck(Request $request){

    $validator= Validator::make($request->all(), [
        'email' => [
            'required',
            Rule::unique('users')->ignore($request->id),
        ],
    ]);
    if($validator->fails()) {
        return response()->json([
            'status' => 400,
            'message' => $validator->errors()->first()
        ]);
    }

}
public function phoneCheck(Request $request){

    $validator= Validator::make($request->all(), [
        'phone_number' => [
            'required',
            Rule::unique('users')->ignore($request->id),
        ],
    ]);
    if($validator->fails()) {

        return response()->json([
            'status' => 400,
            'message' => $validator->errors()->first()
        ]);

    }
}
public function jobShow($id){
    $jobs=Job::with('product','PickupRegion','PickupSubRegion','JobReceiver')->where('id',$id)->first();

    if($jobs){
        $vehicle_Type= VehicleType::whereIn('id',explode(',',$jobs->vehicle_type_id))->get();
    }else{
        $vehicle_Type=[];
    }

    return view('user.view_jobs',compact('jobs','vehicle_Type'));
}
public function jobDelete(Request $request){

    $job_delete = Job::where('id',$request->id)->delete();
    if($job_delete){
        return 1;
    }else{
        return 0;
    }

}

public function updateUserStatus(Request $request){

    User::where('id',$request->id)->update(['status'=>$request->status]);

    $user  = User::where('id',$request->id)->first();
  //  $user->token()->revoke();


    //FcmToken::where('tokenable_id',$request->id)->update(['token' =>'null']);

    return 1;
}

public function getUserdetails(Request $request){
 

    $user  = User::where('id',$request->id)->first(); 

    return $user;
}

public function getDriverList(Request $request){
 

    $getVehiclesDrivers  = Vehicle::where('license_plate',$request->license_plate)->first();
    // echo $getVehiclesDrivers->driver_id;
    $driver  = DB::table('users')->Where('id',$getVehiclesDrivers->driver_id)->first();
    // echo '<pre>'; print_r($driver); die;
    $data['driver_name']    = '<option value="'.$driver->id.'" selected>'.$driver->name.'</option>';
    $data['driver_phone_number']    = $driver->phone_number;
    return $data;
}

public function getVehicleList(Request $request){
 

    $getVehicles  = Vehicle::where('transporter_id',$request->id)->pluck('vehicle_type_id');
    $getDriverIds  = Vehicle::where('transporter_id',$request->id)->pluck('driver_id');
    $getdrivers   = User::select('id','name')->WhereIn('id',$getDriverIds)->get();  
    $getVehiclesTypes = VehicleType::WhereIn('id',$getVehicles)->get(); 
    $vehicleList='<option value="" selected disabled>Select</option>';
    
    if(!empty($getVehiclesTypes)){
        foreach($getVehiclesTypes as $getVehiclesType){

            if(!empty($getVehiclesType->length)){
            $vehicleList.='<option value="'.$getVehiclesType->id.'">'.$getVehiclesType->name.' ('.$getVehiclesType->max_load.' '.$getVehiclesType->max_load_unit.', '.$getVehiclesType->length.' '.$getVehiclesType->unit.')</option>';
            }else{
            $vehicleList.='<option value="'.$getVehiclesType->id.'">'.$getVehiclesType->name.' ('.$getVehiclesType->max_load.' '.$getVehiclesType->max_load_unit.')</option>'; 
            }
        }
    } 
    
    $data['vehicleList']=$vehicleList;
    // $json['result'][]=json_encode($data);
    // echo '<pre>'; print_r($data); die;
    return $data;
}

public function getVehicleNumber(Request $request){

    $getVehiclesNumbers  = Vehicle::where('transporter_id',$request->transporter_id)->where('vehicle_type_id',$request->vehicle_type_id)->get();

    $getDriverIds  = Vehicle::where('transporter_id',$request->id)->where('vehicle_type_id',$request->vehicle_type_id)->pluck('driver_id');
    $getdrivers   = User::select('id','name')->WhereIn('id',$getDriverIds)->get(); 


    $vehicleNumberList='<option value="" selected disabled>select</option>';
    $driverList='<option value="" selected disabled>Select</option>';
    if(!empty($getVehiclesNumbers)){
        foreach($getVehiclesNumbers as $getVehiclesNumber){
            $vehicleNumberList.='<option value="'.$getVehiclesNumber->license_plate.'">'.$getVehiclesNumber->license_plate.'</option>';
        }
    }

    if(!empty($getdrivers)){
        foreach($getdrivers as $getdriver){

             
            $driverList.='<option value="'.$getdriver->id.'">'.$getdriver->name.'</option>'; 
            
        }
    } 
    
    $data['vehicleNumberList']=$vehicleNumberList;
    $data['driverList']=$driverList;
    return $data;
}






public function filetrUser(Request $request){
    $date_range = $request->date_range;
    $page   =   $request->current;
    $limit  =   $request->limit;
    $offset =   ($limit * $page) -  $limit;
    if($request->type=='user'){
        $users  = User::where('role_id',Config::get('variables.User'))->whereDate('created_at','>=',date('Y-m-d',strtotime($date_range[0])))->whereDate('created_at','<=',date('Y-m-d',strtotime($date_range[1])))->take($limit)->skip($offset)->get();
    }else{
        $users  = User::where('role_id',Config::get('variables.Transporter'))->whereDate('created_at','>=',date('Y-m-d',strtotime($date_range[0])))->whereDate('created_at','<=',date('Y-m-d',strtotime($date_range[1])))->take($limit)->skip($offset)->get();
    }
    $result_view = view('user.partial',['users'=>$users])->render();
    return json_encode(['html'=> $result_view,'status'=>true]);
}

public function resetUser(Request $request){
    $page   =   $request->current;
    $limit  =   $request->limit;
    $offset =   ($limit * $page) -  $limit;
    if($request->type=='user'){
        $users          =   User::where('role_id',Config::get('variables.User'))->take($limit)->skip($offset)->get();
    }else{
        $users          =   User::where('role_id',Config::get('variables.Transporter'))->take($limit)->skip($offset)->get();
    }

    $result_view    =   view('user.partial',['users'=>$users])->render();
    return json_encode(['html'=> $result_view,'status'=>true]);

}
public function exportUser(Request $request,$type){
     
    $search     =        $request->search?$request->search:null;
    $date       =        $request->date_range?explode('-',$request->date_range):null;


    return Excel::download(new ExportUser($search,$date,$type), 'users.xlsx');
}
public function exportLoginUser(Request $request){
     
    return Excel::download(new ExportLoginUser(), 'login-users.xlsx');
}
public function csvUser(Request $request,$type){

    $search     =        $request->search?$request->search:null;
    $date       =        $request->date_range?explode('-',$request->date_range):null;
    return (new ExportUser($search,$date,$type))->download('users.csv', \Maatwebsite\Excel\Excel::CSV, ['Content-Type' => 'text/csv']);
}

public function pdfUser(Request $request,$type){

    $search     =        $request->search?$request->search:null;
    $date       =        $request->date_range?explode('-',$request->date_range):null;

    $users=new User;
    if(!empty($date)){
        $users = $users->where('created_at','>=',date('Y-m-d',strtotime($date[0])))->where('created_at','<=',date('Y-m-d',strtotime($date[1])));
    }
    if($type=='user'){
        $users = $users->where('role_id',Config::get('variables.User'));
    }
    if($type=='transporter'){
        $users = $users->where('role_id',Config::get('variables.Transporter'));
    }
    if($search!='on'){

        $users= $users->where(function($q) use($search){
            $q->where('name','like', '%' . $search.'%');
            $q->orWhere('email','like', '%' . $search.'%');
            $q->orWhere('unique_ID','like', '%' . $search.'%');
            $q->orWhere('account_type','like', '%' . $search.'%');

        });
    }
    $users=$users->get();
    $data = [
        'users'=>$users,
    ];
    $pdf        = PDF::loadView('pdf.user', $data);
    return $pdf->download('user.pdf');

}

}
