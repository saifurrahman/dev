<?php

class Program extends Eloquent
{

    protected $table = 'program_master';
    
    public static $rules = array(
            'name' => 'required',
            'category_id' => 'required',
            'classification' => 'required',
            'audience_id' => 'required',
            'language_id' => 'required',
    );
}