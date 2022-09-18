<div class="table-responsive">
    <table class="table table-bordered mb-0">
        <thead>
            <tr>
                <th  style="width:3%;">#</th>
                <th>Name</th>
                <th>
                    <small>Customer Type</small>
                </th>
                <th>Phone</th>
               {{--  <th>Email</th> --}}
                <th><small>Total Due</small></th>
                <th><small>Payment Date</small></th>
                <th>Address</th>
                <th style="width:5%;">Action</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($datas as $index => $item)
                <tr>
                    <th scope="row">
                        {{$index + 1}}
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
                        {{$item->previous_due}}
                    </td> 
                    <td>
                        {{$item->previous_due_date}}
                    </td>
                    <td>
                        <small>
                            {{$item->address}}
                        </small>
                    </td>
                    <td style="width:3%;">
                        <div class="btn-group btnGroupForMoreAction">
                            <button type="button" class="btn btn-sm" data-toggle="dropdown" aria-expanded="true">
                                <i class="fas fa-ellipsis-v"></i>
                                {{-- <i class="fas fa-cogs"></i> --}}
                            </button>
                            <div class="dropdown-menu " x-placement="top-start" style="position: absolute; will-change: top, left; top: -183px; left: 0px;">
                                {{-- <a class="dropdown-item" href="javascript:void(0)">View</a> --}}
                                <a class="dropdown-item singleEditModal" data-id="{{$item->id}}" href="javascript:void(0)">Edit</a>
                                <a class="dropdown-item singleDeleteModal" data-id="{{$item->id}}" data-name="{{$item->name}}" href="javascript:void(0)">Delete</a>
                            {{-- <div class="dropdown-divider"></div>
                                <a class="dropdown-item" href="javascript:void(0)">Separated link</a>
                            </div> --}}
                        </div>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
    {{$datas->links()}}
</div>