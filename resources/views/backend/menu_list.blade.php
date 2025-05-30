@extends('layouts.master_backend')
@section('content')
<div class="">
  <div class="row">
      <div class="col-md-12 col-sm-12 col-xs-12">
          <div class="x_panel">
              <div class="x_title">
                  <h2>{{lang_trans('heading_menu_list')}}</h2>
                  <div class="clearfix"></div>
              </div>
              <div class="x_content">
                  <br/>
                  <table id="datatable" class="table table-striped table-bordered">
                  <thead>
                    <tr>
                      <th>{{ lang_trans('txt_sno') }}</th>
                      <th>{{ lang_trans('txt_menu_name') }}</th>
                      <th>{{ lang_trans('txt_no_of_food_items') }}</th>
                      <th>{{ lang_trans('txt_price_per_plate') }}</th>
                      <th>{{ lang_trans('txt_desc') }}</th>
                      <th>{{ lang_trans('txt_status') }}</th>
                      <th>{{ lang_trans('txt_action') }}</th>
                    </tr>
                  </thead>
                  <tbody>
                    @foreach($datalist as $k => $val)
                      <tr>
                        <td>{{ $k+1 }}</td>
                        <td>{{ $val->menu_name }}</td>
                          <td>  
                            {{ lang_trans('txt_items') }} ({{ \App\Models\FoodItem::whereJsonContains('menu_ids', ["$val->id"])->count() }})                              

                              <button 
                                  class="btn btn-xs btn-primary btn-view-menu-items" 
                                  data-reservation-id="{{ $val->id }}" 
                                  data-toggle="modal" 
                                  data-target="#menu_food_{{ $val->id }}">
                                  {{ lang_trans('btn_view') }}
                              </button>
                              @include('backend.model.menu_food_modal', ['val' => $val])
                          </td>

                        <td>{{ getCurrencySymbol() }} {{ $val->menu_price }}</td>
                        <td>{!! $val->description !!}</td>
                        <td>{!! getStatusBtn($val->status) !!}</td>
                        <td>
                          <a class="btn btn-sm btn-info" href="{{ route('edit-menu',[$val->id]) }}"><i class="fa fa-pencil"></i></a>
                          <button class="btn btn-danger btn-sm delete_btn" data-url="{{ route('delete-menu',[$val->id]) }}" title="{{ lang_trans('btn_delete') }}"><i class="fa fa-trash"></i></button>
                        </td>
                      </tr>
                    @endforeach
                  </tbody>
                </table>
              </div>
          </div>
      </div>
  </div>
</div>          
@endsection