<?php

use Illuminate\Console\Command;
use kije\User;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputOption;

class CreateUser extends Command
{

    /**
     * The console command name.
     *
     * @var string
     */
    protected $name = 'user:create';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create a new User.';

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
     * @return mixed
     */
    public function fire()
    {
        $username = $this->argument('username');
        $password = $this->argument('password');
        $id = $this->argument('id');

        if (empty($username)) {
            $username = $this->ask('Username:');
        }

        if (empty($password)) {
            do {
                $p1 = $this->secret('Password:');
                $p2 = $this->secret('Retype Password:');

                if ($p1 !== $p2) {
                    $this->error('Passwords do not match! Please enter again!');
                }
            } while($p1 !== $p2);

            $password = $p1;
        }

        if (!empty($username) && !empty($password)) {
            $this->info('Creating user "'.$username.'"...');

            $user = new User();
            $user->benutzername = $username;
            if (!empty($id)) {
                $user->id = $id;
            }
            $user->setPassword($password);
            if ($user->save()) {
                $this->info('User created!');
            } else {
                $this->error('Something went wrong!');
            }


        } else {
            $this->argument();
        }
    }

    /**
     * Get the console command arguments.
     *
     * @return array
     */
    protected function getArguments()
    {
        return array(
            array('username', InputArgument::OPTIONAL, 'The username'),
            array('password', InputArgument::OPTIONAL, 'The password'),
            array('id', InputArgument::OPTIONAL, 'The ID of the user'),
        );
    }

    /**
     * Get the console command options.
     *
     * @return array
     */
    protected function getOptions()
    {
        return array();
    }

}
