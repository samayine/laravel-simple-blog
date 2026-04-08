<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>

    @auth
        <p>Congrats you are logged in!</p>
        <form action="{{ route('auth.logout') }}" method="POST">
            @csrf
            <button>log out</button>
        </form>

     <div style="border: 3px solid black;">
        <h2>Create a brand new post</h2>
        <form action="{{ route('posts.create') }}" method="POST">
            @csrf
            <input type="text" name="title" placeholder="title" value="{{ old('title') }}">
            <textarea name="body" placeholder="body content...">{{ old('body') }}</textarea>
            <button>Save Post</button>
        </form>
        @error('title')
            <p style="color: red">{{ $message }}</p>
        @enderror
        @error('body')
            <p style="color: red">{{ $message }}</p>
        @enderror
     </div>

     <div style="border: 3px solid black;">
        <h2>All Posts</h2>
        @foreach ($posts as $post)
        <div style="background-color: gray; padding:10px;margin:10px">
               <h3>{{$post['title']}} by {{$post->user->name}}</h3> 
               {{$post['body']}}
               <p> <a href="{{ route('posts.edit', $post) }}">Edit</a></p>
               <form action="{{ route('posts.delete', $post) }}" method="POST">
                @csrf
                @method('DELETE')
                <button>Delete</button>
              </form>
        </div>
        @endforeach
     </div>

    @else
     <div style="border: 3px solid black;">
        <h2>Register</h2>
        <form action="{{ route('auth.register') }}" method="POST">
            @csrf
            <input name="name" type="text" placeholder="name" value="{{ old('name') }}">
            <input name="email" type="text" placeholder="email" value="{{ old('email') }}">
            <input name="password" type="password" placeholder="password">
            <button>Register</button>
        </form>
    </div>  
    <div style="border: 3px solid black;">
        <h2>Login</h2>
        <form action="{{ route('auth.login') }}" method="POST">
            @csrf
            <input name="loginname" type="text" placeholder="name" value="{{ old('loginname') }}">
            <input name="loginpassword" type="password" placeholder="password">
            <button>log in</button>
        </form>
    </div> 
    @if ($errors->any())
        <div style="border: 1px solid red; padding: 8px; margin-top: 8px;">
            <p><strong>Validation Errors:</strong></p>
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
    @endauth

   
</body>
</html>