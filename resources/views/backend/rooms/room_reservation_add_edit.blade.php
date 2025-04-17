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

  @endphp
<div>

    {{ Form::open(array('url' => route('room-reservation', ['step'=>2]),'method'=>'GET', 'class'=>"form-horizontal form-label-left")) }}
      <div class="row">
        <div class="col-md-12 col-sm-12 col-xs-12">
            <div class="x_panel">
                <div class="x_title">
                    <h2>{{lang_trans('heading_checkin_info')}}</h2>
                    <div class="clearfix"></div>
                </div>
                <div class="x_content">
                    <div class="row">
                      <div class="row d-flex align-items-center">
                        <div class="col-md-2 col-sm-4 col-xs-6">
                            <label class="control-label"> {{lang_trans('btn_checkin')}}<span class="required">*</span></label>
                            {{ Form::text('check_in_date', null, [
                                'class' => "form-control",
                                'id' => "check_in_date",
                                'placeholder' => lang_trans('ph_date'),
                                'autocomplete' => "off"
                            ]) }}
                        </div>
                        <div class="col-md-2 col-sm-4 col-xs-6">
                            <label class="control-label"> {{lang_trans('btn_checkout')}} <span class="required">*</span></label>
                            {{ Form::text('check_out_date', null, [
                                'class' => "form-control",
                                'id' => "check_out_date",
                                'placeholder' => lang_trans('ph_date'),
                                'autocomplete' => "off"
                            ]) }}
                        </div>
                        <div class="col-md-2 col-sm-4 col-xs-6">
                            <label class="control-label"> {{ lang_trans('txt_event_type') }} <span class="required">*</span></label>
                            {{ Form::select('event_type', [
                                '' => 'Select Event Type',
                                'conference' => 'Conference',
                                'wedding' => 'Wedding',
                                'party' => 'Party',
                                'meeting' => 'Meeting'
                            ], null, ['class' => "form-control", "id" => "event_type"]) }}
                        </div>
                        {{ Form::hidden('duration_of_stay', 1, ['id' => 'duration_of_stay']) }}
                        <div class="col-md-2 col-sm-4 col-xs-6">
                            <label class="control-label"> {{lang_trans('txt_adults')}} <span class="required">*</span></label>
                            {{Form::number('adult','',[
                                'class'=>"form-control",
                                "id"=>"adult",
                                "required"=>"required",
                                "placeholder"=>lang_trans('ph_enter').lang_trans('txt_adults'),
                                "min"=>1
                            ])}}
                        </div>
                        {{ Form::hidden('kids', 0, ['id' => 'kids']) }}
                      </div>
                    </div>
                    <div class="ln_solid"></div>
                    <div class="col-md-12 col-sm-12 col-xs-12 text-right">
                        <button id="add-reservation-form", class="btn btn-success btn-submit-form" >{{lang_trans('btn_view_venue')}}</button>
                   
                    </div>
                </div>
            </div>
        </div>
      </div> 
      
<div id="selected-info-section" style="display: none">   
  <div class="row" id="room_list_section">
    <div class="col-md-12 col-sm-12 col-xs-12">
        <div class="x_panel">
          <div class="x_title">
            <h2>{{lang_trans('txt_select_rooms')}}</h2>
            <div class="clearfix"></div>
          </div>

            <div class="x_content">
              <div class="row">
                @foreach($roomlist as $k => $val)
                  <div class="panel-group">
                    <div class="panel panel-default">
                      <div class="panel-heading">
                        <h4 class="panel-title">
                          <i class="fa fa-list"></i>
                          <a data-toggle="collapse" href="#collapse{{$k}}">{{$val['title']}} ({{ lang_trans('txt_capacity') }}: {{$val['adult_capacity']}} Max)</a>
                          <span class="float-right text-danger">
                            <b>{{getCurrencySymbol()}} {{$val['total_price']}}</b> / {{lang_trans('txt_per_room')}}
                            <sup><a class="cursor-pointer" data-toggle="modal" data-target="#room_price_model_{{$k}}">{{lang_trans('btn_price_break')}}</a></sup>
                          </span>
                        </h4>
                        @include('backend/model/room_price_info_model',['list' => $val['dates_with_price'], 'total' => $val['total_price'], 'key' => $k])
                      </div>
                      <div id="collapse{{$k}}" class="panel-collapse">
                        <table class="table table-striped table-bordered">
                          <thead>
                            <tr>
                              <th width="2%">{{lang_trans('txt_select')}}</th>
                              <th width="20%">
                                {{ $val['is_type'] == 'room' ? lang_trans('txt_room_num') : lang_trans('txt_hall_num') }}
                              </th>
                              <th>{{lang_trans('txt_status')}}</th>
                            </tr>
                          </thead>
                          <tbody>
                            @forelse($val['rooms'] as $room)
                              @php
                                $isRoomBooked = in_array($room->id, $booked_rooms) ? true : false;
                              @endphp
                              <tr>
                                <td class="text-center">
                                  {{ Form::checkbox('room_num[]', $room->room_type_id.'~'.$room->id , false ,['id' => 'apply_invoice', 'class' => 'room_checkbox', 'data-roomid' => $room->id, 'disabled' => $isRoomBooked, 'readonly' => $isRoomBooked]) }}
                                </td>
                                <td>{{$room->room_no}}</td>
                                <td>
                                  @if($isRoomBooked)
                                    <span class="btn btn-xs btn-cust">{{lang_trans('txt_booked')}}</span>
                                  @else
                                    <span class="btn btn-xs btn-success">{{lang_trans('txt_available')}}</span>
                                  @endif
                                </td>
                              </tr>
                            @empty
                            @endforelse
                          </tbody>
                        </table>
                      </div>
                    </div>
                  </div>
                @endforeach
              </div>
              <div class="ln_solid"></div>
                <div class="col-md-12 col-sm-12 col-xs-12 text-right">
                  <button class="btn btn-success btn-submit-form" type="submit">{{lang_trans('btn_next')}}</button>
                </div>
            </div>
        </div>
    </div>
  </div>
</div>
{{ Form::close() }}

</div>
{{-- require set var in js var --}}
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
<script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
<script>
  globalVar.page = 'room_reservation_add';
  globalVar.customerList = {!! json_encode($customer_list) !!};

</script> 
<script type="text/javascript" src="{{URL::asset('public/js/page_js/page.js')}}"></script> 
<!-- JavaScript -->
<script>
    document.addEventListener("DOMContentLoaded", function () {
        document.getElementById("add-reservation-form").addEventListener("click", function (event) {
            event.preventDefault(); // Prevent form submission

            let checkInDate = document.getElementById("check_in_date").value.trim();
            let checkOutDate = document.getElementById("check_out_date").value.trim();
            let eventType = document.getElementById("event_type").value.trim();
            let durationOfStay = document.getElementById("duration_of_stay").value.trim();

            // Validation: Check if required fields are filled
            if (checkInDate === "" || checkOutDate === "" || eventType === "" || durationOfStay === "") {
                alert("Please fill in all required fields before proceeding.");
                return;
            }

            // If all fields are filled, show the selected-info-section
            document.getElementById("selected-info-section").style.display = "block";
        });
    });
</script>
@endsection