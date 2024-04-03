<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body onLoad=" LoadOnce()">
@if(isset($name) && in_array($id, unserialize(Cookie::get('id'))))
    hello! {{ $name }}
    @if(is_array(unserialize(Cookie::get('submit'))) && in_array($id, unserialize(Cookie::get('start'))))
        show question
        <form action="{{ route('exam.submit', $id) }}" method="post">
            @csrf
            <button type="submit">Submit</button>
        </form>
    @elseif(is_array(unserialize(Cookie::get('submit'))) && in_array($id, unserialize(Cookie::get('submit'))) || is_array(unserialize(Cookie::get('attempt'))) && array_key_exists($id, unserialize(Cookie::get('attempt'))) && unserialize(Cookie::get('attempt'))[$id] == request()->ip())  {{----}}
    show result of {{ $id }}
    @else
        <form action="{{ route('exam.start', $id) }}" method="post">
            @csrf
            <button type="submit">Start</button>
        </form>
    @endif
@elseif(Auth::user())
    <form action="{{ route('exam.start', $id) }}" method="post">
        @csrf
        <button type="submit">Start</button>
    </form>
@else
    <form action="{{ route('examiner.name', $id) }}" method="post">
        @csrf
        <input type="text" name="name">
        <button type="submit">Start</button>
    </form>
@endif
</body>
</html>


