<x-admin-layout>
    <x-slot name="header">
        Admin Dashboard
    </x-slot>

    <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
        <div class="p-6 bg-white border-b border-gray-200">
            <div class="grid grid-cols-1 gap-6 md:grid-cols-2 lg:grid-cols-3">
                <div class="p-6 bg-blue-50 border rounded-lg shadow-sm">
                    <h3 class="text-lg font-semibold text-blue-800">Total URLs</h3>
                    <p class="text-3xl font-bold">{{ $totalUrls }}</p>
                </div>

                <div class="p-6 bg-green-50 border rounded-lg shadow-sm">
                    <h3 class="text-lg font-semibold text-green-800">Total Users</h3>
                    <p class="text-3xl font-bold">{{ $totalUsers }}</p>
                </div>
            </div>

            <div class="mt-8">
                <h3 class="text-lg font-semibold mb-4">Recent URLs</h3>
                <div class="overflow-x-auto">
                    <table class="min-w-full divide-y divide-gray-200">
                        <thead class="bg-gray-50">
                            <tr>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Original URL</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Short Key</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">User</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Created</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                            @foreach($recentUrls as $url)
                                <tr>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm">
                                        <a href="{{ $url->full_url }}" target="_blank" class="text-blue-600 hover:text-blue-800" rel="noopener noreferrer">
                                            {{ Str::limit($url->full_url, 60) }}
                                        </a>
                                        <p class="text-sm text-gray-500 mt-1">
                                            {{ Str::limit($url->title ?? '', 50) }}
                                        </p>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm">
                                        <a href="{{ route('url.redirect', ['shortKey' => $url->short_key]) }}" target="_blank" class="text-blue-600 hover:text-blue-800">
                                            {{ route('url.redirect', ['shortKey' => $url->short_key]) }}
                                        </a>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm">{{ $url->user->name }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm">{{ $url->created_at->diffForHumans() }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                <div class="mt-4">
                    <a href="{{ route('admin.urls') }}" class="text-blue-600 hover:text-blue-800">View all URLs &rarr;</a>
                </div>
            </div>
        </div>
    </div>
</x-admin-layout>