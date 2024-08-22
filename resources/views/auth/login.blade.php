<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    @vite('resources/css/app.css')
</head>
<body class="bg-base-200">
    <div class="flex justify-center items-center h-screen">
        <div class="w-[500px]">
            <form method="POST" action="{{ route('login') }}" class="card shadow-lg p-6 bg-base-100 mx-auto">
                @csrf

                <div class="form-control mb-4">
                    <label for="email" class="label">
                        <span class="label-text">Email</span>
                    </label>
                    <input id="email" type="email" name="email" value="{{ old('email', 'admin@somecorp.com') }}" required autofocus class="input input-bordered w-full">
                    @error('email')
                        <label class="label">
                            <span class="label-text text-red-500">{{ $message }}</span>
                        </label>
                    @enderror
                </div>

                <div class="form-control mb-6">
                    <label for="password" class="label">
                        <span class="label-text">Password</span>
                    </label>
                    <input id="password" type="password" name="password" value="password" required class="input input-bordered w-full">
                    @error('password')
                        <label class="label">
                            <span class="label-text text-red-500">{{ $message }}</span>
                        </label>
                    @enderror
                </div>

                <div class="form-control">
                    <button type="submit" class="btn btn-primary w-full">
                        Login
                    </button>
                </div>
            </form>
        </div>
    </div>
</body>
</html>