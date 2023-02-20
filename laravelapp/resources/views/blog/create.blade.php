<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
</head>
<body>
    <div class="w-4/6 mx-auto">
        <div class="pt-10">
            <a href="{{ route('blog.index') }}"
               class="py-20 pb-3 italic text-green-500 transition-all border-green-400 hover:text-green-400 hover:border-b-2">
                < Back to previous page
            </a>
        </div>

        {{-- <div class="pt-20 text-center">
        <h1 class="text-3xl text-gray-700">
            Add new post
        </h1>
        <hr class="mt-10 border border-gray-300 border-1">
        </div> --}}

        <div class="pt-6 m-auto">
            <div class="mb-12 border rounded-lg">
                <div class="text-center bg-green-100 border rounded-t-lg">
                    <h1 class="p-5 text-3xl text-gray-600">Add new post</h1>
                    <hr class="border border-gray-300 border-1">
                </div>
                <div class="pb-8">
                    @if ($errors->any())
                    <div class="px-4 py-2 font-bold text-white bg-red-500 rounded-t">
                        Something went wrong...
                    </div>
                    <ul class="px-4 py-3 text-red-700 bg-red-100 border rounded-b border-t-0-red-400">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                    </ul>
                    @endif
                </div>
                <div class="px-8">
                    <form action="{{ route('blog.store') }}" method="POST" enctype="multipart/form-data" class="">
                        @csrf

                        <p class="mb-6">
                            <input class="mr-2" type="checkbox" name="is_published">
                            <label class="text-lg" for="is_published">Is Published</label>
                        </p>

                        <p class="mb-6"><input name="title" class="w-full rounded text-lg @error('title') border-red-300 @else border-gray-200 @enderror" type="text" placeholder="Post Title" value="{{ old('title') }}">
                            @error('title')
                                <span class="text-sm text-red-500"> {{$message}} </span>
                            @enderror

                        <p class="mb-6"><input name="excerpt" class="w-full rounded text-lg @error('excerpt') border-red-300 @else border-gray-200 @enderror" type="text" placeholder="Excerpt..." value="{{ old('excerpt') }}">
                            @error('excerpt')
                                <span class="text-sm text-red-500"> {{$message}} </span>
                            @enderror

                        <p class="mb-6"><input name="min_to_read" class="w-full rounded text-lg @error('min_to_read') border-red-300 @else border-gray-200 @enderror" type="number" placeholder="Minutes to read..." value="{{ old('min_to_red') }}">
                            @error('min_to_read')
                                <span class="text-sm text-red-500"> {{$message}} </span>
                            @enderror

                        <p class="mb-6"><textarea name="body" class="w-full rounded text-lg @error('body') border-red-300 @else border-gray-200 @enderror" cols="30" rows="10" placeholder="Body...">{{ old('body') }}</textarea>

                            @error('body')
                                <span class="text-sm text-red-500"> {{$message}} </span>
                            @enderror

                        </p>

                        <p class="mb-6"><input type="file" name="image"></p>

                        <button class="px-5 py-2 mb-6 text-lg font-bold text-white transition duration-150 bg-green-500 rounded-lg hover:bg-green-700" type="submit">SUBMIT POST</button>
                    </form>
                </div>
            </div>

            {{-- <form
                action="{{ route('blog.store') }}"
                method="POST"
                enctype="multipart/form-data">

                @csrf
                <label for="is_published" class="text-2xl text-gray-500">
                    Is Published
                </label>
                <input
                type="checkbox"
                class="block inline text-2xl bg-transparent border-b-2 outline-none"
                name="is_published">

                <input
                type="text"
                name="title"
                placeholder="Title..."
                class="block w-full h-20 text-2xl bg-transparent border-b-2 outline-none">

                <input
                type="text"
                name="excerpt"
                placeholder="Excerpt..."
                class="block w-full h-20 text-2xl bg-transparent border-b-2 outline-none">

                <input
                type="number"
                name="min_to_read"
                placeholder="Minutes to read..."
                class="block w-full h-20 text-2xl bg-transparent border-b-2 outline-none">

                <textarea
                name="body"
                placeholder="Body..."
                class="block w-full py-20 text-xl bg-transparent border-b-2 outline-none h-60"></textarea>

                <div class="py-10 bg-grey-lighter">
                <label class="flex flex-col items-center px-2 py-3 tracking-wide uppercase border shadow-lg cursor-pointer w-44 bg-white-rounded-lg border-blue">
                    <span class="mt-2 text-base leading-normal">
                        Select a file
                    </span>
                    <input
                    type="file"
                    name="image"
                    class="hidden">
                </label>
                </div>

                <button
                type="submit"
                class="px-8 py-4 text-lg font-extrabold text-gray-100 uppercase bg-blue-500 mt-15 rounded-3xl">
                Submit Post
                </button>
            </form> --}}
        </div>
    </div>
</body>
</html>
