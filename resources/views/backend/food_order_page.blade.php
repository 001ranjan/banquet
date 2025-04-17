@extends('layouts.master_backend')
@section('content')
@php 
    $reservationId = Request::route('reservation_id');
    $i = 1; 
    $settings = getSettings();
    $gstPercFood = $settings['food_gst'];
    $cgstPercFood = $settings['food_cgst'];
@endphp
<Style>
  .filter-button.active {
      background-color: #007bff;
      color: white;
  }

  .filter-button {
      cursor: pointer;
  }

  .food-indicator {
      display: inline-block;
      width: 10px;
      height: 10px;
      border-radius: 50%;
      margin-right: 8px;
  }

  .food-indicator.veg {
      background-color: green; /* Green for Veg */
  }

  .food-indicator.non-veg {
      background-color: red; /* Red for Non-Veg */
  }
</Style>
<div class="">
  {{ Form::open(array('url'=>route('save-food-order'),'id'=>"food-order-form", 'class'=>"form-horizontal form-label-left",'files'=>true)) }}
  {{Form::hidden('gst_perc',$gstPercFood)}}
  {{Form::hidden('cgst_perc',$cgstPercFood)}}
  
    @if($reservationId==null)
    <div class="row {{($reservationId>0) ? 'hide_elem' : ''}}" id="new_guest_section">
        <div class="col-md-12 col-sm-12 col-xs-12">
            <div class="x_panel">
                <div class="x_title">
                    <h2>{{lang_trans('heading_customer_info')}}</h2>
                    <div class="clearfix"></div>
                </div>
                <div class="x_content"> 
                  <div class="row">
                    <div class="col-md-4 col-sm-4 col-xs-12">
                      <label class="control-label"> {{lang_trans('txt_fullname')}} </label>
                      {{Form::text('name',null,['class'=>"form-control col-md-6 col-xs-12", "id"=>"name", "placeholder"=>lang_trans('ph_enter').lang_trans('txt_fullname')])}}
                    </div>
                   <div class="col-md-4 col-sm-4 col-xs-12">
                      <label class="control-label"> {{lang_trans('txt_email')}} </label>
                      {{Form::email('email',null,['class'=>"form-control col-md-6 col-xs-12", "id"=>"email", "placeholder"=>lang_trans('ph_enter').lang_trans('txt_email')])}}
                    </div>
                    <div class="col-md-4 col-sm-4 col-xs-12">
                      <label class="control-label"> {{lang_trans('txt_mobile_num')}} </label>
                      {{Form::text('mobile',null,['class'=>"form-control col-md-6 col-xs-12", "id"=>"mobile", "placeholder"=>lang_trans('ph_enter').lang_trans('txt_mobile_num')])}}
                    </div>
                    <div class="col-md-4 col-sm-4 col-xs-12">
                      <label class="control-label"> {{lang_trans('txt_address')}} </label>
                      {{Form::textarea('address',null,['class'=>"form-control col-md-6 col-xs-12", "id"=>"address", "placeholder"=>lang_trans('ph_enter').lang_trans('txt_address'),"rows"=>1])}}
                    </div>
                    <div class="col-md-4 col-sm-4 col-xs-12">
                      <label class="control-label"> {{lang_trans('txt_table_num')}} </label>
                      {{Form::select('table_num',getTableNums(),null,['class'=>"form-control col-md-6 col-xs-12", "id"=>"table_num", "placeholder"=>lang_trans('ph_select'), "required"=>true])}}
                    </div>
                    <div class="col-md-4 col-sm-4 col-xs-12">
                      <label class="control-label"> {{lang_trans('txt_num_of_persons')}} </label>
                      {{Form::text('num_of_person',null,['class'=>"form-control col-md-6 col-xs-12", "id"=>"num_of_person", "placeholder"=>lang_trans('ph_enter').lang_trans('txt_num_of_persons')])}}
                    </div>
                    <div class="col-md-4 col-sm-4 col-xs-12">
                      <label class="control-label"> {{lang_trans('txt_waiter_name')}} </label>
                      {{Form::text('waiter_name',null,['class'=>"form-control col-md-6 col-xs-12", "id"=>"waiter_name", "placeholder"=>lang_trans('ph_enter').lang_trans('txt_waiter_name')])}}
                    </div>
                  </div>
                </div>
            </div>
        </div>
    </div>
    @endif
    
  <div class="row">
      <div class="col-md-12 col-sm-12 col-xs-12">
          <div class="x_panel">
              <div class="x_title">
                  <h2>{{lang_trans('heading_food_item')}}</h2>
                  <div class="clearfix"></div>
              </div>
              <div class="x_content">                
                  @if($categories->count())
                    <div class="row mb-3">
                        <div class="col-md-4 col-sm-4 col-xs-12">
                            <input type='text' id='txt_searchall' placeholder='Search Items...' class="form-control">
                        </div>
                        <div class="col-md-4 col-sm-4 col-xs-12">
                          <div class="btn-group" role="group">
                              <button type="button" class="btn btn-outline-primary filter-button active" data-filter="all">All</button>
                              <button type="button" class="btn btn-outline-success filter-button" data-filter="veg">Veg</button>
                          </div>
                        </div>
                        <div class="col-md-4 col-sm-4 col-xs-12 text-right">
                            <button class="btn btn-success" type="submit">{{ lang_trans('btn_submit') }}</button>
                        </div>
                    </div>
                    <br/>
                  @endif

                  {{ Form::hidden('reservation_id', $reservationId) }}

                  <table id="datatable__" class="table table-bordered">
                    @if($categories_tree->isEmpty())
                        <tr>
                            <td colspan="4">
                                @can('add-food-category')
                                    <a class="btn btn-sm btn-danger" href="{{ route('add-food-category') }}" target="_blank">
                                        <i class="fa fa-plus"></i>&nbsp;{{ lang_trans('sidemenu_foodcat_add') }}
                                    </a>
                                @endcan
                                @can('add-food-item')
                                    <a class="btn btn-sm btn-primary" href="{{ route('add-food-item') }}" target="_blank">
                                        <i class="fa fa-plus"></i>&nbsp;{{ lang_trans('sidemenu_fooditem_add') }}
                                    </a>
                                @endcan
                            </td>
                        </tr>
                    @endif
                
                    @foreach($categories_tree as $category)
                        @include('backend.partials.food_category_tree', ['category' => $category, 'level' => 0])
                    @endforeach
                </table>
              </div>

              <div class="row">
                <div class="col-md-12 col-sm-12 col-xs-12">
                  <div class="x_panel">
                    <div class="x_title">
                      <h2>{{lang_trans('heading_special_requirement')}}</h2>
                      <div class="clearfix"></div>
                    </div>
                    <div class="x_content">
                      
                      {{-- Add Special Row Starts Here --}}
                      <div class="special_row_parent">
                        <div class="row special_row_elem">
                          <div class="col-md-2 col-sm-2 col-xs-12">
                            <label class="control-label"> {{lang_trans('sidemenu_fooditem_name')}} </label>
                            {{Form::text('special_requirement[name][]',null,['class'=>"form-control col-md-6 col-xs-12", "id"=>"person_name", "placeholder"=>lang_trans('sidemenu_fooditem_name')])}}
                          </div>
                          <div class="col-md-2 col-sm-2 col-xs-12">
                            <label class="control-label"> {{lang_trans('sidemenu_select_category')}} </label>
                            <select name="special_requirement[category_id][]" class="form-control col-md-6 col-xs-12">
                              <option value="">{{ lang_trans('ph_select') }}</option>
                              @foreach ($category_tree as $category)
                                <option value="{{ $category['id'] }}">{{ $category['name'] }}</option>
                              @endforeach
                            </select>
                          </div>
                          <div class="col-md-2 col-sm-2 col-xs-12">
                            <label class="control-label"> {{lang_trans('txt_type')}} </label>
                            {{ Form::select('special_requirement[type][]', ['Veg' => 'Veg', 'Non-Veg' => 'Non-Veg'], null, ['class' => 'form-control col-md-6 col-xs-12', 'id' => 'type', 'placeholder' => lang_trans('ph_select')]) }}
                          </div>
                          <div class="col-md-2 col-sm-2 col-xs-12">
                            <label class="control-label"> {{lang_trans('txt_price')}} </label>
                            {{Form::number('special_requirement[price][]',null,['class'=>"form-control col-md-6 col-xs-12", "id"=>"price", "placeholder"=>lang_trans('txt_price')])}}
                          </div>
                          <div class="col-md-1 col-sm-1 col-xs-12"> 
                            <label class="control-label"> &nbsp;</label><br/>
                            <button type="button" class="btn btn-success add-special-row"><i class="fa fa-plus"></i></button>
                          </div>
                        </div>
                      </div>
                      {{-- Add Special Row Ends Here --}}

                    </div>
                  </div>
                </div>
              </div>

              {{-- Delete Special Row Starts Here --}}
              <div class="colne_special_row_elem" style="display: none;">
                <div class="row special_row_elem">
                  <div class="col-md-2 col-sm-2 col-xs-12">
                    {{Form::text('special_requirement[name][]',null,['class'=>"form-control col-md-6 col-xs-12", "id"=>"person_name", "placeholder"=>lang_trans('sidemenu_fooditem_name')])}}
                  </div>
                  <div class="col-md-2 col-sm-2 col-xs-12">
                    <select name="special_requirement[category_id][]" class="form-control col-md-6 col-xs-12">
                      <option value="">{{ lang_trans('ph_select') }}</option>
                      @foreach ($category_tree as $category)
                        <option value="{{ $category['id'] }}">{{ $category['name'] }}</option>
                      @endforeach
                    </select>
                  </div>
                  <div class="col-md-2 col-sm-2 col-xs-12">
                    {{ Form::select('special_requirement[type][]', ['Veg' => 'Veg', 'Non-Veg' => 'Non-Veg'], null, ['class' => 'form-control col-md-6 col-xs-12', 'id' => 'type', 'placeholder' => lang_trans('ph_select')]) }}
                  </div>
                  <div class="col-md-2 col-sm-2 col-xs-12">
                    {{Form::number('special_requirement[price][]',null,['class'=>"form-control col-md-6 col-xs-12", "id"=>"price", "placeholder"=>lang_trans('txt_price')])}}
                  </div>
                  <div class="col-md-1 col-sm-1 col-xs-12"> 
                    <button type="button" class="btn btn-danger delete-special-row"><i class="fa fa-minus"></i></button>
                  </div>
                </div>
              </div>
              {{-- Delete Special Row Ends Here --}}

              <div class="col-md-12 col-sm-12 col-xs-12">
                <label class="control-label"> {{lang_trans('txt_remark')}} </label>
                {{Form::textarea('remarks',null,['class'=>"form-control col-md-12 col-xs-12", "id"=>"remarks", "rows" => 3, "placeholder"=>lang_trans('txt_remark')])}}
              </div>

          </div>
      </div>
  </div>
 
    <div class="row {{(1==1) ? 'hide_elem' : ''}}">
      <div class="col-md-12 col-sm-12 col-xs-12">
        <div class="x_panel">
          <div class="x_content">
             <table class="table table-bordered">
                  <tr>
                    <th class="text-right">{{lang_trans('txt_inv_applicable')}}</th>
                    <td width="15%" id="td_invoice_apply" class="text-right">{{ Form::checkbox('food_invoice_apply',null,false ,['id'=>'apply_invoice']) }}</td>
                  </tr>
                   <tr>
                    <th class="text-right">{{lang_trans('txt_gst_apply')}}</th>
                    <td width="15%" id="td_gst_apply" class="text-right">{{ Form::checkbox('food_gst_apply',0,false ,['id'=>'apply_gst']) }}</td>
                  </tr>
                  <tr>
                    <th class="text-right">{{lang_trans('txt_subtotal')}} {{Form::hidden('subtotal_amount',null,['id'=>'subtotal_amount'])}}</th>
                    <td width="15%" id="td_subtotal_amount" class="text-right">{{getCurrencySymbol()}} 0.00</td>
                  </tr>
                  <tr>
                    <th class="text-right">{{lang_trans('txt_sgst')}} ({{$gstPercFood}}%) {{Form::hidden('gst_amount',null,['id'=>'gst_amount'])}}</th>
                    <td width="15%" id="td_gst_amount" class="text-right">{{getCurrencySymbol()}} 0.00</td>
                  </tr>
                  <tr class="{{$cgstPercFood > 0 ? '' : 'hide_elem'}}">
                    <th class="text-right">{{lang_trans('txt_cgst')}} ({{$cgstPercFood}}%) {{Form::hidden('cgst_amount',null,['id'=>'cgst_amount'])}}</th>
                    <td width="15%" id="td_cgst_amount" class="text-right">{{getCurrencySymbol()}} 0.00</td>
                  </tr>
                  <tr>
                    <th class="text-right">{{lang_trans('txt_discount')}}</th>
                    <td width="15%" id="td_discount_amount" class="text-right">
                        {{Form::number('discount_amount',null,['class'=>"form-control col-md-7 col-xs-12", "id"=>"discount_amount", "placeholder"=>"Enter Any Discount","min"=>0])}}
                    </td>
                  </tr>
                  <tr class="bg-warning">
                    <th class="text-right">{{lang_trans('txt_total_amount')}} {{Form::hidden('final_amount',null,['id'=>'final_amount'])}}</th>
                    <td width="15%" id="td_final_amount" class="text-right">{{getCurrencySymbol()}} 0.00</td>
                  </tr>
              </table>
          </div>
        </div>
      </div>
    </div>

  @if($categories->count())
    <div class="row">
      <div class="col-md-12 col-sm-12 col-xs-12">
        <div class="x_panel">
          <div class="x_content">
            <div class="col-md-12 col-sm-12 col-xs-12 text-right">
                <button class="btn btn-success" type="submit">{{lang_trans('btn_submit')}}</button>
            </div>
          </div>
        </div>
      </div>
    </div>
  @endif

{{ Form::close() }}
</div>    
{{-- require set var in js var --}}
<script>
  globalVar.page = 'food_order_page';
  globalVar.gstPercentFood = {{$gstPercFood}};
  globalVar.cgstPercentFood = {{$cgstPercFood}};


  $(document).ready(function () {
      // Handle filter button clicks
      $('.filter-button').click(function () {
          const filterType = $(this).data('filter'); // Get the filter type
          
          // Highlight the active button
          $('.filter-button').removeClass('active');
          $(this).addClass('active');
          
          if (filterType === 'all') {
              // Show all rows for "All"
              $('tr').show();
          } else if (filterType === 'veg') {
              // Hide all rows initially
              $('tr').hide();
              
              // Show Veg items
              $('tr[data-type="veg"]').show();
              
              // Recursively show parent categories if any child is visible
              $('tr[data-type="veg"]').each(function () {
                  let parentRow = $(this).prev();
                  while (parentRow.hasClass('tr-bg')) {
                      parentRow.show();
                      parentRow = parentRow.prev();
                  }
              });
          }
      });
  });


  $("#food-item-checkbox").submit(function(e) {
    if ($('input[name="item_qty[]"]:checked').length === 0) {
      e.preventDefault(); // Prevent form submission
      alert('Please select at least one food item.');
    }
  });
</script> 
<script type="text/javascript" src="{{URL::asset('public/js/page_js/page.js')}}"></script>       
@endsection     