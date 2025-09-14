<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            <h1>Create Shorten URL</h1>
        </h2>
        
    </x-slot>
    
    <div class="py-4">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
             <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
                <section>
                    <header>
                        <h2 class="text-lg font-medium text-gray-900">
                            {{ __('Create a New Short URL') }}
                        </h2>

                        <p class="mt-1 text-sm text-gray-600">
                            {{ __("Enter the destination URL you want to shorten.") }}
                        </p>
                    </header>
                    <form method="POST" action="{{ route('urls.store') }}" class="mt-6 space-y-6">
                        @csrf
                        <div>
                            <x-input-label for="full_url" value="Full URL:" />
                            <x-text-input type="url" id="full_url" name="full_url" required class="border rounded px-2 py-1 w-full" />
                            <x-input-error :messages="$errors->get('full_url')" class="mt-2" />
                        </div>
                        <div>
                            <x-input-label for="title" value="Title:" />
                            <x-text-input type="text" id="title" name="title" class="border rounded px-2 py-1 w-full" />
                            <x-input-error :messages="$errors->get('title')" class="mt-2" />
                        </div>
                        <div class="flex items-center gap-4">
                            <x-primary-button>{{ __('Shorten URL') }}</x-primary-button>
                        </div>
                    </form>
                </section>
            </div>
        </div>
    </div>
</x-app-layout>
