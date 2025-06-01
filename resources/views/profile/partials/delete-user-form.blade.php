<form method="POST" action="{{ route('profile.destroy') }}">
    @csrf
    @method('DELETE')

    <p>Yakin mau hapus profile?</p>

    <button type="submit">Delete Account</button>
</form>
