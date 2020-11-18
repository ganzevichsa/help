<?php

namespace App\Console;

use Ddeboer\Imap\Server;
use DateInterval;
use DateTimeImmutable;
use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;
use App;
use Illuminate\Support\Facades\Mail;

class Kernel extends ConsoleKernel
{
    /**
     * The Artisan commands provided by your application.
     *
     * @var array
     */
    protected $commands = [
        //
    ];

    /**
     * Define the application's command schedule.
     *
     * @param  \Illuminate\Console\Scheduling\Schedule  $schedule
     * @return void
     */
    protected function schedule(Schedule $schedule)
    {
        // $schedule->command('inspire')
        //          ->hourly();
        $schedule-> call(function (){
            $server = new Server('mail.server.com');

            // $connection is instance of \Ddeboer\Imap\Connection
            $connection = $server->authenticate('login', 'password');

            // $mailboxes = $connection->getMailboxes();
            $mailboxes = $connection->getMailbox('INBOX');

            $today = new DateTimeImmutable();
            $thirtyDaysAgo = $today->sub(new DateInterval('P1D'));

            $messages = $mailboxes->getMessages(
                new \Ddeboer\Imap\Search\Date\Since($thirtyDaysAgo),
                \SORTDATE, // Sort criteria
                true // Descending order
            );
            $id_mail = App\TaskIt::pluck('id_mail')->max();
//        echo $id_mail;

            foreach ($messages as $m) {
                $a = $m->getNumber();
                $b = $m->getFrom()->getAddress();
                if ($b != 'email') {
                    if ($a > $id_mail) {
                        //               echo $a;

                        $tasks = new \App\TaskIt;
                        $tasks->name = $m->getFrom()->getName();
                        $tasks->email = $m->getFrom()->getAddress();
                        $tasks->theme = $m->getSubject();


                        $tasks->category = 'Заявка с почты';
                        $tasks->status = 'NotCompleted';
                        $tasks->text = $m->getBodyText();
                        $tasks->id_mail = $m->getNumber();

                        $tasks->save();
                        $email = $m->getFrom()->getAddress();
                        $id = $tasks->id;

                        Mail::to($email)->send(new App\Mail\MailCalss($id));
                    }
                }
            }
        })->everyMinute();

    }

    /**
     * Register the commands for the application.
     *
     * @return void
     */
    protected function commands()
    {
        $this->load(__DIR__.'/Commands');

        require base_path('routes/console.php');
    }
}
