@extends('.AdminView.AdminLayout.app')
@section('content')
    <div style="margin-left: 6%;padding: 30px" class="container md-5">
        <div class="col-sm-10">
            <div class="card">
                <div class="card-header">
                    <h4>Select Vehicle</h4>
                </div>
                <div class="card-body">
                    <select id="vehicle" onchange="get_report()" class="form-control">
                        <option disabled selected>----select----</option>
                        @foreach($data as $data2)
                        <option value="{{$data2->get_parked_data}}">{{$data2->type}}</option>
                        @endforeach
                    </select><br/>
                    <div class="row">
                        <div class="col-sm-12">
                            <div class="card">
                                <div class="card-body">
                                    <table  class="table table-striped">
                                        <thead>
                                        <tr>
                                            <th>Provider ID</th>
                                            <th>Vehicle Number</th>
                                            <th>Date</th>
                                            <th>Time</th>
                                        </tr>
                                        </thead>
                                        <tbody id="table">

                                        </tbody>
                                    </table>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>

    <div style="margin-left: 6%;padding: 30px" class="container md-5">
        <div class="col-sm-10">
            <div class="card">
                <div class="card-header">
                    <h4>Select Provider</h4>
                </div>
                <div class="card-body">
                    <select id="provider" onchange="get_provider()" class="form-control">
                        <option disabled selected>----select----</option>
                        @foreach($data4 as $data5)
                            <option value="{{$data5->get_parked_data}}">{{$data5->name}} ({{$data5->id}})</option>
                        @endforeach
                    </select><br/>
                    <div class="row">
                        <div class="col-sm-12">
                            <div class="card">
                                <div class="card-body">
                                    <table  class="table table-striped">
                                        <thead>
                                        <tr>
                                            <th>Vehicle ID</th>
                                            <th>Vehicle Number</th>
                                            <th>Date</th>
                                            <th>Time</th>
                                            <th>Action</th>
                                        </tr>
                                        </thead>
                                        <tbody id="table2">

                                        </tbody>
                                    </table>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- The Modal -->
        <div class="modal fade" id="myModal">
            <div class="modal-dialog">
                <div class="modal-content">

                    <!-- Modal Header -->
                    <div class="modal-header">
                        <h4 class="modal-title">Add Vehicle</h4>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                    </div>

                    <!-- Modal body -->
                    <div class="modal-body">
                        <div class="card">
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
        function get_report()
        {
            let data=JSON.parse(document.getElementById('vehicle').value);
            html="";
            for(let i=0;i<data.length;i++)
            {
                html+="<tr>"+
                    "<td>"+data[i].id+"</td>"
                    +"<td>"+data[i].vehicle_number+"</td>"
                    +"<td>"+data[i].date+"</td>"
                    +"<td>"+data[i].time+"</td>"
                    +"<tr/>"
                ;
            }
            document.getElementById('table').innerHTML=html;
        }

        function get_provider()
        {
            let data=JSON.parse(document.getElementById('provider').value)
            let html="";
            for(let i=0;i<data.length;i++)
            {
                html+="<tr>"+
                    "<td>"+data[i].vehicle_id+"</td>"
                    +"<td>"+data[i].vehicle_number+"</td>"
                    +"<td>"+data[i].date+"</td>"
                    +"<td>"+data[i].time+"</td>"
                    +"<td>"+"<img type='button' width='25px' data-bs-toggle='modal' data-bs-target='#myModal' src='{{url('assest/icon/view.png')}}'/>"+"</td>"
                    +"<tr/>"
                ;
            }
            document.getElementById('table2').innerHTML=html;
        }

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
    </script>
@endsection
