<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Auth Page</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="Authentification View">
    <header class = "Page header sticky top-0 bg-white">
        <h1 class="text-3xl font-bold text-center py-6">Welcome to MailCrate!</h1>
    </header>
    <div class="min-h-screen bg-blue-900 flex justify-center items-center">
        <div class="w-full max-w-4xl bg-white rounded shadow-lg flex">
            <div class="Login-Section w-1/2 p-8 border-r">
                <h2 class="text-xl font-semibold mb-6">Login</h2>
                <form method="POST" action="{{ route('login') }}">
                    @csrf
                    <div class="Login-Email mb-4">
                        <label for="email" class="block text-sm font-medium">Email</label>
                        <input id="email" type="email" name="email" class="w-full border px-4 py-2 rounded" required>
                    </div>
                    <div class="Login Password mb-4">
                        <label for="password" class="block text-sm font-medium">Password</label>
                        <input id="password" type="password" name="password" class="w-full border px-4 py-2 rounded" required>
                    </div>
                    <button type="submit" class="w-full bg-blue-500 text-white py-2 rounded">Login</button>
                </form>
            </div>

            <!-- Register Section -->
            <div class="w-1/2 p-8">
                <h2 class="text-xl font-semibold mb-6">Register</h2>
                <form method="POST" action="{{ route('register') }}">
                    @csrf
                    <div class="Register name mb-4">
                        <label for="name" class="block text-sm font-medium">Name</label>
                        <input id="name" type="string" name="name" class="w-full border px-4 py-2 rounded" required>
                    </div>
                    <div class="Register Email mb-4">
                        <label for="email" class="block text-sm font-medium">Email</label>
                        <input id="email" type="email" name="email" class="w-full border px-4 py-2 rounded" required>
                    </div>
                    <div class="Register Password mb-4">
                        <label for="password" class="block text-sm font-medium">Password</label>
                        <input id="password" type="password" name="password" class="w-full border px-4 py-2 rounded" required minlength="6">
                    </div>
                    <div class="Register Password Re-Type mb-4">
                        <label for="password_confirmation" class="block text-sm font-medium">Confirm Password</label>
                        <input id="password_confirmation" type="password" name="password_confirmation" class="w-full border px-4 py-2 rounded" required minlength="6">
                    </div>
                    <button type="submit" class="w-full bg-green-500 text-white py-2 rounded">Register</button>
                </form>
            </div>
        </div>
    </div>
</body>
</html>
