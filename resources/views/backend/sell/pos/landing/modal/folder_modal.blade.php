
    <div class="modal fade text-left" id="folderpop" tabindex="-1" role="dialog" aria-labelledby="myModalLabel14" style="display: none;" aria-hidden="true">
        <div class="modal-dialog modal-dialog-scrollable modal-dialog-centered modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h3 class="modal-title" id="myModalLabel14">Sell Draft </h3>
                    <button type="button" class="close rounded-pill btn btn-sm btn-icon btn-light btn-hover-primary m-0" data-dismiss="modal" aria-label="Close">
                        <svg width="20px" height="20px" viewBox="0 0 16 16" class="bi bi-x" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                            <path
                                fill-rule="evenodd"
                                d="M4.646 4.646a.5.5 0 0 1 .708 0L8 7.293l2.646-2.647a.5.5 0 0 1 .708.708L8.707 8l2.647 2.646a.5.5 0 0 1-.708.708L8 8.707l-2.646 2.647a.5.5 0 0 1-.708-.708L7.293 8 4.646 5.354a.5.5 0 0 1 0-.708z"
                            ></path>
                        </svg>
                    </button>
                </div>
                <div class="modal-body pos-ordermain">
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="pos-order">
                                <form  class="form-inline" method="POST" action="{{route('admin.session.setting.create.selling.new.session')}}">
                                    @csrf   
                                    <div class="form-group mb-2">
                                        <label for="customer_name" class="sr-only">Customer Name</label>
                                        <input type="text" name="customer_name" required class="form-control" id="customer_name" placeholder="Customer Name">
                                    </div>
                                    <div class="form-group mx-sm-3 mb-2">
                                        <label for="customer_phone" class="sr-only">Customer Phone</label>
                                        <input type="text" name="customer_phone" required class="form-control" id="customer_phone" placeholder="Customer Phone">
                                    </div>
                                    <button type="submit" class="btn btn-primary mb-2" style="padding:5px;">Add New</button>
                                </form>
                            </div>
                        </div>
                        @php
                            $mastersessionname = masterSellingSession_hh();
                            $mastersession    = [];
                            $mastersession    = session()->has($mastersessionname) ? session()->get($mastersessionname)  : [];
                            $i = 1;
                        @endphp
                        @foreach ($mastersession as $index =>  $mstrsession)
                        <div class="col-lg-4">
                            <div class="pos-order">
                                <h5 class="pos-order-title"  style="text-align: center"> {{$mstrsession['name']}} </h5>
                                <div class="orderdetail-pos" style="text-align: center">
                                    <p>
                                        @if ($mstrsession['status'] == 'active')    
                                            <span style="padding:3px 5px; background-color:green;color:#fff">
                                            {{ucfirst($mstrsession['status'])}}    
                                            </span> 
                                            @else
                                            <span style="padding:3px 5px;  background-color:red;color:#fff">
                                                {{ucfirst($mstrsession['status'])}}    
                                            </span> 
                                        @endif
                                    </p>
                                    {{-- <h5 style="text-align: center;">
                                        <strong>{{$mstrsession['name']}}</strong>
                                    </h5> --}}
                                </div>
                                <div class="d-flex justify-content-end">
                                    <a href="{{route('admin.session.changing.selling.cart.session',$mstrsession['session_name'])}}" class="ml-3" title="Delete"><i class="fas fa-edit"></i></a>
                                    <a href="{{route('admin.session.deleting.selling.cart.session',$mstrsession['session_name'])}}" class=" ml-3" title="Delete"><i class="fas fa-trash-alt"></i></a>
                                    {{-- <a href="#" class="confirm-delete ml-3" title="Delete"><i class="fas fa-trash-alt"></i></a> --}}
                                </div>
                            </div>
                        </div>
                        @endforeach

                    </div>
                </div>
            </div>
        </div>
    </div>