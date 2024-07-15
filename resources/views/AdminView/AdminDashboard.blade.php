@extends('.AdminView.AdminLayout.app')
@section('content')
<div style="margin-left: 6%;padding: 40px" class="container mt-5">
    <div class="row">
        <div class="col-sm-3">
            <div class="card">
                <div class="card-header">
                    <h4 style="font-family: Apple">TOTAL INCOME</h4>
                </div>
                <div class="card-body">
                    <img  width="50px" src="{{url('assest/icon/money.png')}}"/>
                    <span style="float: right;font-weight: bold;font-size: xx-large" ><span>&#8377 </span>{{$add}}</span>
                </div>
            </div>
        </div>
        <div class="col-sm-3">
            <div class="card">
                <div class="card-header">
                    <h4 style="font-family: Apple">VEHICLE PARKED</h4>
                </div>
                <div class="card-body">
                    <img  width="50px" src="{{url('assest/icon/road.png')}}"/>
                    <span style="float: right;font-weight: bold;font-size: xx-large" >{{$length}}</span>
                </div>
            </div>
        </div>
        <div class="col-sm-3">
            <div class="card">
                <div class="card-header">
                    <h4 style="font-family: Apple">PROVIDERS</h4>
                </div>
                <div class="card-body">
                    <img  width="50px" src="{{url('assest/icon/operator.png')}}"/>
                    <span style="float: right;font-weight: bold;font-size: xx-large" >{{$length2}}</span>
                </div>
            </div>
        </div>
    </div>
</div>
    <div style="margin-left: 8%;" >
        <div class="card">
            <div class="card-header">
                <h4>Select date-wise data</h4>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-sm-5">
                        <span>From *</span>   <input id="from" class="form-control" type="date"/>
                    </div>
                    <div class="col-sm-5">
                        <span>To *</span>  <input id="to" class="form-control" type="date"/>
                    </div>
                </div><br/>
                <button id="submit" class="btn btn-dark">Submit</button><br/>
                <br/>
                <div id="card2" style="display: none" class="card">
                    <div class="card-body">
                        <div style="font-family: Apple" class="row">
                            <div style="font-size: x-large" class="col-sm-4">
                                <span>No. of days</span>
                                <span id="day">0</span>
                            </div>
                            <div style="font-size: x-large" class="col-sm-4">
                                <span>Total Income: </span><span>&#8377 </span>
                                <span id="income">0</span>
                            </div>
                            <div style="font-size: x-large" class="col-sm-4">
                                <span>Vehicle parked: </span>
                                <span id="parked">0</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        document.getElementById('submit').addEventListener('click',function ()
        {

            let from=document.getElementById('from').value;
            let to=document.getElementById('to').value;

            if(from&&to)
            {
                $.ajax({
                    type:'POST',
                    url:"{{url('/admin/dashboard/s_data')}}",
                    data:{
                        "_token": "{{ csrf_token() }}",
                        from:from,
                        to:to,
                    },
                    success:function (Response)
                    {
                        document.getElementById('parked').innerHTML=Response[0];
                        document.getElementById('income').innerHTML=Response[1];
                        document.getElementById('day').innerHTML=Response[2];
                        document.getElementById('card2').style.display='block';
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
