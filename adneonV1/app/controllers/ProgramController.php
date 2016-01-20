<?php

class ProgramController extends Controller
{

    public function __construct ()
    {
        $this->beforeFilter('csrf', 
                array(
                        'on' => 'post'
                ));
    }
    public function getAll(){
        $program = DB::table('program_master')
                    ->join('category_master', 'program_master.category_id', '=', 'category_master.id')
                    ->join('audience_master', 'program_master.audience_id', '=', 'audience_master.id')
                    ->join('language_master', 'program_master.language_id', '=', 'language_master.id')
                    ->select('program_master.id AS pr_id' ,'program_master.classification', 'program_master.name AS pr_name','category_master.name as c_name','audience_master.name AS a_name','language_master.name AS l_name')
                    ->get();
        
        return Response::json($program);
    }

    public function postProgram ()
    {
        $validator = Validator::make(Input::all(), Program::$rules);
        if ($validator->passes()) {
            $program = new Program();
            $program->name = Input::get('name');
            $program->category_id = Input::get('category_id');
            $program->classification = Input::get('classification');
            $program->audience_id = Input::get('audience_id');
            $program->language_id = Input::get('language_id');
            $program->save();
            return Response::json($program);
        } else {
            return 0;
        }
    }
    
    //delete program
    public function postDelete(){
        $id = Input::get('id');
        $delpro = Program::find($id);
        $delpro->delete();
        return 1;
    }
    

    
}