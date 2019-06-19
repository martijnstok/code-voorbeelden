<?php
/*
Plugin Name: Juizs Export
Plugin URI:  https://www.madpack.works
Description: Plugin die export maakt van alle pruducten op basis van leverdatum
Version:     1.0
Author:      Martijn Stok
Author URI:  https://www.madpack.works
License:     madpack license
License URI: https://www.madpack.works
*/

defined( 'ABSPATH' ) or die( 'No script kiddies please!' );

/** Step 2 (from text above). */
add_action( 'admin_menu', 'my_plugin_menu' );

/** Step 1. */
function my_plugin_menu() {
	add_menu_page( 'Juizs export page', 'Export juizs', 'manage_options', 'juizs_export', 'my_plugin_options', 'https://www.juizs.nl/wp-content/uploads/2018/10/juizs-export-logo.png', 1  );
}

/** Step 3. */
function my_plugin_options() {
	
	if ( !current_user_can( 'manage_options' ) )  {
		wp_die( __( 'You do not have sufficient permissions to access this page.' ) );
	}

	//Maak form frontend
	?>
	<div class="wrap">
		<h1>Maak export van juizs bestellingen</h1>
		<hr>
		<p><b>Let op!</b> Het is belangrijk dat je de juiste format gebruikt voor de leverdatum. Voorbeeld: <b>10 oktober, 2018</b></p>
		<form style="width: 500px;" action="" method="post">
			<b>Leverdatum:</b> <input class="regular-text code" type="text" placeholder="10 oktober, 2018" name="date"> <br><br>
			<input name="exporteren" type="submit" class="button button-primary" value="Exporteren">
		</form>
	</div>
	
	<?php
	if(isset($_POST['exporteren'])){
	
//arrays maken
$bundles = array(
	2521 => array( //ALL DAY 3
		'LS_Spinach'				=> array(
			3001 => 1
		),'LS_Basil'				=> array(
			3002 => 1
		),'LS_Beetroot'				=> array(
			3003 => 1
		),'LS_Carrot'				=> array(
			3004 => 2
		),'LS_Kale'					=> array(
			3005 => 1
		),'LS_Greens Only'			=> array(
			3008 => 1
		),'LS_Cucumber'				=> array(
			3012 => 2
		),'LS_Watermelon-Coconut'	=> array(
			3013 => 1
		),'LS_Beetroot-Acai'		=> array(
			3014 => 2
		),'LS_Zucchini'				=> array(
			3015 => 2
		),'LS_Orange_Bell_Pepper' 	=> array(
			3016 => 1
		),'Bites_03'				=> array(
			7001 => 1
		),'FL_J(folder JUIZS)' 		=> array(
			2004 => 1
		)
	),2522 => array( //ALL DAY 5
		'LS_Spinach'				=> array(
			3001 => 2
		),'LS_Basil'				=> array(
			3002 => 2
		),'LS_Beetroot'				=> array(
			3003 => 2
		),'LS_Carrot'				=> array(
			3004 => 3
		),'LS_Kale'					=> array(
			3005 => 2
		),'LS_Greens Only'			=> array(
			3008 => 2
		),'LS_Cucumber'				=> array(
			3012 => 3
		),'LS_Watermelon-Coconut'	=> array(
			3013 => 2
		),'LS_Beetroot-Acai'		=> array(
			3014 => 3
		),'LS_Zucchini'				=> array(
			3015 => 3
		),'LS_Orange_Bell_Pepper' 	=> array(
			3016 => 1
		),'Bites_05'				=> array(
			7003 => 1
		),'FL_J(folder JUIZS)' 		=> array(
			2004 => 1
		)
	),2523 => array( //ALL DAY 6
		'LS_Spinach'				=> array(
			3001 => 2
		),'LS_Basil'				=> array(
			3002 => 2
		),'LS_Beetroot'				=> array(
			3003 => 2
		),'LS_Carrot'				=> array(
			3004 => 4
		),'LS_Kale'					=> array(
			3005 => 2
		),'LS_Greens Only'			=> array(
			3008 => 2
		),'LS_Cucumber'				=> array(
			3012 => 4
		),'LS_Watermelon-Coconut'	=> array(
			3013 => 2
		),'LS_Beetroot-Acai'		=> array(
			3014 => 4
		),'LS_Zucchini'				=> array(
			3015 => 4
		),'LS_Orange_Bell_Pepper' 	=> array(
			3016 => 2
		),'Bites_06'				=> array(
			7006 => 1
		),'FL_J(folder JUIZS)' 		=> array(
			2004 => 1
		)
	),1479 => array( //TILL DINNER 3
		'LS_Spinach'				=> array(
			3001 => 1
		),'LS_Basil'				=> array(
			3002 => 1
		),'LS_Beetroot'				=> array(
			3003 => 1
		),'LS_Carrot'				=> array(
			3004 => 1
		),'LS_Kale'					=> array(
			3005 => 1
		),'LS_Cucumber'				=> array(
			3012 => 2
		),'LS_Watermelon-Coconut'	=> array(
			3013 => 1
		),'LS_Beetroot-Acai'		=> array(
			3014 => 2
		),'LS_Zucchini'				=> array(
			3015 => 1
		),'LS_Orange_Bell_Pepper' 	=> array(
			3016 => 1
		),'FL_J(folder JUIZS)' 		=> array(
			2004 => 1
		)
	),1480 => array( //TILL DINNER 5
		'LS_Spinach'				=> array(
			3001 => 2
		),'LS_Basil'				=> array(
			3002 => 2
		),'LS_Beetroot'				=> array(
			3003 => 2
		),'LS_Carrot'				=> array(
			3004 => 2
		),'LS_Kale'					=> array(
			3005 => 2
		),'LS_Cucumber'				=> array(
			3012 => 3
		),'LS_Watermelon-Coconut'	=> array(
			3013 => 2
		),'LS_Beetroot-Acai'		=> array(
			3014 => 3
		),'LS_Zucchini'				=> array(
			3015 => 1
		),'LS_Orange_Bell_Pepper' 	=> array(
			3016 => 1
		),'FL_J(folder JUIZS)' 		=> array(
			2004 => 1
		)
	),1481 => array( //TILL DINNER 6
		'LS_Spinach'				=> array(
			3001 => 2
		),'LS_Basil'				=> array(
			3002 => 2
		),'LS_Beetroot'				=> array(
			3003 => 2
		),'LS_Carrot'				=> array(
			3004 => 2
		),'LS_Kale'					=> array(
			3005 => 2
		),'LS_Cucumber'				=> array(
			3012 => 4
		),'LS_Watermelon-Coconut'	=> array(
			3013 => 2
		),'LS_Beetroot-Acai'		=> array(
			3014 => 4
		),'LS_Zucchini'				=> array(
			3015 => 2
		),'LS_Orange_Bell_Pepper' 	=> array(
			3016 => 2
		),'FL_J(folder JUIZS)' 		=> array(
			2004 => 1
		)
	),1249 => array( //GREEN MORNING
		'LS_Spinach'				=> array(
			3001 => 4
		),'LS_Basil'				=> array(
			3002 => 4
		),'LS_Kale'					=> array(
			3005 => 4
		),'LS_Greens Only'			=> array(
			3008 => 4
		),'LS_Zucchini'				=> array(
			3015 => 4
		),'FL_J(folder JUIZS)' 		=> array(
			2004 => 1
		)
	),1244 => array( //EVERY DAY
		'LS_Spinach'				=> array(
			3001 => 3
		),'LS_Basil'				=> array(
			3002 => 2
		),'LS_Beetroot'				=> array(
			3003 => 2
		),'LS_Carrot'				=> array(
			3004 => 3
		),'LS_Greens Only'			=> array(
			3008 => 2
		),'LS_Beetroot-Acai'		=> array(
			3014 => 2
		),'LS_Watermelon-Coconut'	=> array(
			3013 => 2
		),'LS_Zucchini'				=> array(
			3015 => 2
		),'FL_J(folder JUIZS)' 		=> array(
			2004 => 1
		),'LS_Orange_Bell_Pepper' 	=> array(
			3016 => 1
		)
	),1244 => array( //SPORTS
		'LS_Spinach'				=> array(
			3001 => 4
		),'LS_Beetroot'				=> array(
			3003 => 4
		),'LS_Kale'					=> array(
			3005 => 4
		),'LS_Watermelon-Coconut'	=> array(
			3013 => 4
		),'LS_Beetroot-Acai'		=> array(
			3014 => 4
		),'Bites_06' 				=> array(
			7003 => 1
		),'FL_J(folder JUIZS)' 		=> array(
			2004 => 1
		)
	),"Shots Gember Appel" => array( //SHOTS Gem-appel-citro
		'Gem_Appel_Citro' => array(
			1024 => 1
		)
	),"Shots Himalaya" => array( //SHOTS Shots Himalaya
		'Citroen_Himalaya' => array(
			1020 => 1
		)
	),"????" => array( //SHOTS Shots ??
		'Grana_acero_Gua' => array(
			1021 => 1
		)
	),"Juizsy" => array( //SHOTS Juizsy
		'JS_Sweet_Veggie' => array(
			6001 => 1
		)
	),2717 => array( //SHOTS Juizsy abbo
		'JS_Sweet_Veggie' => array(
			6001 => 30
		)
	),2714 => array( //SHOTS Juizsy eenmalig
		'JS_Sweet_Veggie' => array(
			6001 => 30
		)
	)
);
		
		//doe headers voor excel
		foreach (getallheaders() as $name => $value) {
			header_remove($name);
		}
		ob_clean();
		
		$filename = 'export_orders_' . $_POST['date'];
		$filename = str_replace(" ","_",$filename);
		$filename = str_replace(",","",$filename);

		header("Content-Type: application/vnd.ms-excel");
		header('Content-Disposition: attachment; filename='.$filename.'.xls');
		
		
		/*
		* Content Excel:
		*/

		?> 
		<table>
			<tr>
				<th>Order ID</th>
				<th>Leverdatum</th>
				<th>Website</th>
				<th>Bedrijf</th>
				<th>Voornaam</th>
				<th>Achternaam</th>
				<th>Adress_1</th>
				<th>Adress_2</th>
				<th>Postcode</th>
				<th>Stad</th>
				<th>Land</th>
				<th>Email</th>
				<th>Telefoonnummer</th>
				<th>Product id</th>
				<th>Product naam</th>
				<th>Aantal</th>
				<th>Commentaar</th>
			</tr>
		<?php
		
		//pak alle order items
		$customer_orders = get_posts( array(
			'numberposts' => -1,
			'meta_key'    => '_customer_user',
			'post_type'   => wc_get_order_types(),
			'post_status' => array_keys( wc_get_order_statuses() ),
		) );
		
		//loop door alle orders heen
		foreach($customer_orders as $order ){
			if(get_post_meta($order->ID , 'Leverdatum')[0] == $_POST['date']){
				$nummer = 0;
				//leverdatum maken
				$datum = explode(" ", $_POST['date']);
				//10
				$dag = $datum[0];
				//oktober,
				$maand_datum = $datum[1];
				//2018
				$jaar = $datum[2];
				switch($maand_datum){
					case "januari,":
						$maand = "01";
						break;
					case "februari,":
						$maand = "02";
						break;
					case "maart,":
						$maand = "03";
						break;
					case "april,":
						$maand = "04";
						break;
					case "mei,":
						$maand = "05";
						break;
					case "juni,":
						$maand = "06";
						break;
					case "juli,":
						$maand = "07";
						break;
					case "augustus,":
						$maand = "08";
						break;
					case "september,":
						$maand = "09";
						break;
					case "oktober,":
						$maand = "10";
						break;
					case "november,":
						$maand = "11";
						break;
					case "december,":
						$maand = "12";
						break;
				}
				$datum = $jaar . $maand . $dag;
				
				
				$bestelling = wc_get_order( $order->ID);
				$bestelling_data = $bestelling->get_data();
					
				foreach($bestelling->get_items() as $item){
					for($i = 1; $i <= $item->get_quantity(); $i++){
						$nummer++;
						if($item->get_variation_id() != 0){
							$item_id = $item->get_variation_id();
						}else{
							$item_id = $item->get_product_id();
						}
						foreach($bundles[$item_id] as $flesje_naam => $value){
							foreach($value as $flesje_id => $aantal){
								echo '<tr>';
									echo '<td>';
									echo $jaar . $bestelling->get_order_number() . $nummer;
									echo '</td><td>';
									echo $datum;
									echo '</td><td>';
									echo 'GL';
									echo '</td><td>';
									echo $bestelling_data['billing']['company'];
									echo '</td><td>';
									echo $bestelling_data['billing']['first_name'];
									echo '</td><td>';
									echo $bestelling_data['billing']['last_name'];
									echo '</td><td>';
									echo $bestelling_data['billing']['address_1'];
									echo '</td><td>';
									echo $bestelling_data['billing']['address_2'];
									echo '</td><td>';
									echo $bestelling_data['billing']['postcode'];
									echo '</td><td>';
									echo $bestelling_data['billing']['city'];
									echo '</td><td>';
									echo $bestelling_data['billing']['country'];
									echo '</td><td>';
									echo $bestelling_data['billing']['email'];
									echo '</td><td>';
									echo $bestelling_data['billing']['phone'];
									echo '</td><td>';
									echo $flesje_id;
									echo '</td><td>';
									echo $flesje_naam;
									echo '</td><td>';
									echo $aantal;
									echo '</td><td>';
									echo $bestelling->customer_message;
									echo '</td>';
								echo '</tr>';
							}
						}
						
						foreach($item->get_formatted_meta_data( ) as $meta){
							foreach($bundles[wp_kses_post( $meta->display_key )] as $flesje_naam => $value){
								foreach($value as $flesje_id => $aantal){
									echo '<tr>';
									echo '<td>';
									echo $jaar . $bestelling->get_order_number() . $nummer;
									echo '</td><td>';
									echo $datum;
									echo '</td><td>';
									echo 'GL';
									echo '</td><td>';
									echo $bestelling_data['billing']['company'];
									echo '</td><td>';
									echo $bestelling_data['billing']['first_name'];
									echo '</td><td>';
									echo $bestelling_data['billing']['last_name'];
									echo '</td><td>';
									echo $bestelling_data['billing']['address_1'];
									echo '</td><td>';
									echo $bestelling_data['billing']['address_2'];
									echo '</td><td>';
									echo $bestelling_data['billing']['postcode'];
									echo '</td><td>';
									echo $bestelling_data['billing']['city'];
									echo '</td><td>';
									echo $bestelling_data['billing']['country'];
									echo '</td><td>';
									echo $bestelling_data['billing']['email'];
									echo '</td><td>';
									echo $bestelling_data['billing']['phone'];
									echo '</td><td>';
									echo $flesje_id;
									echo '</td><td>';
									echo $flesje_naam;
									echo '</td><td>';
									echo $aantal;
									echo '</td><td>';
									echo $bestelling->customer_message;
									echo '</td>';
								echo '</tr>';
								}
							}
						}
					}
				}
			}
		}
		//Afsluiten excel
		?></table><?php
		die();
	}	
}
?>






