<?php

namespace App\Http\Controllers\Botman;

use App\Http\Controllers\Controller;
use App\Models\SettingsCont;
use BotMan\BotMan\BotMan; 
use BotMan\BotMan\BotManFactory;
use BotMan\BotMan\Cache\LaravelCache;
use Botman\Botman\Drivers\DriverManager;
use Botman\Drivers\Telegram\TelegramDriver;
use App\Http\Controllers\Botman\SignalConversation;

class BotmanController extends Controller
{
    public function teleSetup()
    {
        
    }
}