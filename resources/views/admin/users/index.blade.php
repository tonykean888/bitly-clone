<x-admin-layout>
    <x-slot name="header">
        Admin Dashboard
    </x-slot>
    <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
        <div class="p-6 bg-white border-b border-gray-200">
            <div class="max-w-6xl">
                <section>
                    @if ($users->isEmpty())
                        <div class="p-6 text-gray-900">
                            You have not any USER yet.
                        </div>
                    @else
                        <table class="min-w-full table-auto divide-y divide-gray-200">
                            <thead class="bg-gray-50">
                                <tr>
                                    <th scope="col"
                                        class="px-4 py-3 text-left text-xs font-semibold uppercase tracking-wider text-gray-600">
                                        Name</th>
                                    <th scope="col"
                                        class="px-4 py-3 text-left text-xs font-semibold uppercase tracking-wider text-gray-600">
                                        Email</th>
                                    <th scope="col"
                                        class="px-4 py-3 text-left text-xs font-semibold uppercase tracking-wider text-gray-600">
                                        Role</th>
                                    <th scope="col"
                                        class="px-4 py-3 text-left text-xs font-semibold uppercase tracking-wider text-gray-600">
                                        Created</th>
                                    <th scope="col"
                                        class="px-4 py-3 text-right text-xs font-semibold uppercase tracking-wider text-gray-600">
                                        Action</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-gray-100">
                                @foreach ($users as $user)
                                    <tr class="odd:bg-white even:bg-gray-50 hover:bg-gray-100/60 transition-colors">
                                        <td class="px-4 py-3 align-top">
                                            {{ $user->name }}
                                        </td>
                                        <td class="px-4 py-3 align-top">
                                            {{ $user->email }}
                                        </td>
                                        <td class="px-4 py-3 align-top">
                                            @if ($user->is_admin)
                                                <span class="inline-flex items-center gap-x-1.5 py-1.5 px-3 rounded-full text-xs font-medium bg-teal-500 text-white">ADMIN</span>
                                            @else
                                                <span class="inline-flex items-center gap-x-1.5 py-1.5 px-3 rounded-full text-xs font-medium border border-gray-500 text-gray-500 dark:text-neutral-400">USER</span>
                                            @endif
                                        </td>
                                        <td class="px-4 py-3 text-gray-600 align-top">
                                            <span title="{{ $user->created_at->format('Y-m-d H:i') }}">
                                                {{ $user->created_at->format('d-m-Y H:i') }}
                                            </span>
                                        </td>
                                           
                                        <td class="px-4 py-3 align-top">
                                            <div class="flex justify-end gap-4">
                                                
                                                <x-danger-button
                                                    x-data=""
                                                    x-on:click.prevent="$dispatch('open-modal', 'confirm-url-deletion-{{ $user->id }}')"
                                                    class="inline-flex items-center border-gray-300 rounded-md bg-red-50 px-3 py-1.5 text-xs text-red-700 hover:bg-red-100">
                                                    Delete
                                                </x-danger-button>
                                                
                                                <x-modal name="confirm-url-deletion-{{ $user->id }}" focusable>
                                                    <form method="POST" action="{{ route('admin.users.delete', $user) }}" class="p-6">
                                                        @csrf
                                                        @method('DELETE')
                                                        
                                                        <h2 class="text-lg font-medium text-gray-900">
                                                            {{ __('Are you sure you want to delete this USER?') }}
                                                        </h2>
                                                        
                                                        <div class="mt-6 flex justify-end">
                                                            <x-secondary-button x-on:click="$dispatch('close')">
                                                                {{ __('Cancel') }}
                                                            </x-secondary-button>
                                                            
                                                            <x-danger-button class="ms-3">
                                                                {{ __('Delete USER') }}
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
                        @if ($users->hasPages())
                            <div class="mt-6">
                                {{ $users->links() }}
                            </div>
                        @endif
                    @endif
                </section>
            </div>
        </div>
    </div>
</x-admin-layout>