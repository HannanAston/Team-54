<x-app-layout>

    <form action="/contact" method="POST">
        @csrf
        <input name="name" type="text">
        <input name="email" type="email">
        <textarea name="message"></textarea>
        <button>Submit</button>
    </form>

</x-app-layout>