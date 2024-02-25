<?php

use Illuminate\Foundation\Inspiring;
use Illuminate\Support\Facades\Artisan;

/*
|--------------------------------------------------------------------------
| Console Routes
|--------------------------------------------------------------------------
|
| This file is where you may define all of your Closure based console
| commands. Each Closure is bound to a command instance allowing a
| simple approach to interacting with each command's IO methods.
|
*/

Artisan::command('inspire', function () {
    collect(Inspiring::quotes())->random(7)->each(function ($quote) {
        [$quote, $author] = str($quote)->explode('-');
        event(new \App\Events\TestBroadcast($quote, $author));

        $this->info(sprintf(
            "\n  <options=bold>“ %s ”</>\n  <fg=gray>— %s</>\n",
            trim($quote),
            trim($author)));
        sleep(5);
    });
})->purpose('Broadcast an inspiring quote to public channel');
