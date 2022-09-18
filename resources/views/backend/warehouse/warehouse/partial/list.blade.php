<div class="table-responsive">
    <table class="table table-bordered mb-0">
        <thead>
            <tr>
                <th  style="width:10%;">#</th>
                <th>Name</th>
                <th>Description</th>
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
                        {{$item->description}}
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
     
    {{-- <div class="row">
        <div class="col-md-3">
            Showing 1 to 10 of {{ $datas->total() }} entries 
        </div>
        <div class="col-md-9">
            {{$datas->links()}} 
        </div>
    </div> --}}
    {{$datas->links()}} 
    
</div>