<?php

namespace App\Listeners;

use App\Events\TokenIssued;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use App\Models\Queue;
use Carbon\Carbon;

class UpdateCallTable
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    public function handle(TokenIssued $event)
    {
        {$queues = Queue::with('department')
                    ->whereBetween('queues.created_at',[Carbon::now()->format('Y-m-d 00:00:00'), Carbon::now()->format('Y-m-d 23:59:59')])
                    ->orderBy('queues.created_at', 'desc')
                    ->get();

        $queue_array = [];
        foreach ($queues as $key => $queue) {
            if($queue->called) {
                $queue_array[$key]['id'] = ((int)$key)+1;
                $queue_array[$key]['department'] = $queue->department->name;
                $queue_array[$key]['number'] = ($queue->department->letter!='')?$queue->department->letter.'-'.$queue->number:$queue->number;
                $queue_array[$key]['called'] = 'Yes';
                $queue_array[$key]['counter'] = $queue->call->counter->name;
                $queue_array[$key]['recall'] = '<button class="btn-floating waves-effect waves-light tooltipped" onclick="recall('.$queue->call->id.')"><i class="mdi-navigation-refresh"></i></button>';
            } else {
                $queue_array[$key]['id'] = ((int)$key)+1;
                $queue_array[$key]['department'] = $queue->department->name;
                $queue_array[$key]['number'] = ($queue->department->letter!='')?$queue->department->letter.'-'.$queue->number:$queue->number;
                $queue_array[$key]['called'] = 'No';
                $queue_array[$key]['counter'] = 'NIL';
                $queue_array[$key]['recall'] = '<button class="btn-floating disabled" disabled><i class="mdi-navigation-refresh"></i></button>';
            }
        }}

        $data = array('data' => $queue_array);

        file_put_contents(base_path('assets/files/call'), json_encode($data));

        
        //json Queue list for display

        {$queues2 = Queue::with('department')
                    ->whereBetween('queues.created_at',[Carbon::now()->format('Y-m-d 00:00:00'), Carbon::now()->format('Y-m-d 23:59:59')])
                    ->orderBy('queues.created_at', 'desc')
                    ->get();

        $queue_array2 = [];
        foreach ($queues2 as $key => $queue2) {
            if($queue2->called) {

                //Remove entry from table when called
                
                $queue_array2[$key]['id'] ='';
                $queue_array2[$key]['department'] ='';
                $queue_array2[$key]['number'] ='';
                //$queue_array2[$key]['called'] = 'Yes';
                //$queue_array[$key]['counter'] = $queue->call->counter->name;
                //$queue_array[$key]['recall'] = '<button class="btn-floating waves-effect waves-light tooltipped" onclick="recall('.$queue->call->id.')"><i class="mdi-navigation-refresh"></i></button>';
            } else {
                $queue_array2[$key]['id'] = ((int)$key)+1;
                $queue_array2[$key]['department'] = $queue2->department->name;
                $queue_array2[$key]['number'] = ($queue2->department->letter!='')?$queue2->department->letter.'-'.$queue2->number:$queue2->number;
                
                //Not needed for display queue
                //$queue_array[$key]['called'] = 'No';
                //$queue_array[$key]['counter'] = 'NIL';
                // $queue_array[$key]['recall'] = '<button class="btn-floating disabled" disabled><i class="mdi-navigation-refresh"></i></button>';
            }
        }

        $data2 = array('data' => $queue_array2);

        file_put_contents(base_path('assets/files/call2'), json_encode($data2));
    }}
}
