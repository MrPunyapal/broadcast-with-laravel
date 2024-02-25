<?php

namespace App\Livewire\Pages;

use App\Models\User;
use App\Notifications\CsvExported;
use Illuminate\Support\Facades\Storage;
use Livewire\Attributes\Layout;
use Livewire\Attributes\On;
use Livewire\Attributes\Renderless;
use Livewire\Attributes\Title;
use Livewire\Component;
use Livewire\WithPagination;

#[Layout('layouts.app')]
#[Title('Users')]
class ExportCsv extends Component
{
    use WithPagination;

    public User $user;

    public string $filename;

    public bool $notification = false;

    public function mount()
    {
        $this->user = auth()->user();
    }

    #[On('echo-private:App.Models.User.{user.id},.Illuminate\\Notifications\\Events\\BroadcastNotificationCreated')]
    public function notify($event)
    {
        $this->notification = true;
        $this->filename = $event['filename'];
    }

    #[Renderless]
    public function export()
    {
        $user = $this->user;
        dispatch(function () use ($user) {

            $filename = 'users-'.str(now())->slug().'.csv';

            // Open a file pointer connected to the output stream
            $handle = fopen('php://temp', 'w+');

            // Output the column headings
            fputcsv($handle, ['id', 'name', 'email']);

            User::query()
                ->chunk(1000, function ($users) use ($handle) {
                    $users->each(function ($user) use ($handle) {
                        fputcsv($handle, [$user->id, $user->name, $user->email]);
                    });
                });

            // Move the pointer to the beginning of the file
            rewind($handle);

            // Save the CSV content to the public disk
            Storage::disk('public')->put($filename, stream_get_contents($handle));

            // Close the handle
            fclose($handle);
            sleep(10);

            $user->notify(new CsvExported($filename));
        });

    }

    public function render()
    {
        return view('livewire.pages.export-csv', [
            'users' => User::paginate(10),
        ]);
    }
}
