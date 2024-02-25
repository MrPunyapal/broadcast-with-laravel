<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>{{ config('app.name') }}</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="font-sans text-gray-900 antialiased bg-gray-100 dark:bg-gray-900">

    <h1 class="text-2xl font-bold text-center py-4 dark:text-white">If it is working we will get quotes below</h1>

    <div id="quotes" class="p-4 bg-gray-100 rounded shadow-md dark:bg-gray-800">

    </div>

    <script>
        document.addEventListener('DOMContentLoaded', (event) => {
            window.Echo.channel('test-channel')
                .listen('TestBroadcast', (e) => {
                    let quote = document.createElement('span');
                    quote.innerHTML = e.quote;
                    quote.classList.add('text-gray-800', 'dark:text-gray-200', 'leading-tight');
                    quote.append(document.createElement('br'));
                    let author = document.createElement('span');
                    author.innerHTML = '-' + e.author;
                    author.classList.add('text-gray-500', 'dark:text-gray-400', 'leading-tight');
                    quote.append(author);
                    document.querySelector('#quotes').append(document.createElement('br'));
                    document.querySelector('#quotes').append(quote);
                });

            // for private channel
            // window.Echo.private('test-channel')
            //     .listen('TestBroadcast', (e) => {
            //         console.log(e);
            //     });

            // for presence channel
            // window.Echo.join('test-channel')
            //     .here((users) => {
            //         console.log(users);
            //     })
            //     .joining((user) => {
            //         console.log(user.name);
            //     })
            //     .leaving((user) => {
            //         console.log(user.name);
            //     });

            // notification
            // window.Echo.private('test-channel')
            //     .notification((notification) => {
            //         console.log(notification);
            //     });
        });
    </script>
</body>

</html>
