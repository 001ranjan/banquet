{{-- Display category name only once --}}
@if(count($category['food_items']) > 0)
    <tr class="tr-bg" data-type="{{ $category['type'] }}">
        <td colspan="4" style="padding-left: 10px;">
            <b>{{ $category['name'] }}</b>
        </td>
    </tr>
@endif

{{-- Display food items for this category --}}
@foreach($category['food_items'] as $foodItem)
    @php
        // Fetch the category name based on category_id
        $categoryName = optional($categories->firstWhere('id', $foodItem->category_id))->name;
    @endphp
    <tr class="tr-items" data-type="{{ strtolower($foodItem->type) }}">
        <td width="5%">
            <input type="checkbox" 
                   name="item_qty[{{ $foodItem->id }}]" 
                   value="1" 
                   data-price1="{{ $foodItem->price }}" 
                   id="item_qty_{{ $foodItem->id }}" 
                   class="food-item-checkbox">
        </td>
        <td>
            <!-- Circle Indicator -->
            <span class="food-indicator {{ strtolower($foodItem->type) == 'veg' ? 'veg' : 'non-veg' }}"></span>
            {{ $foodItem->name }} 
        </td>
        {{ Form::hidden(
            'items[' . $foodItem->id . ']', 
            $foodItem->category_id . '~' . $categoryName . '~' . $foodItem->name . '~' . $foodItem->price, 
            ['data-price' => $foodItem->price, 'class' => 'form-control col-md-6 col-xs-12 item_qty', 'min' => 0]
        ) }}
    </tr>
@endforeach

{{-- Recursively render subcategories --}}
@foreach($category['children'] as $childCategory)
    @include('backend.partials.food_category_tree', ['category' => $childCategory, 'level' => $level + 1])
@endforeach
