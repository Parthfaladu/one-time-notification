@extends('layouts.base')

@section('body')
    <div class="col-sm-12">
        <div class="p-3 bg-white mx-md-5 shadow-sm">
            <div class="row py-3 border-light-gray">
                <div class="col-sm-6">
                    <h3 class="text-muted">User Settings</h3>
                </div>
            </div>
            <div class="col-sm-12 mt-4">
                <div class="col-sm-6 offset-sm-3">
                    <form id="userSettingsForm" method="post" action="{{ url('/user/' . $user->id) }}" autocomplete="off">
                        @method('PUT')
                        @csrf
                        <div class="form-group mt-3">
                            <label for="email" class="mb-2">Email</label>
                            <input name="email" id="email" type="email" class="form-input form-control"
                                value="{{ $user->email }}" />
                            @error('email')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="form-group mt-3">
                            <label for="phone-number" class="mb-2">Phone Number</label>
                            <input name="phoneNumber" id="phoneNumber" type="text" class="form-input form-control"
                                value="{{ old('phoneNumber') ?? $user->phone_number }}" />
                                @error('phoneNumber')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                        </div>
                        <div class="mb-2 mt-3">
                            <label for="is-send-notification" class="mb-2 mr-2">Receive notification</label>
                            <input type="hidden" id="isSendNotificationInput" name="isSendNotification"
                                value="{{ $user->is_receive_notification ? 1 : 0 }}" />
                            <input type="checkbox" id="isSendNotification" @if ($user->is_receive_notification) checked @endif
                                data-toggle="toggle" data-size="xs">
                            @error('isSendNotification')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="d-flex justify-content-center mt-5">
                            <button type="submit" class="col-4 btn btn-success">Update</button>
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
            // on switch update value
            $('#isSendNotification').change(function() {
                $("#isSendNotificationInput").val($(this).prop('checked') ? 1 : 0);
            });

            // form validation
            $("#userSettingsForm").validate({
                rules: {
                    email: {
                        required: true,
                        email: true
                    },
                    phoneNumber: "required",
                },
                messages: {
                    phoneNumber: "Please add phone number",
                }
            });
        });
    </script>
@endsection
