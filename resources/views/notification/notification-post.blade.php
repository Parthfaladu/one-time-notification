@extends('layouts.base')

@section('body')
    <div class="col-sm-12">
        <div class="p-3 bg-white mx-md-5 shadow-sm">
            <div class="row py-3 border-light-gray">
                <div class="col-sm-6">
                    <h3 class="text-muted">Post Notification</h3>
                </div>
            </div>
            <div class="col-sm-12 mt-4">
                <div class="col-sm-6 offset-sm-3">
                    <form id="notificationPostForm" method="post" action="{{ url('/notification') }}" autocomplete="off">
                        @csrf
                        <div class="form-group mt-3">
                            <label for="notification-type" class="mb-2">Notification Type</label>
                            <select name="notificationType" id="notificationType" class="form-input form-control" required>
                                <option disabled selected>Select Type</option>
                                <option value="marketing">Marketing</option>
                                <option value="invoices">Invoices</option>
                                <option value="system">System</option>
                            </select>
                            @error('notificationType')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="form-group mt-3">
                            <label for="short-message" class="mb-2">Message</label>
                            <textarea name="shortMessage" id="shortMessage" rows="5" class="form-input form-control"
                                placeholder="short message...." required></textarea>
                            @error('shortMessage')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="form-group mt-3">
                            <label for="expire-at" class="mb-2">Expire At</label>
                            <input name="expireAt" type="text" id="datepicker" class="form-input form-control"
                                required />
                            @error('expireAt')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="form-group mt-3">
                            <label for="destination" class="mb-2">Destination</label>
                            <select name="destination" id="destination" class="form-input form-control" required>
                                <option value="all" selected>All</option>
                                @foreach ($users as $user)
                                    <option value="{{ $user->id }}">{{ $user->name }}</option>
                                @endforeach
                            </select>
                            @error('destination')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <div>
                            <div class="d-flex justify-content-center mt-5">
                                <button type="submit" class="col-4 btn btn-success">Create</button>
                            </div>
                    </form>
                </div>

            </div>
        </div>
    </div>
@endsection

@section('script')
    <script>
        $(function() {
            // date picker for expire at
            $("#datepicker").datepicker({
                dateFormat: "dd/mm/yy"
            });

            // form validation
            $("#notificationPostForm").validate({
                rules: {
                    notificationType: "required",
                    shortMessage: {
                        required: true,
                        maxlength: 100
                    },
                    expireAt: {
                        required: true
                    },
                    destination: "required",
                },
                messages: {
                    notificationType: "please select notification type",
                    shortMessage: "Please write short message",
                    expireAt: "Please select notification expire date",
                    destination: "Please select destination",
                }
            });
        });
    </script>
@endsection
