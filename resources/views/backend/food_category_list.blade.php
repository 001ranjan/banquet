@extends('layouts.master_backend')

@section('content')
<div>
    <div class="row">
        <div class="col-md-12 col-sm-12 col-xs-12">
            <div class="x_panel">
                <div class="x_title">
                    <h2>{{lang_trans('heading_food_category_list')}}</h2>
                    <div class="clearfix"></div>
                </div>
                <div class="x_content">
                    <br/>
                    <table id="datatable" class="table table-striped table-bordered">
                        <thead>
                            <tr>
                                <th>{{ lang_trans('txt_sno') }}</th>
                                <th>{{ lang_trans('txt_category_name') }}</th>
                                <th>{{ lang_trans('txt_sub_category_name') }}</th>
                                <th>{{ lang_trans('txt_status') }}</th>
                                <th>{{ lang_trans('txt_action') }}</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($datalist as $k => $category)
                                <tr>
                                    <td>{{ $k + 1 }}</td>
                                    <td>
                                        @if($category->parent_id == 0)
                                            {{ $category->name }} <!-- Main Category -->
                                        @else
                                            {{ $category->parent->name }} <!-- Main Category of Sub-Category -->
                                        @endif
                                    </td>
                                    <td>
                                        @if($category->parent_id == 0)
                                            - <!-- No Sub-Category for Main Categories -->
                                        @else
                                            {{ $category->name }} <!-- Sub-Category -->
                                        @endif
                                    </td>
                                    <td>{!! getStatusBtn($category->status) !!}</td>
                                    <td>
                                        <a class="btn btn-sm btn-info" href="{{ route('edit-food-category', [$category->id]) }}">
                                            <i class="fa fa-pencil"></i>
                                        </a>
                                        <button class="btn btn-danger btn-sm delete_btn" 
                                                data-url="{{ route('delete-food-category', [$category->id]) }}" 
                                                title="{{ lang_trans('btn_delete') }}">
                                            <i class="fa fa-trash"></i>
                                        </button>
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