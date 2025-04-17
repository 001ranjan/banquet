@extends('layouts.master_backend')
@section('content')
  <link rel="stylesheet" href="{{URL::asset('public/assets/fullcalendar/main.css')}}">
  <script type="text/javascript" src="{{URL::asset('public/assets/fullcalendar/main.js')}}"></script>    
  <script type="text/javascript" src="{{URL::asset('public/assets/fullcalendar/locales-all.min.js')}}"></script>    
  
  <div class="">
    @section('rightColContent')
        <div class="row top_tiles">
          @if(isPermission('dashboard-total-today-checkins'))
            <div class="animated flipInY col-lg-3 col-md-3 col-sm-6 col-xs-12">
                <div class="tile-stats">
                    <div class="icon">
                      <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 60 60" stroke-width="1.5" stroke="currentColor" class="size-6">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M9 12.75 11.25 15 15 9.75M21 12c0 1.268-.63 2.39-1.593 3.068a3.745 3.745 0 0 1-1.043 3.296 3.745 3.745 0 0 1-3.296 1.043A3.745 3.745 0 0 1 12 21c-1.268 0-2.39-.63-3.068-1.593a3.746 3.746 0 0 1-3.296-1.043 3.745 3.745 0 0 1-1.043-3.296A3.745 3.745 0 0 1 3 12c0-1.268.63-2.39 1.593-3.068a3.745 3.745 0 0 1 1.043-3.296 3.746 3.746 0 0 1 3.296-1.043A3.746 3.746 0 0 1 12 3c1.268 0 2.39.63 3.068 1.593a3.746 3.746 0 0 1 3.296 1.043 3.746 3.746 0 0 1 1.043 3.296A3.745 3.745 0 0 1 21 12Z" />
                      </svg>
                    </div>
                    <div class="count">{{$counts[0]->today_check_ins}}</div>
                    <h4>&nbsp;<a href="{{route('list-reservation')}}">{{lang_trans('txt_today_checkin')}}</a></h4>
                    <p>&nbsp;</p>
                </div>
            </div>
          @endif
          {{-- @if(isPermission('dashboard-total-today-checkouts'))
            <div class="animated flipInY col-lg-3 col-md-3 col-sm-6 col-xs-12">
                <div class="tile-stats">
                    <div class="icon">
                        <i class="fa fa-comments-o"></i>
                    </div>
                    <div class="count">{{$counts[0]->today_check_outs}}</div>
                    <h4>&nbsp;<a href="{{route('list-check-outs')}}">{{lang_trans('txt_today_checkout')}}</a></h4>
                    <p>&nbsp;</p>
                </div>
            </div>
          @endif --}}
          {{-- @if(isPermission('dashboard-total-today-checkouts')) --}}
            <div class="animated flipInY col-lg-3 col-md-3 col-sm-6 col-xs-12">
                <div class="tile-stats">
                    <div class="icon">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 60 60" stroke-width="1.5" stroke="currentColor" class="size-6">
                          <path stroke-linecap="round" stroke-linejoin="round" d="M7.5 8.25h9m-9 3H12m-9.75 1.51c0 1.6 1.123 2.994 2.707 3.227 1.129.166 2.27.293 3.423.379.35.026.67.21.865.501L12 21l2.755-4.133a1.14 1.14 0 0 1 .865-.501 48.172 48.172 0 0 0 3.423-.379c1.584-.233 2.707-1.626 2.707-3.228V6.741c0-1.602-1.123-2.995-2.707-3.228A48.394 48.394 0 0 0 12 3c-2.392 0-4.744.175-7.043.513C3.373 3.746 2.25 5.14 2.25 6.741v6.018Z" />
                        </svg>
                    </div>
                    <div class="count">0</div>
                    <h4>&nbsp;<a href="javascript:void(0);">{{ lang_trans("txt_today_lead") }}</a></h4>
                    <p>&nbsp;</p>
                </div>
            </div>
          {{-- @endif --}}
          @if(isPermission('dashboard-total-today-orders'))
            <div class="animated flipInY col-lg-3 col-md-3 col-sm-6 col-xs-12">
                <div class="tile-stats">
                    <div class="icon">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 60 60" stroke-width="1.5" stroke="currentColor" class="size-6">
                      <path stroke-linecap="round" stroke-linejoin="round" d="M13.5 21v-7.5a.75.75 0 0 1 .75-.75h3a.75.75 0 0 1 .75.75V21m-4.5 0H2.36m11.14 0H18m0 0h3.64m-1.39 0V9.349M3.75 21V9.349m0 0a3.001 3.001 0 0 0 3.75-.615A2.993 2.993 0 0 0 9.75 9.75c.896 0 1.7-.393 2.25-1.016a2.993 2.993 0 0 0 2.25 1.016c.896 0 1.7-.393 2.25-1.015a3.001 3.001 0 0 0 3.75.614m-16.5 0a3.004 3.004 0 0 1-.621-4.72l1.189-1.19A1.5 1.5 0 0 1 5.378 3h13.243a1.5 1.5 0 0 1 1.06.44l1.19 1.189a3 3 0 0 1-.621 4.72M6.75 18h3.75a.75.75 0 0 0 .75-.75V13.5a.75.75 0 0 0-.75-.75H6.75a.75.75 0 0 0-.75.75v3.75c0 .414.336.75.75.75Z" />
                    </svg>
                    </div>
                    <div class="count">{{$counts[0]->today_orders}}</div>
                    <h4>&nbsp;<a href="{{route('orders-list')}}">{{lang_trans('txt_today_orders')}}</a></h4>
                    <p>&nbsp;</p>
                </div>
            </div>
          @endif
          <div class="animated flipInY col-lg-3 col-md-3 col-sm-6 col-xs-12">
              <div class="tile-stats">
                <h3><a href="javascript:void(0);" class="count" id="current-time"></a></h3>
                <h4><a href="#">&nbsp;&nbsp;{{date("d F Y")}}</a></h4>
                <p>&nbsp;</p>
              </div>
          </div>
        </div>
    @endsection
    @if(isPermission('dashboard-booking-cal'))
      <div class="row">
        <div class="col-md-12 col-sm-12 col-xs-12">
            <div class="x_panel">
                <div class="x_content">
                     <div id='calendar'></div>
                </div>
            </div>
        </div>
      </div>
    @endif

    <div class="row">
        <div class="col-md-6 col-sm-6 col-xs-12">
          @if(isPermission('dashboard-latest-food-orders'))
            <!-- <div class="row">
                <div class="col-md-12 col-sm-12 col-xs-12">
                    <div class="x_panel">
                        <div class="x_title">
                            <div class="col-sm-12">
                                <div class="col-sm-4 p-left-0">
                                  <h2>{{lang_trans('txt_latest_orders')}}</h2>
                                </div>
                                <div class="col-sm-8 text-right">
                                  <a href="{{route('food-order')}}" class="btn btn-success">{{lang_trans('txt_add_new_orders')}}</a>
                                  <a href="{{route('orders-list')}}" class="btn btn-info">{{lang_trans('btn_view_all')}}</a>
                                </div>
                            </div>
                            <div class="clearfix"></div>
                        </div>
                        <div class="x_content">
                            @foreach($orders as $k=>$val)
                                @php
                                  $totalAmount = 0.00;
                                @endphp
                                @if($val->order_history)
                                    @foreach($val->order_history as $key_OH=>$val_OH)
                                        @if($val_OH->orders_items)
                                            @foreach($val_OH->orders_items as $key_OI=>$val_OI)
                                                @php
                                                  $price = $val_OI->item_price*$val_OI->item_qty;
                                                  $totalAmount = $totalAmount+$price;
                                                  $totalAmmountsArr[$val->id] = $totalAmount;
                                                @endphp
                                            @endforeach
                                        @endif
                                    @endforeach
                                @endif
                            @endforeach
                            <table  class="table table-striped table-bordered">
                              <thead>
                                <tr>
                                  <th>{{lang_trans('txt_sno')}}</th>
                                  <th>{{lang_trans('txt_customer_name')}}</th>
                                  <th>{{lang_trans('txt_table_num')}}</th>
                                  <th>{{lang_trans('txt_order_amount')}}</th>
                                  <th>{{lang_trans('txt_action')}}</th>
                                </tr>
                              </thead>
                              <tbody>
                                @foreach($orders as $k=>$val)
                                  <tr>
                                    <td>{{$k+1}}</td>
                                    <td>{{$val->name}}</td>
                                    <td>{{$val->table_num}}</td>
                                    <td>{{getCurrencySymbol()}} {{@$totalAmmountsArr[$val->id]}}</td>
                                    <td>
                                        <a class="btn btn-sm btn-success" href="{{route('food-order-table',[$val->id])}}">{{lang_trans('btn_repeat_order')}}</i></a>
                                        <button type="button" class="btn btn-primary btn-sm" data-toggle="modal" data-target=".view_modal_{{$k}}">{{lang_trans('btn_view_order')}}</button>
                                        <a class="btn btn-sm btn-warning" href="{{route('food-order-final',[$val->id])}}" target="_blank">{{lang_trans('btn_pay')}}</i></a>

                                        <div class="modal fade view_modal_{{$k}}" tabindex="-1" role="dialog" aria-hidden="true">
                                            <div class="modal-dialog modal-lg">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span></button>
                                                        <h4 class="modal-title" id="myModalLabel">{{lang_trans('txt_order_details')}}: ({{lang_trans('txt_table_num')}}- #{{$val->table_num}})</h4>
                                                    </div>
                                                    <div class="modal-body">
                                                       <table  class="table table-striped table-bordered">
                                                            <tr>
                                                                <th>{{lang_trans('txt_sno')}}</th>
                                                                <th>{{lang_trans('txt_datetime')}}</th>
                                                                <th>{{lang_trans('txt_orderitem_qty')}}</th>
                                                            </tr>
                                                            @if($val->order_history)
                                                                @foreach($val->order_history as $key_OH=>$val_OH)
                                                                    <tr>
                                                                      <td>{{$key_OH+1}}</td>
                                                                      <td>{{$val_OH->created_at}}</td>
                                                                      <td>
                                                                        @if($val_OH->orders_items)
                                                                            <table class="table table-bordered">
                                                                                @foreach($val_OH->orders_items as $key_OI=>$val_OI)
                                                                                    @php
                                                                                        $price = $val_OI->item_price*$val_OI->item_qty;
                                                                                        $totalAmount = $totalAmount+$price;
                                                                                    @endphp
                                                                                    <tr>
                                                                                        <td>{{$val_OI->item_name}}</td>
                                                                                        <td>{{$val_OI->item_qty}}</td>
                                                                                    </tr>
                                                                                @endforeach
                                                                            </table>
                                                                        @endif
                                                                      </td>
                                                                    </tr>
                                                                @endforeach
                                                            @endif
                                                          </table>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </td>
                                  </tr>
                                @endforeach
                              </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div> -->
          @endif 
          @if(isPermission('dashboard-room-list')) 
            <div class="row">
                <div class="col-md-12 col-sm-12 col-xs-12">
                    <div class="x_panel">
                        <div class="x_title">
                          <h2>{{lang_trans('txt_room')}}</h2>
                          <div class="clearfix"></div>
                        </div>
                        <div class="x_content">
                            <table id="datatable_" class="table table-striped table-bordered">
                              <thead>
                                <tr>
                                  <th>{{lang_trans('txt_sno')}}</th>
                                  <th>{{lang_trans('txt_title')}}</th>
                                  <th>{{lang_trans('txt_max_capacity')}}</th>
                                  <th>{{lang_trans('txt_base_price')}}</th>
                                  <th>{{lang_trans('txt_room')}}</th>
                                </tr>
                              </thead>
                              <tbody>
                                @foreach($room_types as $key=>$val)
                                  <tr>
                                    <td>{{$key+1}}</td>
                                    <td>{{$val->title}}</td>
                                    <td>{{lang_trans('txt_adults')}}: {{$val->adult_capacity}}</td>
                                    <td>{{getCurrencySymbol()}} {{$val->base_price}}</td>
                                    <td>
                                        @if($val->rooms->count())
                                          <table class="table table-striped table-bordered">
                                            <thead>
                                              <tr>
                                                <th>{{lang_trans('txt_sno')}}</th>
                                                <th>{{lang_trans('txt_room_num')}}</th>
                                                <th>{{lang_trans('txt_floor')}}</th>
                                              </tr>
                                            </thead>
                                            <tbody>
                                              @foreach($val->rooms as $k=>$v)
                                                <tr>
                                                  <td>{{$k+1}}</td>
                                                  <td>{{$v->room_no}}</td>
                                                  <td>{{getDynamicDropdownById($v->floor, 'dropdown_value')}}</td>
                                                </tr>
                                              @endforeach
                                            </tbody>
                                          </table>
                                        @else
                                          {{lang_trans('txt_no_rooms')}}
                                          <a class="btn btn-xs btn-success" href="{{route('add-room')}}">{{lang_trans('txt_add_new_rooms')}}</a>
                                        @endif
                                    </td>
                                  </tr>
                                @endforeach
                              </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div> 
          @endif  
        </div>
        <div class="col-md-6 col-sm-6 col-xs-12">
          @if(isPermission('dashboard-product-stocks')) 
            <div class="row">
                <div class="col-md-12 col-sm-12 col-xs-12">
                    <div class="x_panel">
                        <div class="x_title">
                            <div class="col-sm-8 p-left-0">
                              <h2>{{lang_trans('txt_product_stocks')}}</h2>
                            </div>
                            <div class="col-sm-4 text-right">
                              <a href="{{route('list-product')}}" class="btn btn-info">{{lang_trans('btn_view_all')}}</a>
                            </div>
                            <div class="clearfix"></div>
                        </div>
                        <div class="x_content">
                          <table id="datatable_" class="table table-striped table-bordered">
                            <thead>
                              <tr>
                                <th>{{lang_trans('txt_sno')}}</th>
                                <th>{{lang_trans('txt_product')}}</th>
                                <th>{{lang_trans('txt_current_stocks')}}</th>
                                <th>{{lang_trans('txt_unit')}}</th>
                              </tr>
                            </thead>
                            <tbody>
                              @foreach($products as $k=>$val)
                                <tr>
                                  <td>{{$k+1}}</td>
                                  <td>{{$val->name}}</td>
                                  <td class="{{stockInfoColor($val->stock_qty)}}">{{$val->stock_qty}}</td>
                                  <td>{{getDynamicDropdownById($val->measurement, 'dropdown_value')}}</td>
                                </tr>
                              @endforeach
                            </tbody>
                          </table>
                        </div>
                    </div>
                </div>
            </div>
          @endif
        </div>
    </div>
</div>
{{-- require set var in js var --}}
<script>
  globalVar.page = 'dashboard_page';

  // Function to update the clock
  function updateClock() {
      const now = new Date();
      const hours = now.getHours();
      const minutes = now.getMinutes();
      const seconds = now.getSeconds();
      const amPm = hours >= 12 ? 'PM' : 'AM';

      // Format time with leading zeros
      const formattedTime = `${hours % 12 || 12}:${minutes.toString().padStart(2, '0')} ${amPm}`;
      document.getElementById('current-time').textContent = formattedTime;
    }

    // Call updateClock every second
    setInterval(updateClock, 1000);

    // Initialize the clock immediately
    updateClock();
</script> 
<script type="text/javascript" src="{{URL::asset('public/js/page_js/page.js')}}"></script>
@endsection