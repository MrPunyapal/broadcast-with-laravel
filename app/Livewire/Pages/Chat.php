<?php

namespace App\Livewire\Pages;

use App\Events\ChatSent;
use Illuminate\Support\Facades\Cache;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Livewire\Component;

#[Layout('layouts.app')]
#[Title('Chats')]
class Chat extends Component
{
    protected $listeners = ['echo-private:chat,ChatSent' => '$refresh'];

    // you may add new added chat to other chats present in $chats
    // or may create listener component to listen to new chat and append to chats
    // at frontend

    public function sendMessage($message)
    {
        $chats = Cache::get('chats', []);
        $chats[] = [
            'user_id' => auth()->id(),
            'user' => auth()->user()->name,
            'message' => $message,
        ];

        Cache::forever('chats', $chats);

        broadcast(new ChatSent())->toOthers();
        // you can create chatroom and broadcast to specific chatroom

    }

    public function render()
    {
        // Cache::forget('chats');
        return view('livewire.pages.chat', [
            'chats' => collect(Cache::get('chats', []))->reverse(),
        ]);
    }
}
