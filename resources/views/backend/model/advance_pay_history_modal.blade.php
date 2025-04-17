<div id="advance_pay_history_{{$val->id}}" class="modal fade" role="dialog">
  <div class="modal-dialog">
    <div class="modal-content">
      @php
        $paymentHistory = \App\Models\PaymentHistory::where('tbl_id',$val->id)->orderBy('created_at', 'desc')->get();
        $totalPayment = $paymentHistory->sum('payment_amount');

        $calc = calcFinalAmount($val);
        $subTotal = $calc['finalRoomAmount'] + $calc['finalOrderAmount'] + $calc['additionalAmount'];
        $totalAmount += $subTotal;
        $balanceDue = numberFormat($subTotal - ($val->advance_payment ?? 0));

      @endphp


      <div class="modal-header">
      <button type="button" class="close" data-dismiss="modal">&times;</button>
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
              </tr>
          </thead>
          <tbody>
            @php 
            
            $no = 1;
            @endphp
              @foreach($paymentHistory as $payment)

              @if($payment->payment_amount == $totalAmount)
                  @continue
              @endif
              <tr>
                  <td>{{ $no++ }}</td>
                  <td>{{ $payment->payment_type }}</td>
                  <td>{{ $payment->transaction_id ?? '-' }}</td>
                  <td>{{ $payment->reference ?? '-' }}</td>
                  <td>{{ $payment->payment_date }}</td>
                  <td>{{ number_format($payment->payment_amount, 2) }}</td>
              </tr>
              @endforeach
              <tfoot>
                <tr>
                    <th colspan="5" class="text-right">Total Payment:</th>
                    <th>{{ number_format($totalPayment - $totalAmount, 2) }}</th>
                </tr>
            </tfoot>
          </tbody>
      </table>                
    </div>
    </div>
  </div>
</div>
