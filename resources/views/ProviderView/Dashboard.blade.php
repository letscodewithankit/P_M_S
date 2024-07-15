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
                    <div id="print_data">
                   <div style="margin-left: 40%">
                       <img style="position: center" width="45px" src="{{url('assest/icon/parking.png')}}"/><br/>
                   </div>
                    <div style="margin-left: 33%">
                        <h5>MADAN MAHAL</h5>
                        <p3>JABALPUR, INDIA</p3><br/><br/>
                        <h2 id="date"></h2>
                        <h4 id="time"></h4>
                    </div>
                    <div>
                        <table class="table table-striped">
                            <thead>
                            <tr>
                                <th>Type</th>
                                <th>Amount</th>
                                <th>Vehicle no.</th>
                            </tr>

                            </thead>
                            <tbody>
                            <tr>
                                <td id="type_t"></td>
                                <td id="amount_t"></td>
                                <td id="vehicle_t"></td>
                            </tr>
                            </tbody>
                        </table>
                    </div>

                    <div style="margin-left: 30%">
                        <h8>Thank you</h8>
                        <h8>Visit again</h8>
                    </div>
                    </div>

                </div>
                <div class="card-footer">
                    <button onclick="p_data()" class="btn btn-danger">Print</button>
                </div>
            </div>
        </div>

    </div>



    <script>
        window.onload=function ()
        {
            console.log('hello')
            const date = new Date();

            let day = date.getDate();
            let month = date.getMonth() + 1;
            let year = date.getFullYear();

            let currentTime = new Date();

            let currentOffset = currentTime.getTimezoneOffset();

            let ISTOffset = 330;   // IST offset UTC +5:30

            let ISTTime = new Date(currentTime.getTime() + (ISTOffset + currentOffset)*60000);

// ISTTime now represents the time in IST coordinates

            let hoursIST = ISTTime.getHours()
            let minutesIST = ISTTime.getMinutes()

            document.getElementById('date').innerHTML=day+"/"+month+"/"+year;
            document.getElementById('time').innerHTML="<h5 style='margin-left: 10%'>" + hoursIST + ":" + minutesIST + " " + "</h5>";
        }
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

                        let t=JSON.parse(document.getElementById('option').value);
                        document.getElementById('type_t').innerHTML=t.type;
                        document.getElementById('amount_t').innerHTML=document.getElementById('charge').value;
                        document.getElementById('vehicle_t').innerHTML=document.getElementById('veh_no').value;

                        document.getElementById('option').value="";
                        document.getElementById('charge').value="";
                        document.getElementById('veh_no').value="";

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

function p_data()
{
    let p=document.getElementById('print_data').innerHTML;
    let p2=window.open('', '', 'height=600', 'width=900');
    p2.document.write(p);
    p2.document.close();
    p2.print();
}

    </script>

@endsection
