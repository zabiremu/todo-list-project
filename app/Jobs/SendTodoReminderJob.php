<?php

namespace App\Jobs;

use App\Mail\TodoReminderMail;
use App\Models\Todo;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;

class SendTodoReminderJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public function __construct(public Todo $todo) {}

    public function handle(): void
    {
        try {
            // Fetch JSON data from API
            $response = Http::get('https://jsonplaceholder.typicode.com/posts');

            if ($response->successful()) {
                $posts = $response->json();

                // Prepare CSV
                $csvPath = storage_path('app/posts_data_' . now()->timestamp . '.csv');
                $handle = fopen($csvPath, 'w');

                fputcsv($handle, ['User ID', 'Title']); // Header

                foreach ($posts as $post) {
                    fputcsv($handle, [$post['userId'], $post['title']]);
                }

                fclose($handle);

                // Log
                Log::info("CSV created at $csvPath");

                // Send Email with Attachment
                Mail::to($this->todo->email)->send(
                    new TodoReminderMail($this->todo, $csvPath)
                );

                // Update Todo
                $this->todo->update(['email_sent' => true]);

                // Delete CSV file after sending
                if (file_exists($csvPath)) {
                    unlink($csvPath);
                    Log::info("CSV file deleted: $csvPath");
                }
            } else {
                Log::error("Failed to fetch posts from API.");
            }
        } catch (\Exception $e) {
            Log::error("Error in SendTodoReminderJob: " . $e->getMessage());
        }
    }
}
