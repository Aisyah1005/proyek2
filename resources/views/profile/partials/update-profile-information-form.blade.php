<!-- resources/views/profile/partials/update-password-form.blade.php -->

<section>
    <header>
        <h2 class="text-lg font-medium text-gray-900">
            Update Password
        </h2>

        <p class="mt-1 text-sm text-gray-600">
            Pastikan akun Anda menggunakan password yang panjang dan acak untuk tetap aman.
        </p>
    </header>

    <form method="post" action="{{ route('password.update') }}" class="mt-6 space-y-6">
        @csrf
        @method('put')

        <!-- Current Password -->
        <div>
            <label for="current_password" class="block text-sm font-medium text-gray-700">Password Saat Ini</label>
            <input id="current_password" name="current_password" type="password" class="mt-1 block w-full" required autocomplete="current-password">
        </div>

        <!-- New Password -->
        <div>
            <label for="password" class="block text-sm font-medium text-gray-700">Password Baru</label>
            <input id="password" name="password" type="password" class="mt-1 block w-full" required autocomplete="new-password">
        </div>

        <!-- Confirm Password -->
        <div>
            <label for="password_confirmation" class="block text-sm font-medium text-gray-700">Konfirmasi Password</label>
            <input id="password_confirmation" name="password_confirmation" type="password" class="mt-1 block w-full" required autocomplete="new-password">
        </div>

        <div class="flex items-center gap-4">
            <button type="submit" class="btn btn-primary">Simpan</button>
        </div>
    </form>
</section>
