<?php

class Home extends BaseController {
	
	/**
	 * @return mixed
     */
	public function main()
	{
		return View::make('main', ['languages' => Languages::getLangs()]);
	}

}
