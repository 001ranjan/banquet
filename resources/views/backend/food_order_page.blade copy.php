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

<style>
  /* Info Box */
.info-box {
    border-radius: 0.375rem;
    box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
    display: flex;
    padding: 15px;
    margin-bottom: 15px;
    background-color: #fff;
}

.info-box-icon {
    width: 60px;
    height: 60px;
    display: flex;
    align-items: center;
    justify-content: center;
    border-radius: 50%;
    color: #fff;
    font-size: 2rem;
}

.info-box-content {
    margin-left: 15px;
}

.info-box-text {
    font-weight: bold;
}

.info-box-number {
    font-size: 1.25rem;
    font-weight: bold;
}
.modal-dialog {
  width: 850px;
  margin: 30px auto;
  
}

</style>
<div class="">
  {{ Form::open(array('url'=>route('food-order-view'),'id'=>"food-order-form", 'class'=>"form-horizontal form-label-left",'files'=>true)) }}
  {{Form::hidden('gst_perc',$gstPercFood)}}
  {{Form::hidden('cgst_perc',$cgstPercFood)}}
  
  <div class="row">
      <div class="col-md-12 col-sm-12 col-xs-12">
          <div class="x_panel">
              <div class="x_title">
                  <h2>{{lang_trans('heading_food_item')}}</h2>
                  <div class="clearfix"></div>
              </div>
              <div class="row">
                  @foreach ($menu_list as $menu)
                      <div class="col-12 col-sm-6 col-md-3 menu-card" data-menu="{{ $menu['id'] }}">
                          <div class="info-box">
                              <input type="radio" name="menu_id" value="{{ $menu['id'] }}" id="menu_{{ $menu['id'] }}" 
                                    class="form-check-input menu-radio filter-menu-button"
                                    {{ request('menu_id') == $menu['id'] ? 'checked' : '' }}>
                              <label for="menu_{{ $menu['id'] }}" class="info-box-content">
                                  <span class="info-box-text">{{ $menu['menu_name'] }}</span>
                                  <br>
                                  <span class="info-box-price">₹{{ $menu['menu_price'] }}</span>
                              </label>
                          </div>
                      </div>
                  @endforeach
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

              <!-- Special Requirement Checkbox -->
              <div class="mb-3">
                  <h2>{{ lang_trans('heading_special_requirement') }}</h2>
                  <input type="checkbox" id="specialRequirementCheckbox" class="form-check-input">
                  <label for="specialRequirementCheckbox">Add Special Requirement</label>
              </div>

              <!-- Special Requirement Fields (Initially Hidden) -->
              <div id="specialRequirementFields" class="border p-3 rounded" style="display: none;">
                  <div class="row">
                      <div class="col-md-12 col-sm-12 col-xs-12">
                          <div class="x_panel">
                              <div class="x_content">
                                  {{-- Add Special Row Starts Here --}}
                                  <!-- Single Price Field (Outside the Loop) -->
                                  <div class="row mt-3">
                                      <div class="col-md-2">
                                          <label class="control-label"> {{lang_trans('txt_price')}} </label>
                                          {{Form::number('special_requirement[price]',null,['class'=>"form-control", "placeholder"=>lang_trans('txt_price')])}}
                                      </div>
                                  </div>
                                  <div class="special_row_parent">
                                      <div class="row special_row_elem">
                                          <div class="col-md-2 col-sm-2 col-xs-12">
                                              <label class="control-label"> {{lang_trans('sidemenu_fooditem_name')}} </label>
                                              {{Form::text('special_requirement[name][]',null,['class'=>"form-control", "placeholder"=>lang_trans('sidemenu_fooditem_name')])}}
                                          </div>
                                          <div class="col-md-2 col-sm-2 col-xs-12">
                                              <label class="control-label"> {{lang_trans('sidemenu_select_category')}} </label>
                                              <select name="special_requirement[category_id][]" class="form-control">
                                                  <option value="">{{ lang_trans('ph_select') }}</option>
                                                  @foreach ($category_tree as $category)
                                                      <option value="{{ $category['id'] }}">{{ $category['name'] }}</option>
                                                  @endforeach
                                              </select>
                                          </div>
                                          <div class="col-md-2 col-sm-2 col-xs-12">
                                              <label class="control-label"> {{lang_trans('txt_type')}} </label>
                                              {{ Form::select('special_requirement[type][]', ['Veg' => 'Veg', 'Non-Veg' => 'Non-Veg'], null, ['class' => 'form-control', 'placeholder' => lang_trans('ph_select')]) }}
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

                  {{-- Delete Special Row Template --}}
                  <div class="colne_special_row_elem" style="display: none;">
                      <div class="row special_row_elem">
                          <div class="col-md-2 col-sm-2 col-xs-12">
                              {{Form::text('special_requirement[name][]',null,['class'=>"form-control", "placeholder"=>lang_trans('sidemenu_fooditem_name')])}}
                          </div>
                          <div class="col-md-2 col-sm-2 col-xs-12">
                              <select name="special_requirement[category_id][]" class="form-control">
                                  <option value="">{{ lang_trans('ph_select') }}</option>
                                  @foreach ($category_tree as $category)
                                      <option value="{{ $category['id'] }}">{{ $category['name'] }}</option>
                                  @endforeach
                              </select>
                          </div>
                          <div class="col-md-2 col-sm-2 col-xs-12">
                              {{ Form::select('special_requirement[type][]', ['Veg' => 'Veg', 'Non-Veg' => 'Non-Veg'], null, ['class' => 'form-control', 'placeholder' => lang_trans('ph_select')]) }}
                          </div>
                          <div class="col-md-1 col-sm-1 col-xs-12"> 
                              <button type="button" class="btn btn-danger delete-special-row"><i class="fa fa-minus"></i></button>
                          </div>
                      </div>
                  </div>
              </div>

              <div class="col-md-12 col-sm-12 col-xs-12">
                <label class="control-label"> {{lang_trans('txt_remark')}} </label>
                {{Form::textarea('remarks',null,['class'=>"form-control col-md-12 col-xs-12", "id"=>"remarks", "rows" => 3, "placeholder"=>lang_trans('txt_remark')])}}
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
                        <button type="submit" class="btn btn-success">{{ lang_trans('btn_submit') }}</button>
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
<script>
document.addEventListener("DOMContentLoaded", function () {
    document.querySelectorAll(".menu-radio").forEach(function (radio) {
        radio.addEventListener("change", function () {
            let selectedMenuId = this.value;
            let url = new URL(window.location.href);
            url.searchParams.set("menu_id", selectedMenuId);
            window.location.href = url.toString(); // Redirect with updated query param
        });
    });
});
</script>

<script>
document.addEventListener("DOMContentLoaded", function () {
    document.getElementById("specialRequirementCheckbox").addEventListener("change", function () {
        let specialRequirementFields = document.getElementById("specialRequirementFields");
        if (this.checked) {
            specialRequirementFields.style.display = "block"; // Show fields
        } else {
            specialRequirementFields.style.display = "none";  // Hide fields
        }
    });
});
</script>
<script type="text/javascript" src="{{URL::asset('public/js/page_js/page.js')}}"></script>       
@endsection     