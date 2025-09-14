<x-admin-layout>
    <x-slot name="header">
        Admin Dashboard
    </x-slot>
    <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
        <div class="p-6 bg-white border-b border-gray-200">
            <div class="max-w-6xl">
                <section>
                    @if ($urls->isEmpty())
                        <div class="p-6 text-gray-900">
                            You have not shortened any URLs yet.
                        </div>
                    @else
                        <table class="min-w-full table-auto divide-y divide-gray-200">
                            <thead class="bg-gray-50">
                                <tr>
                                    <th scope="col"
                                        class="px-4 py-3 text-left text-xs font-semibold uppercase tracking-wider text-gray-600">
                                        Original URL</th>
                                    <th scope="col"
                                        class="px-4 py-3 text-left text-xs font-semibold uppercase tracking-wider text-gray-600">
                                        Short URL</th>
                                    <th scope="col"
                                        class="px-4 py-3 text-left text-xs font-semibold uppercase tracking-wider text-gray-600">
                                        Created</th>
                                    <th scope="col"
                                        class="px-4 py-3 text-left text-xs font-semibold uppercase tracking-wider text-gray-600">
                                        User</th>
                                    <th scope="col"
                                        class="px-4 py-3 text-right text-xs font-semibold uppercase tracking-wider text-gray-600">
                                        Action</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-gray-100">
                                @foreach ($urls as $url)
                                    @php($short = route('url.redirect', ['shortKey' => $url->short_key]))
                                    <tr class="odd:bg-white even:bg-gray-50 hover:bg-gray-100/60 transition-colors">
                                        <td class="px-4 py-3 align-top">
                                            <a href="{{ $url->full_url }}"
                                                class="text-blue-600 hover:text-blue-800 break-all" target="_blank"
                                                rel="noopener noreferrer">
                                                {{ Str::limit($url->full_url, 60) }}
                                            </a>
                                            <p class="text-sm text-gray-500 mt-1">
                                                {{ Str::limit($url->title ?? '', 50) }}
                                            </p>
                                        </td>
                                        <td class="px-4 py-3 align-top">
                                            <div class="flex items-center gap-2">
                                                <a href="{{ $short }}"
                                                    class="text-emerald-700 hover:text-emerald-900 break-all"
                                                    target="_blank"
                                                    rel="noopener noreferrer">{{ $short }}</a>
                                            </div>
                                        </td>
                                        <td class="px-4 py-3 text-gray-600 align-top">
                                            <span title="{{ $url->created_at->format('Y-m-d H:i') }}">
                                                {{ $url->created_at->format('d-m-Y H:i') }}
                                            </span>
                                        </td>
                                        <td class="px-4 py-3 align-top">
                                            <div class="flex items-center gap-2">
                                                {{ $url->user->name }}
                                            </div>
                                        </td>
                                        <td class="px-4 py-3 align-top">
                                            <div class="flex justify-end gap-4">
                                                <a href="{{ route('admin.urls.edit', $url) }}" target="_blank" rel="noopener noreferrer"
                                                    class="inline-flex items-center tracking-widest uppercase gap-1.5 border rounded-md bg-blue-600 px-3 py-1.5 text-xs font-medium text-white shadow-sm transition-colors hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 active:bg-blue-800">
                                                    Edit
                                                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" class="h-4 w-4">
                                                        <path d="M12.5 3a.75.75 0 0 0 0 1.5h2.69l-6.72 6.72a.75.75 0 1 0 1.06 1.06l6.72-6.72V8.5a.75.75 0 0 0 1.5 0V3.75A.75.75 0 0 0 16.75 3h-4.25Z"/>
                                                        <path d="M6.25 5A2.25 2.25 0 0 0 4 7.25v7.5A2.25 2.25 0 0 0 6.25 17h7.5A2.25 2.25 0 0 0 16 14.75V11a.75.75 0 0 0-1.5 0v3.75a.75.75 0 0 1-.75.75h-7.5a.75.75 0 0 1-.75-.75v-7.5a.75.75 0 0 1 .75-.75H9a.75.75 0 0 0 0-1.5H6.25Z"/>
                                                    </svg>
                                                </a>
                                                <x-danger-button
                                                    x-data=""
                                                    x-on:click.prevent="$dispatch('open-modal', 'confirm-url-deletion-{{ $url->id }}')"
                                                    class="inline-flex items-center border-gray-300 rounded-md bg-red-50 px-3 py-1.5 text-xs text-red-700 hover:bg-red-100">
                                                    Delete
                                                </x-danger-button>
                                                
                                                <x-modal name="confirm-url-deletion-{{ $url->id }}" focusable>
                                                    <form method="POST" action="{{ route('admin.urls.delete', $url) }}" class="p-6">
                                                        @csrf
                                                        @method('DELETE')
                                                        
                                                        <h2 class="text-lg font-medium text-gray-900">
                                                            {{ __('Are you sure you want to delete this URL?') }}
                                                        </h2>
                                                        
                                                        <div class="mt-6 flex justify-end">
                                                            <x-secondary-button x-on:click="$dispatch('close')">
                                                                {{ __('Cancel') }}
                                                            </x-secondary-button>
                                                            
                                                            <x-danger-button class="ms-3">
                                                                {{ __('Delete URL') }}
                                                            </x-danger-button>
                                                        </div>
                                                    </form>
                                                </x-modal>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>

                        <!-- Pagination Links -->
                        @if ($urls->hasPages())
                            <div class="mt-6">
                                {{ $urls->links() }}
                            </div>
                        @endif
                    @endif
                </section>
            </div>
        </div>
    </div>
</x-admin-layout>