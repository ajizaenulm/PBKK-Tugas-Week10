<x-layouts.app :title="$title ?? 'Portal Akademik — Login Admin'">
    <div class="min-h-[calc(100vh-16rem)] flex flex-col justify-center items-center py-10 px-4 sm:px-6 lg:px-8">
        <div class="w-full max-w-md">
            {{ $slot }}
        </div>
    </div>
</x-layouts.app>
