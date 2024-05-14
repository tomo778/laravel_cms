<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Carbon\Carbon;
use GuzzleHttp\Client;

class mysqlBatch extends Command
{
    protected $signature = 'mysql:backup';

    protected $description = 'mysql_backup';

    private $apiToken  = 'xxx';
    private $myChatUrl = 'https://api.chatwork.com/v2/rooms/xxx/messages';

    public function __construct()
    {
        parent::__construct();
    }

    public function handle()
    {

        $filename = "backup-" . now()->format('Y-m-d') . ".gz";

        $command = "mysqldump --user=" . env('DB_USERNAME') . " --password=" . env('DB_PASSWORD')
            . " --host=" . env('DB_HOST') . " " . env('DB_DATABASE') . "  | gzip > "
            . storage_path() . "/app/backup/" . $filename;

        $returnVar = NULL;
        $output  = NULL;

        exec($command, $output, $returnVar);

        // if ($returnVar !== 0) {
        //     $message = "バッチ失敗";
        // } else {
        //     $message = "バッチ成功";
        // }
        // $startTime = Carbon::now();
        // $client = new Client();
        // $client->post($this->myChatUrl, [
        //     'form_params' => [
        //         'body' => "$startTime:$message"
        //     ],
        //     'headers' => [
        //         'X-ChatWorkToken' => $this->apiToken
        //     ]
        // ]);
    }
}
