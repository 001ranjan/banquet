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
                        <th>Category</th>
                        <th class="text-center">Item Name</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php
                            $totalOrdersAmount = 0;
                            $serialNo = 1; // Initialize serial number
                            $decodedData = is_string($val->json_data) ? json_decode($val->json_data, true) : $val->json_data;
                        @endphp
                        
                            @foreach($decodedData as $item)
                            <tr>
                                <td>{{ $serialNo++ }}</td>
                                <td>{{ $item['category_name'] ?? '' }}</td>
                                <td>{{ $item['item_name'] ?? '' }}</td>
                            </tr>                
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>