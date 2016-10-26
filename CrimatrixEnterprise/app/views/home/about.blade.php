@extends('layouts.home')
@section('navbar')
    @parent  
@stop

@section('content')
    <div class="container">
    	<div class="row">
    		<div class="col-md-8">
        		<h2>About <span class="text-crimatrix">Crimatrix</span></h2>
	        	<h4>Crimatrix is a community based real-time crime monitoring platform</h4>
        	</div>
        	<div class="col-md-4">
        		<div class="pull-right"><img src="{{asset('img/logo_police.png')}}" alt="police logo"><img src="{{asset('img/logo_glomindz.png')}}" alt="glomindz_logo"></div>
        	</div>
    	</div>
        <div class="row">        	
        	<div class="col-md-12">	        	
	        	<div class="bs-callout bs-callout-info">
						<h4 class="SourceSansPro">Where does Crimatrix work?</h4>
					    <p>Currently, Crimatrix works only <span class="text-crimatrix">in Guwahati</span>. With time, we plan to extend it across Assam.</span></p>			
				</div>
				<div class="bs-callout bs-callout-danger">
					<h4 class="SourceSansPro">Who is behind Crimatrix?</h4>
				    <p>Crimatrix is a joint initiative by <span class="text-crimatrix">Assam Police</span> and <span class="glomindz_text_color">Glomindz</span></p>
				</div>
				<div class="bs-callout bs-callout-warning">
					<h4 class="SourceSansPro">The Crimatrix team is led by:</h4>
				    <p><span class="text-crimatrix">Amitava Sinha</span>  Addl. SP(Crime) City</p>
				    <p>under the guidance and patronage of</p>
				    <p>
				    	<span class="text-crimatrix">Shri J.N. Chowdhury</span> IPS, Director General of Police, and
						<span class="text-crimatrix">Shri Anand Prakash Tiwari</span> IPS, Sr. Supdt of Police, City.
					</p>
				</div>
			</div>			
        </div>
    <div>    	
@stop
