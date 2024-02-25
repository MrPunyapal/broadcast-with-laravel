<div class="dark:bg-gray-800">
    <div class="bg-white rounded-lg p-4 max-w-sm mx-auto">
        <div class="flex items-center space-x-4">
            <div class="flex flex-col">
                <div class="text-gray-600 text-sm">Chat</div>
            </div>
        </div>
        <div class="border-t-2 border-gray-200 px-2 pt-4 mb-2 sm:mb-0">
            <div class="flex flex-col space-y-2 h-[70svh] flex-col-reverse">
                @forelse ($chats as $chat)
                    <div @class([
                        'flex items-center space-x-4',
                        auth()->id() === $chat['user_id'] ? 'flex-row-reverse' : '',
                    ])>
                        <div class="flex-shrink-0">
                            <img src="https://ui-avatars.com/api/?name={{ $chat['user'] }}&color=7F9CF5&background=EBF4FF"
                                alt="avatar" class="w-10 h-10 rounded-full">
                        </div>
                        <div>
                            <div @class([
                                'text-gray-600 text-sm',
                                auth()->id() === $chat['user_id'] ? 'text-end' : '',
                            ])>
                                {{ $chat['user'] }}
                            </div>
                            <div class="bg-gray-200 text-gray-600 text-sm rounded-xl p-2">
                                {{ $chat['message'] }}
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="flex justify-center items-center h-[70svh]">
                        <div class="text-gray-500 text-lg">
                            No chats yet...
                        </div>
                    </div>
                @endforelse
            </div>
        </div>
        <div x-data="{
            message: '',
            sendMessage() {
                if (this.message.trim() === '') return;
                $wire.sendMessage(this.message);
                this.message = '';
            }
        }" class="relative flex justify-end mt-4">
            <input type="text" placeholder="Write Something" x-model="message" x-on:keydown.enter="sendMessage"
                class="w-full focus:outline-none focus:placeholder-gray-400 text-gray-600 placeholder-gray-600 pr-12 bg-gray-200 rounded-full py-3">
            <span class="absolute inset-x-100 flex items-center">
                <button type="button" x-on:click="sendMessage"
                    class="inline-flex items-center justify-center rounded-full h-12 w-12 transition duration-500 ease-in-out text-white bg-blue-500 hover:bg-blue-400 focus:outline-none">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor"
                        class="h-6 w-6 text-white">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M12 19l9 2-9-18-9 18 9-2zm0 0v-8"></path>
                    </svg>
                </button>
            </span>
        </div>
    </div>
</div>
