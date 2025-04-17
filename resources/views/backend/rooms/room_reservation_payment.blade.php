@extends('layouts.master_backend')
@section('content')
  @php 
    $quickCheckIn = (Request::route()->action['as'] == 'quick-check-in') ? true : false;
    $flag = 0;
    $heading = lang_trans('btn_add');
    if(isset($data_row) && !empty($data_row)){
        $flag = 1;
        $heading = lang_trans('btn_update');
    }

    $calculatedAmount         = calcFinalAmount($data_row, 0);
  $totalRoomAmount          = $calculatedAmount['subtotalRoomAmount'];
  $advancePayment           = $calculatedAmount['advancePayment'];
  
  $roomAmountDiscount       = $calculatedAmount['totalRoomAmountDiscount'];
  $roomAmountGst            = $calculatedAmount['totalRoomAmountGst'];
  $roomAmountCGst           = $calculatedAmount['totalRoomAmountCGst'];
  $finalRoomAmount          = $calculatedAmount['finalRoomAmount'];

  $totalOrderAmountGst      = $calculatedAmount['totalOrderAmountGst'];
  $totalOrderAmountCGst     = $calculatedAmount['totalOrderAmountCGst'];
  $totalOrderAmountDiscount = $calculatedAmount['totalOrderAmountDiscount'];
  $orderGst                 = $calculatedAmount['totalOrderGstPerc'];
  $orderCGst                = $calculatedAmount['totalOrderCGstPerc'];
  $totalOrdersAmount        = $calculatedAmount['subtotalOrderAmount'];
  $finalOrderAmount         = $calculatedAmount['finalOrderAmount'];

  $additionalAmount         = $calculatedAmount['additionalAmount'];
  $additionalAmountReason   = $data_row->additional_amount_reason;

  $grandTotal               = $finalRoomAmount + $finalOrderAmount + $additionalAmount;
  $balanceDue               = $grandTotal - $advancePayment;

  @endphp
<div>
<div class="x_title">
    <h2>Guest Information</h2>
    <div class="clearfix"></div>
</div>
<table class="table table-bordered">
    <tr>
        <th>Full name</th>
        <td>{{$customer['name']}}</td>
        <th>Father name</th>
        <td>{{$customer['father_name']}}</td>
    </tr>
    <tr>
        <th>Email</th>
        <td>{{$customer['email']}}</td>
        <th>Mobile No.</th>
        <td>{{$customer['mobile']}}</td>
    </tr>
    <tr>
        <th>Gender</th>
        <td>{{$customer['gender']}}</td>
        <th>Age</th>
        <td>{{$customer['age']}} Year</td>
    </tr>
    <tr>
        <th>Address</th>
        <td colspan="3">{{$customer['address']}}</td>
    </tr>
</table>

<div class="x_title">
    <h2>Check In/Out Information</h2>
    <div class="clearfix"></div>
</div>
<table class="table table-bordered">
    <tr>
        <th>Check In</th>
        <td>{{$uri_params['check_in_date']}}</td>

        <th>Check Out</th>
        <td>{{$uri_params['check_out_date']}}</td>
        
    </tr>
    <tr>
            
        <th>Booked on</th>
        <td>{{$uri_params['check_out_date']}}</td>
        
        <th>Closed on</th>
        <td>{{$uri_params['check_out_date']}}</td>
    
    </tr>
    <tr>
        
        <th>Duration</th>
        <td>{{$uri_params['duration_of_stay']}}</td>
        
        <th>Guests</th>
        <td>{{$uri_params['adult']}}</td>
    
    </tr>
    <tr>
        
        <th>Id Card Type</th>
        <td>{{$uri_params['idcard_type']}}</td>
        
        <th>Id Card Number</th>
        <td>{{$uri_params['idcard_no']}}</td>
    
    </tr>
</table>

    {{ Form::open(array('url' => route('save-reservation'),'method'=>'POST','id'=>"add-reservation-form", 'class'=>"form-horizontal form-label-left",'files'=>true)) }}

    {{ Form::hidden('customerData', $customerData ?? '') }}

  <div class="row">
      <div class="col-md-12 col-sm-12 col-xs-12">
          <div class="x_panel">
              <div class="x_title">
                  <h2>{{lang_trans('heading_payment_info')}}</h2>
                  <div class="clearfix"></div>
              </div>
              <div class="x_content">
                  <div class="row">
                      <div class="col-md-12 col-sm-12 col-xs-12">
                        <table class="table table-bordered">
                          <tr>
                            <th>{{lang_trans('txt_payment_mode')}}</th>
                            <td>{{ ($data_row->payment_mode>0) ? config('constants.PAYMENT_MODES')[$data_row->payment_mode] : 'NA' }}</td>
                          </tr>
                        </table>
                      </div>
                      <div class="col-md-12 col-sm-12 col-xs-12">
                        <table class="table table-bordered">
                          <thead>
                            <tr>
                              <th class="text-center" width="2%">{{lang_trans('txt_sno')}}.</th>
                              <th class="text-center" width="20%">{{lang_trans('txt_room')}}</th>
                              <th class="text-center" width="5%">{{lang_trans('txt_duration')}}</th>
                              <th class="text-center" width="5%">{{lang_trans('txt_base_price')}}</th>
                              <th class="text-center" width="10%">{{lang_trans('txt_total_amount')}}</th>
                            </tr>
                          </thead>
                          <tbody>
                             @if($data_row->booked_rooms) 

                             @php $serialNo = 1; @endphp 
                              @foreach($data_row->booked_rooms as $key => $roomInfo)
                                @php
                                  $checkIn = dateConvert($roomInfo->check_in, 'Y-m-d');
                                  $checkOut = dateConvert($roomInfo->check_out, 'Y-m-d');
                                  $durOfStayPerRoom = (strtotime($checkOut) - strtotime($checkIn)) / (60 * 60 * 24) + 1;
                                  $priceInfo = getDateWisePriceList($roomInfo->date_wise_price);
                                  $amountPerRoom = $priceInfo[1];
                                @endphp

                                @if (!empty($priceInfo[0])) 
                                  <tr class="per_room_tr">
                                    <td class="text-center">{{$serialNo}}</td>
                                    <td>
                                        {{ ($roomInfo->room_type) ? $roomInfo->room_type->title : ""}}<br/>
                                        ({{lang_trans('txt_room_num')}} : {{$roomInfo->room->room_no}})
                                    </td>
                                    <th class="text-center">
                                      <span class="duration_of_per_room {{ ($roomInfo->swapped_from_room) ? 'swapped_room' : 'no_swapped_room'}}">{{$durOfStayPerRoom}}</span>
                                    </th>
                                    <td class="text-center">
                                      <button type="button" class="btn btn-xs btn-info cursor-pointer" data-toggle="modal" data-target="#room_price_model_{{$key}}">{{lang_trans('btn_price_break')}}</button>
                                      @include('backend/model/room_price_info_model',['list'=>$priceInfo[0], 'total'=>$priceInfo[1], 'key'=>$key])
                                    </td>
                                    <td class="text-right">{{getCurrencySymbol()}} {{ $amountPerRoom }}</td>
                                  </tr>
                                  @php $serialNo++; @endphp 
                                @endif
                              @endforeach
                            @endif
                          </tbody>
                        </table>
                        <table class="table table-bordered">
                          <tr>
                            <th class="text-right">{{lang_trans('txt_subtotal')}}</th>
                            <td width="15%" colspan="2" class="text-right" id="subtotal_display">
                              {{getCurrencySymbol()}} {{ numberFormat($totalRoomAmount) }}
                            </td>
                          </tr>
                          <tr>
                            <th class="text-right">Apply GST</th>
                            <td width="15%" colspan="2" id="td_gst_apply" class="text-right">
                              {{ Form::checkbox('gst_apply', 1, true, ['id'=>'apply_gst']) }}
                            </td>
                          </tr>
                          <tr>
                            <th class="text-right">SGST (<span id="sgst_perc">6</span>%)</th>
                            <td width="15%" colspan="2" class="text-right" id="sgst_amount_display">
                              {{getCurrencySymbol()}} 0
                            </td>
                          </tr>
                          <tr>
                            <th class="text-right">CGST (<span id="cgst_perc">6</span>%)</th>
                            <td width="15%" colspan="2" class="text-right" id="cgst_amount_display">
                              {{getCurrencySymbol()}} 0
                            </td>
                          </tr>
                          <tr>
                            <th class="text-right">Discount</th>
                            <td width="10%">
                              {{ Form::number('discount_order_amount', $roomAmountDiscount, ['class'=>"form-control", "id"=>"order_discount", "min"=>0]) }}
                            </td>
                            <td width="10%">
                              {{ Form::select('room_discount_in', ['amt' => 'Amount', '%' => '%'], 'amt', ['class'=>'form-control', "id"=>"room_discount_in"]) }}
                            </td>
                          </tr>
                          <tr class="bg-danger">
                            <th class="text-right">Total Amount</th>
                            <td width="15%" colspan="2" id="td_final_amount" class="text-right">
                              {{getCurrencySymbol()}} 0
                            </td>
                          </tr>
                        </table>

                        <table class="table table-bordered">
                        
                          <tr>
                              <th class="text-right">Advance</th>
                              <td width="10%">
                              {{Form::number('advance_payment',null,['class'=>"form-control col-md-7 col-xs-12",'required'=>true, "id"=>"advance_payment", "placeholder"=>lang_trans('ph_enter').lang_trans('txt_advance_payment'),"min"=>0])}}
                              </td>
                              <td width="10%">
                          {{Form::select('payment_mode',config('constants.PAYMENT_MODES'),null,['class'=>"form-control col-md-7 col-xs-12",'required'=>true, "id"=>"payment_mode", "placeholder"=>"--Select--"])}}
                              </td>
                          </tr>

                        </table>

                        <table class="table table-bordered">
                          <tr class="bg-danger">
                            <th class="text-right">{{lang_trans('txt_balance_due')}}</th>
                            <td width="15%" id="td_advance_amount" class="text-right">{{getCurrencySymbol()}} {{ numberFormat($balanceDue) }}</td>
                          </tr>
                        </table>


                        <div class="row">
                          <div class="col-md-12 col-sm-12 col-xs-12 text-right">                  
                            <div class="d-flex justify-content-end mt-3">
                           
                              <button class="btn btn-success btn-submit-form" type="submit" disabled_>{{lang_trans('btn_submit')}}</button>

                            </div>
                          </div>       
                        </div>
                      </div>
                  </div>
              </div>
          </div>
      </div>
  </div>
    {{ Form::close() }}
</div>
<div class="colne_persons_info_elem hide_elem">
  <div class="row persons_info_elem">
     <div class="col-md-2 col-sm-2 col-xs-12">
        {{Form::text('persons_info[name][]',null,['class'=>"form-control col-md-6 col-xs-12", "id"=>"person_name", "placeholder"=>lang_trans('ph_enter').lang_trans('txt_name')])}}
      </div>
      <div class="col-md-2 col-sm-2 col-xs-12">
        {{ Form::select('persons_info[gender][]',config('constants.GENDER'),null,['class'=>'form-control col-md-6 col-xs-12','placeholder'=>lang_trans('ph_select')]) }}
      </div>
      <div class="col-md-1 col-sm-1 col-xs-12">
        {{Form::number('persons_info[age][]',null,['class'=>"form-control col-md-6 col-xs-12", "id"=>"person_age", "placeholder"=>lang_trans('ph_enter').lang_trans('txt_age'),"min"=>10])}}
      </div>
      <div class="col-md-2 col-sm-2 col-xs-12">
        {{Form::textarea('persons_info[address][]',null,['class'=>"form-control col-md-6 col-xs-12", "id"=>"address", "placeholder"=>lang_trans('ph_enter').lang_trans('txt_address'),"rows"=>1])}}
      </div>
      <div class="col-md-2 col-sm-2 col-xs-12">
          {{ Form::select('persons_info[idcard_type][]',getDynamicDropdownList('type_of_ids'),null,['class'=>'form-control col-md-6 col-xs-12','placeholder'=>lang_trans('ph_select')]) }}                             
      </div>
      <div class="col-md-2 col-sm-2 col-xs-12">
        {{Form::text('persons_info[idcard_no][]',null,['class'=>"form-control col-md-6 col-xs-12", "id"=>"idcard_no", "placeholder"=>lang_trans('ph_enter').lang_trans('txt_id_number')])}}
      </div>
      <div class="col-md-1 col-sm-1 col-xs-12"> 
        <button type="button" class="btn btn-danger delete-row"><i class="fa fa-minus"></i></button>
      </div>
  </div>
</div>
{{-- require set var in js var --}}
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
<script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
<script type="text/javascript" src="{{URL::asset('public/js/page_js/page.js')}}"></script> 
<script>
document.addEventListener("DOMContentLoaded", function() {
    const gstCheckbox = document.getElementById('apply_gst');
    const subtotal = parseFloat("{{ $totalRoomAmount }}");

    const sgstPercElem = document.getElementById('sgst_perc');
    const cgstPercElem = document.getElementById('cgst_perc');
    const sgstAmountElem = document.getElementById('sgst_amount_display');
    const cgstAmountElem = document.getElementById('cgst_amount_display');
    const discountInput = document.getElementById('order_discount');
    const discountType = document.getElementById('room_discount_in');
    const finalAmountElem = document.getElementById('td_final_amount');

    const advancePaymentInput = document.getElementById('advance_payment');
    const balanceDueElem = document.getElementById('td_advance_amount');

    function calculateAmounts() {
        let sgstPerc = gstCheckbox.checked ? 6 : 0;
        let cgstPerc = gstCheckbox.checked ? 6 : 0;

        let sgstAmount = (subtotal * sgstPerc) / 100;
        let cgstAmount = (subtotal * cgstPerc) / 100;

        let discountVal = parseFloat(discountInput.value || 0);
        let discountAmt = 0;

        let grossAmount = subtotal + sgstAmount + cgstAmount;

        if (discountType.value === '%') {
            discountAmt = (grossAmount * discountVal) / 100;
        } else {
            discountAmt = discountVal;
        }

        let finalAmount = grossAmount - discountAmt;

        // Advance payment and balance due calculation
        let advancePayment = parseFloat(advancePaymentInput.value || 0);
        let balanceDue = finalAmount - advancePayment;

        // Update UI
        sgstPercElem.textContent = sgstPerc;
        cgstPercElem.textContent = cgstPerc;

        sgstAmountElem.textContent = '₹ ' + sgstAmount.toFixed(2);
        cgstAmountElem.textContent = '₹ ' + cgstAmount.toFixed(2);
        finalAmountElem.textContent = '₹ ' + finalAmount.toFixed(2);
        balanceDueElem.textContent = '₹ ' + balanceDue.toFixed(2);
    }

    // Initial calculation
    calculateAmounts();

    // Event listeners
    gstCheckbox.addEventListener('change', calculateAmounts);
    discountInput.addEventListener('input', calculateAmounts);
    discountType.addEventListener('change', calculateAmounts);
    advancePaymentInput.addEventListener('input', calculateAmounts);
});
</script>

@endsection