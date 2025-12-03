<x-app-layout>

    <form action="/contact" method="POST">
        @csrf
        <p>Name: </p>
        <input placeholder="name" name="name" type="text">
        <p>Email: </p>
        <input placeholder="email" name="email" type="email">
        <p>Message: </p>
        <textarea placeholder="message" name="message"></textarea>
        <button>Submit</button>
    </form>

</x-app-layout>