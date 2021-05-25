<?php

    #Ivan Jevtic 0550/2018
    #Filip Kojic 0285/2018
    #Filip Zaric 0345/2018

namespace App\Controllers;
/**
 * Klasa Home - implementira metodu index za prikaz poruke dobrodoslice
 * 
 *  @version 1.0
 */
class Home extends BaseController
{
	public function index()
	{
		return view('welcome_message');
	}
}
