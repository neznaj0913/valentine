<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>My Valentine Letter</title>
    @vite('resources/css/app.css')
</head>

<body class="bg-gradient-to-br from-pink-100 to-rose-200 min-h-screen flex items-center justify-center">

    <div class="bg-white p-10 rounded-2xl shadow-2xl border-4 border-pink-400 max-w-lg text-center">

        <h1 class="text-3xl font-bold text-pink-600 mb-6">
            💌 A Letter for You
        </h1>

        @if($letter)
        <p class="text-lg text-pink-700 mb-4">
            <strong>From:</strong> {{ $letter->name }}
        </p>

        <p class="text-gray-700 leading-relaxed">
            {{ $letter->message }}
        </p>
        @else
        <p class="text-gray-600">
            No letter found.
        </p>
        @endif

        <a href="{{ url('/valentine') }}"
            class="mt-6 inline-block bg-pink-500 text-white px-6 py-2 rounded-full hover:bg-pink-600 transition">
            Back
        </a>
    </div>

</body>

</html>