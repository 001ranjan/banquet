@extends('layouts.master_backend')
@section('content')
<div class="">
  <div class="row">
      <div class="col-md-12 col-sm-12 col-xs-12">
          <div class="x_panel">
              <div class="x_title">
                  <h2>{{lang_trans('heading_food_item_list')}}</h2>
                  <div class="clearfix"></div>
              </div>
              <div class="x_content">
                  <br/>
                  <table id="datatable" class="table table-striped table-bordered">
                  <thead>
                    <tr>
                      <th>{{ lang_trans('txt_sno') }}</th>
                      <th>{{ lang_trans('txt_category') }}</th>
                      <th>menu</th>
                      <th>{{ lang_trans('txt_item_name') }}</th>
                      <th>{{ lang_trans('txt_price') }}</th>
                      <th>{{ lang_trans('txt_desc') }}</th>
                      <th>{{ lang_trans('txt_type') }}</th>
                      <th>{{ lang_trans('txt_status') }}</th>
                      <th>{{ lang_trans('txt_action') }}</th>
                    </tr>
                  </thead>
                  <tbody>
                    @foreach($datalist as $k => $val)
                      <tr>
                        <td>{{ $k+1 }}</td>
                        <td>{{ $val->category->name }}</td>
                        <td>
                            @foreach($val->menus as $menu)
                                {{ $menu->menu_name }}{{ !$loop->last ? ', ' : '' }}
                            @endforeach
                        </td>
                        <td>{{ $val->name }}</td>
                        <td>{{ getCurrencySymbol() }} {{ $val->price }}</td>
                        <td>{!! $val->description !!}</td>
                        <td>{{ $val->type }}</td>
                        <td>{!! getStatusBtn($val->status) !!}</td>
                        <td>
                          <a class="btn btn-sm btn-info" href="{{ route('edit-food-item',[$val->id]) }}"><i class="fa fa-pencil"></i></a>
                          <button class="btn btn-danger btn-sm delete_btn" data-url="{{ route('delete-food-item',[$val->id]) }}" title="{{ lang_trans('btn_delete') }}"><i class="fa fa-trash"></i></button>
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