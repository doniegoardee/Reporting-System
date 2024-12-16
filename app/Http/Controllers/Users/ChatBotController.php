<?php

namespace App\Http\Controllers\Users;

use App\Http\Controllers\Controller;
use BotMan\BotMan\BotMan;
use Illuminate\Http\Request;
use App\Models\Reports;
use BotMan\BotMan\BotManFactory;

class ChatBotController extends Controller
{
    protected $botman;

    public function __construct()
    {
        $config = [
            'web' => [
                'driver' => 'web',
            ],
        ];

        $this->botman = BotManFactory::create($config);
    }

    public function handleBot(Request $request)
    {
        $this->botman->reply($request->input('message'));
        $user = auth()->user();

        $this->botman->hears('hi', function (BotMan $bot) {
            $bot->reply('Hi! How can I help you?');
        });

        $this->botman->hears('hello', function (BotMan $bot) {
            $bot->reply('Hello! How can I help you?');
        });

        $this->botman->hears('check report status', function (BotMan $bot) {
            $reports = Reports::all();

            if ($reports->isEmpty()) {
                $bot->reply('You have no reports to display.');
            } else {
                $response = "Here are your reports and their statuses:\n\n <br></br>";

                $groupedReports = $reports->groupBy(function ($report) {
                    return $report->subject_type . '-' . $report->status;
                });

                foreach ($groupedReports as $group => $groupReports) {
                    $count = $groupReports->count();
                    list($subjectType, $status) = explode('-', $group);
                    $response .= "Subject: {$subjectType}, Status: {$status} - Count: {$count}\n <br></br>";
                }

                $bot->reply($response);
            }
        });


        $this->botman->hears('show my reports', function (BotMan $bot) use ($user) {
            $reports = Reports::where('user_id', $user->id)->get();

            if ($reports->isEmpty()) {
                $bot->reply("You have no reports filed.");
            } else {
                $response = "Here are your reports and their details:<br></br>";
                foreach ($reports as $report) {
                    $response .= "Report ID: " . $report->id . "<br>" .
                        "Location: " . $report->location . "<br>" .
                        "Description: " . $report->description . "<br>" .
                        "Severity: " . $report->severity . "<br>" .
                        "Status: " . $report->status . "<br><br>";
                }
                $bot->reply($response);
            }
        });

        $this->botman->hears('show reports on {keyword}', function (BotMan $bot, $keyword) use ($user) {
            $reports = Reports::where('user_id', $user->id)
                ->where(function ($query) use ($keyword) {
                    $query->where('location', 'like', "%$keyword%")
                        ->orWhere('description', 'like', "%$keyword%")
                        ->orWhere('severity', 'like', "%$keyword%")
                        ->orWhere('status', 'like', "%$keyword%")
                        ->orWhere('subject_type', 'like', "%$keyword%");
                })
                ->get();

            if ($reports->isEmpty()) {
                $bot->reply("You have no reports filed for \"$keyword\".");
            } else {
                $response = "Here are your reports related to \"$keyword\" and their details:<br></br>";
                foreach ($reports as $report) {
                    $response .= "Report ID: " . $report->id . "<br>" .
                        "Location: " . $report->location . "<br>" .
                        "Description: " . $report->description . "<br>" .
                        "Severity: " . $report->severity . "<br>" .
                        "Status: " . $report->status . "<br><br>";
                }
                $bot->reply($response);
            }
        });

        $this->botman->hears('contact', function (BotMan $bot) {
            $contactInfo = "For assistance, you can reach us at:<br>" .
                "Email: support@example.com<br>" .
                "Phone: (123) 456-7890<br>" .
                "Our office hours are Monday to Friday, 9 AM to 5 PM.";
            $bot->reply($contactInfo);
        });

        $this->botman->fallback(function (BotMan $bot) {
            $bot->reply('Sorry, these are the available commands for the moment:<br><br>' .
                '<b>hi</b> or <b>hello</b>:<br> To greet the bot.<br></br>' .
                '<b>check report status</b>:<br> To check the status of your report.<br></br>' .
                '<b>show my reports</b>:<br> To see your filed reports.<br></br>' .
                '<b>show reports on {keyword}</b>:<br> To filter reports by specific keywords (e.g., "flood").<br></br>' .
                '<b>contact</b>:<br> To get our contact information.<br></br>' .
                'Please ask me!');
        });


        $this->botman->listen();
    }

    public function botman(Request $request)
    {
        $message = $request->input('message');
        $responseMessage = "You said: " . $message;

        return response()->json([
            'status' => 200,
            'messages' => [
                [
                    'type' => 'text',
                    'text' => $responseMessage,
                    'attachment' => null,
                    'additionalParameters' => []
                ]
            ]
        ]);
    }
}
