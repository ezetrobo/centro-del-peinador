<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ContenidoController extends Controller
{
    public function printShared($xLink = null) {
		echo '<ul class="shared">'
		. '<li class="btn-facebook">'
		. '<a href="' . $xLink . '">'
		. '<img src="'.asset('images/icons/facebook-v.png').'"'
			. '</a>'
			. '</li>';

		echo '<li class="btn-twitter">'
		. '<a href="' . $xLink . '">'
		. '<img src="'.asset('images/icons/twitter-v.png').'"'
			. '</a>'
			. '</li>'
			. '</ul>';
	}
}

