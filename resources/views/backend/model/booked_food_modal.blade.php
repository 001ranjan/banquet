<div id="booked_food_{{$val->id}}" class="modal fade" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">{{ lang_trans('txt_order_food_item') }}</h4>
            </div>
            <div class="modal-body" id="modal-food-content-{{$val->id}}">
                <p class="text-center">Loading...</p> <!-- Placeholder -->
            </div>
        </div>
    </div>
</div>