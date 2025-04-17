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
                    <h2>{{$heading}} {{lang_trans('heading_menu')}}</h2>
                    <div class="clearfix"></div>
                </div>
                <div class="x_content">
                    <br/>
                    
                    @if($flag == 1)
                        {{ Form::model($data_row, ['url' => route('save-menu'), 'id' => "menu-form", 'class' => "form-horizontal form-label-left"]) }}
                        {{ Form::hidden('id', null) }}
                    @else
                        {{ Form::open(['url' => route('save-menu'), 'id' => "menu-form", 'class' => "form-horizontal form-label-left"]) }}
                    @endif
                    {{-- Menu Name --}}
                    <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="menu_name">{{ lang_trans('txt_menu_name') }} <span class="required">*</span></label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                            {{ Form::text('menu_name', null, ['class' => "form-control col-md-7 col-xs-12", 'id' => "menu_name", 'required' => 'required']) }}
                            @if ($errors->has('menu_name'))
                                <div class="error text-danger">{{ $errors->first('menu_name') }}</div>
                            @endif
                        </div>
                    </div>

                    {{-- Description --}}
                    <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="description">{{ lang_trans('txt_desc') }}</label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                            {{ Form::textarea('description', null, ['class' => "form-control col-md-7 col-xs-12", 'id' => "description", 'rows' => 1]) }}
                            @if ($errors->has('description'))
                                <div class="error text-danger">{{ $errors->first('description') }}</div>
                            @endif
                        </div>
                    </div>

                    {{-- Price --}}
                    <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="menu_price">{{ lang_trans('txt_price_per_plate') }} </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                            {{ Form::text('menu_price', null, ['class' => "form-control col-md-7 col-xs-12", 'id' => "menu_price", 'required' => 'required']) }}
                            @if ($errors->has('menu_price'))
                                <div class="error text-danger">{{ $errors->first('menu_price') }}</div>
                            @endif
                        </div>
                    </div>

                    {{-- Status --}}
                    <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12">{{ lang_trans('txt_status') }}</label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                            {{ Form::select('status', config('constants.LIST_STATUS'), 1, ['class' => 'form-control']) }}
                            @if ($errors->has('status'))
                                <div class="error text-danger">{{ $errors->first('status') }}</div>
                            @endif
                        </div>
                    </div>

                    {{-- Submit and Reset Buttons --}}
                    <div class="form-group">
                        <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
                            <button class="btn btn-primary" type="reset">
                                {{ lang_trans('btn_reset') }}
                            </button>
                            <button class="btn btn-success" type="submit">
                                {{ lang_trans('btn_submit') }}
                            </button>
                        </div>
                    </div>
                    {{ Form::close() }}

                </div>
            </div>
        </div>
    </div>
</div>
@endsection