<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <meta http-equiv="X-UA-Compatible" content="ie=edge"/>
    <title>Laravel App</title>
    <link rel="stylesheet" href="{{ asset('css/app.css') }}"/>
</head>
<body class="w-full h-full bg-gray-100">
    <div>
        <div class="w-4/5 mx-auto">
            <div class="pt-10">
                <a href="{{ route('home') }}"
                   class="py-20 pb-3 italic text-green-500 transition-all border-green-400 hover:text-green-400 hover:border-b-2">
                    < Back to home page
                </a>
            </div>

            <div class="pt-6 text-center">
                <h1 class="text-3xl text-gray-700">
                    All Articles
                </h1>
                <hr class="border border-gray-300 mt-9 border-1">
            </div>

            <div class="py-10 sm:py-20">
                <a class="inline px-4 py-4 text-base transition-all bg-green-500 rounded-full shadow-xl primary-btn sm:text-xl hover:bg-green-400"
                   href="{{ route('blog.create') }}">
                    New Article
                </a>
            </div>
        </div>

        {{-- @if(session()->has('message'))
            <div class="w-4/5 pb-10 mx-auto">
                <div class="px-4 py-2 font-bold text-white bg-red-500 rounded-t">
                    Warning
                </div>
                <div class="px-4 py-3 text-red-700 bg-red-100 border border-red-400 rounded-b border-t-1">
                    {{ session()->get('message') }}
                </div>
            </div>
        @endif --}}

        @foreach ($posts as $post)
        <div class="w-4/5 pb-10 mx-auto">
            <div class="pt-10 pb-10 bg-white rounded-lg drop-shadow-2xl sm:basis-3/4 basis-full sm:mr-8 sm:pb-0">
                <div class="box-border w-11/12 pb-10 mx-auto">
                    <h2 class="pt-6 text-2xl font-bold text-gray-900 transition-all sm:pt-0 hover:text-gray-700">
                        <a href="{{ route('blog.show', $post->id) }}">
                            {{ $post->title }}
                        </a>
                    </h2>

                    <p class="w-full py-8 text-lg text-gray-900 break-words">
                        {{ $post->body }}
                        {{-- {{str_limit($post->body,100,'...')}} --}}
                    </p>

                    <span class="text-sm text-gray-500 sm:text-base">
                        Made by:
                            <a href=""
                                class="pb-3 italic text-green-500 transition-all border-green-400 hover:text-green-400 hover:border-b-2">
                                    Rasedul
                            </a>
                        on 13-07-2022
                    </span>

                    <a href="{{ route('blog.edit', $post->id) }}" class="block italic text-green-500 border-green-400 border-b-1">Edit</a>

                    <form
                    action="{{ route('blog.destroy', $post->id) }}" method="POST" onclick="return confirm('Are you sure delete the post ?')">
                    @csrf
                    @method('DELETE')
                        <button class="pt-3 pr-3 text-red-500" type="submit">
                            Delete
                        </button>
                    </form>
                </div>
            </div>
        </div>
        @endforeach

        <div class="w-4/5 pb-10 mx-auto">
            {{ $posts->links() }}
        </div>
    </div>


</body>
</html>
