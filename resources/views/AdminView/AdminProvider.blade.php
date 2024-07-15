@extends('.AdminView.AdminLayout.app')
@section('content')
    <div style="margin-left: 6%;padding: 30px" class="container mt-5">
        <div class="row">
            <div class="col-sm-4">
            <div class="card">
                <div class="card-header">
                    <h5>Add new provider</h5>
                </div>
                <div class="card-body">
                    <input id="name" class="form-control" type="text" name="name" placeholder="Enter full name" required/><br/>
                    <input id="email" class="form-control" type="email" name="email" placeholder="Enter email" required/><br/>
                    <input id="password" class="form-control" type="password" name="password" placeholder="Enter Password" required/><br/>
                </div>
                <div class="card-footer">
                    <button id="mybtn" class="btn btn-primary" type="submit">Submit</button>
                </div>
            </div>
        </div>
        <div class="col-sm-8">
           <div class="card">
               <div class="card-header">
                   <h5>All providers</h5>
               </div>
               <div class="card-body">
                   <table class="table table-striped">
                       <thead>
                       <tr>
                           <th>ID</th>
                           <th>Full Name</th>
                           <th>Email</th>
                           <th>Password</th>
                           <th>Action</th>
                       </tr>
                       </thead>
                       <tbody>
                       @foreach($data as $data2)
                       <tr>
                           <td>{{$data2->id}}</td>
                           <td>{{$data2->name}}</td>
                           <td>{{$data2->email}}</td>
                           <td>*******</td>
                           <td>
                               <img data-bs-toggle="modal" onclick="edit_provider({{$data2}})" data-bs-target="#myModal" type="button" width="25px" src="{{url('assest/icon/edit.png')}}"/>
                               <img type="button" width="25px" src="{{url('assest/icon/delete.png')}}"/>
                           </td>
                       </tr>
                       @endforeach
                       </tbody>
                   </table>
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
                        <h4 class="modal-title">Edit Provider</h4>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                    </div>

                    <!-- Modal body -->
                    <div class="modal-body">
                       <div class="container">
                           <div class="card">
                               <div class="card-body">
                                   <input id="edit_name" class="form-control" type="name" value="" required/><br/>
                                   <input id="edit_email" class="form-control" type="email" value="" required/><br/>
                                   <input id="new_password" class="form-control" type="password" placeholder="Enter new password" required/><br/>
                                   <button id="update_submit" type="submit" class="btn btn-primary">Update</button>
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
        document.getElementById('mybtn').addEventListener('click',function (e)
        {
            e.preventDefault();
            let name=document.getElementById('name').value;
            let email=document.getElementById('email').value;
            let password=document.getElementById('password').value;
            const emailPattern =
                /^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/;
            const isValid = emailPattern.test(email);
            if(name&&email&&password&&isValid==true)
            {
                $.ajax({
                    type:'POST',
                    url:"{{url('/admin/dashboard/provider/store')}}",
                    data:{
                        "_token": "{{ csrf_token() }}",
                        name:name,
                        email:email,
                        password:password,
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


        function edit_provider(ans)
        {
            document.getElementById('edit_name').value=ans.name;
            document.getElementById('edit_email').value=ans.email;
            document.getElementById('update_submit').addEventListener('click',function ()
            {
                let name=document.getElementById('edit_name').value;
                let email=document.getElementById('edit_email').value;
                let password=document.getElementById('new_password').value;
                const emailPattern =
                    /^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/;
                const isValid = emailPattern.test(email);
                if(name&&email&&password&&isValid==true)
                {
                    $.ajax({
                        type:'POST',
                        url:"{{url('/admin/dashboard/provider/update')}}",
                        data:{
                            "_token": "{{ csrf_token() }}",
                            id:ans.id,
                            name:name,
                            email:email,
                            password:password,
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
                        position:'right',
                        icon: "error",
                        title: "Invalid credentials",
                        showConfirmButton: false,
                        timer: 1500
                    });
                }
            })
        }

        // function delete_provider(data)
        // {
        //
        // }
    </script>
@endsection
