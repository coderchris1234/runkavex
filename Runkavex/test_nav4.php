<?php
require __DIR__ . '/vendor/autoload.php';
$app = require_once __DIR__ . '/bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\View;

$id = DB::table('users')->where('username', 'testtrader1')->value('id');
Auth::loginUsingId($id);
View::share('errors', new Illuminate\Support\ViewErrorBag);

foreach (['trade', 'stocks', 'pre-ipo', 'copy-trading', 'bot-trading', 'nft-gallery', 'loans-apply', 'markets', 'buy-plan', 'index'] as $view) {
    $html = View::make("dashboard.$view")->render();
    preg_match_all('/aria-current="page"/', $html, $tabs);
    preg_match_all('/class="nav-link-item nav-link-active"/', $html, $side);
    preg_match_all('/bg-primary text-content-inverse/', $html, $pills);
    echo str_pad($view, 13) . " topTabs=" . count($tabs[0]) . " sidebarActive=" . count($side[0]) . " pillsHighlighted=" . count($pills[0]) . PHP_EOL;
}