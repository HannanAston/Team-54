<x-app-layout>

    <div class="bg-[#f0f0f0] min-h-screen p-20">
        <div class="max-w-xl mx-auto px-6">

            <h1 class="text-3xl font-bold text-[#33] mb-10 text-center">Contact Us</h1>

            <form action="/contact" method="POST" class="bg-white p-10 rounded-xl shadow-md border border-gray-200 space-y-6">
                @csrf
                <div>
                    <label class="block text-[#333] font-medium mb-2">Name</label>
                    <input type="text" name="name" placeholder="Enter yout name" class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:outline-none focus:ring-[#c19a6b]">
                </div>
                <div>
                    <label class="block text-[#333] font-medium mb-2">Email</label>
                    <input type="email" name="email" placeholder="Enter yout email" class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:outline-none focus:ring-[#c19a6b]">
                </div>
                <div>
                    <label class="block text-[#333] font-medium mb-2">Message</label>
                    <textarea name="message" placeholder="Write your message..." class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:outline-none focus:ring-[#c19a6b]"></textarea>
                </div>
                <button type="submit" class="w-full bg-[#c19a6b] text-white py-3 rounded-lg font-semibold hover:-90 transition">Send Message</button>
            </form>
        </div>
    </div>

</x-app-layout>