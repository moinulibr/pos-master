
    <br/><br/>
    {{-- <button class="btn btn-primary pull-left" name="pdf"> <i class="fa fa-download"></i>
        PDF
    </button> --}}
    <div class="action-buttons">
        <h4 class="text-center">Transactional Statement </h4>
        <div class="table-responsive">
            <table id="example1" class="table table-bordered table-striped table-hover">
                <thead style="background-color:#320101;color:white;height:55px;">
                    <tr style="border:1px solid white;">
                        <th style="width:5%;text-align:center;">#</th>
                        <th style="width:11%;text-align:center;">T.T. Invoice</th>
                        <th style="width:5%;text-align:center;">
                            <small style="font-size:8px;">Ledger Page</small>
                        </th>
                        <th style="width:5%;text-align:center;">
                            <small style="font-size:9px;text-align:center;">
                                Next Payment Date
                            </small>
                        </th>
                        <th style="width:5%;text-align:center;">Date</th>
                        <th style="width:23%;text-align:center;">
                            Transaction Type
                        </th>
                        <th style="width:11%;text-align:center;">Amount</th>
                        <th style="width:10%;text-align:center;background-color:aliceblue;color:#1a1717;">
                            Sell Amount
                        </th>
                        <th style="width:10%;text-align:center;background-color:aliceblue;color:#1a1717;">Paid</th>
                        <th style="width:10%;text-align:center;background-color:aliceblue;color:#1a1717;">Due</th>
                        <th style="width:11%;text-align:center;">Balance</th>
                    </tr>
                </thead>
                <tbody>
                    @php
                        $totalSellAmount = 0;
                        $totalSellPaidAmount = 0;
                        $totalSellDueAmount = 0;
                    @endphp
                    @foreach ($customer->customerTransactionStatement ? $customer->customerTransactionStatement : [] as $index => $tsitem)
                    <tr 
                        @if ($tsitem->tt_module_id == 1)
                        style="background-color:#f3f0f0;color:#161212"
                        @elseif ($tsitem->tt_module_id == 3)
                        style="background-color:#c99a9a;color:white"
                        @elseif ($tsitem->tt_module_id == 4)
                        style="background-color:#cdcdcd;color:#181717"
                        @elseif ($tsitem->tt_module_id == 5)
                        style="background-color:#89a389;color:white"
                        @endif
                    >
                        <td style="width:5%;text-align:center;">{{ $index + (1)}}</td>
                        <td style="width:11%;text-align:center;">
                            <small>{{$tsitem->tt_module_invoice_no}}</small>
                        </td>
                        <td style="width:5%;text-align:center;">
                            {{$tsitem->ledger_page_no}}
                        </td>
                        <td style="width:5%;text-align:center;">
                            {{$tsitem->next_payment_date}}
                        </td>
                        <td style="width:5%;text-align:center;">{{date('d-m-Y',strtotime($tsitem->created_at))}}</td>
                        <td style="width:23%;text-align:center;">
                            {{ getCTSModuleBySingleModuleId_hp($tsitem->tt_module_id) }}
                        </td>
                        <td style="width:11%;text-align:center;">{{$tsitem->amount}}</td>
                        <td style="width:10%;text-align:center;background-color:aliceblue;color:#1a1717;">
                           {{$tsitem->sell_amount}}
                        </td>
                        <td style="width:10%;text-align:center;background-color:aliceblue;color:#1a1717;">{{$tsitem->sell_paid}}</td>
                        <td style="width:10%;text-align:center;background-color:aliceblue;color:#1a1717;">{{$tsitem->sell_due}}</td>
                        <th style="width:11%;text-align:center;">
                            <strong >
                                {{$tsitem->cdc_amount}}
                            </strong>
                        </th>
                        @php
                            $totalSellAmount += $tsitem->sell_amount;
                            $totalSellPaidAmount += $tsitem->sell_paid;
                            $totalSellDueAmount += $tsitem->sell_due;
                        @endphp
                    </tr>
                    @endforeach
                    <tr>
                        <th colspan="7" style="text-align:right;">Total</th>
                        <th style="text-align:center;">{{number_format($totalSellAmount,2,'.','') }}</th>
                        <th style="text-align:center;">{{number_format($totalSellPaidAmount,2,'.','')}}</th>
                        <th style="text-align:center;">{{number_format($totalSellDueAmount,2,'.','')}}</th>
                        <th></th>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>






    {{-- 
        <tr style="background-color:#837f7f;color:white">
            <td style="width:5%;text-align:center;">01</td>
            <td style="width:11%;text-align:center;">
                <small>--</small>
            </td>
            <td style="width:5%;text-align:center;">
                011
            </td>
            <td style="width:5%;text-align:center;">
                10-12-2022
            </td>
            <td style="width:5%;text-align:center;">05-12-2022</td>
            <td style="width:23%;text-align:center;">
                Previous due  
            </td>
            <td style="width:11%;text-align:center;">50000.00</td>
            <td style="width:10%;text-align:center;">
                00.00
            </td>
            <td style="width:10%;text-align:center;">00.00</td>
            <td style="width:10%;text-align:center;">50000.00</td>
            <td style="width:11%;text-align:center;">50000.00</td>
        </tr>
        <tr style="background-color:#b77878;color:white">
            <td style="width:5%;text-align:center;">02</td>
            <td style="width:11%;text-align:center;">
                <small>#sel765432</small>
            </td>
            <td style="width:5%;text-align:center;">
                012
            </td>
            <td style="width:5%;text-align:center;">
                13-12-2022
            </td>
            <td style="width:5%;text-align:center;">08-12-2022</td>
            <td style="width:23%;text-align:center;">
                Quotation  
            </td>
            <td style="width:11%;text-align:center;">20000.00</td>
            <td style="width:10%;text-align:center;">
                00.00
            </td>
            <td style="width:10%;text-align:center;">00.00</td>
            <td style="width:10%;text-align:center;">00.00</td>
            <td style="width:11%;text-align:center;">50000.00</td>
        </tr>
        <tr>
            <td style="width:5%;text-align:center;">03</td>
            <td style="width:11%;text-align:center;">
                <small>#sel765433</small>
            </td>
            <td style="width:5%;text-align:center;">
                012
            </td>
            <td style="width:5%;text-align:center;">
                13-12-2022
            </td>
            <td style="width:5%;text-align:center;">09-12-2022</td>
            <td style="width:23%;text-align:center;">
                Sell  
            </td>
            <td style="width:11%;text-align:center;">00.00</td>
            <td style="width:10%;text-align:center;">
                30000.00
            </td>
            <td style="width:10%;text-align:center;">10000.00</td>
            <td style="width:10%;text-align:center;">20000.00</td>
            <td style="width:11%;text-align:center;">70000.00</td>
        </tr>
        <tr  style="background-color:#727070;color:white">
            <td style="width:5%;text-align:center;">04</td>
            <td style="width:11%;text-align:center;">
                <small>--</small>
            </td>
            <td style="width:5%;text-align:center;">
                012
            </td>
            <td style="width:5%;text-align:center;">
                13-12-2022
            </td>
            <td style="width:5%;text-align:center;">10-12-2022</td>
            <td style="width:23%;text-align:center;">
                Loan  
            </td>
            <td style="width:11%;text-align:center;">10000.00</td>
            <td style="width:10%;text-align:center;">
                00.00
            </td>
            <td style="width:10%;text-align:center;">00.00</td>
            <td style="width:10%;text-align:center;">00.00</td>
            <td style="width:11%;text-align:center;">80000.00</td>
        </tr>
        <tr  style="background-color:#507850;color:white">
            <td style="width:5%;text-align:center;">05</td>
            <td style="width:11%;text-align:center;">
                <small>--</small>
            </td>
            <td style="width:5%;text-align:center;">
                012
            </td>
            <td style="width:5%;text-align:center;">
                15-12-2022
            </td>
            <td style="width:5%;text-align:center;">11-12-2022</td>
            <td style="width:23%;text-align:center;">
                Advance  
            </td>
            <td style="width:11%;text-align:center;">20000.00</td>
            <td style="width:10%;text-align:center;">
                00.00
            </td>
            <td style="width:10%;text-align:center;">00.00</td>
            <td style="width:10%;text-align:center;">00.00</td>
            <td style="width:11%;text-align:center;">60000.00</td>
        </tr>
        <tr>
            <td style="width:5%;text-align:center;">06</td>
            <td style="width:11%;text-align:center;">
                <small>SR321453</small>
            </td>
            <td style="width:5%;text-align:center;">
                013
            </td>
            <td style="width:5%;text-align:center;">
                15-12-2022
            </td>
            <td style="width:5%;text-align:center;">12-12-2022</td>
            <td style="width:23%;text-align:center;">
                Sell Return  
            </td>
            <td style="width:11%;text-align:center;">00.00</td>
            <td style="width:10%;text-align:center;">
                00.00
            </td>
            <td style="width:10%;text-align:center;">00.00</td>
            <td style="width:10%;text-align:center;">00.00</td>
            <td style="width:11%;text-align:center;">55000.00</td>
        </tr>
        <tr>
            <td style="width:5%;text-align:center;">07</td>
            <td style="width:11%;text-align:center;">
                <small>--</small>
            </td>
            <td style="width:5%;text-align:center;">
                013
            </td>
            <td style="width:5%;text-align:center;">
                15-12-2022
            </td>
            <td style="width:5%;text-align:center;">13-12-2022</td>
            <td style="width:23%;text-align:center;">
                Sell Due Payment  
            </td>
            <td style="width:11%;text-align:center;">4000.00</td>
            <td style="width:10%;text-align:center;">
                00.00
            </td>
            <td style="width:10%;text-align:center;">00.00</td>
            <td style="width:10%;text-align:center;">00.00</td>
            <td style="width:11%;text-align:center;">51000.00</td>
        </tr>
        <tr>
            <td style="width:5%;text-align:center;">08</td>
            <td style="width:11%;text-align:center;">
                <small>--</small>
            </td>
            <td style="width:5%;text-align:center;">
                013
            </td>
            <td style="width:5%;text-align:center;">
                15-12-2022
            </td>
            <td style="width:5%;text-align:center;">14-12-2022</td>
            <td style="width:23%;text-align:center;">
                Previous Due Payment  
            </td>
            <td style="width:11%;text-align:center;">11000.00</td>
            <td style="width:10%;text-align:center;">
                00.00
            </td>
            <td style="width:10%;text-align:center;">00.00</td>
            <td style="width:10%;text-align:center;">00.00</td>
            <td style="width:11%;text-align:center;">40000.00</td>
        </tr>
        <tr>
            <td style="width:5%;text-align:center;">09</td>
            <td style="width:11%;text-align:center;">
                <small>--</small>
            </td>
            <td style="width:5%;text-align:center;">
                013
            </td>
            <td style="width:5%;text-align:center;">
                --
            </td>
            <td style="width:5%;text-align:center;">15-12-2022</td>
            <td style="width:23%;text-align:center;">
                Previous Due Payment   
            </td>
            <td style="width:11%;text-align:center;">40000.00</td>
            <td style="width:10%;text-align:center;">
                00.00
            </td>
            <td style="width:10%;text-align:center;">00.00</td>
            <td style="width:10%;text-align:center;">00.00</td>
            <td style="width:11%;text-align:center;">00.00</td>
        </tr> 
    --}}