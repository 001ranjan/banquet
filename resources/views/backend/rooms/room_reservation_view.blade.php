@extends('layouts.master_backend')
@section('content')
@php 
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
<div class="">
      <div class="row" id="new_guest_section">
      <div class="col-md-12 col-sm-12 col-xs-12">
          <div class="x_panel">
              <div class="x_title">
                  <h2>{{lang_trans('heading_guest_info')}}</h2>
                  <div class="clearfix"></div>
              </div>
              <div class="x_content"> 
                <div class="row"> 
                  <div class="col-md-12 col-sm-12 col-xs-12">
                      <table class="table table-bordered">
                          <tr>
                            <th>{{lang_trans('txt_fullname')}}</th>
                            <td>{{($data_row->customer) ? $data_row->customer->name : ''}}</td>
                            <th>{{lang_trans('txt_father_name')}}</th>
                            <td>{{($data_row->customer) ? $data_row->customer->father_name : ''}}</td>
                          </tr>
                          <tr>
                            <th>{{lang_trans('txt_email')}}</th>
                            <td>{{($data_row->customer) ? $data_row->customer->email : ''}}</td>
                            <th>{{lang_trans('txt_mobile_num')}}</th>
                            <td>{{($data_row->customer) ? $data_row->customer->mobile : ''}}</td>
                          </tr>
                          <tr>
                            <th>{{lang_trans('txt_gender')}}</th>
                            <td>{{($data_row->customer) ? $data_row->customer->gender : ''}}</td>
                            <th>{{lang_trans('txt_age')}}</th>
                            <td>{{($data_row->customer) ? $data_row->customer->age : ''}} {{lang_trans('txt_years')}}</td>
                          </tr>
                          <tr>
                            <th>{{lang_trans('txt_address')}}</th>
                            <td colspan="3">{{($data_row->customer) ? $data_row->customer->address : ''}}, {{($data_row->customer) ? $data_row->customer->city : ''}}, {{($data_row->customer) ? $data_row->customer->state : ''}}, {{($data_row->customer) ? $data_row->customer->country : ''}}</td>
                          </tr>
                        </tbody>
                      </table>
                    </div>
                </div>
              </div>
          </div>
      </div>
  </div>
  
  <div class="row">
      <div class="col-md-12 col-sm-12 col-xs-12">
          <div class="x_panel">
              <div class="x_title">
                  <h2>{{lang_trans('heading_checkInOut_info')}}</h2>
                  <div class="clearfix"></div>
              </div>
              <div class="x_content">
                  <div class="row">
                       <div class="col-md-12 col-sm-12 col-xs-12">
                          <table class="table table-bordered">
                            <tr>
                              <th>{{lang_trans('btn_checkin')}}</th>
                              <td>{{dateConvert($data_row->check_in,'d-m-Y H:i')}}</td>
                              <th>{{lang_trans('btn_checkout')}}</th>
                              <td>{{ dateConvert($data_row->check_out,'d-m-Y H:i') }}</td>
                            </tr>
                            <tr>
                              <th>{{lang_trans('txt_booked_on_date')}}</th>
                              <td>{{ ($data_row->created_at_checkin!=null) ? dateConvert($data_row->created_at_checkin,'d-m-Y H:i') : 'NA'}}</td>
                              <th>{{lang_trans('txt_closed_on_date')}}</th>
                              <td>{{ ($data_row->created_at_checkout!=null) ? dateConvert($data_row->created_at_checkout,'d-m-Y H:i') : 'NA'}}</td>
                            </tr>
                            <tr>
                              <th>{{lang_trans('txt_duration')}}</th>
                              <td>{{$data_row->duration_of_stay}}</td>
                              <th>{{lang_trans('txt_adults')}}</th>
                              <td>{{$data_row->adult}}</td>
                            </tr>
                            <tr>
                              <th>{{lang_trans('txt_idcard_type')}}</th>
                              <td>{{@getDynamicDropdownById($data_row->idcard_type, 'dropdown_value')}}</td>
                              <th>{{lang_trans('txt_idcard_num')}}</th>
                              <td>{{$data_row->idcard_no}}</td>
                            </tr>
                            <tr>
                              <th>{{lang_trans('txt_inv_applicable')}}</th>
                              <td>{{($data_row->invoice_num!='') ? 'Yes' : 'No'}}</td>
                              <th>{{lang_trans('txt_company_gst_num')}}</th>
                              <td>{{$data_row->company_gst_num}}</td>
                            </tr>
                            <tr>
                              <th>{{lang_trans('txt_booked_by')}}</th>
                              <td>{{$data_row->booked_by}}</td>
                              <th>{{lang_trans('txt_vehicle_number')}}</th>
                              <td>{{$data_row->vehicle_number}}</td>
                            </tr>
                             <tr>
                              <th>{{lang_trans('txt_referred_by')}}</th>
                              <td>{{$data_row->referred_by}}</td>
                              <th>{{lang_trans('txt_referred_by_name')}}</th>
                              <td>{{$data_row->referred_by_name}}</td>
                            </tr>
                             <tr>
                              <th>{{lang_trans('txt_payment_mode')}}</th>
                              <td>{{ @config('constants.PAYMENT_MODES')[$data_row->payment_mode]}}</td>
                              <th>{{lang_trans('txt_room_plan')}}</th>
                              <td>{{$data_row->room_plan}}</td>
                            </tr>
                            <tr>
                              <th>{{lang_trans('txt_event_type')}}</th>
                              <td colspan="3">{{$data_row->event_type}}</td>
                            </tr>
                             <tr>
                              <th>{{lang_trans('txt_remark_amount')}}</th>
                              <td colspan="3">{{$data_row->remark_amount}}</td>
                            </tr>
                             <tr>
                              <th>{{lang_trans('txt_remark')}}</th>
                              <td colspan="3">{{$data_row->remark}}</td>
                            </tr>
                          </table>
                        </div>
                           
                  </div>                  
              </div>
          </div>
      </div>
  </div>

  <div class="row">
      <div class="col-md-12 col-sm-12 col-xs-12">
          <div class="x_panel">
              <div class="x_title">
                  <h2>{{lang_trans('heading_person_info')}}</h2>
                  <div class="clearfix"></div>
              </div>
              <div class="x_content">
                  <div class="row">
                       <div class="col-md-12 col-sm-12 col-xs-12">
                          <table class="table table-bordered">
                            <tr>
                              <th>{{lang_trans('txt_sno')}}.</th>
                              <th>{{lang_trans('txt_name')}}</th>
                              <th>{{lang_trans('txt_gender')}}</th>
                              <th>{{lang_trans('txt_age')}}</th>
                              <th>{{lang_trans('txt_address')}}</th>
                              <th>{{lang_trans('txt_idcard_type')}}</th>
                              <th>{{lang_trans('txt_idcard_num')}}</th>
                            </tr>
                            @if($data_row->persons)
                              @foreach($data_row->persons as $k=>$val)
                                <tr>
                                  <td>{{$k+1}}</td>
                                  <td>{{$val->name}}</td>
                                  <td>{{$val->gender}}</td>
                                  <td>{{$val->age}}</td>
                                  <td>{{$val->address}}</td>
                                  <td>{{@getDynamicDropdownById($val->idcard_type, 'dropdown_value')}}</td>
                                  <td>{{$val->idcard_no}}</td>
                                </tr>
                              @endforeach
                            @else
                              <tr>
                                  <td colspan="7">{{lang_trans('txt_no_record')}}</td>
                              </tr>
                            @endif
                          </table>
                        </div>
                           
                  </div>                  
              </div>
          </div>
      </div>
  </div>

   <div class="row">
      <div class="col-md-12 col-sm-12 col-xs-12">
          <div class="x_panel">
              <div class="x_title">
                  <h2>{{lang_trans('txt_idcard_uploaded')}}</h2>
                  <div class="clearfix"></div>
              </div>
              <div class="x_content">
                  <div class="row">
                       <div class="col-md-12 col-sm-12 col-xs-12">
                          <table class="table table-bordered">
                            <tr>
                              <th>{{lang_trans('txt_sno')}}.</th>
                              <th>Name</th>
                              <th>{{lang_trans('txt_action')}}</th>
                            </tr>
                            @if($data_row->id_cards)
                              @foreach($data_row->id_cards as $k=>$val)
                                @if($val->file!='')
                                  <tr>
                                    <td>{{$k+1}}</td>
                                    <td> 
                                    {{ getDynamicDropdownList('type_of_ids')[$data_row->idcard_type] ?? '' }}
                                    </td>
                                    <td>
                                      <a href="{{ asset('public/uploads/id_cards/' . ($val->file ?? 'blank_id.jpg')) }}" 
                                        data-toggle="lightbox" 
                                        data-title="{{ lang_trans('txt_idcard') }}" 
                                        class="btn btn-sm btn-primary">
                                        <i class="fa fa-eye"></i>
                                      </a>
                                      <a href="{{ asset('public/uploads/id_cards/' . ($val->file ?? 'blank_id.jpg')) }}" class="btn btn-sm btn-success" download><i class="fa fa-download"></i> </a>
                                      <!-- <a href="{{checkFile($val->file,'uploads/id_cards/','blank_id.jpg')}}" data-toggle="lightbox"  data-title="{{lang_trans('txt_idcard')}}" data-footer="" class="btn btn-sm btn-primary"><i class="fa fa-eye"></i> </a> -->
                                      <!-- <a href="{{checkFile($val->file,'uploads/id_cards/','blank_id.jpg')}}" class="btn btn-sm btn-success" download><i class="fa fa-download"></i> </a> -->
                                    </td>
                                  </tr>
                                @endif
                              @endforeach
                            @else
                              <tr>
                                  <td colspan="2">{{lang_trans('txt_no_file')}}</td>
                              </tr>
                            @endif
                          </table>
                        </div>
                           
                  </div>                  
              </div>
          </div>
      </div>
  </div>

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
                            <td width="15%" class="text-right">{{getCurrencySymbol()}} {{ numberFormat($totalRoomAmount) }}</td>
                          </tr>
                          <tr>
                            <th class="text-right">{{lang_trans('txt_sgst')}} ({{$data_row->gst_perc}}%)</th>
                            <td width="15%" class="text-right">{{getCurrencySymbol()}} {{ numberFormat($roomAmountGst) }}</td>
                          </tr>
                          <tr class="{{$data_row->cgst_perc > 0 ? '' : 'hide_elem'}}">
                            <th class="text-right">{{lang_trans('txt_cgst')}} ({{$data_row->cgst_perc}}%)</th>
                            <td width="15%" id="td_advance_amount" class="text-right">{{getCurrencySymbol()}} {{ numberFormat($roomAmountCGst) }}</td>
                          </tr>
                          {{-- <tr>
                            <th class="text-right">{{lang_trans('txt_advance_amount')}}</th>
                            <td width="15%" id="td_advance_amount" class="text-right">{{getCurrencySymbol()}} {{ numberFormat($advancePayment) }}</td>
                          </tr> --}}
                          <tr>
                            <th class="text-right">{{lang_trans('txt_discount')}}</th>
                            <td width="15%" id="td_advance_amount" class="text-right">{{getCurrencySymbol()}} {{ numberFormat($roomAmountDiscount) }}</td>
                          </tr>
                          <tr class="bg-success">
                            <th class="text-right">{{lang_trans('txt_final_amount')}}</th>
                            <td width="15%" id="td_final_amount" class="text-right">{{getCurrencySymbol()}} {{ numberFormat($finalRoomAmount) }}</td>
                          </tr>
                        </table>
                        
                        @if($data_row->orders_items->isNotEmpty()) 
                        <div class="x_title">
                            <h2>{{lang_trans('txt_food_orders')}}</h2>
                            <div class="clearfix"></div>
                        </div>
                        
                        <table class="table table-bordered">
                            <tr>
                                <th>
                                    {{ lang_trans('txt_sl_no') }}
                                </th>
                                <!-- <th class="txt-center">
                                    {{ lang_trans('txt_category') }}
                                </th> -->
                                <th class="txt-center">
                                    {{lang_trans('txt_item_name')}}
                                </th>
                                <th class="txt-center">food detail</th>                                
                                <th class="txt-center">
                                    {{lang_trans('txt_date')}}
                                </th>
                                <th class="txt-center">
                                    Item Qty
                                </th>
                                <th class="txt-center">
                                    {{lang_trans('txt_item_price')}}
                                </th>
                                <th width="txt-center">
                                  {{lang_trans('txt_total_amount')}}
                                </th>                              

                            </tr>
                            @if($data_row->orders_items->count()>0)
                            @php
                                $totalOrdersAmount = 0;
                                $serialNo = 1; // Initialize serial number
                            @endphp

                            @foreach($data_row->orders_items->sortByDesc('id') as $val)
                                <tr>
                                  <td>{{ $serialNo++ }}</td> <!-- Serial Number --> 
                                  <!-- <td></td> -->
                                  <td>{{ $val->item_name }}</td>
                                  <td>
                                      <button 
                                          class="btn btn-xs btn-primary btn-view-food-items" 
                                          data-reservation-id="{{ $val->id }}" 
                                          data-toggle="modal" 
                                          data-target="#booked_food_{{$val->id}}">
                                          {{ lang_trans('btn_view') }}
                                      </button>
                                      @include('backend/model/booked_food_modal',['val' => $val])
                          
                                  </td>
                                  <td>{{ dateConvert($val->created_at,'d-m-Y') }}</td>
                                  <td>{{ $val->item_qty}}</td>              
                                  <td class="txt-right">
                                        {{ getCurrencySymbol() }} {{ numberFormat($val->item_price) }}
                                    </td>     
                                    <td class="txt-right"> {{ getCurrencySymbol() }} {{ numberFormat($val->item_price * $val->item_qty) }}</td>
                                </tr>
                                @php
                                    $totalOrdersAmount += ($val->item_qty * $val->item_price);
                                @endphp

                            @endforeach
                                <tr>
                                    <td colspan="7"> <b>Remark : </b>{{$val->remark}}</td>
                                </tr>
                            @endif
                        </table>
                        
                        <table class="table table-bordered">
                          <tr>
                            <th class="text-right">{{lang_trans('txt_subtotal')}}</th>
                            <td width="15%" class="text-right">{{getCurrencySymbol()}} {{ numberFormat($totalOrdersAmount) }}</td>
                          </tr>
                          <tr>
                            <th class="text-right">{{lang_trans('txt_sgst')}} ({{$orderGst}}%)</th>
                            <td width="15%" class="text-right">{{getCurrencySymbol()}} {{ numberFormat($totalOrderAmountGst) }}</td>
                          </tr>
                          <tr class="{{$orderCGst > 0 ? '' : 'hide_elem'}}">
                            <th class="text-right">{{lang_trans('txt_cgst')}} ({{$orderCGst}}%)</th>
                            <td width="15%" id="td_advance_amount" class="text-right">{{getCurrencySymbol()}} {{ numberFormat($totalOrderAmountCGst) }}</td>
                          </tr>
                          <tr>
                            <th class="text-right">{{lang_trans('txt_discount')}}</th>
                            <td width="15%" id="td_advance_amount" class="text-right">{{getCurrencySymbol()}} {{ numberFormat($totalOrderAmountDiscount)}}</td>
                          </tr>
                          <tr class="bg-success">
                            <th class="text-right">{{lang_trans('txt_final_amount')}}</th>
                            <td width="15%" id="td_final_amount" class="text-right">{{getCurrencySymbol()}} {{ numberFormat($finalOrderAmount) }}</td>
                          </tr>
                        </table>
                        @endif

                        <table class="table table-bordered">
                            <tr class="bg-default">
                              <th class="text-right">
                                {{ ($additionalAmountReason) ? $additionalAmountReason : lang_trans('txt_additional_amount_reason') }}
                              </th>
                              <td width="15%" class="text-right">
                               {{getCurrencySymbol()}} {{ numberFormat($additionalAmount) }}
                              </td>
                            </tr>
                        </table>

                        <table class="table table-bordered">
                          <tr class="bg-warning">
                            <th class="text-right">{{lang_trans('txt_grand_total')}}</th>
                            <td width="15%" class="text-right">{{getCurrencySymbol()}} {{ numberFormat($grandTotal) }}</td>
                          </tr>
                        </table>

                        <table class="table table-bordered">
                          <tr class="bg-default">
                            <th class="text-right">{{lang_trans('txt_advance_amount')}}</th>
                            <td width="15%" id="td_advance_amount" class="text-right">{{getCurrencySymbol()}} {{ numberFormat($advancePayment) }}</td>
                          </tr>
                        </table>

                        <table class="table table-bordered">
                          <tr class="bg-danger">
                            <th class="text-right">{{lang_trans('txt_balance_due')}}</th>
                            <td width="15%" id="td_advance_amount" class="text-right">{{getCurrencySymbol()}} {{ numberFormat($balanceDue) }}</td>
                          </tr>
                        </table>
                        <hr>
                        <div class="row">
                          <div class="col-md-12 col-sm-12 col-xs-12 text-right">                  
                            <div class="d-flex justify-content-end mt-3">
                              <button class="btn btn-sm btn-success no-print me-2" onclick="printSlip()">
                                {{ lang_trans('btn_print') }}
                              </button>
                              <button class="btn btn-sm btn-success no-print" onclick="downloadInvoice()">
                                {{ lang_trans('txt_download') }}
                              </button>
                            </div>
                          </div>       
                        </div>
                      </div>
                  </div>
              </div>
          </div>
      </div>
  </div>
</div>   
    <script type="text/javascript" src="{{ URL::asset('public/js/page_js/page.js') }}"></script> 
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.5.1/jspdf.umd.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/html2canvas/1.4.1/html2canvas.min.js"></script>
    <script>
    function downloadInvoice() {
        const { jsPDF } = window.jspdf;
        let doc = new jsPDF('p', 'mm', 'a4'); // Create a new PDF document
        // Get the invoice ID from a hidden field or data attribute
        let invoiceId = "{{ $data_row->id }}"; // Laravel blade syntax to pass ID
        // Capture the invoice content
        html2canvas(document.body, {
            scale: 2
        }).then(canvas => {
            let imgData = canvas.toDataURL('image/png');
            let imgWidth = 210; // A4 width in mm
            let pageHeight = 297; // A4 height in mm
            let imgHeight = (canvas.height * imgWidth) / canvas.width;
            let position = 10;

            // Add the image to the PDF
            doc.addImage(imgData, 'PNG', 0, position, imgWidth, imgHeight);
            doc.save(`kot_no_${invoiceId}.pdf`);
        });
    }
</script>
@endsection