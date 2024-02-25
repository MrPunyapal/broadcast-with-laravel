# Broadcasting with Laravel
Note: this is not related with setup of this project. you can setup this project similar to any other laravel project.

## Installation

### Backend (Pusher)

1. Install the Pusher PHP Server Library:

```bash
composer require pusher/pusher-php-server
```

2. uncomment the `BroadcastServiceProvider` in `config/app.php`:

```php
App\Providers\BroadcastServiceProvider::class,
```

3. Set the `BROADCAST_DRIVER` in the `.env` file:

```env
BROADCAST_DRIVER=pusher
```

4. Set the Pusher credentials in the `.env` file:

```env
PUSHER_APP_ID=your-app-id
PUSHER_APP_KEY=your-app-key
PUSHER_APP_SECRET=your-app-secret
PUSHER_APP_CLUSTER=your-app-cluster
```

### Frontend (Laravel Echo)

1. Install the Laravel Echo and Pusher JS libraries:

```bash
npm install --save laravel-echo pusher-js
```

2. uncomment js code in `resources/js/bootstrap.js`:

```js
import Echo from 'laravel-echo';

window.Pusher = require('pusher-js');

window.Echo = new Echo({
    ...
});
```

3. run `npm run dev` to compile the assets.

## Usage

### Backend

1. Create an event:

```bash
php artisan make:event TestBroadcast
```

2. Modify the event class:
    implement the `ShouldBroadcast` interface
    and add the `broadcastOn` method:

```php
use Illuminate\Broadcasting\Channel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;

class TestBroadcast implements ShouldBroadcast
{
 
    // ...

    public function broadcastOn()
    {
        return new Channel('test-channel');
    }
}
```

3. add channel to the `routes/channels.php` file:

```php
Broadcast::channel('test-channel', function ($user) {
    return true;
});
```

4. Broadcast the event:

```php
event(new TestBroadcast());
```

### Frontend

1. Listen for the event:

```js

window.Echo.channel('test-channel')
    .listen('TestBroadcast', (e) => {
        console.log(e);
        // do something
    });
```
Thanks for reading. If you have any question, feel free to ask on [@MrPunyapal](https://twitter.com/MrPunyapal)






