<div class="table-responsive">
    <table class="table table-bordered mb-0">
        <thead>
            <tr>
                <th>#</th>
                <th>Unit Full Name</th>
                <th>Short Name</th>
                <th>Parent Unit</th>
                <th>Base Unit</th>
                <th>Description</th>
                <th style="width:3%;">Action</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($datas as $index => $item)
                <tr>
                    <th scope="row">
                        {{$index + 1}}
                    </th>
                    <td>
                        {{$item->full_name}}
                    </td>
                    <td>{{$item->short_name}}</td>
                    <td>
                        @php
                            $parent = $item->parentUnit(); 
                            $parentName = "No Parent";
                            if($parent['status'] == true)
                            {
                                $parentName = $parent['unit']->short_name;
                            } 
                        @endphp
                        {{$parentName}}
                    </td>
                    <td>
                        @php
                            $parent = $item->baseUnit(); 
                            $parentName = "No Base Unit";
                            if($parent['status'] == true)
                            {
                                $parentName = $parent['unit']->short_name;
                            } 
                        @endphp
                        {{$parentName}}
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
                                <a class="dropdown-item singleDeleteModal" data-id="{{$item->id}}" data-name="{{$item->full_name}}" href="javascript:void(0)">Delete</a>
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