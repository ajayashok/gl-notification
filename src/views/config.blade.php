<!-- resources/views/vendor/notificationmanager/config.blade.php -->
@extends('notificationmanager::layouts.app')

@section('content')
<div class="container">
    <h1>Notification Manager Configuration</h1>

    <form action="{{ route('notification-manager.config.update') }}" method="POST">
        @csrf

        <div class="card mb-3">
            <div class="card-header d-flex justify-content-between align-items-center">
                <h2 class="mb-0">Email Configuration</h2>
                <div class="custom-control custom-switch">
                    <input type="checkbox" class="custom-control-input" id="email_enabled" name="email_enabled" 
                           {{ $object->getConfiguration('email')?->enabled ? 'checked' : '' }}>
                    <label class="custom-control-label" for="email_enabled">Enable Email</label>
                </div>
            </div>
            <div class="card-body" id="email_config" style="display: none;">
                <table class="table table-bordered">
                    <tr>
                        <td><label for="email_smtp_driver">Driver</label></td>
                        <td><input type="text" class="form-control" name="email_smtp_driver" id="email_smtp_driver" placeholder="smtp" value="{{ $object->getConfiguration('email')?->smtp_driver }}"></td>
                    </tr>
                    <tr>
                        <td><label for="email_smtp_host">Host</label></td>
                        <td><input type="text" class="form-control" name="email_smtp_host" id="email_smtp_host" placeholder="smtp.gmail.com" value="{{ $object->getConfiguration('email')?->smtp_host }}"></td>
                    </tr>
                    <tr>
                        <td><label for="email_smtp_port">Port</label></td>
                        <td><input type="text" class="form-control" name="email_smtp_port" id="email_smtp_port" placeholder="587" value="{{ $object->getConfiguration('email')?->smtp_port }}"></td>
                    </tr>
                    <tr>
                        <td><label for="email_username">Username</label></td>
                        <td><input type="text" class="form-control" name="email_username" id="email_username" placeholder="*********" value="{{ $object->getConfiguration('email')?->username }}"></td>
                    </tr>
                    <tr>
                        <td><label for="email_password">Password</label></td>
                        <td><input type="password" class="form-control" name="email_password" id="email_password" placeholder="*********" value="{{ $object->getConfiguration('email')?->password }}"></td>
                    </tr>
                    <tr>
                        <td><label for="email_encryption">Encryption</label></td>
                        <td><input type="text" class="form-control" name="email_encryption" id="email_encryption" placeholder="TLS" value="{{ $object->getConfiguration('email')?->encryption }}"></td>
                    </tr>
                </table>
            </div>
        </div>

        <div class="card mb-3">
            <div class="card-header d-flex justify-content-between align-items-center">
                <h2 class="mb-0">WhatsApp Configuration</h2>
                <div class="custom-control custom-switch">
                    <input type="checkbox" class="custom-control-input" id="whatsapp_enabled" name="whatsapp_enabled" 
                           {{ $object->getConfiguration('whatsapp')?->enabled ? 'checked' : '' }}>
                    <label class="custom-control-label" for="whatsapp_enabled">Enable WhatsApp</label>
                </div>
            </div>
            <div class="card-body" id="whatsapp_config" style="display: none;">
                <table class="table table-bordered">
                    <tr>
                        <td><label for="whatsapp_token">Token</label></td>
                        <td><input type="text" class="form-control" name="whatsapp_token" id="whatsapp_token" value="{{ $object->getConfiguration('whatsapp')?->token }}"></td>
                    </tr>
                    <tr>
                        <td><label for="waba_id">Waba Id</label></td>
                        <td><input type="text" class="form-control" name="waba_id" id="waba_id" value="{{ $object->getConfiguration('whatsapp')?->waba_id }}"></td>
                    </tr>
                </table>
            </div>
        </div>

        <div class="card mb-3">
            <div class="card-header d-flex justify-content-between align-items-center">
                <h2 class="mb-0">Telegram Configuration</h2>
                <div class="custom-control custom-switch">
                    <input type="checkbox" class="custom-control-input" id="telegram_enabled" name="telegram_enabled" 
                           {{ $object->getConfiguration('telegram')?->enabled ? 'checked' : '' }}>
                    <label class="custom-control-label" for="telegram_enabled">Enable Telegram</label>
                </div>
            </div>
            <div class="card-body" id="telegram_config" style="display: none;">
                <table class="table table-bordered">
                    <tr>
                        <td><label for="telegram_token">Telegram Token</label></td>
                        <td><input type="text" class="form-control" name="telegram_token" id="telegram_token" value="{{ $object->getConfiguration('telegram')?->token }}"></td>
                    </tr>
                    <tr>
                        <td><label for="telegram_chat_id">Telegram Chat ID</label></td>
                        <td><input type="text" class="form-control" name="telegram_chat_id" id="telegram_chat_id" value="{{ $object->getConfiguration('telegram')?->chat_id }}"></td>
                    </tr>
                </table>
            </div>
        </div>

        <div class="card mb-3">
            <div class="card-header d-flex justify-content-between align-items-center">
                <h2 class="mb-0">SMS Configuration</h2>
                <div class="custom-control custom-switch">
                    <input type="checkbox" class="custom-control-input" id="sms_enabled" name="sms_enabled" 
                           {{ $object->getConfiguration('sms')?->enabled ? 'checked' : '' }}>
                    <label class="custom-control-label" for="sms_enabled">Enable SMS</label>
                </div>
            </div>
            <div class="card-body" id="sms_config" style="display: none;">
                <table class="table table-bordered">
                    <tr>
                        <td><label for="sms_api_key">API Key</label></td>
                        <td><input type="text" class="form-control" name="sms_api_key" id="sms_api_key" value="{{ $object->getConfiguration('sms')?->api_key }}"></td>
                    </tr>
                </table>
            </div>
        </div>

        <button type="submit" class="btn btn-primary">Save Configuration</button>
    </form>
</div>

<script>
    $(document).ready(function() {
        // Toggle visibility based on checkbox state
        function toggleVisibility() {
            $('#email_enabled').is(':checked') ? $('#email_config').show() : $('#email_config').hide();
            $('#whatsapp_enabled').is(':checked') ? $('#whatsapp_config').show() : $('#whatsapp_config').hide();
            $('#telegram_enabled').is(':checked') ? $('#telegram_config').show() : $('#telegram_config').hide();
            $('#sms_enabled').is(':checked') ? $('#sms_config').show() : $('#sms_config').hide();
        }

        // Initial check
        toggleVisibility();

        // Toggle visibility on change
        $('#email_enabled').change(toggleVisibility);
        $('#whatsapp_enabled').change(toggleVisibility);
        $('#telegram_enabled').change(toggleVisibility);
        $('#sms_enabled').change(toggleVisibility);
    });
</script>
@endsection
