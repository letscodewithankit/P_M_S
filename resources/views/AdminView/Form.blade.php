@extends('.AdminView.AdminLayout.app')
@section('content')
    <div style="margin-left: 5%;padding: 30px;" class="container">
        <div class="row">
             <div class="col-sm-6">
                 <div style="padding:20px;height: 420px;border: 1px solid darkgray">
                     <div style="display: inline" id="1">
                         <h4>1. Personal Detail's</h4>
                         <div style="background-color: #fff;border-top: 2px dashed #8c8b8b;"></div><br/>
                         <input type="text" id="name" class="form-control" placeholder="Enter full name" required/><br/>
                         <input type="email" id="email" class="form-control" placeholder="Enter email"/><br/>
                         <input type="number" id="contact" class="form-control" placeholder="Enter mob. number" required/><br/>
                         <textarea type="text" id="message" class="form-control" placeholder="Enter message"></textarea>
                     </div>
                     <div style="display: none" id="2">
                         <h4>2. Services</h4>
                         <div style="background-color: #fff;border-top: 2px dashed #8c8b8b;"></div><br/>
                         @foreach($data as $data2)
                         <div style="font-size: larger" class="form-check checkbox-xl get_checked_data">

                             <input  class="form-check-input" onclick="check({{$data2->id}})" type="checkbox" value="{{$data2->id}}" id="check0" />
                             <label value="{{$data2->service}}"  class="form-check-label" for="checkbox-3">{{$data2->service}}</label>

                         </div>
                         @endforeach

                         <br/>
                         <div class="row">
                             <h6>Select date for storage</h6>
                             <div class="col-sm-4">
                                 <h7>From *</h7>
                                 <input id="check" type="date" class="form-control" id="from" disabled/>
                             </div>
                             <div class="col-sm-4">
                                 <h7>To *</h7>
                                 <input id="check2" type="date" class="form-control" id="to" disabled/>
                             </div>
                         </div>
                         <br/><br/>
                     </div>
                     <div style="display: none" id="3">
                         <h4>3. Payment</h4>
                         <div style="background-color: #fff;border-top: 2px dashed #8c8b8b;"></div><br/><br/>
                         <h6>Payment *</h6>
                         <input class="form-control" value="&#8377 1000" disabled/><br/><br/><br/><br/><br/><br/><br/>
                     </div>
                     <br/>
                     <button onclick="next('next')" id="next" style="float: right;margin-left: 4px" class="btn btn-primary">>>Next</button>
                     <button id="add_to_cart" style="display:none;float: right;margin-left: 4px" class="btn btn-success">Add to table</button>
                     <button id="submit" style="display:none;float: right;margin-left: 4px" class="btn btn-success">Submit</button>
                     <button onclick="next('prev')" id="prev" style="display:none;float: right;margin-left: 4px" class="btn btn-dark">>>Prev</button>
                 </div>
             </div>

            <div class="col-sm-6">
                <div class="card">
                    <div class="card-header">
                        <span style="font-size: larger">Table</span>
                        <button data-bs-toggle='modal' data-bs-target='#myModal' class="btn btn-dark" style="float: right">All data</button>
                    </div>
                </div>
                <div class="table-responsive" style="padding: 20px; border: 1px solid grey">
                    <table id="myTable"  class="table table-striped">
                        <thead>
                        <tr>
                            <th>Full name</th>
                            <th>Email</th>
                            <th>Mobile number</th>
                            <th>Message</th>
                            <th>Services</th>
                        </tr>
                        </thead>
                        <tbody id="render_data">

                        </tbody>
                    </table>
                </div>
            </div>

             </div>
        </div>

    <!-- The Modal -->
    <div class="modal fade" id="myModal">
        <div class="modal-dialog modal-lg modal-dialog-scrollable">
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
                                <div>
                                    <table class="table table-striped">
                                        <thead>
                                        <tr>
                                            <th>Full name</th>
                                            <th>Email</th>
                                            <th>Mob no.</th>
                                            <th>Message</th>
                                            <th>Service</th>
                                        </tr>

                                        </thead>
                                        <tbody>
                                        @foreach($data44 as $data55)
                                        <tr>
                                            <td>{{$data55->full_name}}</td>
                                            <td>{{$data55->email}}</td>
                                            <td>{{$data55->mob_number}}</td>
                                            <td>{{$data55->message}}</td>
                                            <td>{{($data55->service)}}</td>
                                        </tr>
                                        @endforeach
                                        </tbody>
                                    </table>
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
        let process=true;
        let html="";
        const fd=new FormData();
        const data=[];
        function check(id)
        {
            if(id==3&&process==true)
            {
                document.getElementById('check').removeAttribute('disabled');
                document.getElementById('check2').removeAttribute('disabled');
                process=false;
            }
            else if(id==3&&process==false)
            {
                document.getElementById('check').disabled=true;
                document.getElementById('check2').disabled=true;
                process=true;
            }

        }
        let a=0;
        function next(target)
        {
            if(target=='next')
            {
                ++a;
            }
            else
            {
                --a;
            }
            if(a==1)
            {
                document.getElementById('2').style.display="block";
                document.getElementById('1').style.display="none";
                document.getElementById('3').style.display="none";

                document.getElementById('add_to_cart').style.display="block";
                document.getElementById('prev').style.display="block";
                document.getElementById('submit').style.display="none";
                document.getElementById('next').style.display="block";


                let x = document.getElementById("myTable").rows.length;

                if(x<=1)
                {
                    document.getElementById('next').disabled=true;
                }
                else
                {
                    document.getElementById('next').removeAttribute('disabled');
                }


            }
            if(a==2)
            {
                document.getElementById('2').style.display="none";
                document.getElementById('1').style.display="none";
                document.getElementById('3').style.display="block";

                document.getElementById('add_to_cart').style.display="none";
                document.getElementById('prev').style.display="block";
                document.getElementById('next').style.display="none";
                document.getElementById('submit').style.display="block";
            }
            if(a==0)
            {
                document.getElementById('2').style.display="none";
                document.getElementById('1').style.display="block";
                document.getElementById('3').style.display="none";

                document.getElementById('next').removeAttribute('disabled');

                document.getElementById('add_to_cart').style.display="none";
                document.getElementById('prev').style.display="none";
                document.getElementById('next').style.display="block";
                document.getElementById('submit').style.display="none";
            }
        }
      document.getElementById('add_to_cart').addEventListener('click',function ()
      {
          var full_name = document.getElementById('name').value;
                var email = document.getElementById('email').value;
                var contact = document.getElementById('contact').value;
                var message = document.getElementById('message').value;
                var check11 = document.getElementsByClassName('get_checked_data')[0].children[0].checked;
                var check22 = document.getElementsByClassName('get_checked_data')[1].children[0].checked;
                var check33 = document.getElementsByClassName('get_checked_data')[2].children[0].checked;

                var service = "";

                if (check11 == true) {
                    service += document.getElementsByClassName('get_checked_data')[0].children[1].textContent + "<br/>";
                }
                if (check22 == true) {
                    service += document.getElementsByClassName('get_checked_data')[1].children[1].textContent + "<br/>";
                }
                if (check33 == true) {
                    service += document.getElementsByClassName('get_checked_data')[2].children[1].textContent;
                }

                if ((full_name) && (contact) && (check11 || check22 || check33))
                {

                    document.getElementById('next').removeAttribute('disabled');

                    document.getElementById('name').value='';
                    document.getElementById('email').value='';
                    document.getElementById('contact').value='';
                    document.getElementById('message').value='';

                    document.getElementsByClassName('get_checked_data')[0].children[0].checked=false;
                    document.getElementsByClassName('get_checked_data')[1].children[0].checked=false;
                    document.getElementsByClassName('get_checked_data')[2].children[0].checked=false;

                    document.getElementById('check').disabled=true;
                    document.getElementById('check2').disabled=true;
                    process=true;

                    let date22=document.getElementById('check').value
                        +"-"+document.getElementById('check2').value;


                    data.push({
                        full_name:full_name,
                        email:email,
                        contact:contact,
                        message:message,
                        service,service

                    })

                    html += "<tr>" +
                        "<td>" + full_name + "</td>" +
                        "<td>" + email + "</td>" +
                        "<td>" + contact + "</td>" +
                        "<td>" + message + "</td>" +
                        "<td>" +
                        service
                        + "</td>" +
                        "</tr>";
                    document.getElementById('render_data').innerHTML = html;

                }
                else
                {
                    Swal.fire({
                        icon: "error",
                        title: "Something went wrong",
                        showConfirmButton: false,
                        timer: 1500
                    });
                }

      })


        document.getElementById('submit').addEventListener('click',function ()
        {

            console.log(data)
            $.ajax({
                type:'POST',
                url:"{{url('/form/store')}}",
                data:{
                    "_token": "{{ csrf_token() }}",
                    data:data
                },
                success:function ()
                {

                    location.reload();
                    Swal.fire({
                        icon: "success",
                        title: "Your work has been saved",
                        showConfirmButton: false,
                        timer: 1500
                    });

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
        })




    </script>
@endsection
