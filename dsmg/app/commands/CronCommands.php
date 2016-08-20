<?php

use Illuminate\Console\Command;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Input\InputArgument;


class CronCommands extends Command {

	/**
	 * The console command name.
	 *
	 * @var string
	 */
	protected $name = 'email:overdue';

	/**
	 * The console command description.
	 *
	 * @var string
	 */
	protected $description = 'Weekly DSMG overdue report.';

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
		$query ="SELECT c.code, a.role, a.due_date_of_inspection,a.date_of_inspection,a.maintenance_by,a.designation FROM nfr_jp_crossing_inspection_ledger a INNER JOIN (SELECT station_id, MAX(due_date_of_inspection) due_date_of_inspection FROM nfr_jp_crossing_inspection_ledger GROUP BY station_id) b ON a.station_id = b.station_id AND a.due_date_of_inspection = b.due_date_of_inspection ,nfr_station_master c WHERE a.station_id=c.id and a.due_date_of_inspection<NOW() ORDER BY a.due_date_of_inspection,a.station_id";
		$data = DB::select(DB::raw($query));

		$result=array();

		for($i=0;$i<count($data);$i++){
			$row =array(
			'station' => $data[$i]->code,
			'due_date_of_inspection' => $data[$i]->due_date_of_inspection,
			);
			array_push($result,$row);
		}
		$html = '<html><body>'
	    . '<p>Hello, Welcome to TechZoo.</p>'
	    . '</body></html>';
	    $mailAttachment= PDF::load($html, 'A4', 'portrait')->show('my_pdf');
    		Mail::send('emails.reports', $result, function($message){
            $message->from('support@glomindz.com', 'DSMG');
            $message->to('saifur.rahman@glomindz.com')->subject('DSMG overdue report');

    });
	}

	/**
	 * Get the console command arguments.
	 *
	 * @return array
	 */
	protected function getArguments()
	{
		return array(
			array('example', InputArgument::REQUIRED, 'An example argument.'),
		);
	}

	/**
	 * Get the console command options.
	 *
	 * @return array
	 */
	protected function getOptions()
	{
		return array(
			array('example', null, InputOption::VALUE_OPTIONAL, 'An example option.', null),
		);
	}

}
