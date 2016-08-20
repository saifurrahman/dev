<?php

class CronController extends BaseController
{


  public function getTest(){
    $data = array(
      'test' => 'Testing'
      );
    Mail::send('emails.reports', $data, function($message){
            $message->from('support@glomindz.com', 'DSMG');
            $message->to('saifur.rahman@glomindz.com')->subject('DSMG daily report');
    });
	}
}
