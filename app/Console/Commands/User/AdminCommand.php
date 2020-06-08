<?php

namespace App\Console\Commands\User;

use App\Entities\User;
use Illuminate\Console\Command;

class AdminCommand extends Command
{
    protected $signature = 'user:set-admin {email}';
    protected $description = 'Set administrator rights to certain user';

    public function handle()
    {
        $email = $this->argument('email');

        /** @var User $user */
        if (!$user = User::where('email', $email)->first()) {
            $this->error('Undefined user with email ' . $email);

            return false;
        }

        try {
            $user->setAdminRights();
        } catch (\Exception $e) {
            $this->error($e->getMessage());

            return false;
        }

        $this->info('Administrator rights have been assigned');

        return true;
    }
}
