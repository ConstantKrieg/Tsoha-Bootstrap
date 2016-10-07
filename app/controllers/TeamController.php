<?php


class TeamController extends BaseController{


	public static function teams(){
		self::check_logged_in();
		$user = self::get_user_logged_in();

		$teams = Team::all();

		View::make('/team/teams.html', array('teams' => $teams, 'user' => $user));
	}
}