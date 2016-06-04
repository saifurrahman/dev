<?php

class ReportController extends Controller
{

  public function __construct() {
    $this->beforeFilter ( 'csrf', array (
        'on' => 'post'
    ) );
  }
//Overdue gear by station
    public function postOverduegearbystation(){
      $station_ids="";
      $query;
        if(Input::get('station_id') != null){
  			     $station_ids = implode(",",Input::get('station_id'));
             $query="select t1.station_gear_id,t1.role,MAX(t1.next_maintenance_date) as due_date,t3.code as station,t4.gear_no,t5.code as type,t6.code as schedule_code from nfr_maintenance_schedule_ledger t1,nfr_station_master t3,nfr_station_gear_master t4,nfr_gear_type_master t5,nfr_schedule_code_master t6 where t1.station_id IN ($station_ids) and t1.station_id=t3.id and t1.schedule_code_id=t6.id and t1.station_gear_id=t4.id and t4.gear_type_id=t5.id GROUP by t1.station_gear_id,t1.role_id,t1.schedule_code_id HAVING max(t1.next_maintenance_date)<NOW() ORDER BY t1.station_gear_id,t1.schedule_code_id,t1.role_id,t1.next_maintenance_date asc";
  		  }
        $data = DB::select(DB::raw($query));
        return Response::json($data);

    }
    public function postGearhistory(){
      $station_gear_id=Input::get('station_gear_id');
      $query="SELECT t1.*,t2.code,t2.periodicity_level_1,t2.periodicity_level_2 from nfr_maintenance_schedule_ledger t1,nfr_schedule_code_master t2 where t1.station_gear_id=$station_gear_id and  t1.schedule_code_id=t2.id ORDER BY t1.schedule_code_id,t1.next_maintenance_date DESC";
        $data = DB::select(DB::raw($query));
        return Response::json($data);

    }
    public function getOverduecrossinginspection(){
      $query ="SELECT a.id, a.station_id, a.role, a.due_date_of_inspection,a.date_of_inspection,a.maintenance_by,a.designation,c.code FROM nfr_jp_crossing_inspection_ledger a INNER JOIN (SELECT station_id, MAX(due_date_of_inspection) due_date_of_inspection FROM nfr_jp_crossing_inspection_ledger GROUP BY station_id) b ON a.station_id = b.station_id AND a.due_date_of_inspection = b.due_date_of_inspection ,nfr_station_master c WHERE a.station_id=c.id ORDER BY a.due_date_of_inspection,a.station_id";
      $data = DB::select(DB::raw($query));
      return Response::json($data);
    }
    public function postMaintenancereports(){
      $from_date= $this->convert_to_mysqlDateFormate(Input::get('from_date'));
      $to_date= $this->convert_to_mysqlDateFormate(Input::get('to_date'));

      $station_ids="";
      $query;
        if(Input::get('station_id') != null){
  			     $station_ids = implode(",",Input::get('station_id'));

             $query="SELECT t1.*,t4.code as station,t5.code as gear_type,t2.gear_no,t3.code as schedule_code FROM nfr_maintenance_schedule_ledger t1,nfr_station_gear_master t2, nfr_schedule_code_master t3,nfr_station_master t4,nfr_gear_type_master t5 WHERE t1.station_gear_id=t2.id AND t1.schedule_code_id=t3.id AND t2.station_id=t4.id AND t2.gear_type_id=t5.id AND t1.maintenance_date BETWEEN '$from_date' and '$to_date' and t1.station_id IN ($station_ids) ORDER BY t1.station_id,t1.updated_at desc ";
  		  }else{
          $query="SELECT t1.*,t4.code as station,t5.code as gear_type,t2.gear_no,t3.code as schedule_code FROM nfr_maintenance_schedule_ledger t1,nfr_station_gear_master t2, nfr_schedule_code_master t3,nfr_station_master t4,nfr_gear_type_master t5 WHERE t1.station_gear_id=t2.id AND t1.schedule_code_id=t3.id AND t2.station_id=t4.id AND t2.gear_type_id=t5.id AND t1.maintenance_date BETWEEN '$from_date' and '$to_date' ORDER BY t1.station_id,t1.updated_at desc";
        }


        $data = DB::select(DB::raw($query));

        return Response::json($data);

    }
    public function postGearwisemaintenancereports(){
      $from_date= $this->convert_to_mysqlDateFormate(Input::get('from_date'));
      $to_date= $this->convert_to_mysqlDateFormate(Input::get('to_date'));
      $gear_code="";
      $criteria="";
      if(Input::get('gear_code') != null){
          $gear_code=implode(",",Input::get('gear_code'));
          $criteria=" AND t5.id IN($gear_code)";
      }
      $station_ids="";
      $query;
        if(Input::get('station_id') != null){
  			     $station_ids = implode(",",Input::get('station_id'));
             $criteria=$criteria." AND t1.station_id IN ($station_ids)";

  		  }
        $query="SELECT t1.*,t4.code as station,t5.code as gear_type,t2.gear_no,t3.code as schedule_code FROM nfr_maintenance_schedule_ledger t1,nfr_station_gear_master t2, nfr_schedule_code_master t3,nfr_station_master t4,nfr_gear_type_master t5 WHERE t1.station_gear_id=t2.id AND t1.schedule_code_id=t3.id AND t2.station_id=t4.id AND t2.gear_type_id=t5.id  AND t1.maintenance_date BETWEEN '$from_date' and '$to_date'  $criteria ORDER BY t1.station_gear_id,t1.schedule_code_id,t1.role_id,t1.next_maintenance_date ";

        $data = DB::select(DB::raw($query));

        return Response::json($data);

    }
    public function getGeneratepdf(){
      $pdf = App::make('dompdf');
      $html='<h3>Gear Maintenance Report from <small>---</small></h3>';

    //  echo 'Test   ---'.$_GET['fromDate'];
        $from_date= $this->convert_to_mysqlDateFormate($_GET['fromDate']);
      $to_date= $this->convert_to_mysqlDateFormate($_GET['toDate']);

      $station_ids="";
      $query;
        if(Input::get('station_id') != null){
  			     $station_ids = implode(",",Input::get('station_ids'));

             $query="SELECT t1.*,t4.code as station,t5.code as gear_type,t2.gear_no,t3.code as schedule_code FROM nfr_maintenance_schedule_ledger t1,nfr_station_gear_master t2, nfr_schedule_code_master t3,nfr_station_master t4,nfr_gear_type_master t5 WHERE t1.station_gear_id=t2.id AND t1.schedule_code_id=t3.id AND t2.station_id=t4.id AND t2.gear_type_id=t5.id AND t1.maintenance_date BETWEEN '$from_date' and '$to_date' and t1.station_id IN ($station_ids) ORDER BY t1.station_id,t1.updated_at desc ";
  		  }else{
          $query="SELECT t1.*,t4.code as station,t5.code as gear_type,t2.gear_no,t3.code as schedule_code FROM nfr_maintenance_schedule_ledger t1,nfr_station_gear_master t2, nfr_schedule_code_master t3,nfr_station_master t4,nfr_gear_type_master t5 WHERE t1.station_gear_id=t2.id AND t1.schedule_code_id=t3.id AND t2.station_id=t4.id AND t2.gear_type_id=t5.id AND t1.maintenance_date BETWEEN '$from_date' and '$to_date' ORDER BY t1.station_id,t1.updated_at desc";
        }

      $data = DB::select(DB::raw($query));
      $html='<!DOCTYPE html><html><head><meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>head><body>';

      foreach ($data as $row) {
           $html.='<h4>'.$row->station_id.'</h5>';
      }
      $html.='</body></html>';
      $pdf->loadHTML($html);
      //$pdf->loadHTML($data);
      return $pdf->stream();

    }
    public function postJpinspectionreports(){
      $from_date= $this->convert_to_mysqlDateFormate(Input::get('from_date'));
      $to_date= $this->convert_to_mysqlDateFormate(Input::get('to_date'));
      $station_ids="";
      $query;
        if(Input::get('station_id') != null){
             $station_ids = implode(",",Input::get('station_id'));

             $query="SELECT t1.*,t2.code FROM nfr_jp_crossing_inspection_ledger t1, nfr_station_master t2 where t1.station_id=t2.id AND t1.date_of_inspection BETWEEN '$from_date' and '$to_date' and t1.station_id IN ($station_ids) order by t1.station_id,t1.date_of_inspection desc";
        }else{
          $query="SELECT t1.*,t2.code FROM nfr_jp_crossing_inspection_ledger t1, nfr_station_master t2 where t1.station_id=t2.id AND t1.date_of_inspection BETWEEN '$from_date' and '$to_date' order by t1.station_id,t1.date_of_inspection desc";
        }
        $data = DB::select(DB::raw($query));

        return Response::json($data);

    }
    public function convert_to_mysqlDateFormate($getdate){
       //to yyyy-mm-dd
     $date = DateTime::createFromFormat('d-m-Y', $getdate);
     $date = $date->format('Y-m-d');
     return $date;
   }

    public function getDashboardreport(){
      $result=[];
      //$query ="SELECT t1.station_id,t2.code,t1.station_gear_id,t3.gear_no,t1.next_maintenance_date from nfr_maintenance_schedule_ledger t1,nfr_station_master t2,nfr_station_gear_master t3 WHERE t1.station_id=t2.id and t1.station_gear_id=t3.id and t1.next_maintenance_date =(SELECT max(next_maintenance_date) FROM nfr_maintenance_schedule_ledger where station_gear_id=t1.station_gear_id and role_id=t1.role_id GROUP by station_gear_id,role_id) and t1.next_maintenance_date <NOW() ";
      $query ="select t1.*,t3.code as station,t4.gear_no,t5.code as type,t6.code as schedule_code from nfr_maintenance_schedule_ledger t1,nfr_station_master t3,nfr_station_gear_master t4,nfr_gear_type_master t5,nfr_schedule_code_master t6 where  t1.station_id=t3.id and t1.schedule_code_id=t6.id and t1.station_gear_id=t4.id and t4.gear_type_id=t5.id GROUP by t1.station_id,t1.station_gear_id,t1.role_id,t1.schedule_code_id HAVING max(t1.next_maintenance_date)<NOW() ORDER BY t1.station_gear_id,t1.schedule_code_id,t1.role_id";
      $result['overdue_gears'] = DB::select(DB::raw($query));

      $query ="SELECT t1.station_id,t2.code,COUNT(*) as total FROM station_wise_overdue t1,nfr_station_master t2 WHERE t1.station_id=t2.id GROUP BY t1.station_id";
      $result['overdue_count'] = DB::select(DB::raw($query));

      return Response::json($result);

    }
}
