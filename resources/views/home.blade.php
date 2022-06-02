<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>URL Shortner</title>

    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap" rel="stylesheet">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">

    <style>
        body {
            font-family: 'Nunito', sans-serif;
        }

    </style>
</head>

<body class="antialiased bg-gray-300">
    <div class="container mx-auto h-full w-full flex flex-col space-y-4 pt-10">
        <div class="p-2 w-full h-auto">
            <form method="POST" action="/">
                @csrf
                <div class="flex bg-gray-50 p-2 rounded-2xl shadow">
                    <input autocomplete="off" class="p-4 outline-none bg-transparent w-full"
                        placeholder="Paste long url and shorten it" type="url" name="link" value="{{ old('link') }}">
                    <button class="bg-blue-500 text-white px-6 py-2 rounded-2xl" type="submit">Shorten</button>
                </div>
                @error('link')
                    <div class="bg-red-500 px-4 py-2 rounded-2xl mt-4">{{ $message }}</div>
                @enderror
            </form>
            @if (Session::has('success'))
                @include('shared.success')
            @endif
        </div>
        <div class="w-full p-2">
            <table v-else class="w-full text-sm text-left text-gray-800 rounded-2xl">
                <thead class="text-xs text-gray-200 uppercase bg-gray-500 rounded-2xl">
                    <tr>
                        <th scope="col" class="px-6 py-3">#</th>
                        <th scope="col" class="px-6 py-3">Link</th>
                        <th scope="col" class="px-6 py-3">Short Link</th>
                        <th scope="col" class="px-6 py-3">Generated</th>
                        <th scope="col" class="px-6 py-3">Last Visited</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($shortLinks as $shortLink)
                        <tr class="bg-white hover:bg-gray-100 transition border-b">
                            <td class="px-6 py-4">{{ $shortLink->id }}</td>
                            <td class="px-6 py-4">{{ $shortLink->link }}</td>
                            <td class="px-6 py-4"><a class="text-blue-700"
                                    href="{{ route('urlShortner.link', $shortLink->code) }}"
                                    target="_blank">{{ route('urlShortner.link', $shortLink->code) }}</a>
                            </td>
                            <td class="px-6 py-4">{{ $shortLink->created_at->diffForHumans() }}</td>
                            <td class="px-6 py-4">
                                {{ $shortLink->created_at->equalTo($shortLink->updated_at) ? 'Not Visited' : $shortLink->updated_at->diffForHumans() }}
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</body>

</html>
