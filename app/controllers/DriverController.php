<?php
	


	class DriverController extends BaseController{

	
		public static function index(){

			$drivers = Driver:: all();

		 	View::make('drivers/drivers.html', array('drivers' => $drivers));
		}

	}