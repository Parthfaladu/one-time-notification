@extends('layouts.base')

@section('body')
    <div class="col-sm-12">
        <div class="p-3 bg-white mx-md-5 shadow-sm">
            <div class="row py-3 border-light-gray">
                <div class="col-sm-6">
                    <h3 class="text-muted">Notifications</h3>
                </div>
                <div class="col-sm-6 d-flex justify-content-end">
                    <a href="{{ url('/notification/create') }}" class="btn btn-info">Post Notification</a>
                </div>
            </div>
            <div class="mt-5">
                <table id="notification_list_dt" class="table table-bordered table-hover table-res mt-2">
                    <thead>
                        <tr>
                            <th>Id</th>
                            <th>Notification</th>
                            <th>User</th>
                            <th>Notification Type</th>
                            <th>Expired At</th>
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
            $('#notification_list_dt').DataTable({
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
                    'url': '/notification/dt',
                },
                'columns': [{
                        data: 'id',
                        name: 'id'
                    },
                    {
                        data: function(data) {
                            return data.data.message;
                        },
                        name: 'data.message'
                    },
                    {
                        data: function(data) {
                            return data.user.name
                        },
                        name: 'user.name'
                    },
                    {
                        data: 'notification_type',
                        name: 'notification_type'
                    },
                    {
                        data: function(data) {
                            return moment(data.expire_at).format('DD/MM/YYYY')
                        },
                        name: 'expire_at'
                    }
                ],
            });
        });
    </script>
@stop
