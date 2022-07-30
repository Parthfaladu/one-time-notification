@extends('layouts.base')

@section('body')
    <div class="col-sm-12">
        <div class="p-3 bg-white mx-md-5 shadow-sm">
            <div class="row py-3 border-light-gray">
                <div class="col-sm-6">
                    <h3 class="text-muted">Users</h3>
                </div>
            </div>
            <div class="mt-5">
                <table id="user_list_dt" class="table table-bordered table-hover table-res mt-2">
                    <thead>
                        <tr>
                            <th>Id</th>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Phone Number</th>
                            <th>Notification Enable</th>
                            <th>Unread Notification</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

@stop

@section('script')
    <script>
        $(function() {
            $('#user_list_dt').DataTable({
                paging: true,
                searching: true,
                ordering: true,
                info: true,
                autoWidth: true,
                responsive: true,
                processing: true,
                serverSide: true,
                order: [
                    [0, 'desc']
                ],
                ajax: {
                    'url': '/user/dt',
                },
                "columns": [{
                        data: 'id',
                        name: 'id'
                    },
                    {
                        data: function(data) {
                            return `<a href='/user/dashboard/${data.id}' class='btn btn-link'>${data.name}</a>`
                        },
                        name: 'name'
                    },
                    {
                        data: function(data) {
                            return `<a href='/user/dashboard/${data.id}' class='btn btn-link'>${data.email}</a>`
                        },
                        name: 'email'
                    },
                    {
                        data: 'phone_number',
                        name: 'phone_number'
                    },
                    {
                        data: function(data) {
                            return data.is_receive_notification ? 'Yes' : 'No'
                        },
                        name: 'is_receive_notification'
                    },
                    {
                        data: 'unread_notifications_without_expired_count',
                        name: 'unread_notifications_without_expired_count'
                    },
                    {
                        data: function(data) {
                            return `<a href='/user/${data.id}' class='btn btn-info'>Settings</a>`
                        },
                        name: 'action'
                    }
                ],
            });
        });
    </script>
@stop
