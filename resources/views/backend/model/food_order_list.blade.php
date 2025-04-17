@if($foodOrders->isNotEmpty())
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>{{ lang_trans('txt_sl_no') }}</th>
                <th>{{ lang_trans('txt_category') }}</th>
                <th>{{ lang_trans('txt_item_name') }}</th>
                <th>{{ lang_trans('txt_date') }}</th>
                <th>{{ lang_trans('txt_price') }}</th>
            </tr>
        </thead>
        <tbody>
            @foreach($foodOrders as $order)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td class="txt-center">{{ $order->json_data['category_name'] ?? 'NA' }}</td>
                    <td class="txt-center">{{ $order->item_name }}</td>
                    <td class="txt-center">{{ date('d-m-Y', strtotime($order->created_at)) }}</td>
                    <td class="txt-right">{{ getCurrencySymbol() }} {{ numberFormat($order->item_price) }}</td>
                </tr>
            @endforeach
            <tr>
                <th colspan="4" class="txt-right">{{lang_trans('txt_total_per_plate_cost')}}</th>
                <th class="txt-right">{{ getCurrencySymbol() }} {{ numberFormat($foodOrders->sum('item_price')) }}</th>
            </tr>
            <tr>
                <th colspan="4" class="txt-right">{{ lang_trans('txt_no_of_guest') }}</th>
                <th class="txt-right">{{ $totGuest }}</th>
            </tr>
            <tr>
                <th colspan="4" class="txt-right">{{ lang_trans('txt_food_total') }}</th>
                <th class="txt-right">{{ getCurrencySymbol() }} {{ numberFormat($foodOrders->sum('item_price') * $totGuest) }}</th>
            </tr>
        </tbody>
    </table>
@else
    <p class="text-center">{{ lang_trans('txt_no_food_orders') }}</p>
@endif