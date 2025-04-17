<tr class="tr-bg" data-type="{{ $category['type'] }}">
    <td colspan="4" style="padding-left: {{ $level * 20 }}px;">
        <b>{{ $category['name'] }}</b>
    </td>
</tr>

{{-- Display food items for this category --}}
@foreach($category['food_items'] as $foodItem)
    <tr class="tr-items" data-type="{{ strtolower($foodItem->type) }}">
        <td width="5%">
            <input type="checkbox" name="selected_items[]" value="{{ $foodItem->id }}" id="item_{{ $foodItem->id }}" class="food-item-checkbox">
        </td>
        <td>{{ $foodItem->name }}</td>
        <td width="15%">{{ getCurrencySymbol() }} {{ $foodItem->price }}</td>
        <td width="12%">
            <!-- Quantity Input -->
            <div class="input-group">
                <span class="input-group-btn">
                    <button type="button" class="btn btn-danger btn-number" data-type="minus" data-field="item_qty[{{ $foodItem->id }}]">
                        <span class="glyphicon glyphicon-minus"></span>
                    </button>
                </span>
                {{ Form::number('item_qty['.$foodItem->id.']', 0, [
                    'data-price' => $foodItem->price,
                    'class' => 'form-control input-number text-center',
                    'placeholder' => lang_trans('ph_qty'),
                    'min' => 0,
                    'max' => 100,
                    'readonly' => true,
                    'style' => 'height: 33px;'
                ]) }}
                <span class="input-group-btn">
                    <button type="button" class="btn btn-success btn-number" data-type="plus" data-field="item_qty[{{ $foodItem->id }}]">
                        <span class="glyphicon glyphicon-plus"></span>
                    </button>
                </span>
            </div>
        </td>
    </tr>
@endforeach

{{-- Recursively render subcategories --}}
@foreach($category['children'] as $childCategory)
    @include('backend.partials.food_category_tree', ['category' => $childCategory, 'level' => $level + 1])
@endforeach