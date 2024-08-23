@props(['messages'])

@if ($messages)
    <ul style="text-align: start; color: red;">
        @foreach ((array) $messages as $message)
            <li>{{ $message }}</li>
        @endforeach
    </ul>
@endif
