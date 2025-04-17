<div id="menu_food_{{$val->id}}" class="modal fade" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">{{ lang_trans('txt_items') }}</h4>
            </div>
            <div class="modal-body" id="modal-menu-food-content-{{$val->id}}">
                
                @php
                $id = $val->id;
                $items = \App\Models\FoodItem::whereJsonContains('menu_ids', ["$id"])->get();
                @endphp
                         
                @if($items->count() > 0)
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>{{ lang_trans('txt_sl_no') }}</th>
                            <th>{{ lang_trans('txt_category') }}</th>
                            <th>{{ lang_trans('txt_item_name') }}</th>
                            <th>{{ lang_trans('txt_price') }}</th>
                            <th>{{ lang_trans('txt_date') }}</th>
                        </tr>
                    </thead>
                    <tbody>

                        @foreach($items as $item)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td class="txt-center">{{ $item->category->name ?? 'NA' }}</td>
                                <td class="txt-center">{{ $item->name }}</td>
                                <td class="txt-right">{{ getCurrencySymbol() }} {{ numberFormat($item->price) }}</td>
                                <td class="txt-center">{{ date('d-m-Y', strtotime($item->created_at)) }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                @else
                    <p class="text-center">No items available.</p>
                @endif
            </div>
        </div>
    </div>
</div>
