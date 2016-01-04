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

             $query="select t1.*,t3.code as station,t4.gear_no,t5.code as type,t6.code as schedule_code from nfr_maintenance_schedule_ledger t1,nfr_station_master t3,nfr_station_gear_master t4,nfr_gear_type_master t5,nfr_schedule_code_master t6 where t1.station_id IN ($station_ids) and t1.station_id=t3.id and t1.schedule_code_id=t6.id and t1.station_gear_id=t4.id and t4.gear_type_id=t5.id and t1.next_maintenance_date<=NOW() and t1.next_maintenance_date = (SELECT MAX(t2.next_maintenance_date) FROM nfr_maintenance_schedule_ledger t2 WHERE t2.station_gear_id = t1.station_gear_id and t2.role=t1.role) order by t1.station_gear_id";
  		  }else{
          $query="select t1.*,t3.code as station,t4.gear_no,t5.code as type,t6.code as schedule_code from nfr_maintenance_schedule_ledger t1,nfr_station_master t3,nfr_station_gear_master t4,nfr_gear_type_master t5,nfr_schedule_code_master t6 where  t1.station_id=t3.id and t1.schedule_code_id=t6.id and t1.station_gear_id=t4.id and t4.gear_type_id=t5.id and t1.next_maintenance_date<=NOW() and t1.next_maintenance_date = (SELECT MAX(t2.next_maintenance_date) FROM nfr_maintenance_schedule_ledger t2 WHERE t2.station_gear_id = t1.station_gear_id and t2.role=t1.role) order by t1.station_gear_id";
        }
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
        $query="SELECT t1.*,t4.code as station,t5.code as gear_type,t2.gear_no,t3.code as schedule_code FROM nfr_maintenance_schedule_ledger t1,nfr_station_gear_master t2, nfr_schedule_code_master t3,nfr_station_master t4,nfr_gear_type_master t5 WHERE t1.station_gear_id=t2.id AND t1.schedule_code_id=t3.id AND t2.station_id=t4.id AND t2.gear_type_id=t5.id  AND t1.maintenance_date BETWEEN '$from_date' and '$to_date'  $criteria ORDER BY t1.station_id,t5.id desc ";

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

}
