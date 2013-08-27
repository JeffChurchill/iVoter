<?php

class BaseController extends Controller {
	
	// Add this here to avoid calling in every controller or view
	protected  $layout = "layouts.default";

	/**
	 * Setup the layout used by the controller.
	 *
	 * @return void
	 */
	protected function setupLayout()
	{
		if ( ! is_null($this->layout))
		{
			$this->layout = View::make($this->layout);
		}
	}

}