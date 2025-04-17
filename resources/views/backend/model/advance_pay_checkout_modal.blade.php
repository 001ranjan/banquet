<div id="advance_pay_{{$val->id}}" class="modal fade" role="dialog">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">{{ lang_trans('btn_advance_pay') }}</h4>
      </div>
      {{ Form::open(['url' => route('advance-pay'), 'id' => "advance-pay-form"]) }}
      {{ Form::hidden('id', $val->id) }}

      <div class="modal-body">
        <div class="form-group">
          <label class="control-label text-danger" style="margin-bottom: 10px;" >Balance Due: {{ $balanceDue }}</label>
        </div>
        <table class="">
          <tbody>
            <tr>
              <!-- Amount -->
              <td style="padding-right: 10px;">
                <label class="control-label">  Amount <span class="required">*</span>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</label>
                {{ Form::number('advance_payment', null, [
                    'class' => "form-control", 
                    'min' => 0, 
                    'required' => true, 
                    'placeholder' => 'Add Amount',
                    'style' => 'max-width: 210px;' 

                ]) }}
              </td>
              <!-- Date of Payment -->
              <td style="padding-right: 10px;">
                <label class="control-label">Date <span class="required">*</span>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; </label>
              {{ Form::datetimeLocal('date_of_payment', old('date_of_payment', now()->format('Y-m-d\TH:i')), [
                    'class' => "form-control", 
                    'required' => true,
                    'style' => 'max-width: 210px;' 

                ]) }}
              </td>
            </tr>

            <tr>
              <!-- Amount -->
              <td style="padding-right: 10px;">
                <label class="control-label">{{ lang_trans('txt_payment_mode') }} <span class="required">*</span></label>
                {{ Form::select('payment_mode', config('constants.PAYMENT_MODES'), null, [
                    'class' => "form-control",
                    'required' => true, 
                    'placeholder' => "--Select--",
                    'style' => 'max-width: 210px;' 
                ]) }}
              </td>
              <!-- Date of Payment -->
              <td style="padding-right: 10px;">
                <label class="control-label">Reference </label>
                {{ Form::text('reference', null, [
                    'class' => "form-control", 
                    'placeholder' => 'Enter Reference',
                    'style' => 'max-width: 210px;' 
                ]) }}
              </td>
            </tr>
          </tbody>
        </table>        
      </div>

      <div class="modal-footer text-right">
        <button type="button" class="btn btn-default" data-dismiss="modal">{{ lang_trans('btn_cancel') }}</button>
        <button type="submit" class="btn btn-success">{{ lang_trans('btn_submit') }}</button>
      </div>
      {{ Form::close() }}

      @php
      $paymentHistory = \App\Models\PaymentHistory::where('tbl_id',$val->id)->orderBy('created_at', 'desc')->get();
          $totalPayment = $paymentHistory->sum('payment_amount');
      @endphp

      <div class="modal-header">
        <h4 class="modal-title">Previous Payments </h4>
      </div>
      <div class="modal-body">
      <table class="table table-bordered">
          <thead>
              <tr>
                  <th>ID</th>
                  <th>Payment Type</th>
                  <th>Transaction ID</th>
                  <th>Reference</th>
                  <th>Payment Date</th>
                  <th>Payment Amount</th>
                  <th>Action</th>
              </tr>
          </thead>
          <tbody>
            @php 
            
            $no = 1;
            @endphp
              @foreach($paymentHistory as $payment)
              <tr>
                  <td>{{ $no++ }}</td>
                  <td>{{ $payment->payment_type }}</td>
                  <td>{{ $payment->transaction_id ?? '-' }}</td>
                  <td>{{ $payment->reference ?? '-' }}</td>
                  <td>{{ $payment->payment_date }}</td>
                  <td>{{ number_format($payment->payment_amount, 2) }}</td>
              <td>
                  <!-- Delete Form -->
                  <form action="{{ route('delete-payment-history', ['id' => $payment->id, 'customer_id' => $payment->customer_id]) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this payment?');">
                    @csrf
                    @method('DELETE')
                    
                      <input type="hidden" name="customer_id" value="{{ $payment->customer_id }}">

                      <button type="submit" class="btn btn-danger btn-sm">
                          <i class="fa fa-trash"></i>
                      </button>
                  </form>
              </td>
              </tr>
              @endforeach
              <tfoot>
                <tr>
                    <th colspan="6" class="text-right">Total Payment:</th>
                    <th>{{ number_format($totalPayment, 2) }}</th>
                </tr>
            </tfoot>

          </tbody>
      </table>                
    </div>
    </div>
  </div>
</div>
