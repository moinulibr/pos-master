<div class="table-responsive  table-responsive-index-page">
    <table class="table table-bordered mb-0">
        <thead>
            <tr>
                <th style="width:5%;">Action</th>
                <th  style="width:3%;">#</th>
                <th  style="width:3%;">C.ID</th>
                <th>Name</th>
                <th>
                    <small>Customer Type</small>
                </th>
                <th>Phone</th>
               {{--  <th>Email</th> --}}
                <th><small>Advance</small></th>
                <th><small>Total Due</small></th>
                <th><small>Next Payment Date</small></th>
                <th>Address</th>
                <th>Created By</th>
                <th>Created At</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($datas as $index => $item)
                <tr>
                    <td style="width:3%;">
                        <div class="btn-group btnGroupForMoreAction">
                            <button type="button" class="btn btn-sm" data-toggle="dropdown" aria-expanded="true">
                                <i class="fas fa-ellipsis-v"></i>
                                {{-- <i class="fas fa-cogs"></i> --}}
                            </button>
                            <div class="dropdown-menu " x-placement="top-start" style="position: absolute; will-change: top, left; top: -183px; left: 0px;">
                                {{-- <a class="dropdown-item" href="javascript:void(0)">View</a> --}}
                                <a class="dropdown-item singleHistoryModal" data-id="{{$item->id}}" href="{{route('admin.customer.history')}}">History</a>
                                <a class="dropdown-item singleNextPaymentDateModal" data-id="{{$item->id}}" href="javascript:void(0)">Next Payment Date</a>
                                <a class="dropdown-item singleAddLoanModal" data-id="{{$item->id}}" href="javascript:void(0)">Add Loan</a>
                                <a class="dropdown-item singleAddAdvanceModal" data-id="{{$item->id}}" href="javascript:void(0)">Add Advance</a>
                                <a class="dropdown-item singleReceivePreviousDueModal" data-id="{{$item->id}}" href="javascript:void(0)">Receive Previous Due</a>
                                <a class="dropdown-item singleEditModal" data-id="{{$item->id}}" href="javascript:void(0)">Edit</a>
                                <a class="dropdown-item singleDeleteModal" data-id="{{$item->id}}" data-name="{{$item->name}}" href="javascript:void(0)">Delete</a>
                            {{-- <div class="dropdown-divider"></div>
                                <a class="dropdown-item" href="javascript:void(0)">Separated link</a>
                            </div> --}}
                        </div>
                    </td>
                    <th scope="row">
                        {{$index + 1}}
                    </th>
                    <th scope="row">
                        {{$item->custom_id}}
                    </th>
                    <td>
                        {{$item->name}}
                    </td> 
                    <td>
                        <small>
                            {{$item->customerTypies ? $item->customerTypies->name : ""}}
                        </small>
                    </td> 
                    <td>
                        {{$item->phone}}
                    </td>
                   {{--  <td>
                        {{$item->email ?? "No Email"}}
                    </td>  --}}
                    <td>
                        0
                    </td>
                    <td>
                        {{$item->previous_due}}
                    </td> 
                    <td>
                        {{$item->next_payment_date}}
                    </td>
                    <td>
                        <small>
                            {{$item->address}}
                        </small>
                    </td>
                    <td>
                        <small>
                            {{$item->createdBY ? $item->createdBY->name : NULL }}
                        </small>
                    </td>
                    <td>
                        <small>
                            {{ date(randomDateFormat_hh(),strtotime($item->created_at))}}
                        </small>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
    {{$datas->links()}}
</div>