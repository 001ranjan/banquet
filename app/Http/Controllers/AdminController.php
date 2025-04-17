<?php

namespace App\Http\Controllers;

use DB;
use Auth;
use Hash;
use Session;
use App\Models\User;
use App\Models\Role;
use App\Models\Room;
use App\Models\Order;
use App\Models\Season;
use App\Models\Setting;
use App\Models\Product;
use App\Models\Expense;
use App\Models\FoodItem;
use App\Models\RoomType;
use App\Models\Customer;
use App\Models\MediaFile;
use App\Models\Amenities;
use App\Models\RoomPrice;
use App\Models\OrderItem;
use App\Models\Permission;
use App\Models\PersonList;
use App\Models\BookedRoom;
use App\Models\Reservation;
use Illuminate\Http\Request;
use App\Models\FoodCategory;
use App\Models\StockHistory;
use App\Models\OrderHistory;
use App\Models\PaymentHistory;
use App\Models\DynamicDropdown;
use App\Models\ExpenseCategory;
use App\Models\SpecialFoodItem;
use Barryvdh\DomPDF\Facade\Pdf;
use App\Models\SpecialFoodRemark;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;
use App\Http\Requests\ExpenseCategoryRequest;
use App\Models\Menu;

class AdminController extends Controller
{
    private $paginate = 10;
    private $core;
    public $data = [];

    public function __construct()
    {
        $this->core = app(\App\Http\Controllers\CoreController::class);
        $this->middleware('auth');
    }

    public function index() {  
        $this->data['counts'] = DB::select(DB::raw("SELECT             
            (SELECT COUNT(*) FROM users WHERE status = 1) as user_count,
            (SELECT COUNT(*) FROM orders WHERE DATE(`created_at`) = CURDATE()) as today_orders,
            (SELECT COUNT(*) FROM reservations WHERE DATE(`check_in`) = CURDATE()) as today_check_ins,
            (SELECT COUNT(*) FROM reservations WHERE DATE(`check_out`) = CURDATE()) as today_check_outs"
        ));
        $this->data['products'] = Product::whereStatus(1)->whereIsDeleted(0)->orderBy('stock_qty','ASC')->paginate(50);
        $orderIds = OrderHistory::where('is_book',1)->orderBy('id','DESC')->pluck('order_id');
        $this->data['orders'] = Order::with('last_order_history')->whereIn('id',$orderIds)->orderBy('created_at','DESC')->get();

        $dateRange = ['checkin_date'=>date('Y-m-01'), 'checkout_date'=>date('Y-m-t')];
        $this->getRoomList();
        return view('backend/dashboard',$this->data);
    }

    /* ***** Start User Functions ***** */
    public function editLoggedUserProfile(Request $request){
        $this->data['data_row']=User::whereId(Auth::user()->id)->first();
        return view('backend/users/logged_user_profile',$this->data);
    }

    public function saveProfile(Request $request) {
        if($this->core->checkWebPortal()==0 && in_array(Auth::user()->id, [1,2,3])){
            return redirect()->back()->with(['info' => config('constants.FLASH_NOT_ALLOW_FOR_DEMO')]);
        } 
        if($request->form_type == 'updatePassword'){
            $request->merge(['password'=>Hash::make($request->new_password)]);
        }
        
        $res = User::updateOrCreate(['id'=>Auth::user()->id],$request->except(['_token','new_password','conf_password','email']));
        if($res){
            return redirect()->back()->with(['success' => config('constants.FLASH_REC_UPDATE_1')]);
        }
        return redirect()->back()->with(['error' => config('constants.FLASH_REC_UPDATE_0')]);
    }

    public function addUser() {
        $this->data['roles']=$this->getRoleList();
        return view('backend/users/user_add_edit',$this->data);
    }

    public function editUser(Request $request){
        $this->data['roles']=$this->getRoleList();
        $this->data['data_row']=User::whereId($request->id)->first();
        if(!$this->data['data_row']){
            return redirect()->back()->with(['error' => config('constants.FLASH_REC_NOT_FOUND')]);
        }
        return view('backend/users/user_add_edit',$this->data);
    }

    public function saveUser(Request $request) {
        if($request->id>0){
            if($this->core->checkWebPortal()==0){
                return redirect()->back()->with(['info' => config('constants.FLASH_NOT_ALLOW_FOR_DEMO')]);
            }  
            $success = config('constants.FLASH_REC_UPDATE_1');
            $error = config('constants.FLASH_REC_UPDATE_0');
        } else {
            $success = config('constants.FLASH_REC_ADD_1');
            $error = config('constants.FLASH_REC_ADD_0');
        }
        if($request->new_password){
            $request->merge(['password'=>Hash::make($request->new_password)]);
        }
        $res = User::updateOrCreate(['id'=>$request->id],$request->except(['_token','new_password','conf_password']));
        if($res){
            return redirect()->route('list-user')->with(['success' => $success]);
        }
        return redirect()->back()->with(['error' => $error]);
    }

    public function listUser() {
         $this->data['datalist']=User::where('is_deleted', 0)->orderBy('name','ASC')->get();
        return view('backend/users/user_list',$this->data);
    }

    public function deleteUser(Request $request) {
        if($this->core->checkWebPortal()==0){
            return redirect()->back()->with(['info' => config('constants.FLASH_NOT_ALLOW_FOR_DEMO')]);
        }  
        if(User::whereId($request->id)->update(['is_deleted'=>1, 'status'=>0])){
            return redirect()->back()->with(['success' => config('constants.FLASH_REC_DELETE_1')]);
        }
        return redirect()->back()->with(['error' => config('constants.FLASH_REC_DELETE_0')]);
    }
    /* ***** End User Functions ***** */

    /* ***** Start Room Functions ***** */
    public function addRoom() {
        $this->data['roomtypes_list'] = getRoomTypesList();
        return view('backend/rooms/room_add_edit',$this->data);
    }

    public function editRoom(Request $request){
        $this->data['roomtypes_list'] = getRoomTypesList();
        $this->data['data_row'] = Room::whereId($request->id)->first();
        if(!$this->data['data_row']){
            return redirect()->back()->with(['error' => config('constants.FLASH_REC_NOT_FOUND')]);
        }
        return view('backend/rooms/room_add_edit',$this->data);
    }

    public function saveRoom(Request $request) {
        if($request->id>0){
            if($this->core->checkWebPortal()==0){
                return redirect()->back()->with(['info' => config('constants.FLASH_NOT_ALLOW_FOR_DEMO')]);
            }  
            $success = config('constants.FLASH_REC_UPDATE_1');
            $error = config('constants.FLASH_REC_UPDATE_0');
        } else {
            $success = config('constants.FLASH_REC_ADD_1');
            $error = config('constants.FLASH_REC_ADD_0');
        }

        // $res = Room::updateOrCreate(['id' => $request->id],$request->except(['_token','amenities_ids']));  \\Older
        $res = Room::updateOrCreate(['id' => $request->id],$request->except(['_token']));
        
        if($res){
            $mediaData = [
                'tbl_id' => $res->id,
                'media_ids' => $request->media_ids,
                'files' => ($request->hasFile('room_images')) ? $request->room_images : null,
                'folder_path' => 'uploads/room_images',
                'type' => 'room_image',
            ];           
            $this->core->uploadAndUnlinkMediaFile($mediaData);

            return redirect()->back()->with(['success' => $success]);
        }
        return redirect()->back()->with(['error' => $error]);
    }

    public function listRoom() {
        $this->data['datalist'] = Room::whereStatus(1)->whereIsDeleted(0)->orderBy('order_num','ASC')->get();
        return view('backend/rooms/room_list',$this->data);
    }

    public function deleteRoom(Request $request) {
        if($this->core->checkWebPortal()==0){
            return redirect()->back()->with(['info' => config('constants.FLASH_NOT_ALLOW_FOR_DEMO')]);
        }  
        if(Room::whereId($request->id)->update(['is_deleted'=>1])){
            return redirect()->back()->with(['success' => config('constants.FLASH_REC_DELETE_1')]);
        }
        return redirect()->back()->with(['error' => config('constants.FLASH_REC_DELETE_0')]);
    }
    /* ***** End Room Functions ***** */

    /* ***** Start Room Types Functions ***** */
    public function addRoomType() {
        $this->data['amenities_list'] = $this->getAmenitiesList();
        return view('backend/rooms/room_types_add_edit',$this->data);
    }

    public function editRoomType(Request $request){
        $this->data['amenities_list'] = $this->getAmenitiesList();
        $this->data['data_row'] = RoomType::whereId($request->id)->first();
        if(!$this->data['data_row']){
            return redirect()->back()->with(['error' => config('constants.FLASH_REC_NOT_FOUND')]);
        }
        return view('backend/rooms/room_types_add_edit',$this->data);
    }

    public function saveRoomType(Request $request) {
        $splashMsg = getSplashMsg(['id' => $request->id, 'type'=>'add_update']);
        if($request->id>0){
            if($this->core->checkWebPortal()==0){
                return redirect()->back()->with(['info' => config('constants.FLASH_NOT_ALLOW_FOR_DEMO')]);
            } 
        } 

        // $request->merge([
        //     'amenities'=> implode(',', $request->amenities_ids)
        // ]);
        // $res = RoomType::updateOrCreate(['id' => $request->id],$request->except(['_token','amenities_ids']));
        $res = RoomType::updateOrCreate(['id' => $request->id],$request->except(['_token']));
        
        if($res){
            $mediaData = [
                'tbl_id' => $res->id,
                'media_ids' => $request->media_ids,
                'files' => ($request->hasFile('room_type_images')) ? $request->room_type_images : null,
                'folder_path' => 'uploads/room_type_images',
                'type' => 'room_type_image',
            ];           
            $this->core->uploadAndUnlinkMediaFile($mediaData);
            return redirect()->back()->with(['success' => $splashMsg['success']]);
        }
        return redirect()->back()->with(['success' => $splashMsg['error']]);
    }

    public function listRoomType() {
        $this->data['room_categories'] = getConstants('LIST_ROOM_CATEGORY');
        $this->data['datalist'] = RoomType::whereStatus(1)->whereIsDeleted(0)->orderBy('order_num','ASC')->get();
        return view('backend/rooms/room_types_list',$this->data);
    }

    public function deleteRoomType(Request $request) {
        if($this->core->checkWebPortal()==0){
            return redirect()->back()->with(['info' => config('constants.FLASH_NOT_ALLOW_FOR_DEMO')]);
        }  
        if(RoomType::whereId($request->id)->update(['is_deleted'=>1])){
            return redirect()->back()->with(['success' => config('constants.FLASH_REC_DELETE_1')]);
        }
        return redirect()->back()->with(['error' => config('constants.FLASH_REC_DELETE_0')]);
    }

    public function viewRoomType(Request $request) {
        $this->data['data_row'] = RoomType::whereId($request->id)->whereIsDeleted(0)->first();
        if(!$this->data['data_row']){
            return redirect()->back()->with(['error' => config('constants.FLASH_REC_NOT_FOUND')]);
        }
        return view('backend/rooms/room_types_view',$this->data);
    }

    public function priceRuleRoomType($id) {
        $this->data['room_type_id'] = $id;
         $this->data['seasons_list'] = Season::where('is_deleted', 0)->orderBy('name','ASC')->get();
         $this->data['datalist'] = RoomType::whereStatus(1)->whereIsDeleted(0)->orderBy('order_num','ASC')->get();
         $roomPrices = RoomPrice::where('room_type_id', $id)->get();
         $priceList = [];
         if($roomPrices->count()){
             foreach ($roomPrices as $key => $value) {
                $priceList[$value->season_id] = ['id'=>$value->id, 'price'=>$value->price];
             }
         }
         $this->data['price_list'] = $priceList;
        return view('backend/rooms/room_type_price_rule',$this->data);
    }

    public function savePriceRuleRoomType(Request $request) {
        $splashMsg = getSplashMsg(['id' => $request->id, 'type' => 'add_update']);
        if(!$request->season_ids || count($request->season_ids) == 0){
           return redirect()->back()->with(['info' => config('constants.FLASH_INVALID_PARAMS')]);
        }
        
        $priceIds = [];
        $isPrice = true;
        foreach ($request->season_ids as $key => $value) {
            if(!$request->amount[$value]){
              $isPrice = false;
              break;  
            }
            $postdata = [
                'room_type_id' => $request->room_type_id,
                'season_id' => $value,
                'price' => $request->amount[$value],
            ];
            $priceIds[] = $request->ids[$value];
            $res = RoomPrice::updateOrCreate(['id'=>$request->ids[$value]], $postdata);
        }
        if(!$isPrice){
           return redirect()->back()->with(['info' => config('constants.FLASH_INVALID_PARAMS')]);
        }
        if($res){
            if(count($priceIds)){
                RoomPrice::where('room_type_id', $request->room_type_id)->whereNotIn('id',$priceIds)->delete();
            }
            return redirect()->back()->with(['success' => $splashMsg['success']]);
        }
        return redirect()->back()->with(['success' => $splashMsg['error']]);
    }
    /* ***** End Room Types Functions ***** */

    /* ***** Start Amenities Functions ***** */
    public function addAmenities() {
        return view('backend/rooms/amenities_add_edit',$this->data);
    }

    public function editAmenities(Request $request){
        $this->data['data_row']=Amenities::whereId($request->id)->first();
        if(!$this->data['data_row']){
            return redirect()->back()->with(['error' => config('constants.FLASH_REC_NOT_FOUND')]);
        }
        return view('backend/rooms/amenities_add_edit',$this->data);
    }

    public function saveAmenities(Request $request) {
        if($request->id>0){
            if($this->core->checkWebPortal()==0){
                return redirect()->back()->with(['info' => config('constants.FLASH_NOT_ALLOW_FOR_DEMO')]);
            } 
            $success = config('constants.FLASH_REC_UPDATE_1');
            $error = config('constants.FLASH_REC_UPDATE_0');
        } else {
            $success = config('constants.FLASH_REC_ADD_1');
            $error = config('constants.FLASH_REC_ADD_0');
        }
        $res = Amenities::updateOrCreate(['id'=>$request->id],$request->except(['_token']));
        
        if($res){
            return redirect()->back()->with(['success' => $success]);
        }
        return redirect()->back()->with(['error' => $error]);
    }

    public function listAmenities() {
        $this->data['datalist']=Amenities::whereStatus(1)->whereIsDeleted(0)->orderBy('name','ASC')->get();
        return view('backend/rooms/amenities_list',$this->data);
    }

    public function deleteAmenities(Request $request) {
        if($this->core->checkWebPortal()==0){
            return redirect()->back()->with(['info' => config('constants.FLASH_NOT_ALLOW_FOR_DEMO')]);
        }  
        if(Amenities::whereId($request->id)->update(['is_deleted'=>1])){
            return redirect()->back()->with(['success' => config('constants.FLASH_REC_DELETE_1')]);
        }
        return redirect()->back()->with(['error' => config('constants.FLASH_REC_DELETE_0')]);
    }
    /* ***** End Amenities Functions ***** */

    /* ***** Start RoomReservation Functions ***** */
    public function roomReservation1(Request $request, $step) {
        $this->data['roomtypes_list'] = getRoomTypesList('custom');
        $this->data['customer_list'] = getCustomerList('get');
        $this->data['form_step'] = $step;
        if(in_array($this->data['form_step'], [1, 2])){
            if($step == 2){
                $inDate = dateConvert($request->check_in_date);
                $outDate = dateConvert($request->check_out_date);
                $this->data['roomlist'] = getRoomsWithPrice(['checkin_date' => $inDate, 'checkout_date' => $outDate]);
                $this->data['booked_rooms'] = getBookedRooms(['checkin_date' => $inDate, 'checkout_date' => $outDate]);
                $this->data['rooms'] = Room::whereStatus(1)->whereIsDeleted(0)->orderBy('room_no','ASC')->get();
                $this->data['uri_params'] = $request->all();
            }
            return view('backend/rooms/room_reservation_add_edit',$this->data);
        }
        return redirect()->route('list-reservation')->with(['error' => config('constants.FLASH_INVALID_PARAMS')]);
    }

    public function roomReservation(Request $request, $step) {
        // dd($request);

        $this->data['roomtypes_list'] = getRoomTypesList('custom');
        $this->data['customer_list'] = getCustomerList('get');
        // $this->data['form_step'] = $step;
        // if(in_array($this->data['form_step'], [1, 2])){
            // if($step == 1){
                $inDate = dateConvert($request->check_in_date);
                $outDate = dateConvert($request->check_out_date);
                $this->data['roomlist'] = getRoomsWithPrice(['checkin_date' => $inDate, 'checkout_date' => $outDate]);
                $this->data['booked_rooms'] = getBookedRooms(['checkin_date' => $inDate, 'checkout_date' => $outDate]);
                $this->data['uri_params'] = $request->all();
                $this->data['rooms'] = Room::whereStatus(1)->whereIsDeleted(0)->orderBy('room_no','ASC')->get();
            // }
            $this->data['customerData'] = json_encode($this->data, true);
            // dd($this->data);
            if(!$request->all()){
                return view('backend/rooms/room_reservation_add_edit',$this->data);
            }else{
                return view('backend/rooms/room_reservation_vanue_add_edit',$this->data);
            }

        // }
        // return redirect()->route('list-reservation')->with(['error' => config('constants.FLASH_INVALID_PARAMS')]);
    }

    // public function saveReservationVenue(Request $request) {
    //     $this->data['vanue'] = $request->all();
    //     $this->data['customer_list'] = getCustomerList('get');
    //     return view('backend/rooms/room_reservation_vanue_add_edit',$this->data);
    // }

    public function roomReservationPayment(Request $request) {

        $this->data['uri_params'] = $request->all();        
        $this->data['customer'] = getCustomerInfo($this->data['uri_params']['selected_customer_id']);
        
        $this->data['customerData'] = json_encode($this->data, true);
        
        $this->data['data_row'] = Reservation::with('orders_items', 'persons', 'booked_rooms')
        ->whereId($this->data['customer']['id'])
        ->first();        

        return view('backend/rooms/room_reservation_payment',$this->data);
    }
    
    public function editReservation(Request $request){
        $this->data['data_row'] = Reservation::with('orders_items','orders_info', 'booked_rooms')->whereId($request->id)->whereIsCheckout(0)->first();
        if($this->data['data_row']){
            return view('backend/rooms/check_out',$this->data);
        } else {
            return redirect()->route('list-reservation')->with(['error' => config('constants.FLASH_NOT_ALLOW_URL')]);
        }
    }

    public function saveReservation(Request $request) {
        $pre_data = json_decode($request->customerData); 
        $pre_customer_data = $pre_data->uri_params;
        // Log::debug(":: Booking Form Submit Data: ::" . print_r($request->all(), true));
        if($request->id>0){ // ----- check id
            if($this->core->checkWebPortal()==0){
                return redirect()->back()->with(['info' => config('constants.FLASH_NOT_ALLOW_FOR_DEMO')]);
            } 
            $success = config('constants.FLASH_REC_UPDATE_1');
            $error = config('constants.FLASH_REC_UPDATE_0');
        } else {
            $success = config('constants.FLASH_REC_ADD_1');
            $error = config('constants.FLASH_REC_ADD_0');
        }

        if(!$pre_customer_data->check_in_date || !$pre_customer_data->check_out_date || !$pre_customer_data->duration_of_stay){
            return redirect()->back()->with(['error' => config('constants.FLASH_FILL_REQUIRED_FIELD')]);
        }

        $reservationData = [];
        $customerData = [];

        if($pre_customer_data->guest_type=='existing'){
            $customerId = $pre_customer_data->selected_customer_id;
            $custData   = Customer::whereId($customerId)->first();
            $custName   = $custData->name ?? '';
        } else {
            $custName = $pre_customer_data->name;
            if(!$pre_customer_data->name || !$pre_customer_data->mobile || !$pre_customer_data->gender){
                return redirect()->back()->with(['error' => config('constants.FLASH_FILL_REQUIRED_FIELD')]);
            }
            $customerData = [
                "surname"     => $pre_customer_data->surname,
                "name"        => $pre_customer_data->name,
                "middle_name" => $pre_customer_data->middle_name,
                "father_name" => $pre_customer_data->father_name,
                "email"       => ($pre_customer_data->email) ? $pre_customer_data->email : null,
                "mobile"      => $pre_customer_data->mobile,
                "address"     => $pre_customer_data->address,
                "nationality" => $pre_customer_data->nationality,
                "country"     => $pre_customer_data->country,
                "state"       => $pre_customer_data->state,
                "city"        => $pre_customer_data->city,
                "gender"      => $pre_customer_data->gender,
                "age"         => $pre_customer_data->age,
                "password"    => Hash::make($pre_customer_data->mobile),
            ]; 
            $customerId = Customer::insertGetId($customerData);

            // sync user and customer
            $this->core->syncUserAndCustomer();
        }

        $reservationData = [
            "customer_id"       => $customerId,
            "guest_type"        => $pre_customer_data->guest_type,
            "check_in"          => dateConvert($pre_customer_data->check_in_date, 'Y-m-d H:i:s'),
            "check_out"         => dateConvert($pre_customer_data->check_out_date, 'Y-m-d H:i:s'),
            "duration_of_stay"  => $pre_customer_data->duration_of_stay,
            "event_type"        => $pre_customer_data->event_type,
            "time_slot"         => $request->time_slot, // -----
            "custom_time"       => $request->custom_time, // -----
            "adult"             => $pre_customer_data->adult,
            "kids"              => $pre_customer_data->kids,
            "booked_by"         => $pre_customer_data->booked_by,
            "vehicle_number"    => $pre_customer_data->vehicle_number,
            "reason_visit_stay" => $pre_customer_data->reason_visit_stay,
            "advance_payment"   => $request->advance_payment,
            "idcard_type"       => $pre_customer_data->idcard_type,
            "idcard_no"         => $pre_customer_data->idcard_no,
            "referred_by"       => $pre_customer_data->referred_by,
            "referred_by_name"  => $pre_customer_data->referred_by_name,
            "remark_amount"     => $pre_customer_data->remark_amount,
            "remark"            => $pre_customer_data->remark,
            "company_name"      => $pre_customer_data->company_name,
            "company_gst_num"   => $pre_customer_data->company_gst_num,
            "room_plan"         => $request->room_plan, // -----
            "payment_mode"      => $request->payment_mode ?? "",
        ];

        if(!$request->id){
            $reservationData["created_at_checkin"] = date('Y-m-d H:i:s');
        }
        $res = Reservation::updateOrCreate(['id' => $request->id],$reservationData);
        if($res){
            // add rooms
            if(!$request->id){
                $this->addReservationRoom($res, $pre_data); // check this function
            }
            // add ledger
            if($request->advance_payment){
                $where = [
                    'purpose'  => 'ROOM_ADVANCE',
                    'tbl_id'   => $res->id,
                    'tbl_name' => 'reservations',
                ];
                $paymentHistoryData = $where;
                $paymentHistoryData['payment_date']   = date('Y-m-d H:i:s');
                $paymentHistoryData['customer_id']    = $res->customer_id;
                $paymentHistoryData['user_id']        = getCustomerInfo($res->customer_id)->user_id;
                $paymentHistoryData['added_by']       = Auth::user()->id;
                $paymentHistoryData['payment_amount'] = $request->advance_payment;
                $paymentHistoryData['payment_type']   = getPaymentModeById($res->payment_mode);
                $paymentHistoryData['credit_debit']   = 'Debit';
                $paymentHistoryData['payment_of']     = 'cr';
                $paymentHistoryData['transaction_id'] = getNextInvoiceNo('ph');
                $this->core->updateOrCreatePH($where, $paymentHistoryData);
            }

            $mediaData = [ // media files
                'tbl_id'      => $res->id,
                'media_ids'   => $request->media_ids,
                'files'       => ($request->hasFile('id_image')) ? $request->id_image : null,
                'folder_path' => 'uploads/id_cards',
                'type'        => 'id_cards',
            ];   
  

            $this->core->uploadAndUnlinkMediaFile($mediaData);
            
            $persons_info_data = $pre_customer_data->persons_info;
            
            if(isset($persons_info_data->name)){
                $personsData = [];
                // $personReqData = $persons_info_data;
                foreach($persons_info_data->name as $k => $val){
                    if($val!=''){
                        $personsData[] = [
                            'reservation_id' => $res->id,
                            'name'           => $val, 
                            'gender'         => $persons_info_data->gender[$k], 
                            'age'            => $persons_info_data->age[$k], 
                            'address'        => $persons_info_data->address[$k], 
                            'idcard_type'    => $persons_info_data->idcard_type[$k], 
                            'idcard_no'      => $persons_info_data->idcard_no[$k]
                        ];
                    }
                }
                if(count($personsData)>0){
                    PersonList::insert($personsData);
                }
            } 

            // send sms
            if(!$request->id && $pre_customer_data->mobile){
                $this->core->sendSms(1,$pre_customer_data->mobile,["name" => $custName]);
            } 
            return redirect()->route('list-reservation')->with(['success' => $success]);
        }
        return redirect()->back()->with(['error' => $error]);
    }

    public function cancelReservation(Request $request) {
        // start trasaction
        DB::beginTransaction();
        try {
            if (Reservation::whereId($request->id)->update(['is_deleted' => 1, 'is_cancelled' => 1, 'cancelled_datetime' => date('Y-m-d H:i:s')])) {
                BookedRoom::where('reservation_id', $request->id)->update(['is_checkout' => 1]);

                //add ledger (Reverse paid amount)
                $paymetHis = PaymentHistory::where('tbl_id', $request->id)->where('tbl_name', 'reservations')->get();
                if($paymetHis) {
                    foreach ($paymetHis as $key => $value) {
                        $paymentHistoryData = []; 
                        $where = [
                            'purpose'  => str_replace('_REV', '', $value->purpose).'_REV',
                            'tbl_id'   => $value->tbl_id,
                            'tbl_name' => 'reservations',
                        ];
                        $paymentHistoryData['purpose']        = $where['purpose'];
                        $paymentHistoryData['tbl_id']         = $where['tbl_id'];
                        $paymentHistoryData['tbl_name']       = $where['tbl_name'];
                        $paymentHistoryData['payment_date']   = date('Y-m-d H:i:s');
                        $paymentHistoryData['customer_id']    = $value->customer_id;
                        $paymentHistoryData['user_id']        = $value->user_id;
                        $paymentHistoryData['added_by']       = Auth::user()->id;
                        $paymentHistoryData['payment_amount'] = $value->payment_amount;
                        $paymentHistoryData['payment_type']   = $value->payment_type;
                        $paymentHistoryData['credit_debit']   = 'Credit';
                        $paymentHistoryData['payment_of']     = 'dr';
                        $paymentHistoryData['transaction_id'] = getNextInvoiceNo('ph');
                        $this->core->updateOrCreatePH($where, $paymentHistoryData);
                    }
                }
                DB::commit();
                return redirect()->route('list-reservation')->with(['success' => config('constants.FLASH_RESERVATION_CANCELLED_1')]);
            }
        } catch (\Exception $e) {
            DB::rollback();
        }
        return redirect()->route('list-reservation')->with(['error' => config('constants.FLASH_RESERVATION_CANCELLED_0')]);
    }

    public function viewReservation(Request $request) {
        
            $this->data['data_row'] = Reservation::with('orders_items', 'persons', 'booked_rooms')
            ->whereId($request->id)
            ->first();        


        return view('backend/rooms/room_reservation_view',$this->data);
    }

    public function checkOut(Request $request) {
        $this->data['data_row']=Reservation::with('orders_items','orders_info', 'booked_rooms')->whereId($request->id)->whereIsCheckout(0)->first();
        if($this->data['data_row']){
            return view('backend/rooms/check_out',$this->data);
        } else {
            return redirect()->route('list-reservation')->with(['error' => config('constants.FLASH_NOT_ALLOW_URL')]);
        }
    }

    public function saveCheckOutData(Request $request) {
        $settings = getSettings();
        $reservationData = [];
        $orderInfo = [];
        $amountArr =  $request->amount;
        $roomDiscount = $request->discount_amount;
        if($request->room_discount_in == 'perc'){
            $totalAmount = $amountArr['total_room_amount'] + $amountArr['total_room_amount_gst'] + $amountArr['total_room_amount_cgst'];
            $roomDiscount = ($roomDiscount/100)*$totalAmount;
        }
        $amountArr['room_amount_discount'] = $roomDiscount;
        $amountArr['additional_amount'] = $request->additional_amount;
        $reservationData = [
            "check_out"           => dateConvert($request->check_out_date, 'Y-m-d H:i:s'),
            "created_at_checkout" => date('Y-m-d H:i:s'),
            "duration_of_stay"    => $request->duration_of_stay,
            "amount_json"         => json_encode($amountArr),
            "idcard_type"         => $request->idcard_type,
            "idcard_no"           => $request->idcard_no,
            "company_gst_num"     => $request->company_gst_num,
            "payment_mode"        => $request->payment_mode,
            "payment_status"      => $request->payment_status,
            "is_checkout"         => 1,

            "discount"            => $amountArr['room_amount_discount'],
            "sub_total"           => $amountArr['total_room_amount'],
            "gst_perc"            => $settings['gst'],
            "cgst_perc"           => $settings['cgst'],
            "gst_amount"          => $amountArr['total_room_amount_gst'],
            "cgst_amount"         => $amountArr['total_room_amount_cgst'],
            "grand_total"         => $amountArr['total_room_final_amount'],

            "addtional_amount"         => $amountArr['additional_amount'],
            "additional_amount_reason" => $request->additional_amount_reason,
        ];
        $mobile = '';
        $name = '';
        $resData = Reservation::with('booked_rooms')->whereId($request->id)->first();
        if($request->id>0){            
            if($resData){
                if($resData->customer){
                    $mobile = $resData->customer->mobile;
                    $name = $resData->customer->name;
                }
                if($resData->invoice_num==null && $request->invoice_applicable==1){
                    $reservationData['invoice_num'] = getNextInvoiceNo();
                    $orderInfo['invoice_num'] = getNextInvoiceNo('orders');
                }
            }
        }

        $mediaData = [
            'tbl_id'      => $request->id,
            'media_ids'   => $request->media_ids,
            'files'       => ($request->hasFile('id_image')) ? $request->id_image : null,
            'folder_path' => 'uploads/id_cards',
            'type'        => 'id_cards',
        ];           
        $this->core->uploadAndUnlinkMediaFile($mediaData);

        $res = Reservation::updateOrCreate(['id' => $request->id], $reservationData);
        if($res){

            //update booked rooms checkout date
            $this->updateReservationRoom($resData, $request);

            $gstApply = $gstPerc = $gstAmount = $cgstPerc = $cgstAmount = 0;
            if($request->food_gst_apply==1){
                $gstApply = 1;
                $gstPerc = $settings['food_gst'];
                $gstAmount = $request->amount['order_amount_gst'];

                $cgstPerc = $settings['food_cgst'];
                $cgstAmount = $request->amount['order_amount_cgst'];
            }

            $orderInfo['reservation_id'] = $request->id;
            $orderInfo['invoice_date']   = dateConvert($request->check_out_date, 'Y-m-d H:i:s');
            $orderInfo['gst_apply']      = $gstApply;
            $orderInfo['gst_perc']       = $gstPerc;
            $orderInfo['cgst_perc']      = $cgstPerc;
            $orderInfo['gst_amount']     = $gstAmount;
            $orderInfo['cgst_amount']    = $cgstAmount;

            $orderDiscount = $request->discount_order_amount;
            if($request->order_discount_in == 'perc'){
                $totalAmount = $amountArr['order_amount']+$amountArr['order_amount_gst']+$amountArr['order_amount_cgst'];
                $orderDiscount = ($orderDiscount/100)*$totalAmount;
            }
            $orderInfo['discount'] = $orderDiscount;
            
            $orderData = Order::where('reservation_id',$request->id)->first();
            if($orderData){
                $orderInfo["original_date"] = date('Y-m-d H:i:s');
                Order::where('reservation_id',$request->id)->update($orderInfo);
            }
            
            //add ledger
            $cal = calcFinalAmount($res);
            if($cal){   
                $paymentHistoryData = [];            
                $where = [
                    'purpose'  => 'ROOM_AMOUNT',
                    'tbl_id'   => $resData->id,
                    'tbl_name' => 'reservations',
                ];
                $paymentHistoryData['purpose']        = $where['purpose'];
                $paymentHistoryData['tbl_id']         = $where['tbl_id'];
                $paymentHistoryData['tbl_name']       = $where['tbl_name'];
                $paymentHistoryData['payment_date']   = date('Y-m-d H:i:s');
                $paymentHistoryData['customer_id']    = $res->customer_id;
                $paymentHistoryData['user_id']        = getCustomerInfo($res->customer_id)->user_id;
                $paymentHistoryData['added_by']       = Auth::user()->id;
                $paymentHistoryData['payment_amount'] = $cal['finalRoomAmount'];
                $paymentHistoryData['payment_type']   = getPaymentModeById($resData->payment_mode);
                $paymentHistoryData['credit_debit']   = 'Debit';
                $paymentHistoryData['payment_of']     = 'cr';
                $paymentHistoryData['transaction_id'] = getNextInvoiceNo('ph');
                $this->core->updateOrCreatePH($where, $paymentHistoryData);

                if($cal['finalOrderAmount'] > 0){
                    $where = [
                        'purpose'  => 'FOOD_ORDER_AMOUNT',
                        'tbl_id'   => $orderData->id,
                        'tbl_name' => 'orders',
                    ];
                    $paymentHistoryData['purpose']        = $where['purpose'];
                    $paymentHistoryData['tbl_id']         = $where['tbl_id'];
                    $paymentHistoryData['tbl_name']       = $where['tbl_name'];
                    $paymentHistoryData['payment_amount'] = $cal['finalOrderAmount'];
                    $this->core->updateOrCreatePH($where, $paymentHistoryData);
                }
            }

            //send sms
            if($mobile!=''){
                $this->core->sendSms(2,$mobile,['name' => $name]);
            } 
            return redirect()->route('list-reservation')->with(['success' => config('constants.FLASH_CHECKOUT_1')]);
        }
        return redirect()->back()->with(['error' => config('constants.FLASH_CHECKOUT_0')]);
    }

    public function invoice(Request $request) {
        $this->data['type'] = $request->type;
        $this->data['data_row'] = Reservation::with('orders_items', 'orders_info', 'booked_rooms')->whereId($request->id)->first();
        return view('backend/rooms/invoice',$this->data);
    }

    public function listReservation() {
        $this->data['list'] = 'check_ins';
        $this->data['datalist'] = Reservation::with('orders_items','booked_rooms')->whereStatus(1)->whereIsDeleted(0)->whereIsCheckout(0)->orderBy('created_at','DESC')->get();
        return view('backend/rooms/room_reservation_list',$this->data);
    }

    public function listCheckOuts() {
        $startDate = getNextPrevDate('prev');
        $this->data['list'] = 'check_outs';
        $this->data['datalist'] = Reservation::with('booked_rooms')->whereDate('check_out', '>=', $startDate." 00:00:00")->whereDate('check_out', '<=', DB::raw('CURDATE()'))->whereStatus(1)->whereIsDeleted(0)->whereIsCheckout(1)->orderBy('created_at','DESC')->get();
        $this->data['roomtypes_list'] = getRoomTypesList();
        $this->data['customer_list'] = getCustomerList('get');
        $this->data['search_data'] = ['customer_id' => '','room_type_id' => '','date_from' => $startDate, 'date_to' => date('Y-m-d')];

        return view('backend/rooms/room_reservation_list',$this->data);
    }

    public function listCancelledReservations() {
        $this->data['list'] = 'cancelled';
        $this->data['datalist']=Reservation::with('booked_rooms')->whereIsCancelled(1)->orderBy('created_at','DESC')->paginate(10);
        return view('backend/rooms/room_reservation_list',$this->data);
    }

    public function markAsPaid(Request $request){
        $this->data['data_row']=Reservation::whereId($request->id)->whereIsCheckout(1)->first();
        if($this->data['data_row']){
            Reservation::whereId($request->id)->update(['payment_status'=>1]);
            return redirect()->route('list-reservation')->with(['success' => config('constants.FLASH_REC_UPDATE_1')]);
        } else {
            return redirect()->route('list-reservation')->with(['error' => config('constants.FLASH_REC_UPDATE_0')]);
        }
    }

    public function advancePay(Request $request) {
        $resData = Reservation::find($request->id);
        if($resData){
            $advance = ($resData->advance_payment) ? $resData->advance_payment+$request->advance_payment : $request->advance_payment;
            $postData = ["advance_payment" => $advance];
            $res = Reservation::updateOrCreate(['id'=>$request->id],$postData);
            if($res){
                //add ledger
                if($request->advance_payment){
                    $paymentHistoryData = [
                        'purpose'  => 'ROOM_ADVANCE',
                        'tbl_id'   => $resData->id,
                        'tbl_name' => 'reservations',
                    ];
                    $paymentHistoryData['payment_date']   = $request->date_of_payment ?? date('Y-m-d H:i:s');
                    $paymentHistoryData['customer_id']    = $resData->customer_id;
                    $paymentHistoryData['user_id']        = getCustomerInfo($resData->customer_id)->user_id;
                    $paymentHistoryData['added_by']       = Auth::user()->id;
                    $paymentHistoryData['payment_amount'] = $request->advance_payment;
                    $paymentHistoryData['payment_type']   = getPaymentModeById($resData->payment_mode);
                    $paymentHistoryData['credit_debit']   = 'Debit';
                    $paymentHistoryData['payment_of']     = 'cr';
                    $paymentHistoryData['transaction_id'] = getNextInvoiceNo('ph');
                    $paymentHistoryData['reference']      = $request->reference ?? null;
                    $this->core->storePH($paymentHistoryData);
                }
                return redirect()->back()->with(['success' => config('constants.FLASH_REC_ADD_1')]);
            }
        }
        return redirect()->back()->with(['error' => config('constants.FLASH_REC_ADD_0')]);
    }

    public function swapRoom(Request $request) {
        $reservationData = getReservationById($request->id);
        if(!$reservationData){
            return redirect()->back()->with(['error' => config('constants.FLASH_INVALID_PARAMS')]);
        }
        $this->data['reservation_id'] = $request->id;
        $this->data['booked_rooms'] = getBookedRooms(['reservation_id' => $request->id]);
        $this->data['roomtypes_list'] = getRoomTypesListWithRooms();
        return view('backend/rooms/room_swap',$this->data);
    }

    public function saveSwapRoom(Request $request) {
        if(!$request->new_room || !$request->old_room){
            return redirect()->back()->with(['error' => config('constants.FLASH_ALL_FIELD_REQUIRED')]);
        }
        
        $expNewRoom = explode('~', $request->new_room);
        $expOldRoom = explode('~', $request->old_room);

        //get booked old room info
        $queryBookedRoom = BookedRoom::where('reservation_id', $request->id)->where('room_type_id', $expOldRoom[0])->where('room_id', $expOldRoom[1])->whereIsCheckout(0);
        $bookedRoomData = $queryBookedRoom->first();
        //get roomType by id
        $roomTypeDetails = getRoomTypeById($expNewRoom[0]);

        //set old room data array
        $priceInfo = getRoomsWithPrice([ 'checkin_date'=>$bookedRoomData->check_in, 'checkout_date'=>date('Y-m-d H:i:s'), 'room_type_ids'=>[$expOldRoom[0]] ]);
        $oldRoomData = [
            'check_in' => $bookedRoomData->check_in,
            'check_out' => date('Y-m-d H:i:s'),
            'date_wise_price'=>json_encode($priceInfo[$expOldRoom[0]]['dates_with_price']),
            'swapped_from_room' => $expNewRoom[1],
            'is_checkout' => 1,
        ];
        
        $queryBookedRoom->delete($oldRoomData);

        //set new room data array
        $dateDiff = dateDiff(date('Y-m-d'), $bookedRoomData->check_in, 'daysWIthSymbol');
        $checkDate = ($dateDiff < 0) ? date('Y-m-d 00:00:00') : $bookedRoomData->check_in;
        $priceInfo = getRoomsWithPrice([ 'checkin_date' => $checkDate, 'checkout_date' => $bookedRoomData->check_out, 'room_type_ids' => [$expNewRoom[0]] ]);

        $newRoomData = [
            'reservation_id' => $request->id,
            'room_type_id' => $expNewRoom[0],
            'room_id' => $expNewRoom[1],
            'room_price' => $roomTypeDetails->base_price,
            'date_wise_price' => json_encode($priceInfo[$expNewRoom[0]]['dates_with_price']),
            'check_in' => date('Y-m-d H:i:s'),
            'check_out' => $bookedRoomData->check_out,
        ];
        $res = BookedRoom::insert($newRoomData);
        if($res){
            return redirect()->back()->with(['success' => config('constants.FLASH_ROOM_SWAP_1')]);
        }
        return redirect()->back()->with(['success' => config('constants.FLASH_ROOM_SWAP_0')]);
    }

    public function deleteReservation(Request $request) {
        if($this->core->checkWebPortal()==0){
            return redirect()->back()->with(['info' => config('constants.FLASH_NOT_ALLOW_FOR_DEMO')]);
        }  
        if(Reservation::whereId($request->id)->update(['is_deleted'=>1])){
            return redirect()->back()->with(['success' => config('constants.FLASH_REC_DELETE_1')]);
        }
        return redirect()->back()->with(['error' => config('constants.FLASH_REC_DELETE_0')]);
    }
    /* ***** End RoomReservation Functions ***** */

    /* ***** Start FoodCategory Functions ***** */
    public function addFoodCategory()
    {
        $this->data['categories'] = $this->getCategoryHierarchy();

        return view('backend.food_category_add_edit', $this->data);
    }

    public function editFoodCategory(Request $request)
    {
        $this->data['data_row'] = FoodCategory::find($request->id);

        if (!$this->data['data_row']) {
            return redirect()->back()->with(['error' => config('constants.FLASH_REC_NOT_FOUND')]);
        }

        // $this->data['categories'] = FoodCategory::where('parent_id',0)
        //     ->where('id', '!=', $this->data['data_row']->id) // Avoid self-referencing
        //     ->where('status', 1)
        //     ->where('is_deleted', 0)
        //     ->pluck('name', 'id')
        //     ->toArray();

        $this->data['categories'] = $this->getCategoryHierarchy();

        return view('backend.food_category_add_edit', $this->data);
    }

    public function saveFoodCategory(Request $request)
    {
        if ($this->core->checkWebPortal() == 0) {
            return redirect()->back()->with(['info' => config('constants.FLASH_NOT_ALLOW_FOR_DEMO')]);
        }

        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $successMessage = $request->id ? config('constants.FLASH_REC_UPDATE_1') : config('constants.FLASH_REC_ADD_1');
        $errorMessage = $request->id ? config('constants.FLASH_REC_UPDATE_0') : config('constants.FLASH_REC_ADD_0');

        $res = FoodCategory::updateOrCreate(
            ['id' => $request->id],
            $request->except(['_token'])
        );

        if ($res) {
            return redirect()->route('list-food-category')->with(['success' => $successMessage]);
        }

        return redirect()->back()->with(['error' => $errorMessage]);
    }

    public function listFoodCategory()
    {
        $this->data['datalist'] = FoodCategory::with('parent')
        // ->where('status', 1)
        ->where('is_deleted', 0)
        ->orderBy('parent_id', 'ASC') // Ensures Main Categories come first
        ->orderBy('name', 'ASC')     // Then orders by name
        ->get();

        return view('backend.food_category_list', $this->data);
    }

    public function deleteFoodCategory(Request $request)
    {
        if ($this->core->checkWebPortal() == 0) {
            return redirect()->back()->with(['info' => config('constants.FLASH_NOT_ALLOW_FOR_DEMO')]);
        }

        $res = FoodCategory::whereId($request->id)->update(['is_deleted' => 1]);

        if ($res) {
            return redirect()->route('list-food-category')->with(['success' => config('constants.FLASH_REC_DELETE_1')]);
        }

        return redirect()->back()->with(['error' => config('constants.FLASH_REC_DELETE_0')]);
    }

    private function getCategoryHierarchy($parentId = 0, $level = 0) {
        $categories = FoodCategory::where('parent_id', $parentId)
            ->where('status', 1)
            ->where('is_deleted', 0)
            ->orderBy('name', 'ASC')
            ->get();
    
        $hierarchy = [];
        foreach ($categories as $category) {
            $hierarchy[] = [
                'id' => $category->id,
                'name' => str_repeat('— ', $level) . $category->name,
            ];
            $hierarchy = array_merge($hierarchy, $this->getCategoryHierarchy($category->id, $level + 1));
        }
        return $hierarchy;
    }
    /* ***** End FoodCategory Functions ***** */

    private function getMenuHierarchy() {
        $menus = Menu::where('status', '1')
            ->where('is_deleted', 0)
            ->orderBy('menu_name', 'ASC')
            ->get();
        return $menus;
    }
    /* ***** End Menu Functions ***** */

    /* ***** Start FoodItems Functions ***** */
    public function addFoodItem() {
        $this->data['category_list'] = $this->getCategoryHierarchy();
        $this->data['menu_list'] = $this->getMenuHierarchy();
        return view('backend/food_item_add_edit',$this->data);
    }

    public function editFoodItem(Request $request){
        $this->data['category_list'] = $this->getCategoryHierarchy();
        $this->data['menu_list'] = $this->getMenuHierarchy();
        $this->data['data_row'] = FoodItem::whereId($request->id)->first();
        if(!$this->data['data_row']){
            return redirect()->back()->with(['error' => config('constants.FLASH_REC_NOT_FOUND')]);
        }
        return view('backend/food_item_add_edit',$this->data);
    }

    public function saveFoodItem(Request $request) {
        $validator = Validator::make($request->all(), [
            'category_id' => 'required|exists:food_categories,id', // Correct validation rule
            'name' => 'required|string|max:255',
            'price' => 'required|numeric',
            'description' => 'nullable|string',
            'menu_id' => 'required|array', // Ensures that menu_id is provided as an array
            'menu_id.*' => 'exists:menus,id', // Validates that each menu_id is a valid menu    
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }
    
        if($request->id > 0) {
            $success = config('constants.FLASH_REC_UPDATE_1');
            $error = config('constants.FLASH_REC_UPDATE_0');
        } else {
            $success = config('constants.FLASH_REC_ADD_1');
            $error = config('constants.FLASH_REC_ADD_0');
        }
    
        // Save or update the food item
        // $res = FoodItem::updateOrCreate(['id' => $request->id], $request->except(['_token']));


        // Convert menu_id array to JSON format
        // $menuJson = json_encode($request->menu_id);

        $res = FoodItem::updateOrCreate(
            ['id' => $request->id],
            array_merge($request->except(['_token', 'menu_id']), ['menu_ids' => $request->menu_id]) // Store menu_ids as JSON
        );

        if ($res) {
            return redirect()->back()->with(['success' => $success]);
        }
    
        return redirect()->back()->with(['error' => $error]);
    }

    public function listFoodItem() {
        $this->data['datalist'] = FoodItem::whereIsDeleted(0)->orderBy('name','ASC')->get();
        return view('backend/food_item_list',$this->data);
    }

    public function deleteFoodItem(Request $request) {
        if(FoodItem::whereId($request->id)->update(['is_deleted'=>1])){
            return redirect()->back()->with(['success' => config('constants.FLASH_REC_DELETE_1')]);
        }
        return redirect()->back()->with(['error' => config('constants.FLASH_REC_DELETE_0')]);
    }
    /* ***** End FoodItems Functions ***** */


    /* ***** Start Menu Functions ***** */
    public function addMenu() {
        return view('backend/menu_add_edit',$this->data);
    }

    public function editMenu(Request $request){
        $this->data['data_row'] = Menu::whereId($request->id)->first();
        if(!$this->data['data_row']){
            return redirect()->back()->with(['error' => config('constants.FLASH_REC_NOT_FOUND')]);
        }
        return view('backend/menu_add_edit',$this->data);
    }

    public function saveMenu(Request $request) {

        $validator = Validator::make($request->all(), [
            'menu_name'     => 'required|string|max:255',
            'description'   => 'nullable|string',
            'menu_price'    => 'required|numeric',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }
    
        if($request->id > 0) {
            $success = config('constants.FLASH_REC_UPDATE_1');
            $error = config('constants.FLASH_REC_UPDATE_0');
        } else {
            $success = config('constants.FLASH_REC_ADD_1');
            $error = config('constants.FLASH_REC_ADD_0');
        }
    
        // Save or update the food item
        $res = Menu::updateOrCreate(['id' => $request->id], $request->except(['_token']));
    
        if ($res) {
            return redirect()->back()->with(['success' => $success]);
        }
    
        return redirect()->back()->with(['error' => $error]);
    }

    public function listMenu() {
        $this->data['datalist'] = Menu::whereIsDeleted(0)->orderBy('menu_name','ASC')->get();
        return view('backend/menu_list',$this->data);
    }

    public function deleteMenu(Request $request) {
        if(Menu::whereId($request->id)->update(['is_deleted'=>1])){
            return redirect()->back()->with(['success' => config('constants.FLASH_REC_DELETE_1')]);
        }
        return redirect()->back()->with(['error' => config('constants.FLASH_REC_DELETE_0')]);
    }
    /* ***** End Menu Functions ***** */
    

    /* ***** Start ExpenseCategory Functions ***** */
    public function addExpenseCategory() {
        return view('backend/expenses/category_add_edit',$this->data);
    }

    public function editExpenseCategory(Request $request){
        $this->data['data_row'] = ExpenseCategory::whereId($request->id)->first();
        if(!$this->data['data_row']){
            return redirect()->back()->with(['error' => config('constants.FLASH_REC_NOT_FOUND')]);
        }
        return view('backend/expenses/category_add_edit',$this->data);
    }

    public function saveExpenseCategory(ExpenseCategoryRequest $request) {
        if($request->id>0){
            if($this->core->checkWebPortal()==0){
                return redirect()->back()->with(['info' => config('constants.FLASH_NOT_ALLOW_FOR_DEMO')]);
            } 
            $success = config('constants.FLASH_REC_UPDATE_1');
            $error = config('constants.FLASH_REC_UPDATE_0');
        } else {
            $success = config('constants.FLASH_REC_ADD_1');
            $error = config('constants.FLASH_REC_ADD_0');
        }
        $res = ExpenseCategory::updateOrCreate(['id'=>$request->id],$request->except(['_token']));
        
        if($res){
            return redirect()->back()->with(['success' => $success]);
        }
        return redirect()->back()->with(['error' => $error]);
    }

    public function listExpenseCategory() {
        $this->data['datalist'] = ExpenseCategory::whereStatus(1)->orderBy('name','ASC')->get();
        return view('backend/expenses/category_list',$this->data);
    }

    public function deleteExpenseCategory(Request $request) {
        if($this->core->checkWebPortal()==0){
            return redirect()->back()->with(['info' => config('constants.FLASH_NOT_ALLOW_FOR_DEMO')]);
        }  
        if(ExpenseCategory::whereId($request->id)->update(['status'=>0])){
            return redirect()->back()->with(['success' => config('constants.FLASH_REC_DELETE_1')]);
        }
        return redirect()->back()->with(['error' => config('constants.FLASH_REC_DELETE_0')]);
    }
    /* ***** End ExpenseCategory Functions ***** */

    /* ***** Start Expenses Functions ***** */
    public function addExpense() {
        $this->data['category_list'] = $this->getExpenseCategoryList();
        return view('backend/expenses/add_edit',$this->data);
    }

    public function editExpense(Request $request){
        $this->data['category_list']=$this->getExpenseCategoryList();
        $this->data['data_row']=Expense::with('attachments')->whereId($request->id)->first();
        if(!$this->data['data_row']){
            return redirect()->back()->with(['error' => config('constants.FLASH_REC_NOT_FOUND')]);
        }
        return view('backend/expenses/add_edit',$this->data);
    }

    public function saveExpense(Request $request) {
        if($request->id>0){
            $success = config('constants.FLASH_REC_UPDATE_1');
            $error = config('constants.FLASH_REC_UPDATE_0');
        } else {
            $success = config('constants.FLASH_REC_ADD_1');
            $error = config('constants.FLASH_REC_ADD_0');
        }
        $res = Expense::updateOrCreate(['id'=>$request->id],$request->except(['_token']));
        
        if($res){
            $mediaData = [
                'tbl_id'      => $res->id,
                'media_ids'   => $request->media_ids,
                'files'       => ($request->hasFile('attachments')) ? $request->attachments : null,
                'folder_path' => 'uploads/expenses',
                'type'        => 'expenses',
            ];           
            $this->core->uploadAndUnlinkMediaFile($mediaData);

            if($request->amount){
                $where = [
                    'purpose'  => 'EXPENSE',
                    'tbl_id'   => $res->id,
                    'tbl_name' => 'expenses',
                ];
                $paymentHistoryData = $where;
                $paymentHistoryData['payment_date']   = $res->datetime;
                $paymentHistoryData['customer_id']    = null;
                $paymentHistoryData['user_id']        = Auth::user()->id;
                $paymentHistoryData['added_by']       = Auth::user()->id;
                $paymentHistoryData['payment_amount'] = $res->amount;
                $paymentHistoryData['payment_type']   = getPaymentModeById('cash');
                $paymentHistoryData['credit_debit']   = '';
                $paymentHistoryData['payment_of']     = 'dr';
                $paymentHistoryData['transaction_id'] = getNextInvoiceNo('ph');
                $this->core->updateOrCreatePH($where, $paymentHistoryData);
            }

            return redirect()->back()->with(['success' => $success]);
        }
        return redirect()->back()->with(['error' => $error]);
    }

    public function listExpense() {
        $startDate = getNextPrevDate('prev');
        $this->data['category_list'] = $this->getExpenseCategoryList();
         $this->data['datalist'] = Expense::whereDate('datetime', '>=', $startDate." 00:00:00")->whereDate('datetime', '<=', DB::raw('CURDATE()'))->orderBy('datetime','DESC')->get();
         $this->data['search_data'] = ['category_id'=>'','date_from'=>$startDate, 'date_to'=>date('Y-m-d')];
        return view('backend/expenses/list',$this->data);
    }

    public function deleteExpense(Request $request) {
        if(Expense::whereId($request->id)->delete()){
            return redirect()->back()->with(['success' => config('constants.FLASH_REC_DELETE_1')]);
        }
        return redirect()->back()->with(['error' => config('constants.FLASH_REC_DELETE_0')]);
    }
    /* ***** End Expenses Functions ***** */

    /* ***** Start StockManage Functions ***** */
    public function addProduct() {
        return view('backend/product_add_edit',$this->data);
    }

    public function editProduct(Request $request){
        $this->data['data_row'] = Product::whereId($request->id)->first();
        if(!$this->data['data_row']){
            return redirect()->back()->with(['error' => config('constants.FLASH_REC_NOT_FOUND')]);
        }
        return view('backend/product_add_edit',$this->data);
    }

    public function saveProduct(Request $request) {
        if($request->id>0){
            $success = config('constants.FLASH_REC_UPDATE_1');
            $error = config('constants.FLASH_REC_UPDATE_0');
        } else {
            $success = config('constants.FLASH_REC_ADD_1');
            $error = config('constants.FLASH_REC_ADD_0');
        }
        $res = Product::updateOrCreate(['id'=>$request->id],$request->except(['_token','curr_stock']));
        
        if($res){
            return redirect()->back()->with(['success' => $success]);
        }
        return redirect()->back()->with(['error' => $error]);
    }

    public function listProduct() {
        $this->data['datalist'] = Product::whereIn('status',[1,2])->whereIsDeleted(0)->orderBy('stock_qty','ASC')->get();
        return view('backend/product_list',$this->data);
    }

    public function deleteProduct(Request $request) {
        if($this->core->checkWebPortal()==0){
            return redirect()->back()->with(['info' => config('constants.FLASH_NOT_ALLOW_FOR_DEMO')]);
        }  
        if(Product::whereId($request->id)->update(['is_deleted'=>1])){
            return redirect()->back()->with(['success' => config('constants.FLASH_REC_DELETE_1')]);
        }
        return redirect()->back()->with(['error' => config('constants.FLASH_REC_DELETE_0')]);
    }

    public function inOutStock() {
        $this->data['product_list'] = $this->getProductList();
        $this->data['room_list'] = getRoomList();
        return view('backend/stock_in_out',$this->data);
    }

    public function saveStock(Request $request) {
        $request->merge(['added_by' => Auth::user()->id]);
        $res = StockHistory::insert($request->except(['_token']));
        if($res){
            $this->stcokUpdate($request->stock_is, $request->product_id, $request->qty);
            return redirect()->back()->with(['success' => config('constants.FLASH_REC_ADD_1')]);
        }
        return redirect()->back()->with(['error' => config('constants.FLASH_REC_ADD_0')]);
    }

    public function stockHistory() {
        $startDate = getNextPrevDate('prev');
        $this->data['datalist'] = StockHistory::whereDate('created_at', '>=', $startDate." 00:00:00")->whereDate('created_at', '<=', DB::raw('CURDATE()'))->orderBy('id','DESC')->get();
        $this->data['products'] = Product::where('is_deleted',0)->pluck('name','id');
        $this->data['rooms'] = getRoomList();
        $this->data['search_data'] = ['product_id'=>'','is_stock'=>'','date_from'=>$startDate, 'date_to'=>date('Y-m-d')];
        return view('backend/stock_history',$this->data);
    }

    public function deleteStockHistory(Request $request) {
        if($this->core->checkWebPortal()==0){
            return redirect()->back()->with(['info' => config('constants.FLASH_NOT_ALLOW_FOR_DEMO')]);
        }  
        $stockDataQuery = StockHistory::whereId($request->id);
        $tmpStockData = $stockDataQuery->first();
        if($stockDataQuery->delete()){
            $this->stcokUpdate($tmpStockData->stock_is, $tmpStockData->product_id, $tmpStockData->qty);
            return redirect()->back()->with(['success' => config('constants.FLASH_REC_DELETE_1')]);
        }
        return redirect()->back()->with(['error' => config('constants.FLASH_REC_DELETE_0')]);
    }

    function stcokUpdate($stock_is = '', $product_id, $qty){
        if($stock_is=='add'){
            Product::whereId($product_id)->increment('stock_qty', $qty);
        } else {
           Product::whereId($product_id)->decrement('stock_qty', $qty); 
        }
    }
    /* ***** End StockManage Functions ***** */

    /* ***** Start FoodOrders Functions ***** */
    public function listOrders() {
        $this->data['datalist'] = Order::whereDate('created_at', DB::raw('CURDATE()'))->where('status','!=',4)->orderBy('id','DESC')->get();
        $this->data['search_data'] = ['date_from' => date('Y-m-d'), 'date_to' => date('Y-m-d')];
        return view('backend/orders_list',$this->data);
    }

    public function foodOrder(Request $request) {

        // $selectedMenuId = json_encode([$request->input('menu_id')]); 
        $selectedMenuId = $request->input('menu_id');
        
        $data = FoodItem::whereJsonContains('menu_ids', $selectedMenuId)->get();
          
        // Get categories and their food items
        $this->data['categories'] = FoodCategory::with(['food_items' => function ($query) use ($selectedMenuId) {
            $query->where('status', 1);
            
            if ($selectedMenuId) {
                $query->whereJsonContains('menu_ids', $selectedMenuId);
            }    
        }])
        ->where('status', 1)
        ->where('is_deleted', 0)
        ->get();
        // Group categories by their parent_id
        $groupedCategories = $this->data['categories']->groupBy('parent_id');
        
        // Recursive function to build the hierarchy
        $buildTree = function ($parentId) use ($groupedCategories, &$buildTree) {
            return $groupedCategories->get($parentId, collect())
                ->map(function ($category) use ($buildTree) {
                    // Determine if the category is Veg or Non-Veg
                    $type = ($category->parent_id == 0 && $category->id == 1) ? 'veg' :
                            (($category->parent_id == 0 && $category->id == 2) ? 'non-veg' : null);
    
                    return [
                        'id' => $category->id,
                        'name' => $category->name,
                        'type' => $type, // Assign type (Veg or Non Veg)
                        'food_items' => $category->food_items,
                        'children' => $buildTree($category->id),
                    ];
                });
        };
    
        $this->data['categories_tree'] = $buildTree(0);

        $this->data['category_tree'] = $this->getCategoryHierarchy(); //For Fetching Food Category Tree In Select
        
        $this->data['menu_list'] = $this->getMenuHierarchy();

        return view('backend/food_order_page', $this->data);
    }
    
    public function FoodOrderCancel(Request $request) {
        $order = Order::with('orders_items')->find($request->order_id);

        if ($order) {
            $order->status = 1; // Set status to 4 (Cancelled)
            $order->save();

           
            // Update related orders_items status
            if ($order->orders_items->isNotEmpty()) { // Check if the collection is not empty
                foreach ($order->orders_items as $item) {
                    $item->status = 4; // Assuming 4 means cancelled
                    $item->save();
                }
            }

            return redirect()->route('list-reservation')->with(['success' => 'Orders Successfully Cancelled']);
        }
    
        return response()->json([
            'success' => false,
            'message' => 'Order not found.'
        ]);
    }
    
    public function foodOrderTable(Request $request) {
        // Get categories with their food items and children (subcategories)
        $this->data['categories_list'] = FoodCategory::with('food_items', 'children')
            ->where('status', 1)
            ->where('is_deleted', 0)
            ->orderBy('name', 'ASC')
            ->get();
        // Get the specific order
        $this->data['order_row'] = Order::where('id', $request->segment(3))->first();
        return view('backend/food_order_table_page', $this->data);
    }
    
    public function foodOrderFinal(Request $request) {
        // Get categories with their food items and children (subcategories)
        $this->data['categories_list'] = FoodCategory::with('food_items', 'children')
            ->where('status', 1)
            ->where('is_deleted', 0)
            ->orderBy('name', 'ASC')
            ->get();
        // Get the specific order
        $this->data['order_row'] = Order::where('id', $request->segment(3))->first();
        return view('backend/food_order_final_page', $this->data);
    }

    // Fetch Food Order As Per Reservation
    public function fetchFoodOrders(Request $request)
    {
        $reservationId = $request->reservation_id;

        // Validate the reservation ID
        if (!$reservationId) {
            return response()->json(['html' => '<p class="text-danger">Invalid reservation ID.</p>']);
        }

        // Fetch Total Guest
        $totGuest = Reservation::where('id', $reservationId)->value('adult');

        // Fetch food orders related to the reservation
        $foodOrders = OrderItem::where('order_id', $reservationId)
            ->where('reservation_id', $reservationId) // Corrected: Removed quotes
            ->get();

        // Log::info('Reservation ID: ' . $reservationId);
        // Log::info('Food Orders: ' . print_r($foodOrders->toArray(), true));

        // Return the view as a response
        $html = view('backend.model.food_order_list', compact('foodOrders','totGuest'))->render();

        return response()->json(['html' => $html]);
    }
    
    public function foodOrderView(Request $request){
        $request->session()->flash('food_order', $request->all());
        $menu = Menu::where('id', $request->menu_id)->first();
        
        // Pass data properly to the view
        return view('backend.food_order_view', compact('menu'));
    }

    public function saveFoodOrder(Request $request){
        // $order_exist = Order::where('reservation_id', $request->reservation_id)->exists();
        $order_exist = Order::where('reservation_id', $request->reservation_id)->first();
        // if ($order_exist) {
        //     return redirect()->route('kitchen-invoice', ['order_id' => $order_exist->id, 'order_type' => 'room-order']);
        // }

        // Log::debug(":: Food Order Form Submit Data: ::" . print_r($request->all(), true));
        $insertRec = true;
        $insertRecOrderHistorty = true;
        $orderHistoryResId = null;

        $invoiceDate = date('Y-m-d');
        $settings = getSettings();
        $orderArr = [];
        $itemsArr = array_filter($request->item_qty);
        // Log::debug(":: Item Array: " . print_r($itemsArr, true));
        if(count($itemsArr)>0){
            $orderData = [];
            $gstPerc = $cgstPerc = $gstAmount = $cgstAmount = 0;
            
            if($request->gst_apply==1){
                $gstPerc    = $request->gst_perc;
                $cgstPerc   = $request->cgst_perc;
                $gstAmount  = $request->order_amount_gst;
                $cgstAmount = $request->order_amount_cgst;
            }
            $orderInfo = [
                'reservation_id' => $request->reservation_id,
                'invoice_num'    => ($request->food_invoice_apply=="on") ? getNextInvoiceNo('orders') : null,
                'invoice_date'   => $invoiceDate,
                'table_num'      => $request->table_num,
                'gst_apply'      => $request->gst_apply,
                'gst_perc'       => $gstPerc,
                'gst_amount'     => $gstAmount,
                'cgst_perc'      => $cgstPerc,
                'cgst_amount'    => $cgstAmount,
                'discount'       => $request->discount_order_amount,
                'total_amount'   => $request->price_par_plate,
                'name'           => $request->name,
                'email'          => $request->email,
                'mobile'         => $request->mobile,
                'address'        => $request->address,
                'gender'         => $request->gender,
                'num_of_person'  => $request->no_of_guests,
                'waiter_name'    => $request->waiter_name,
                'payment_mode'   => $request->payment_mode,
                'status'         => 0,
            ];
            if($order_exist){
                $orderInfo['original_date'] = date('Y-m-d H:i:s');
             
                $orderRes = Order::where('id',$order_exist->id)->update($orderInfo);

                OrderItem::where('order_id', $order_exist->id)->delete();
                    
                if($orderRes){
                    /////////////////////////////////////   old-start
                    // Process Special Requirements
                    if (!empty($request->specialRequirement)) {
                        $specialRequirements = $request->specialRequirement;
                        
                        // Combine the fields into rows and filter out empty ones
                        $specialItems = [];
                        $jsonDataArray = []; // This will store multiple JSON objects
                        if (!empty($specialRequirements['name'])) {
                            foreach ($specialRequirements['name'] as $index => $name) {
                                if (
                                    !empty($name) &&
                                    !empty($specialRequirements['category_id'][$index]) &&
                                    !empty($specialRequirements['type'][$index])
                                ) {
                                    // Prepare JSON data for each item
                                    $jsonDataArray[] = [
                                        'category_id'   => $specialRequirements['category_id'][$index],
                                        'category_name' => FoodCategory::where('id', $specialRequirements['category_id'][$index])->value('name'),
                                        'item_name'     => $name,
                                        'type'          => $specialRequirements['type'][$index],
                                    ];
                                }
                            }
                        }
                        // Only add the entry if there's at least one valid special requirement
                        if (!empty($jsonDataArray)) {
                            $specialItems[] = [
                                'order_id'         => $order_exist->id,
                                'order_history_id' => $orderHistoryResId,
                                'reservation_id'   => $orderInfo['reservation_id'],
                                'item_name'        => 'special requirements',
                                'item_price'       => $specialRequirements['price'],
                                'item_qty'         => $request->no_of_guests,
                                'json_data'        => json_encode($jsonDataArray), // Store all items in one JSON field
                                'remark'           => $request->remarks,
                                'status'           => 3,
                                'created_at'       => now(),
                                'updated_at'       => now(),
                            ];
                        }
                        // Insert the filtered records into the database
                        if (!empty($specialItems)) {      
                           
                            // $orderItemRes = OrderItem::where('order_id',$order_exist->id)->where('item_name','special requirements')->update($specialItems);
                            OrderItem::insert($specialItems); // Bulk insert all special items
                        }
                    }
                    
                    $jsonMenuDataArray = []; // This will store multiple JSON objects
                    foreach ($itemsArr as $k => $val) {
                        $exp = explode('~', $request->items[$k]);

                        $jsonMenuDataArray[] = [
                            'category_id'   => $exp[0],
                            'category_name' => $exp[1],
                            'item_name'     => $exp[2],
                            'item_id'       => $request->no_of_guests,
                            'type'          => FoodItem::where('id', $k)->value('type'),
                        ];
                    }
                    // Store all JSON data as a single JSON array
                    $orderArr[] = [
                        'order_id'         => $order_exist->id, 
                        'order_history_id' => $orderHistoryResId, 
                        'reservation_id'   => $orderInfo['reservation_id'],
                        'item_name'        => $request->menu_name,
                        'item_price'       => $request->menu_price,
                        'item_qty'         => $request->no_of_guests, // Count of items instead of individual qty
                        'json_data'        => json_encode($jsonMenuDataArray), // Store all items in one JSON field
                        'remark'           => $request->remarks,
                        'status'           => 3,
                        'created_at'       => now(),
                        'updated_at'       => now(),
                    ];

                    // Insert the order food items data into the database
                    $res = OrderItem::insert($orderArr);
                    
                    ////////////////////////////////////////////// old-end
                    OrderHistory::where('order_id',$order_exist->id)->update(['is_book'=>0]);

                    //send sms
                    if($request->mobile){
                        $this->core->sendSms(3,$request->mobile,['name' => $request->name]);
                    } 
                    return redirect()->route('kitchen-invoice',['order_id' => $order_exist->id,'order_type'=>'room-order'])->with(['success' => 'Orders Successfully submitted']);
                    // return redirect()->route('order-invoice-final',[$request->order_id])->with(['success' => 'Orders Successfully submitted']);
                } else {
                    return redirect()->back()->with(['error' => 'Order placed failed.Try again']);
                }
            } else {
                if($request->reservation_id>0){
                    $insertRecOrderHistorty = false;
                } else {
                    // check table num is booked or not (if table num booked , no new orders row added, added in orderHistory table)
                    $isTableBooked = isTableBook($request->table_num);
                    if($isTableBooked){
                        $insertRec = false;
                        $orderResId = $isTableBooked->order_id;
                    }
                }
                if($insertRec){
                    $orderResId = Order::insertGetId($orderInfo);
                }

                if($insertRecOrderHistorty){
                    $orderHistoryResId = OrderHistory::insertGetId(['order_id' => $orderResId, 'table_num' => $request->table_num]);
                }

                // Order ID
                $lastOrderId = $orderResId;

                // Reservation ID
                $reservationID = $request->reservation_id;

                // Fetch Customer ID
                $custID = Reservation::where('id', $reservationID)->value('customer_id');

                // Process Special Requirements
                if (!empty($request->specialRequirement)) {
                    $specialRequirements = $request->specialRequirement;
                    
                    // Combine the fields into rows and filter out empty ones
                    $specialItems = [];
                    $jsonDataArray = []; // This will store multiple JSON objects
                    if (!empty($specialRequirements['name'])) {
                        foreach ($specialRequirements['name'] as $index => $name) {
                            if (
                                !empty($name) &&
                                !empty($specialRequirements['category_id'][$index]) &&
                                !empty($specialRequirements['type'][$index])
                            ) {
                                // Prepare JSON data for each item
                                $jsonDataArray[] = [
                                    'category_id'   => $specialRequirements['category_id'][$index],
                                    'category_name' => FoodCategory::where('id', $specialRequirements['category_id'][$index])->value('name'),
                                    'item_name'     => $name,
                                    'type'          => $specialRequirements['type'][$index],
                                ];
                            }
                        }
                    }
                    // Only add the entry if there's at least one valid special requirement
                    if (!empty($jsonDataArray)) {
                        $specialItems[] = [
                            'order_id'         => $lastOrderId,
                            'order_history_id' => $orderHistoryResId,
                            'reservation_id'   => $reservationID,
                            'item_name'        => 'special requirements',
                            'item_price'       => $specialRequirements['price'],
                            'item_qty'         => $request->no_of_guests,
                            'json_data'        => json_encode($jsonDataArray), // Store all items in one JSON field
                            'remark'           => $request->remarks,
                            'status'           => 3,
                            'created_at'       => now(),
                            'updated_at'       => now(),
                        ];
                    }
                    // Insert the filtered records into the database
                    if (!empty($specialItems)) {
                        OrderItem::insert($specialItems); // Bulk insert all special items
                    }
                }
                
                
                $jsonMenuDataArray = []; // This will store multiple JSON objects
                foreach ($itemsArr as $k => $val) {
                    $exp = explode('~', $request->items[$k]);

                    $jsonMenuDataArray[] = [
                        'category_id'   => $exp[0],
                        'category_name' => $exp[1],
                        'item_name'     => $exp[2],
                        'item_id'       => $request->no_of_guests,
                        'type'          => FoodItem::where('id', $k)->value('type'),
                    ];
                }

                // Store all JSON data as a single JSON array
                $orderArr[] = [
                    'order_id'         => $lastOrderId, 
                    'order_history_id' => $orderHistoryResId, 
                    'reservation_id'   => $reservationID, 
                    'item_name'        => $request->menu_name,
                    'item_price'       => $request->menu_price,
                    'item_qty'         => $request->no_of_guests, // Count of items instead of individual qty
                    'json_data'        => json_encode($jsonMenuDataArray), // Store all items in one JSON field
                    'remark'           => $request->remarks,
                    'status'           => 3,
                    'created_at'       => now(),
                    'updated_at'       => now(),
                ];

                // Insert the order food items data into the database
                $res = OrderItem::insert($orderArr);
                if($res){
                    if($request->reservation_id>0) {
                        return redirect()->route('kitchen-invoice',['order_id' => $lastOrderId,'order_type'=>'room-order'])->with(['success' => 'Orders Successfully submitted']);
                    }
                    return redirect()->route('kitchen-invoice',['order_id' => $orderHistoryResId,'order_type'=>'table-order'])->with(['success' => 'Orders Successfully submitted']);
                } else {
                    return redirect()->back()->with(['error' => 'Order placed failed.Try again']);
                }
            }

        }

        return redirect()->back()->with(['error' => 'Please provide item quantity']);
    }

    public function deleteOrderItem(Request $request) {
        if(OrderItem::whereId($request->id)->delete()){
            return redirect()->back()->with(['success' => config('constants.FLASH_REC_DELETE_1')]);
        }
        return redirect()->back()->with(['error' => config('constants.FLASH_REC_DELETE_0')]);
    } 

    public function orderInvoice(Request $request) {
        $id = $request->segment(3);
        $this->data['data_row'] = Order::with('orders_items')->whereId($id)->first();
        return view('backend/food_order_invoice',$this->data);
    }

    public function orderInvoiceFinal(Request $request) {
        $this->data['data_row'] = Order::where('id',$request->segment(3))->first();
        return view('backend/food_order_final_invoice',$this->data);
    }

    public function kitchenInvoice(Request $request){
        $id = $request->segment(3);
        $type = $request->segment(4);
        if($type=='room-order'){
            $this->data['data_row'] = Order::whereId($id)->first();
        } else {
            $this->data['data_row'] = OrderHistory::with('order')->whereId($id)->first();
        }
         $this->data['type'] = $type;
         $settings = getSettings();

        return view('backend/kitchen_invoice',$this->data);
    }

    // Kitchen Order Invoice Download
    public function downloadKitchenInvoice($id)
    {
        $data_row = Order::with('orders_items')->findOrFail($id); // Adjust based on your model
        $settings = getSettings();
        $type = 'room-order'; // Set based on your logic

        $pdf = Pdf::loadView('backend.invoice_template', compact('data_row', 'settings', 'type'));
        return $pdf->download("invoice_{$id}.pdf");
    }

    public function editKitchenInvoice($id)
    {
        $data_row = Order::with('orders_items')->findOrFail($id); // Adjust based on your model
        $settings = getSettings();

        return view('backend.edit_invoice', compact('data_row', 'settings'));
    }

    public function updateKitchenInvoice(Request $request, $id)
    {
        $order = Order::findOrFail($id);

        // Validate and update order details
        $order->update($request->all());

        // Update order items if necessary
        if ($request->has('order_items')) {
            foreach ($request->order_items as $item_id => $item_data) {
                $orderItem = OrderItem::findOrFail($item_id);
                $orderItem->update($item_data);
            }
        }

        return redirect()->route('kitchen-invoice-edit', $id)->with('success', 'Invoice updated successfully.');
    }

    public function processFoodOrder(Request $request) {
        // Get the selected items (food item IDs)
        $selectedItems = $request->input('selected_items', []); // Default to empty array if no items selected
    
        // Process the selected food items and quantities
        foreach ($selectedItems as $itemId) {
            $quantity = $request->input("item_qty[$itemId]", 0); // Get the quantity for the selected item
    
            // Perform actions like storing the order, calculating prices, etc.
            // Example: Save the food order to a database or session
        }
    
        // Return a response (e.g., redirect to another page or show a success message)
        return redirect()->route('food-order-summary');
    }
    /* ***** End FoodOrders Functions ***** */

    /* ***** Start Setting Functions ***** */
    public function settingsForm() {
        $this->data['data_row'] = Setting::pluck('value','name');
        return view('backend/settings',$this->data);
    }

    public function saveSettings(Request $request) {
        if($this->core->checkWebPortal()==0){
            return redirect()->back()->with(['info' => config('constants.FLASH_NOT_ALLOW_FOR_DEMO')]);
        }  
        $requestExcept = ['_token', 'sms_api_active', 'site_logo', 'site_favicon'];
        $res = null;

        //save settings: sms api active or not
        $value = ($request->sms_api_active && $request->sms_api_active == 'on') ? 1 : 0;
        Setting::updateOrCreate(['name'=>'sms_api_active'], ['name'=>'sms_api_active', 'value'=>$value, 'updated_at'=>date('Y-m-d h:i:s')]);

        //update site favicon
        if($request->hasFile('site_favicon')){
            unlinkImg(getSettings('site_favicon'),'uploads/favicon/');
            $filename=$this->core->fileUpload($request->site_favicon,'uploads/favicon'); 
            Setting::updateOrCreate(['name'=>'site_favicon'], ['name'=>'site_favicon', 'value'=>$filename]);
        }
        //update site logo
        if($request->hasFile('site_logo')){
            unlinkImg(getSettings('site_logo'),'uploads/logo/');
            $filename=$this->core->fileUpload($request->site_logo,'uploads/logo'); 
            Setting::updateOrCreate(['name'=>'site_logo'], ['name'=>'site_logo', 'value'=>$filename]);
        }
        foreach($request->all() as $key => $value){ 
            if(!in_array($key, $requestExcept)){
               $res = Setting::updateOrCreate(['name'=>$key], ['name'=>$key, 'value'=>$value, 'updated_at'=>date('Y-m-d h:i:s')]);
            }
        }
        if($res){  
            //set updated settings in session
            setSettings();

            //clear cache
            removeCacheKeys();
            
            return redirect()->back()->with(['success' => config('constants.FLASH_REC_UPDATE_1')]);
        }
        return redirect()->back()->with(['error' => config('constants.FLASH_REC_UPDATE_0')]);
    }
    /* ***** End Setting Functions ***** */

    /* ***** Start Permissions Functions ***** */
    public function listPermission() {
        $categoryList = config('constants.LIST_PERMISSIONS_CATEGORY');
        asort($categoryList);
        $permissions = Permission::where('status',1)->orderBy('category','ASC')->orderBy('permission_type','ASC')->get();
        $dataArr = [];
        foreach ($permissions as $key => $val) {
            $dataArr[$val->category][] = $val;
        }
        $this->data['datalist'] = $dataArr;
        $this->data['category_list'] = $categoryList;
        // dd($this->data['datalist']);
        return view('backend/permissions/list',$this->data);
    }

    public function savePermission(Request $request) {
        if($this->core->checkWebPortal()==0){
            return redirect()->back()->with(['info' => config('constants.FLASH_NOT_ALLOW_FOR_DEMO')]);
        }  
        $requestExcept = ['_token'];
        $res = null;
        $ids = $request->ids;
        $superAdmin       = $request->super_admin;
        $admin            = $request->admin;
        $receptionist     = $request->receptionist;
        $stokManager      = $request->store_manager;
        $financialManager = $request->financial_manager;
        $housekeeper      = $request->housekeeper;
        foreach($ids as $key => $id){ 
            $superAdminP = 1; //not change superadmin, so set default 1
            $adminP = $recP = $smP = $fmP = $hkP = 0;
            if(isset($superAdmin[$id])) $superAdminP = 1;
            if(isset($admin[$id])) $adminP = 1;
            if(isset($receptionist[$id])) $recP = 1;
            if(isset($stokManager[$id])) $smP = 1;
            if(isset($financialManager[$id])) $fmP = 1;
            if(isset($housekeeper[$id])) $hkP = 1;
            $res = Permission::where('id',$id)->update([
                "super_admin"       => $superAdminP,
                'admin'             => $adminP,
                'receptionist'      => $recP,
                'store_manager'     => $smP,
                'financial_manager' => $fmP,
                'housekeeper'       => $hkP
            ]);
        }
        if($res){            
            return redirect()->back()->with(['success' => config('constants.FLASH_REC_UPDATE_1')]);
        }
        return redirect()->back()->with(['error' => config('constants.FLASH_REC_UPDATE_0')]);
    }
    /* ***** End Permissions Functions ***** */

    public function deleteMediaFile(Request $request) {
        $row_data = MediaFile::whereId($request->id)->first();
        if(MediaFile::whereId($request->id)->delete()){
            unlinkImg($row_data->file,'uploads/'.$row_data->type.'/');
            return redirect()->back()->with(['success' => config('constants.FLASH_REC_DELETE_1')]);
        }
        return redirect()->back()->with(['error' => config('constants.FLASH_REC_DELETE_0')]);
    }

    /* ***** Start Dynamic Dropdowns Functions ***** */
    public function listDynamicDropdowns() {
        $dynamicDropdowns = DynamicDropdown::where('status', 1)->where('is_deleted', 0)->orderBy('dropdown_name','ASC')->orderBy('is_deletable','ASC')->get();
        $datalist = [];
        foreach ($dynamicDropdowns as $key => $value) {
            if(isset($datalist[$value->dropdown_name])){
                $datalist[$value->dropdown_name]['values'][] = $value;
            } else {
                $datalist[$value->dropdown_name] = ['dropdown_name' => $value->dropdown_name, 'title' => lang_trans('txt_dropdown_' . $value->dropdown_name), 'values' => [$value]];
            }
        }
        $this->data['datalist'] = $datalist;
        return view('backend/dynamic_dropdowns/list',$this->data);
    }

    public function saveDynamicDropdowns(Request $request) {
        if($this->core->checkWebPortal()==0){
            return redirect()->back()->with(['info' => config('constants.FLASH_NOT_ALLOW_FOR_DEMO')]);
        }  
       $res = null; 
       // dd($request->all());
       foreach($request->all() as $dropdownName => $dropdownValues){
            $ids = []; 
            if(is_array($dropdownValues)){
                DynamicDropdown::where("dropdown_name", $dropdownName)->where('is_deletable', 1)->where('status', 1)->update(['is_deleted'=>1]);
                foreach($dropdownValues as $k=>$v){
                    $where = ["id"=> $k, "dropdown_name"=>$dropdownName];
                    $data = ['dropdown_name'=>$dropdownName, 'dropdown_value'=>$v, 'is_deletable'=>1, 'is_deleted'=>0];

                    $dropdownObj = getDynamicDropdownRecord($where);
                    if($dropdownObj){
                        $data['is_deletable'] = $dropdownObj->is_deletable;
                    }
                    $res = DynamicDropdown::updateOrCreate($where, $data);
                }
            }            
        }
        if($res){            
            return redirect()->back()->with(['success' => config('constants.FLASH_REC_UPDATE_1')]);
        }
        return redirect()->back()->with(['error' => config('constants.FLASH_REC_UPDATE_0')]);
    }
    /* ***** End Dynamic Dropdowns Functions ***** */

    /* ***** Start Internal Functions ***** */
    function getRoleList(){
        return Role::orderBy('role','ASC')->pluck('role','id');
    }

    function getAmenitiesList(){
        return Amenities::whereStatus(1)->whereIsDeleted(0)->orderBy('name','ASC')->get();
    }

    function getFoodCategoryList(){
        return FoodCategory::whereStatus(1)->whereIsDeleted(0)->orderBy('name','ASC')->pluck('name','id');
    }

    function getExpenseCategoryList(){
        return ExpenseCategory::whereStatus(1)->orderBy('name','ASC')->pluck('name','id');
    }

    function getProductList(){
        return Product::whereStatus(1)->whereIsDeleted(0)->orderBy('name','ASC')->pluck('name','id');
    }

    function getRoomList(){
        $this->data['booked_rooms'] = getBookedRooms();
        $this->data['room_types'] = RoomType::with('rooms')->whereStatus(1)->whereIsDeleted(0)->orderBy('order_num','ASC')->get();
        return $this->data;
    }

    function addReservationRoom($reservationData, $pre_data){
        $customersData = $pre_data->uri_params;
        $roomData = [];
        $roomArray = explode(", ", $customersData->room_num);

        if($roomArray && count($roomArray) > 0){
            foreach($roomArray as $val){
                $exp = explode('~', $val);
                $roomTypeDetails = getRoomTypeById($exp[0]);
                
                // get datewise price list
                $priceInfo = getRoomsWithPrice([ 'checkin_date' => $customersData->check_in_date, 'checkout_date' => $customersData->check_out_date, 'room_type_ids' => [$exp[0]] ]);
                $roomData[] = [
                    'reservation_id'  => $reservationData->id,
                    'room_type_id'    => $exp[0],
                    'room_id'         => $exp[1],
                    'room_price'      => $roomTypeDetails->base_price,
                    'room_price'      => $roomTypeDetails->base_price,
                    'check_in'        => dateConvert($customersData->check_in_date, 'Y-m-d H:i:s'),
                    'check_out'       => dateConvert($customersData->check_out_date, 'Y-m-d H:i:s'),
                    'date_wise_price' => json_encode($priceInfo[$exp[0]]['dates_with_price'])
                ];
            }
            BookedRoom::insert($roomData);
        }
    }

    function addReservationRoom1($reservationData, $pre_data)
    {
        $customersData = $pre_data->uri_params;
        
        // Ensure room_num is properly formatted as an array
        $roomArray = is_array($customersData->room_num) ? $customersData->room_num : explode(", ", $customersData->room_num);
        
        if (!empty($roomArray)) {
            $roomData = [];

            foreach ($roomArray as $val) {
                [$roomTypeId, $roomId] = explode('~', $val);
                $roomTypeDetails = getRoomTypeById($roomTypeId);

                // Fetch datewise price list
                $priceInfo = getRoomsWithPrice([
                    'checkin_date'   => $customersData->check_in_date,
                    'checkout_date'  => $customersData->check_out_date,
                    'room_type_ids'  => [$roomTypeId]
                ]);

                $roomData[] = [
                    'reservation_id'  => $reservationData->id,
                    'room_type_id'    => $roomTypeId,
                    'room_id'         => $roomId,
                    'room_price'      => $roomTypeDetails->base_price,
                    'check_in'        => dateConvert($customersData->check_in_date, 'Y-m-d H:i:s'),
                    'check_out'       => dateConvert($customersData->check_out_date, 'Y-m-d H:i:s'),
                    'date_wise_price' => json_encode($priceInfo[$roomTypeId]['dates_with_price'] ?? [])
                ];
            }

            // Batch insert to optimize database interaction
            if (!empty($roomData)) {
                BookedRoom::insert($roomData);
            }
        }
    }


    function updateReservationRoom($reservationData, $request){
        $roomData = [];
        if($reservationData->booked_rooms && count($reservationData->booked_rooms) > 0){
            foreach($reservationData->booked_rooms as $val){
                if($val->is_checkout == 0){
                    $roomData = [
                        'is_checkout' => 1,
                        'check_out'   => dateConvert($request->check_out_date, 'Y-m-d H:i:s'),
                    ];
                    BookedRoom::where('id', $val->id)->update($roomData);
                }
            }
        }
    }
    /* ***** End Internal Functions ***** */
}
