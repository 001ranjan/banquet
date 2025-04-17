<div id="booked_food_{{$val->id}}" class="modal fade" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">{{ lang_trans('txt_order_food_item') }}</h4>
            </div>
            <div class="modal-body">
                <table class="table table-bordered">
                <thead>
                    <tr>
                    <th class="text-center" width="2%">{{lang_trans('txt_sno')}}.</th>
                    <th class="text-center">Category</th>
                    <th class="text-center">Item Name</th>
                    </tr>
                </thead>
                <tbody>
                @if($val->orders_items->count()>0)
                    @php
                        $totalOrdersAmount = 0;
                        $serialNo = 1; // Initialize serial number
                    @endphp

                    @foreach($val->orders_items->sortByDesc('id') as $val)
                        <tr>
                            <td colspan="4">{{ $val->item_name }}</td>
                        </tr>

                        @php
                            $totalOrdersAmount += ($val->item_qty * $val->item_price);
                            $data = is_string($val->json_data) ? json_decode($val->json_data, true) : $val->json_data;
                        @endphp

                        @if(!empty($data) && is_array($data))
                            @foreach($data as $row)
                                <tr>
                                <td>{{ $serialNo++ }}</td> <!-- Serial Number -->
                                <td>{{ $row['category_name'] ?? '' }}</td>
                                <td>{{ $row['item_name'] ?? '' }}</td>
                                </tr>
                            @endforeach
                        @endif
                    @endforeach
                    @endif
                    

                </tbody>
                </table>
            </div>
        </div>
    </div>
</div>