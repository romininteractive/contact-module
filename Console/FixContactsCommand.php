<?php

namespace Modules\Contact\Console;

use Illuminate\Console\Command;
use Modules\Contact\Entities\Contact;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputOption;

class FixContactsCommand extends Command
{
    /**
     * The console command name.
     *
     * @var string
     */
    protected $name = 'contact:fix';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Fix invalid data for contacts.';

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
    public function handle()
    {
        $contacts = app(Contact::class)->whereDoesntHave('addresses', function ($q) {
            $q->where('type', 'billing');
        })->get();

        foreach ($contacts as &$contact) {
            if ($contact->createAddress('billing')) {
                $this->info($contact->getName().'\'s billing address created.');
            }
        }
    }

    /**
     * Get the console command arguments.
     *
     * @return array
     */
    protected function getArguments()
    {
        return [
            // ['example', InputArgument::REQUIRED, 'An example argument.'],
        ];
    }

    /**
     * Get the console command options.
     *
     * @return array
     */
    protected function getOptions()
    {
        return [
            ['example', null, InputOption::VALUE_OPTIONAL, 'An example option.', null],
        ];
    }
}
