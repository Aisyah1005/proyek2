<form method="POST" action="{{ route('password.update') }}">
    @csrf
    @method('PUT')

    <div>
        <label>Current Password</label>
        <input type="password" name="current_password" required>
    </div>

    <div>
        <label>New Password</label>
        <input type="password" name="password" required>
    </div>

    <div>
        <label>Confirm New Password</label>
        <input type="password" name="password_confirmation" required>
    </div>

    <button type="submit">Update Password</button>
</form>
