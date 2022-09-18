<div class="modal-dialog modal-lg">
    <form action="{{route('admin.unit.update')}}" method="POST" class="updateUnitData modal-content">
        @csrf
        <input type="hidden" name="id" value="{{$unit->id}}">
        <div class="modal-header">
            <h5 class="modal-title">
                Update Unit 
                <span class="font-weight-light">Information</span>
                <br />
                {{-- <small class="text-muted">Add New Unit</small> --}}
            </h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">×</button>
        </div>
        <div class="modal-body">

            <div class="form-group row">
                <div class="col-md-12 processing" style="text-align: center;display: none;">
                    <span style="color:saddlebrown;">
                        <span class="spinner-border spinner-border-sm" role="status"></span>Processing
                    </span>
                </div>
            </div>


            <div class="form-group row">
                <label class="col-form-label col-sm-3 text-sm-right">Unit Full Name</label>
                <div class="col-sm-8">
                    <input name="full_name" value="{{$unit->full_name}}" type="text" class="form-control" placeholder="Unit Full Name">
                    <strong class="full_name_err color-red"></strong>
                    <div class="clearfix"></div>
                </div>
            </div>
            <div class="form-group row">
                <label class="col-form-label col-sm-3 text-sm-right">Unit Short Name</label>
                <div class="col-sm-8">
                    <input name="short_name" value="{{$unit->short_name}}" type="text" class="form-control" placeholder="Unit Short Name">
                    <strong class="short_name_err color-red"></strong>
                    <div class="clearfix"></div>
                </div>
            </div>
            <div class="form-group row">
                <label class="col-form-label col-sm-3 text-sm-right">
                        Parent Unit Name
                </label>
                <div class="col-sm-8">
                    <select name="parent_id" id="" class="form-control" style="background-color: lavender;color:green;">
                        <option {{$unit->parent_id == 0 ?'selected' : ''}} value="0">No Parent Unit</option>
                        @foreach ($datas as $item)
                            <option {{$unit->parent_id == $item->id ?'selected' : ''}} value="{{ $item->id }}">{{ $item->full_name }}</option>
                        @endforeach
                    </select>
                    <strong class="parent_id_err color-red"></strong>
                    <div class="clearfix"></div>
                </div>
            </div>
            <div class="form-group row">
                <label class="col-form-label col-sm-3 text-sm-right">
                        Calculation Value
                </label>
                <div class="col-sm-8">
                    <input name="calculation_value" value="{{$unit->calculation_value}}" type="number" step="any" class="form-control" placeholder="Calculation By This Value"  style="background-color: lavender;color:green;">
                    <strong class="calculation_value_err color-red"></strong>
                    <div class="clearfix"></div>
                </div>
            </div>
            <div class="form-group row">
                <label class="col-form-label col-sm-3 text-sm-right">Base Unit</label>
                <div class="col-sm-8">
                    <select name="base_unit_id" id="" class="form-control">
                        <option {{$unit->base_unit_id == 0 ?'selected' : ''}} value="0">No Base Unit</option>
                        @foreach ($datas as $item)
                            <option {{$unit->base_unit_id == $item->id ?'selected' : ''}} value="{{ $item->id }}">{{ $item->full_name }}</option>
                        @endforeach
                    </select>
                    <strong class="base_unit_id_err color-red"></strong>
                    <div class="clearfix"></div>
                </div>
            </div>
            <div class="form-group row">
                <label class="col-form-label col-sm-3 text-sm-right">Description</label>
                <div class="col-sm-8">
                    <textarea name="description" class="form-control" placeholder="Description">{{$unit->description}}</textarea>
                    <strong class="description_err color-red"></strong>
                    <div class="clearfix"></div>
                </div>
            </div>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            <input type="submit" class="btn btn-primary" role="status" value="Update">
        </div>
    </form>
</div>
