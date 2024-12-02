<?php

use App\Console\Commands\UpdateVeiculos;
use Illuminate\Support\Facades\Schedule;

Schedule::command(UpdateVeiculos::class)->hourly();
