
    <br/><br/>
    <button class="btn btn-primary pull-left" name="pdf"> <i class="fa fa-download"></i>
        PDF
    </button>
    <div class="action-buttons">
        <h4 class="text-center">Transactional Statement </h4>
        <div class="table-responsive">
            <table id="example1" class="table table-bordered table-striped table-hover">
                <thead style="background-color:#1a1717;color:white;height:55px;">
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
                        <th style="width:10%;text-align:center;">
                            <small style="font-size:8px;text-align:center;">
                                Sell Amount Only
                            </small>
                        </th>
                        <th style="width:10%;text-align:center;">Paid</th>
                        <th style="width:10%;text-align:center;">Due</th>
                        <th style="width:11%;text-align:center;">Balance</th>
                    </tr>
                    <tr  style="background-color:#ffff;color:white;height:5px;"><td colspan="11"></td></tr>
                </thead>
                <tbody>
                    @foreach ($customer->customerTransactionStatement ? $customer->customerTransactionStatement : [] as $index => $tsitem)
                    <tr style="background-color:#837f7f;color:white">
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
                        <td style="width:10%;text-align:center;">
                           {{$tsitem->sell_amount}}
                        </td>
                        <td style="width:10%;text-align:center;">{{$tsitem->sell_paid}}</td>
                        <td style="width:10%;text-align:center;">{{$tsitem->sell_due}}</td>
                        <td style="width:11%;text-align:center;">{{$tsitem->cdc_amount}}</td>
                    </tr>
                    @endforeach
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
                </tbody>
            </table>
        </div>
    </div>