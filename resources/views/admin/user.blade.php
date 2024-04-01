@extends('layouts.master')
@section('title')
    Users
@endsection
@section('page-title')
    Users
@endsection
@section('css')
    <!-- DataTables -->
    <link href="{{ URL::asset('build/libs/datatables.net-bs4/css/dataTables.bootstrap4.min.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ URL::asset('build/libs/datatables.net-buttons-bs4/css/buttons.bootstrap4.min.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ URL::asset('build/libs/datatables.net-select-bs4/css/select.bootstrap4.min.css') }}" rel="stylesheet" type="text/css" />

    <!-- Responsive datatable examples -->
    <link href="{{ URL::asset('build/libs/datatables.net-responsive-bs4/css/responsive.bootstrap4.min.css') }}" rel="stylesheet" type="text/css" />

    <link href="{{ URL::asset('build/libs/sweetalert2/sweetalert2.min.css') }}" rel="stylesheet" type="text/css" />

@endsection
@section('body')

    <body data-sidebar="colored">
    @endsection
    @section('content')
        <div class="row">
            <div class="col-md-12">
                <div class="content-description mb-3">
                    You can add, update and remove users on your account(1/2 remaining).
                </div>
                <div class="flex-end mb-3">
                    <button type="button" class="btn btn-primary" data-toggle="modal" data-bs-toggle="modal" data-bs-target=".addUser">
                        Add New User
                    </button>
                </div>
                <table id="datatable" class="table table-bordered dt-responsive nowrap"
                            style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                    <thead>
                        <tr>
                            <th>Name</th>
                            <th>Email</th>                      
                            <th>Role</th>
                            <th>Action</th>
                           
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($users as $user)
                            <tr>
                                <td>{{$user->name}}</td>
                                <td>{{$user->email}}</td>
                                <td>{{$user->role}}</td>
                                <td class="flex">
                                    <button type="button" class="btn btn-primary" data-toggle="modal" data-bs-toggle="modal" data-bs-target=".updateModal{{ $user->id }}">
                                        <i class="ri-pencil-line"></i>
                                    </button>
                                    <form action="{{ route('users.destroy', $user->id) }}" method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger waves-effect waves-light">
                                            <i class="ri-delete-bin-line"></i>
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                       
                    </tbody>
                </table>
                
            </div>        

        </div>

        <div class="modal fade addUser" tabindex="-1" role="dialog" aria-labelledby="addUser" id="addUserModal"  aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="addUserModalLabel">Add User</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">                            
                        </button>
                    </div>
                    
                    <div class="modal-body">
                        <!-- Form for updating user information -->
                    
                        <form action="{{ route('users.store') }}" method="POST" id="addForm">
                            @csrf
                            
                            <div class="form-group mb-3">
                                <input type="text" name="name" id='name' class="form-control" placeholder="Name" required>
                                <span class="text-danger" role="alert" id="nameError"></span>
                              
                            </div>
                            <div class="form-group mb-3">
                                <input type="text" name="email" id="email"  class="form-control" placeholder="Email" required>
                                <span class="text-danger" role="alert" id="emailError"></span>
                            </div>
                            <div class="form-group mb-3">
                                <select name="role" id="" class="form-control">                                  
                                    <option value="admin">Admin</option>
                                    <option value="user">User</option>
                                </select>
                            </div>                               
                        </form>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-light waves-effect" data-bs-dismiss="modal" id="closeModal">Close</button>
                        <button type="submit" form="addForm" class="btn btn-primary waves-light">Add</button>
                    </div>                        
                </div>
            </div>
        </div>

        @foreach($users as $user)
            <div class="modal fade updateModal{{ $user->id }}" tabindex="-1" role="dialog" aria-labelledby="updateModalLabel{{ $user->id }}" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="updateModalLabel{{ $user->id }}">Update User Information</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                               
                            </button>
                        </div>
                        
                        <div class="modal-body">
                            <!-- Form for updating user information -->
                        
                            <form action="{{ route('users.update', $user->id) }}" method="POST" id="updateForm{{ $user->id }}">
                                @csrf
                                @method('PUT')
                                <div class="form-group mb-3">
                                    <input type="text" name="name" value="{{ $user->name }}" class="form-control">
                                </div>
                                <div class="form-group mb-3">
                                    <input type="text" name="email" value="{{ $user->email }}" class="form-control">
                                </div>
                                <div class="form-group mb-3">
                                    <select name="role" id="" class="form-control">
                                        <option value="{{ $user->role }}">{{ $user->role }}</option>
                                        <option value="admin">Admin</option>
                                        <option value="user">User</option>
                                    </select>
                                </div>                               
                            </form>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-light waves-effect" data-bs-dismiss="modal">Close</button>
                            <button type="submit" form="updateForm{{ $user->id }}" class="btn btn-primary waves-light">Update</button>
                        </div>                        
                    </div>
                </div>
            </div>
        @endforeach
    @endsection
  
    @section('scripts')
        <!-- Required datatable js -->
        <script src="{{ URL::asset('build/libs/datatables.net/js/jquery.dataTables.min.js') }}"></script>
        <script src="{{ URL::asset('build/libs/datatables.net-bs4/js/dataTables.bootstrap4.min.js') }}"></script>
        <!-- Buttons examples -->
        <script src="{{ URL::asset('build/libs/datatables.net-buttons/js/dataTables.buttons.min.js') }}"></script>
        <script src="{{ URL::asset('build/libs/datatables.net-buttons-bs4/js/buttons.bootstrap4.min.js') }}"></script>
        <script src="{{ URL::asset('build/libs/jszip/jszip.min.js') }}"></script>
        <script src="{{ URL::asset('build/libs/pdfmake/build/pdfmake.min.js') }}"></script>
        <script src="{{ URL::asset('build/libs/pdfmake/build/vfs_fonts.js') }}"></script>
        <script src="{{ URL::asset('build/libs/datatables.net-buttons/js/buttons.html5.min.js') }}"></script>
        <script src="{{ URL::asset('build/libs/datatables.net-buttons/js/buttons.print.min.js') }}"></script>
        <script src="{{ URL::asset('build/libs/datatables.net-buttons/js/buttons.colVis.min.js') }}"></script>

        <script src="{{ URL::asset('build/libs/datatables.net-keytable/js/dataTables.keyTable.min.js') }}"></script>
        <script src="{{ URL::asset('build/libs/datatables.net-select/js/dataTables.select.min.js') }}"></script>

        <!-- Responsive examples -->
        <script src="{{ URL::asset('build/libs/datatables.net-responsive/js/dataTables.responsive.min.js') }}"></script>
        <script src="{{ URL::asset('build/libs/datatables.net-responsive-bs4/js/responsive.bootstrap4.min.js') }}"></script>

        <!-- Datatable init js -->
        <script src="{{ URL::asset('build/js/pages/datatables.init.js') }}"></script> 

         <!-- Sweet Alerts js -->
         <script src="{{ URL::asset('build/libs/sweetalert2/sweetalert2.min.js') }}"></script>

         <!-- Sweet alert init js-->
         <script src="{{ URL::asset('build/js/pages/sweet-alerts.init.js') }}"></script>

        <!-- App js -->
        <script src="{{ URL::asset('build/js/app.js') }}"></script>

        <script>
            $(document).ready(function () {
                $('#addForm').submit(function (e) {
                    e.preventDefault(); // Prevent the default form submission
        
                    // Submit the form asynchronously using AJAX
                    $.ajax({
                        url: $(this).attr('action'),
                        type: $(this).attr('method'),
                        data: $(this).serialize(),
                        success: function (response) {
                            // Handle success response
                            $('#addUserModal').modal('hide'); // Close the modal
                        },
                        error: function (xhr) {
                            if (xhr.status === 422) { // Validation error
                                var errors = xhr.responseJSON.errors;
                                $.each(errors, function (key, value) {
                                    $('#' + key + 'Error').text(value[0]);
                                });
                            } else {
                                // Handle other error scenarios
                            }
                        }
                    });
                });
        
                // Close the modal without fading out
                $('#closeModal').click(function () {
                    $('#addUserModal').modal('hide');
                });
            });
        </script>
        
    @endsection
