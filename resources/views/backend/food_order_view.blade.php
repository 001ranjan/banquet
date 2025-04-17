@extends('layouts.master_backend')
@section('content')

@php 
    
    $settings = getSettings();
    $gstPercFood = $settings['food_gst'] ?? 0;
    $cgstPercFood = $settings['food_cgst'] ?? 0;

    $totalOrdersAmount = 0;
    $foodAmountCGst = 0;
    $foodAmountGst = 0;
    $foodOrderAmountDiscount = 0;
    $finalOrderAmount = 0;

    if(session()->has('food_order')) {
        $foodOrder = session('food_order');
   
        $reservationId = $foodOrder['reservation_id'] ?? [];
   
        $items = $foodOrder['items'] ?? [];
        $itemQty = $foodOrder['item_qty'] ?? [];
        $specialRequirement = $foodOrder['special_requirement'] ?? [];
        $orderDate = $foodOrder['order_date'] ?? now()->format('Y-m-d');

        $remarks = $foodOrder['remarks'] ?? '';

        $priceParPlate = $menu->menu_price + ($specialRequirement['price'] ?? 0);

        $menuId = $menu['id'] ?? 0;
        $menuName = $menu['menu_name'] ?? '';
        $menuPrice = $menu['menu_price'] ?? 0;
        
        // Apply GST & CGST if applicable
        $foodAmountGst = ($totalOrdersAmount * $gstPercFood) / 100;
        $foodAmountCGst = ($totalOrdersAmount * $cgstPercFood) / 100;

        // Compute final order amount after discount
        $finalOrderAmount = $totalOrdersAmount + $foodAmountGst + $foodAmountCGst - $foodOrderAmountDiscount;
    }
@endphp

<div class="container mt-4">
    <h2>Food Item Summary</h2>

    @if(session()->has('food_order'))

        {{ Form::open(array('url'=>route('save-food-order'),'id'=>"food-order-form", 'class'=>"form-horizontal form-label-left", 'files'=>true)) }}
        {{Form::hidden('gst_perc',$gstPercFood)}}
        {{Form::hidden('cgst_perc',$cgstPercFood)}}
        {{Form::hidden('menu_id',$menuId)}}
        {{Form::hidden('menu_name',$menuName)}}
        {{Form::hidden('menu_price',$menuPrice)}}
        {{Form::hidden('reservation_id',$reservationId)}}
        {{Form::hidden('remarks',$remarks)}}
        {{Form::hidden('price_par_plate',$priceParPlate)}}
                
        <input type="hidden" name="specialRequirement[price]" value="{{ $specialRequirement['price'] }}">

        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>S.No</th>
                    <th>Category</th>
                    <th>Item Detail</th>
                    <th>Date</th>
                    <th>Price</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td colspan="4">{{ $menu->menu_name }} </td> 
                    <td>₹{{ number_format($menu->menu_price, 2) }}</td>
                </tr>

                @php $sno = 1; @endphp
                @foreach($items as $key => $value)
                @if(isset($itemQty[$key]))  {{-- Check if item is in item_qty array --}}
                    @php
                        $itemDetails = explode('~', $value);
                        $qty = $itemQty[$key] ?? 1;
                        $price = $itemDetails[3] * $qty;
                    @endphp
                    <tr>
                        <td>{{ $sno++ }}</td>
                        <td>{{ $itemDetails[1] }}</td>
                        <td>{{ $itemDetails[2] }}</td>
                        <td>{{ $orderDate }}</td>
                    </tr>
                    {{-- Hidden input fields to submit data --}}
                    <input type="hidden" name="items[{{ $key }}]" value="{{ $value }}">
                    <input type="hidden" name="item_qty[{{ $key }}]" value="{{ $qty }}">
                    <input type="hidden" name="order_date" value="{{ $orderDate }}">
                    @endif
                @endforeach
                <tr>
                    <td colspan="4">Special Requirements</td>
                    <td>₹{{ number_format($specialRequirement['price'] ?? 0, 2) }}</td>
                </tr>
                @php $sno = 1; @endphp
                @foreach($specialRequirement['name'] as $index => $name)
                    @if(!empty($name))
                        <tr>
                            <td>{{ $sno++ }}</td>
                            @php
                            $categoryName = \App\Models\FoodCategory::find($specialRequirement['category_id'][$index])->name ?? 'N/A';
                            
                            $date = now()->format('Y-m-d');
                            @endphp
                            <td>{{ $categoryName }}</td>
                            <td>{{ $name }}</td>
                            <td>{{ $date }}</td>
                            <!-- <td>{{ $specialRequirement['type'][$index] ?? 'N/A' }}</td> -->
                        </tr>
                        {{-- Hidden input fields to submit data --}}
                        <input type="hidden" name="specialRequirement[name][]" value="{{ $name }}">
                        <input type="hidden" name="specialRequirement[category_id][]" value="{{ $specialRequirement['category_id'][$index] }}">
                        <input type="hidden" name="specialRequirement[type][]" value="{{ $specialRequirement['type'][$index] ?? '' }}">

                    @endif
                @endforeach
            </tbody>
        </table>
        <table class="table table-bordered">
            <td> <b>Remarks :</b> {{ $foodOrder['remarks'] ?? 'N/A' }}</td>
        </table>

        <table class="table table-bordered">
            <tr>
                <th class="text-right">Total Price Per Plate</th>
                <td width="15%" class="text-right" colspan="2">{{ getCurrencySymbol() }} <span id="price_par_plate">{{ number_format($priceParPlate, 2) }}</span></td>
            </tr>
            <tr>
                <th class="text-right">No. of Guests</th>
                <td width="15%" colspan="2">{{ Form::number('no_of_guests', null, ['class'=>"form-control", "id"=>"no_of_guests", "min"=>1, "required"]) }}</td>
            </tr>
            <tr>
                <th class="text-right">Subtotal</th>
                <td width="15%" class="text-right" colspan="2">{{ getCurrencySymbol() }} <span id="total_order_amount">{{ number_format($totalOrdersAmount, 2) }}</span></td>
            </tr>
            <tr>
                <th class="text-right">Apply GST</th>
                <td width="15%" colspan="2">
                    {{ Form::checkbox('gst_apply', 1, false, ['id' => 'apply_gst']) }}
                </td>
            </tr>

            <tr>
                <th class="text-right">GST ({{$gstPercFood}}%)</th>
                <td width="15%" class="text-right" colspan="2">{{ getCurrencySymbol() }} <span id="order_amount_gst">{{ number_format($foodAmountGst, 2) }}</span>
                <input type="hidden" name="order_amount_gst" id="order_amount_gst_input" value="{{ number_format($foodAmountGst, 2) }}">
            </td>

            </tr>
            <tr class="{{ $cgstPercFood > 0 ? '' : 'hide_elem' }}">
                <th class="text-right">CGST ({{$cgstPercFood}}%)</th>
                <td width="15%" class="text-right" colspan="2">{{ getCurrencySymbol() }} <span id="order_amount_cgst">{{ number_format($foodAmountGst, 2) }}</span>
                <input type="hidden" name="order_amount_cgst" id="order_amount_cgst_input" value="{{ number_format($foodAmountGst, 2) }}">
            </td>
            </tr>
            <tr>
                <th class="text-right">Discount</th>
                <td width="10%">
                        {{ Form::number('discount_order_amount', $foodOrderAmountDiscount, ['class'=>"form-control", "id"=>"order_discount", "min"=>0]) }}
                </td>
                <td width="10%">
                    {{ Form::select('room_discount_in', ['amt' => 'Amount', '%' => '%'], 'amt', ['class'=>'form-control', "id"=>"room_discount_in"]) }}    
                </td>
            </tr>
            <tr class="bg-warning">
                <th class="text-right">Total Amount</th>
                <td width="15%" class="text-right" colspan="2">{{ getCurrencySymbol() }} <span id="order_final_amount">{{ number_format($finalOrderAmount, 2) }}</span>
                <input type="hidden" name="order_final_amount" id="order_final_amount_input" value="{{ number_format($finalOrderAmount, 2) }}">
            </td>
            </tr>

        </table>
        
        <div class="text-right">
            <button type="submit" class="btn btn-success" id="submit_order">Submit Order</button>
        </div>

        {{ Form::close() }}

    @else
        <p>No food order data available.</p>
    @endif
</div>
<script>
document.addEventListener("DOMContentLoaded", function() {
    const guestsInput = document.getElementById("no_of_guests");
    const discountInput = document.getElementById("order_discount");
    const discountType = document.getElementById("room_discount_in");
    const gstCheckbox = document.getElementById("apply_gst"); 

    function recalculateTotal() {
        let pricePerPlate = {{$priceParPlate}} || 0;
        
        let guests = parseInt(guestsInput.value) || 1;
        let subtotal = pricePerPlate * guests;

        let gstPerc = {{ $gstPercFood }};
        let cgstPerc = {{ $cgstPercFood }};
        let discountValue = parseFloat(discountInput.value) || 0;
        let discountTypeValue = discountType.value;

        // Calculate Discount
        let discountAmount = discountTypeValue === '%' ? (subtotal * discountValue) / 100 : discountValue;

        let gstAmount = 0;
        let cgstAmount = 0;

        // Apply GST & CGST only if checkbox is checked
        if (gstCheckbox.checked) {
            gstAmount = (subtotal * gstPerc) / 100;
            cgstAmount = (subtotal * cgstPerc) / 100;
        }

        let finalAmount = subtotal + gstAmount + cgstAmount - discountAmount;

        document.getElementById("total_order_amount").innerText = subtotal.toFixed(2);
        document.getElementById("order_amount_gst").innerText = gstAmount.toFixed(2);
        document.getElementById("order_amount_cgst").innerText = cgstAmount.toFixed(2);
        document.getElementById("order_final_amount").innerText = finalAmount.toFixed(2);
    
        // Update hidden input field
        document.getElementById("order_final_amount_input").value = finalAmount.toFixed(2);
        document.getElementById("order_amount_gst_input").value = gstAmount.toFixed(2);
        document.getElementById("order_amount_cgst_input").value = cgstAmount.toFixed(2);
        
    }

    // Event listeners for changes
    guestsInput.addEventListener("input", recalculateTotal);
    discountInput.addEventListener("input", recalculateTotal);
    gstCheckbox.addEventListener("change", recalculateTotal); // Listen for GST checkbox change
});
</script>


@endsection     