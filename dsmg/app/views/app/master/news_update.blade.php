@extends('layouts.app') @section('content')
<div class="row">
			<div class="page-header">
				<h3>News and Updates</h3>
			</div>
</div>
{{Form::open(array('url' => ' ','id'=>'news_update','class'=>'form-horizontal' , 'method' => 'post'))}}
<div class="row">

</div>
{{ Form::close()}}

{{HTML::script('packages/script/master/news_update.js');}} @stop
