<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800">
            Notifikasi
        </h2>
    </x-slot>

    <div class="py-10">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            <div class="bg-white shadow rounded-lg divide-y">

                @forelse ($notifications as $notification)
                    <div class="px-6 py-4 flex items-start gap-4">
                        <div class="flex-shrink-0">
                            🔔
                        </div>
                        <div>
                            <p class="text-sm text-gray-800">
                                {{ $notification->data['message'] ?? 'Notifikasi baru' }}
                            </p>
                            <p class="text-xs text-gray-400 mt-1">
                                {{ $notification->created_at->diffForHumans() }}
                            </p>
                        </div>
                    </div>
                @empty
                    <div class="px-6 py-8 text-center text-gray-500">
                        Belum ada notifikasi.
                    </div>
                @endforelse

            </div>

        </div>
    </div>
</x-app-layout>