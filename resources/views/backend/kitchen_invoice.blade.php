@php 
    $settings = getSettings();
    $totalOrdersAmount = 0;
@endphp
<!DOCTYPE html>
<html lang="en">
<head>
    <meta content="text/html; charset=utf-8" http-equiv="Content-Type">
    <meta charset="utf-8">
    <meta content="IE=edge" http-equiv="X-UA-Compatible">
    <meta content="width=device-width, initial-scale=1" name="viewport">
    <title>{{ $settings['site_page_title'] }}: {{ lang_trans('txt_invoice') }}</title>
    <link href="{{ URL::asset('public/assets/bootstrap/dist/css/bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ URL::asset('public/css/invoice_style.css') }}" rel="stylesheet">
    <script type="text/javascript" src="{{URL::asset('public/assets/jquery/jquery.min.js')}}"></script>
</head>
<body>
    <div>
        <div align="center" class="col-md-12 col-sm-12 col-xs-12">
            <label class="control-label col-md-12 col-sm-12 col-xs-12">
                <font size="2">
                    {{ $settings['hotel_name'] }}, {{ $settings['hotel_address'] }}
                </font>
            </label>
        </div>
        <div align="center" class="col-md-12 col-sm-12 col-xs-12">
            <label class="control-label col-md-12 col-sm-12 col-xs-12">
                <font size="2">
                    {{ lang_trans('txt_ph') }}: {{ $settings['hotel_phone'] }}
                </font>
            </label>
        </div>
        <div align="center" class="col-md-12 col-sm-12 col-xs-12">
            <label class="control-label col-md-12 col-sm-12 col-xs-12">
                <font size="2">
                    {{ lang_trans('txt_website') }}: {{ $settings['hotel_website'] }}
                </font>
            </label>
        </div>
        <div align="center" class="col-md-12 col-sm-12 col-xs-12">
            <hr/>
            <table border="0" border-style="ridge" class="class-inv-21_" style="width: 70%">
                <tr>
                    <td align="left" width="70%">
                        <div>
                            {{ lang_trans('txt_gstin') }}
                        </div>
                    </td>
                    <td class="txt-right" width="30%">
                        <div>
                            {{ $settings['gst_num'] }}
                        </div>
                    </td>
                </tr>
                <tr>
                    <td align="left" width="70%">
                        <div>
                            {{ lang_trans('txt_date') }}
                        </div>
                    </td>
                    <td class="txt-right" width="30%">
                        <div>
                            {{ date("d M Y h:i A") }}
                        </div>
                    </td>
                </tr>
                <tr>
                    <td align="left" width="70%">
                        <div>
                            {{ lang_trans('txt_price_per_plate') }}
                        </div>
                    </td>
                    <td class="txt-right" width="30%">
                        <div>
                        {{ getCurrencySymbol() }}{{ $data_row->total_amount }}
                        </div>
                    </td>
                </tr>
                <!-- <tr>
                    <td align="left" width="70%">
                        <div>
                            {{ lang_trans('txt_bill_to') }}
                        </div>
                    </td>
                    <td class="txt-right" width="30%">
                        <div>
                            {{ ($type=='room-order') ? $data_row->reservation_data->customer->name : $data_row->order->name }}
                        </div>
                    </td>
                </tr>
                <tr>
                    <td align="left" width="70%">
                        <div>
                            {{ ($data_row->table_num>0) ? lang_trans('txt_table_num') : lang_trans('txt_room_num') }}
                        </div>
                    </td>
                    <td class="txt-right" width="30%">
                        <div>
                            {{ ($data_row->table_num>0) ? $data_row->table_num : ( ($data_row->reservation_data) ? $data_row->reservation_data->room_num : '') }}
                        </div>
                    </td>
                </tr> -->

                <tr>
                    <td align="left" width="70%">
                        <div>
                            {{ lang_trans('txt_num_of_persons') }}
                        </div>
                    </td>
                    <td class="txt-right" width="30%">
                        <div>
                            {{ $data_row->num_of_person }}
                        </div>
                    </td>
                </tr>
            </table>
            <hr/>
            <h5>{{lang_trans('txt_orderd_items')}}</h5>
            <table border="1" border-style="ridge" style="width: 70%">
                <tr>
                    <th>
                        {{ lang_trans('txt_sl_no') }}
                    </th>
                    <th class="txt-center">
                        {{ lang_trans('txt_category') }}
                    </th>
                    <th class="txt-center">
                        {{lang_trans('txt_item_name')}}
                    </th>
                    <th class="txt-center">
                        {{lang_trans('txt_date')}}
                    </th>
                    <th class="txt-center">
                        {{lang_trans('txt_amount')}}
                    </th>
                </tr>
                @if($data_row->orders_items->count()>0)
                @php
                    $totalOrdersAmount = 0;
                    $serialNo = 1; // Initialize serial number
                @endphp

                @foreach($data_row->orders_items->sortByDesc('id') as $val)
                    <tr>
                        <td colspan="4">{{ $val->item_name }}</td>
                        <td class="txt-right">
                            {{ getCurrencySymbol() }} {{ numberFormat($val->item_price) }}
                        </td>                   
                    </tr>

                    @php
                        $totalOrdersAmount += ($val->item_qty * $val->item_price);
                        $data = is_string($val->json_data) ? json_decode($val->json_data, true) : $val->json_data;
                        $date = $val['created_at']->format('Y-m-d');
                    @endphp

                    @if(!empty($data) && is_array($data))
                        @foreach($data as $row)
                            <tr>
                            <td>{{ $serialNo++ }}</td> <!-- Serial Number -->
                            <td>{{ $row['category_name'] ?? '' }}</td>
                            <td>{{ $row['item_name'] ?? '' }}</td>
                            <td>{{ $date ?? '' }}</td>
                            </tr>
                        @endforeach
                    @endif
                @endforeach
                    <tr>
                        <td colspan="5"> <b>Remark : </b>{{$val->remark}}</td>
                    </tr>
                @endif
            </table>
                    
            <h4> {{ lang_trans('txt_token_num') }} : {{ $data_row->id }} </h4>
            <button class="btn btn-sm btn-success no-print" onclick="printSlip()">
                {{ lang_trans('btn_print') }}
            </button>
            <button class="btn btn-sm btn-success no-print" onclick="downloadInvoice()">
                {{ lang_trans('txt_download') }}
            </button>            
            <a href="{{ route('food-order', ['reservation_id' => $data_row->reservation_id]) }}" class="btn btn-sm btn-success no-print">
                {{ lang_trans('btn_edit') }}
            </a>
            <td>
                <button class="btn btn-danger btn-sm delete_btn" data-url="{{ route('food-order-cancel', ['order_id' => $data_row->id]) }}" title="{{ lang_trans('btn_cancel_order') }}">
                    {{ lang_trans('btn_cancel_order') }}
                </button>
            </td>
            <a class="btn btn-sm btn-danger no-print" href="{{ route('list-reservation') }}" id="back-btn">
                {{ lang_trans('btn_go_back') }}
            </a>
        </div>
    </div>
    <script type="text/javascript" src="{{ URL::asset('public/js/page_js/page.js') }}"></script> 
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.5.1/jspdf.umd.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/html2canvas/1.4.1/html2canvas.min.js"></script>
    <script>
    function downloadInvoice() {
        const { jsPDF } = window.jspdf;
        let doc = new jsPDF('p', 'mm', 'a4'); // Create a new PDF document
        // Get the invoice ID from a hidden field or data attribute
        let invoiceId = "{{ $data_row->id }}"; // Laravel blade syntax to pass ID
        // Capture the invoice content
        html2canvas(document.body, {
            scale: 2
        }).then(canvas => {
            let imgData = canvas.toDataURL('image/png');
            let imgWidth = 210; // A4 width in mm
            let pageHeight = 297; // A4 height in mm
            let imgHeight = (canvas.height * imgWidth) / canvas.width;
            let position = 10;

            // Add the image to the PDF
            doc.addImage(imgData, 'PNG', 0, position, imgWidth, imgHeight);
            doc.save(`kot_no_${invoiceId}.pdf`);
        });
    }
</script>
<script>
    history.pushState(null, null, document.URL);
    window.addEventListener("popstate", function () {
        history.pushState(null, null, document.URL);
    });
</script>
<script src="{{URL::asset('public/assets/sweetalert2-7.0.0/sweetalert2.all.min.js')}}"></script>    
<script src="{{URL::asset('public/js/custom.js')}}"></script>
</body>
</html>