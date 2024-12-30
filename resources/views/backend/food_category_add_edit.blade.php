@extends('layouts.master_backend')
@section('content')
@php 
    $flag = 0;
    $heading = lang_trans('btn_add');
    if(isset($data_row) && !empty($data_row)){
        $flag = 1;
        $heading = lang_trans('btn_update');
    }
@endphp
<div class="">
    <div class="row">
        <div class="col-md-12 col-sm-12 col-xs-12">
            <div class="x_panel">
                <div class="x_title">
                    <h2>{{$heading}} {{lang_trans('heading_food_category')}}</h2>
                    <div class="clearfix"></div>
                </div>

                <div class="x_content">
                    <br/>
                    @if($flag == 1)
                        {{ Form::model($data_row, ['url' => route('save-food-category'), 'id' => "food-category-form", 'class' => "form-horizontal form-label-left"]) }}
                        {{ Form::hidden('id', null) }}
                    @else
                        {{ Form::open(['url' => route('save-food-category'), 'id' => "food-category-form", 'class' => "form-horizontal form-label-left"]) }}
                    @endif
                
                    <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="parent_id">{{ lang_trans('txt_parent_category') }}</label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                            <select name="parent_id" id="parent_id" class="form-control">
                                <option value="0">None</option>
                                @foreach ($categories as $category)
                                    <option value="{{ $category['id'] }}" 
                                        @if (isset($data_row) && $data_row->parent_id == $category['id']) selected @endif>
                                        {{ $category['name'] }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                
                    <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="name">{{ lang_trans('txt_category_name') }}<span class="required">*</span></label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                            {{ Form::text('name', null, ['class' => "form-control col-md-7 col-xs-12", "id" => "name", "required" => "required"]) }}
                        </div>
                    </div>
                
                    <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="status">{{ lang_trans('txt_status') }}</label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                            {{ Form::select('status', config('constants.LIST_STATUS'), 1, ['class' => 'form-control']) }}
                        </div>
                    </div>
                
                    <div class="form-group">
                        <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
                            <button class="btn btn-primary" type="reset">{{ lang_trans('btn_reset') }}</button>
                            <button class="btn btn-success" type="submit">{{ lang_trans('btn_submit') }}</button>
                        </div>
                    </div>
                    {{ Form::close() }}
                </div>
            
            </div>
        </div>
    </div>
</div>
@endsection