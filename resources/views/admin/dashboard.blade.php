<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Admin Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <!-- Stats -->
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
                <div class="bg-white overflow-hidden shadow-sm rounded-lg p-6">
                    <div class="text-sm font-medium text-gray-500 truncate">Total Users</div>
                    <div class="mt-1 text-3xl font-semibold text-gray-900">1,234</div>
                </div>
                <div class="bg-white overflow-hidden shadow-sm rounded-lg p-6">
                    <div class="text-sm font-medium text-gray-500 truncate">Active Managers</div>
                    <div class="mt-1 text-3xl font-semibold text-gray-900">15</div>
                </div>
                <div class="bg-white overflow-hidden shadow-sm rounded-lg p-6">
                    <div class="text-sm font-medium text-gray-500 truncate">Total Fields</div>
                    <div class="mt-1 text-3xl font-semibold text-gray-900">42</div>
                </div>
                <div class="bg-white overflow-hidden shadow-sm rounded-lg p-6">
                    <div class="text-sm font-medium text-gray-500 truncate">Total Bookings</div>
                    <div class="mt-1 text-3xl font-semibold text-gray-900">8,569</div>
                </div>
            </div>

            <!-- Quick Actions -->
            <div class="bg-white overflow-hidden shadow-sm rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <h3 class="text-lg font-medium text-gray-900 mb-4">Quick Management</h3>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <a href="{{ url('/admin/users') }}" class="flex items-center p-4 border rounded-lg hover:bg-gray-50 transition">
                            <div class="p-3 rounded-full bg-blue-100 text-blue-600 mr-4">
                                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"></path></svg>
                            </div>
                            <div>
                                <h4 class="font-bold text-gray-800">Manage Users</h4>
                                <p class="text-sm text-gray-500">Create, edit, or delete user accounts and roles.</p>
                            </div>
                        </a>
                        <a href="{{ route('admin.fields.index') }}"
                        class="flex items-center p-4 border rounded-lg hover:bg-gray-50 transition">

                            <div class="p-3 rounded-full bg-green-100 text-green-600 mr-4">
                                <!-- icon -->
                                <svg class="w-6 h-6" fill="none" stroke="currentColor"
                                    viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M3 7h18M3 12h18M3 17h18" />
                                </svg>
                            </div>

                            <div>
                                <h4 class="font-bold text-gray-800">Manage Fields</h4>
                                <p class="text-sm text-gray-500">
                                    Add, edit, or delete sports fields
                                </p>
                            </div>
                        </a>
                        <a href="#" class="flex items-center p-4 border rounded-lg hover:bg-gray-50 transition">
                            <div class="p-3 rounded-full bg-indigo-100 text-indigo-600 mr-4">
                                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path></svg>
                            </div>
                            <div>
                                <h4 class="font-bold text-gray-800">System Settings</h4>
                                <p class="text-sm text-gray-500">Configure global application settings.</p>
                            </div>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
