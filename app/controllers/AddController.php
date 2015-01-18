<?php

class AddController extends BaseController {

	/**
	 * @return mixed
	 */
	public function add() {
		return View::make('add');
	}

	/**
	 * @return mixed
	 */
	public function insert() {
		if (empty($_POST)) {
			return View::make('empty_post');
		} else {
			$res = Insertion::insert($_POST);
			if ($res) {
				return View::make('insertion_complete');
			} else {
				return View::make('insertion_error');
			}
		}
	}

}
