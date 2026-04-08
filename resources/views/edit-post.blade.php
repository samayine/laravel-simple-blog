<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
    <h1>Edit Post</h1>
    <form action="{{ route('posts.update', $post) }}" method="POST">
        @csrf
        @method('PUT')
        <input type="text" name="title" value="{{ old('title', $post->title) }}">
        <textarea name="body">{{ old('body', $post->body) }}</textarea>
        <button>Save Changes</button>
    </form>
    @error('title')
        <p style="color: red">{{ $message }}</p>
    @enderror
    @error('body')
        <p style="color: red">{{ $message }}</p>
    @enderror
</body>
</html>