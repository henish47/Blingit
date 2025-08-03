
<div class="container mx-auto text-center mt-10">
    <h2 class="text-2xl font-bold mb-4">Please verify your email address</h2>
    <p class="mb-4">
        A verification link has been sent to your email address.
        If you didn't receive it, click below:
    </p>

    @if (session('message'))
        <p class="text-green-500">{{ session('message') }}</p>
    @endif

    <form method="POST" action="{{ route('verification.send') }}">
        @csrf
        <button class="bg-green-600 text-white px-4 py-2 rounded hover:bg-green-700">Resend Verification Email</button>
    </form>

    <a href="/login">back</a>
</div>

