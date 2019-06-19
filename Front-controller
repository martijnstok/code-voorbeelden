<?php
/* 
 *
 * Auteur: Martijn Stok
 * Functie: Front-controller op de Mad Pack site
 * 
 * Versie: 1.4
 *
 * libraries: -
 * 
 */

//Kijk of de coockies zijn gezet
if(!isset($_COOKIE['GDPR_CHECK'])){
	//Include cookiebar
	include('view/parts/overig/cookiebar.php');
}

//Declareer vars
$path = 'view/';
$case = '';

//Include settings.php
include('settings.php');
include('meta-data.php');

//include algemene bestanden
include('header.php');
include('view/parts/menu/menu.php');



if(isset($_GET)){
	
	//Verwijder alle '/' achter de url zodat er niet verkeerde 404 krijgt
	if(substr($_SERVER[REQUEST_URI], -1) == '/'){
		if(isset($_GET['page'])){
			$string = $_SERVER[REQUEST_URI];
			$string = substr($string, 0, -1);
			//Redirect naar page zonder '/' achter url
			header('Location: '. $string);
		}
	}
	
	//Als er een get is met 'page'
	if(isset($_GET['page'])){
		
		//zet var pagename
		$page_name = $_GET['page'];
		
		//Word er een sub-page opgevraagd?
		if(!isset($_GET['subpage'])){
			//Er is geen subpage
			if(file_exists($path . $page_name . '.php')){
				//Pagina bestaat!
				include($path . $page_name . '.php');
			}else{
				//Pagina bestaad niet, 404!
				include($path . '404.php');
			}
		}else{
			//Er is een subpage
			//Declareer vars
			$subpage_soort = $_GET['page'];
			$page_name = $_GET['subpage'];
			$path = 'view/cases/';
			
			if(file_exists($path . $subpage_soort . '/' . $page_name . '.php')){
				//Pagina bestaad!
				include($path . $subpage_soort . '/' . $page_name . '.php');
			}else{
				//Pagina bestaad niet, 404!
				include($path . '404.php');
			}
		}
	}else{
		//er is geen GET['page'] gezet, Home!
		include($path . 'home.php');
	}
}else{
	//er is geen GET gezet, Home!
	$page_name = 'home';
}

//Als laatst de footer inladen
include('footer.php');


?>
