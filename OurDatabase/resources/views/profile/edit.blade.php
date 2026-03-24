<x-slot name="header">
</x-slot>

<div class="py-12 bg-[#f0f0f0] min-h-screen">

    <div class="max-w-5xl mx-auto sm:px-6 lg:px-8 space-y-6">

        <div class="p-6 sm:p-8 bg-white shadow-sm rounded-xl border border-[#666]">
            <div class="max-w-xl">
                @include('profile.partials.update-profile-information-form')
            </div>
        </div>

        <div class="p-6 sm:p-8 bg-white shadow-sm rounded-xl border border-[#666]">
            <div class="max-w-xl">
                @include('profile.partials.update-password-form')
            </div>
        </div>

        <div class="p-6 sm:p-8 bg-white shadow-sm rounded-xl border border-[#c19a6b]">
            <div class="max-w-xl">
                @include('profile.partials.delete-user-form')
            </div>
        </div>

    </div>

</div>
