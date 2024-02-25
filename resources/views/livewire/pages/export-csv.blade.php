<div>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            Users
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <div class="mt-4" x-data="{ showMessage: false }">
                        <button wire:click="export" x-on:click="showMessage = true"
                            class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">Export
                            CSV</button>
                        @if ($notification)
                            <div class="mt-3 p-2 bg-green-100 border-l-4 border-green-500 text-green-700 px-4 py-3 rounded relative"
                                role="alert">
                                <strong class="font-bold">Email Sent Successfully </strong>
                                <span class="block sm:inline">
                                    FYI filename: {{ $filename }}
                                </span>
                            </div>
                        @endif
                        <div x-show="showMessage" style="display: none"
                            class="mt-3 p-2 bg-blue-100 border-l-4 border-blue-500 text-blue-700 px-4 py-3 rounded relative"
                            role="alert">
                            <strong class="font-bold">CSV Export in Progress!</strong>
                            <span class="block sm:inline">You can safely leave this page. We'll send the CSV file to
                                your email and notify you once it's ready.</span>
                        </div>
                    </div>
                    <table class="table-auto w-full">
                        <thead>
                            <tr>
                                <th class="px-4 py-2">Name</th>
                                <th class="px-4 py-2">Email</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($users as $user)
                                <tr>
                                    <td class="border px-4 py-2">{{ $user->name }}</td>
                                    <td class="border px-4 py-2">{{ $user->email }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                    {{ $users->links() }}
                </div>
            </div>
        </div>
    </div>
</div>
