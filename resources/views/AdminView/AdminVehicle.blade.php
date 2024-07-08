@extends('.AdminView.AdminLayout.app')
@section('content')
    <div style="margin-left: 7%;padding: 40px" class="container md-4">
        <div class="col-sm-12">
            <div class="card">
                <div class="card-header">
                    <div>
                        <span style="font-weight: bolder;font-size: larger">All vehicle type</span>
                        <button data-bs-toggle="modal" data-bs-target="#myModal" class="btn btn-primary" style="float: right">+ Add vehicle</button>
                    </div>

                </div>
             <div class="card-body">
                 <table class="table table-striped">
                     <thead>
                     <tr>
                         <th>Type</th>
                         <th>Charge</th>
                         <th>Action</th>
                     </tr>
                     </thead>
                     <tbody>
                     @foreach($data as $data2)
                         <tr>
                             <td>{{$data2->type}}</td>
                             <td><span>&#8377 </span>{{$data2->charges}}</td>
                             <td>
                                 <img type="button" data-bs-toggle="modal" onclick="edit_vehicle({{$data2}})" data-bs-target="#myModal2" type="button" width="25px" src="{{url('assest/icon/edit.png')}}"/>
                                 <img onclick="destroy({{$data2}})" type="button" width="25px" src="{{url('assest/icon/delete.png')}}"/>
                             </td>
                         </tr>
                     @endforeach
                     </tbody>
                 </table>
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
                        <div class="container">
                            <div class="card">
                                <div class="card-body">
                                    <input id="type" class="form-control" type="name" placeholder="Enter type of vehicle" required/><br/>
                                    <input id="charge" class="form-control" type="number" placeholder="Enter charges" required/><br/>
                                    <button id="add_vehicle" type="submit" class="btn btn-primary">Submit</button>
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


        <!-- The Modal -->
        <div class="modal fade" id="myModal2">
            <div class="modal-dialog">
                <div class="modal-content">

                    <!-- Modal Header -->
                    <div class="modal-header">
                        <h4 class="modal-title">Edit Vehicle</h4>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                    </div>

                    <!-- Modal body -->
                    <div class="modal-body">
                        <div class="container">
                            <div class="card">
                                <div class="card-body">
                                    <input id="edit_type" class="form-control" type="name" value="" required/><br/>
                                    <input id="edit_charge" class="form-control" type="number" value="" required/><br/>
                                    <button id="edit_vehicle" type="submit" class="btn btn-primary">Submit</button>
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
        document.getElementById('add_vehicle').addEventListener('click',function ()
        {
            let type=document.getElementById('type').value;
            let charge=document.getElementById('charge').value;
            if(charge&&type)
            {
                $.ajax({
                    type:'POST',
                    url:"{{url('/admin/dashboard/vehicle/store')}}",
                    data:{
                        "_token": "{{ csrf_token() }}",
                        type:type,
                        charge:charge,
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
        function edit_vehicle(data) {
            document.getElementById('edit_type').value = data.type;
            document.getElementById('edit_charge').value = data.charges;

            document.getElementById('edit_vehicle').addEventListener('click', function () {
                let type = document.getElementById('edit_type').value;
                let charge = document.getElementById('edit_charge').value;
                if (charge && type) {
                    $.ajax({
                        type: 'POST',
                        url: "{{url('/admin/dashboard/vehicle/update')}}",
                        data: {
                            "_token": "{{ csrf_token() }}",
                            id: data.id,
                            type: type,
                            charge: charge,
                        },
                        success: function () {

                            Swal.fire({
                                icon: "success",
                                title: "Your work has been saved",
                                showConfirmButton: false,
                                timer: 1500
                            });
                            location.reload();
                        },
                        error: function () {
                            Swal.fire({
                                icon: "error",
                                title: "Something went wrong",
                                showConfirmButton: false,
                                timer: 1500
                            });
                        }
                    })
                } else {
                    Swal.fire({
                        icon: "error",
                        title: "Invalid credentials",
                        showConfirmButton: false,
                        timer: 1500
                    });
                }

            })

        }

        function destroy(data)
        {
            Swal.fire({
                title: "Are you sure?",
                text: "You won't be able to revert this!",
                icon: "warning",
                showCancelButton: true,
                confirmButtonColor: "#3085d6",
                cancelButtonColor: "#d33",
                confirmButtonText: "Yes, delete it!"
            }).then((result) => {
                if (result.isConfirmed) {

                    $.ajax({
                        type: 'POST',
                        url: "{{url('/admin/dashboard/vehicle/destroy')}}",
                        data: {
                            "_token": "{{ csrf_token() }}",
                            id: data.id,
                        },
                        success: function () {

                            Swal.fire({
                                title: "Deleted!",
                                text: "Your file has been deleted.",
                                icon: "success"
                            });
                            location.reload();
                        },
                        error: function () {
                            Swal.fire({
                                icon: "error",
                                title: "Something went wrong",
                                showConfirmButton: false,
                                timer: 1500
                            });
                        }
                    })


                }
            });

        }
    </script>
@endsection
