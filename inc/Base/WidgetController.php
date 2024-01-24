<?php

/**
 * @package  WPGreeksCPT
 */

namespace Inc\Base;

use Inc\Base\BaseController;
use Inc\Api\Widgets\WpgreeksWidget;

/**
* 
*/
class WidgetController extends BaseController
{
	public function register()
	{
		if ( ! $this->activated( 'wpgreeks_widget' ) ) return;

		$wpgreeks_widget = new WpgreeksWidget();
		$wpgreeks_widget->register();
	}
}