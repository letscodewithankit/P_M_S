@extends('.ProviderView.ProviderLayout.app')
@section('content')
    <head>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
              integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH"
              crossorigin="anonymous">
    </head>
    <div class="container-fluid row" style="margin-top: 2%">

        <div class="col-sm-6">
            <div class="container-fluid">
                <div class="card">
                    <div style="font-size: larger;font-weight: bold" class="card-header">
                        <span>Provider</span>
{{--                        <span style="float: right"><button data-bs-toggle="modal" data-bs-target="#myModal" class="btn btn-dark">Recent</button></span>--}}
                    </div>
                    <div class="card-body">
                        <select id="option" onchange="change()" class="form-select">
                            <option disabled selected>---- select ----</option>
                            @foreach($data as $data2)
                            <option value="{{$data2}}">{{$data2->type}}</option>
                            @endforeach
                        </select><br/>
                        <div class="col-sm-4">
                            <div class="input-group">
                              <span class="input-group-text">
                              &#8377
                              </span>
                                <input type="text" class="form-control" name="charge" id="charge" disabled>
                            </div>
                        </div><br/>
                        <input id="veh_no" class="form-control" type="text" placeholder="Enter vehicle number"/> <br/>

                        <button id="check_in" class="btn btn-success">Check In</button>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-sm-6">
            <div style="margin-top: -3%" class="card">
                <div class="card-body">
                    <div style="font-size: larger;font-family: Calibri;font-weight: bold"><span>Name:</span>
                        <span>{{Auth::guard('web')->user()->name}}</span>
                        <span style="float: right"><span>Email: </span>{{Auth::guard('web')->user()->email}}</span>
                    </div>
                </div>
            </div><br/>
            <div class="card">
                <div class="card-header">
                    <h5>Receipt</h5>
                </div>
                <div class="card-body">

                </div>
            </div>
        </div>
        <!-- The Modal -->
        <div class="modal fade" id="myModal">
            <div class="modal-dialog">
                <div class="modal-content">

                    <!-- Modal Header -->
                    <div class="modal-header">
                        <h4 class="modal-title">Edit Provider</h4>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                    </div>

                    <!-- Modal body -->
                    <div class="modal-body">
                        <div class="container">
                            <div class="card">
                                <div class="card-body">
                                   <div id="table">{{Auth::guard('web')->user()}}</div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Modal footer -->
                    <div class="modal-footer">
                        <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>
                    </div>

                </div>
            </div>
        </div>
    </div>



    <script>
        function change()
        {
            let a=JSON.parse(document.getElementById('option').value);
            document.getElementById('charge').value=a.charges;
        }
        document.getElementById('check_in').addEventListener('click',function ()
        {
            let a=JSON.parse(document.getElementById('option').value);
            let veh_no=document.getElementById('veh_no').value;
            if(veh_no&&a)
            {
                $.ajax({
                    type:'POST',
                    url:'{{url('/provider/dashboard/store')}}',
                    data:{
                        "_token": "{{ csrf_token() }}",
                        vehicle_id:a.id,
                        provider_id:{{Auth::guard('web')->user()->id}},
                        vehicle_number:veh_no
                    },
                    success:function ()
                    {
                        Swal.fire({
                            icon: "success",
                            title: "Your work has been saved",
                            showConfirmButton: false,
                            timer: 1500
                        });
                        location.reload();
                    },
                    error:function ()
                    {
                        Swal.fire({
                            icon: "error",
                            title: "Something went wrong",
                            showConfirmButton: false,
                            timer: 1500
                        });
                    }
                })
            }
            else
            {
                Swal.fire({
                    icon: "error",
                    title: "Invalid credentials",
                    showConfirmButton: false,
                    timer: 1500
                });
            }
        })



    </script>

@endsection
