@if($foodItems->isNotEmpty())
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

            @foreach($foodItems as $item)
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
    <p class="text-center">{{ lang_trans('txt_no_food_orders') }}</p>
@endif