<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\User;

class RechargePoints extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'recharge:points';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Recharge Point User';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $this->info("Recharge Points Monthly");
        $user = User::all();
        $user->map(function($item) {
            if ($item->type_user == 1) {
                $item->credit_points = ($item->credit_points + USER::REGULAR_POINT);
            } else if ($item->type_user == 3) {
                $item->credit_points = ($item->credit_points + USER::PREMIUM_POINT);
            }
            $item->save();
            $this->line($item);
        });
    }
}
