@extends('notificationmanager::layouts.app')

@section('content')
<div class="container">
    <h1>Notification Manager Configuration</h1>

    <form action="{{ route('notification-manager.config.update') }}" method="POST">
        @csrf

        <h2>Email Configuration</h2>
        <div class="form-group">
            <label for="email_enabled">Enable Email</label>
            <input type="checkbox" name="email_enabled" id="email_enabled" {{ config('notification-manager.email.enabled') ? 'checked' : '' }}>
        </div>
        <div class="form-group">
            <label for="email_smtp_server">SMTP Server</label>
            <input type="text" name="email_smtp_server" id="email_smtp_server" value="{{ config('notification-manager.email.smtp_server') }}">
        </div>
        <div class="form-group">
            <label for="email_username">Username</label>
            <input type="text" name="email_username" id="email_username" value="{{ config('notification-manager.email.username') }}">
        </div>
        <div class="form-group">
            <label for="email_password">Password</label>
            <input type="password" name="email_password" id="email_password" value="{{ config('notification-manager.email.password') }}">
        </div>

        <h2>WhatsApp Configuration</h2>
        <div class="form-group">
            <label for="whatsapp_enabled">Enable WhatsApp</label>
            <input type="checkbox" name="whatsapp_enabled" id="whatsapp_enabled" {{ config('notification-manager.whatsapp.enabled') ? 'checked' : '' }}>
        </div>
        <div class="form-group">
            <label for="whatsapp_token">Token</label>
            <input type="text" name="whatsapp_token" id="whatsapp_token" value="{{ config('notification-manager.whatsapp.token') }}">
        </div>
        <div class="form-group">
            <label for="whatsapp_templates">Templates</label>
            <textarea name="whatsapp_templates" id="whatsapp_templates">{{ json_encode(config('notification-manager.whatsapp.templates')) }}</textarea>
        </div>

        <h2>Telegram Configuration</h2>
        <div class="form-group">
            <label for="telegram_enabled">Enable Telegram</label>
            <input type="checkbox" name="telegram_enabled" id="telegram_enabled" {{ config('notification-manager.telegram.enabled') ? 'checked' : '' }}>
        </div>
        <div class="form-group">
            <label for="telegram_chat_id">Chat ID</label>
            <input type="text" name="telegram_chat_id" id="telegram_chat_id" value="{{ config('notification-manager.telegram.chat_id') }}">
        </div>
        <h2>SMS Configuration</h2>
        <div class="form-group">
            <label for="sms_enabled">Enable SMS</label>
            <input type="checkbox" name="sms_enabled" id="sms_enabled" {{ config('notification-manager.sms.enabled') ? 'checked' : '' }}>
        </div>
        <div class="form-group">
            <label for="sms_api_key">API Key</label>
            <input type="text" name="sms_api_key" id="sms_api_key" value="{{ config('notification-manager.sms.api_key') }}">
        </div>

        <button type="submit" class="btn btn-primary">Save Configuration</button>
    </form>
</div>
@endsection