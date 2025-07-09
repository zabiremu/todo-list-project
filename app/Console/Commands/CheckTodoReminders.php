<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Todo;
use App\Jobs\SendTodoReminderJob;

class CheckTodoReminders extends Command
{
    protected $signature = 'todos:check-reminders';
    protected $description = 'Check for todos that need reminders';

    public function handle()
    {
        $this->info('Checking for due todos...');
        $todos = Todo::where('due_date', '<=', now()->addMinutes(10))
            ->where('email_sent', false)
            ->get();

        $this->info("Found {$todos->count()} todos needing reminders");

        foreach ($todos as $todo) {
            SendTodoReminderJob::dispatch($todo);
            $this->line("Dispatched job for todo ID: {$todo->id}");
        }

        return Command::SUCCESS;
    }
}
