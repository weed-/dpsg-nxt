<?php
	/*
		Scoutnet Kalender Template: INLINE (default)
		
		Dir stehen hier alle Inhalte des Kalenders in einem Array zur Verf�gung.
		Z.B.:
		    	<?php echo date('d. m. Y', $event->Start); ?>
    			<?php echo $event->Title; ?>
    			<?php echo $event->Author->get_full_name(); ?>
    			<?php var_dump($event); ?>
	*/ 

 
/**
 * Einbindung �ber [snk] mit den folgenden m�glichen Parametern:
 *	elementcount			Anzahl auszulesender Elemente
 *	externalTemplateName	Name des externen Templates (wie im Widget)
 * z.B. [snk elementcount=5 externalTemplateName=MEINNAME]
 */


/*
	Bjoerns cooles Listentemplate fuer den Scoutnet-Kalender
	20120323 b.stromberg@data-systems.de
*/

// deutsch, deutscher, am deutschesten
setlocale (LC_ALL, 'de_DE@euro', 'de_DE', 'de', 'ge');

// Zeitzone ...
date_default_timezone_set('Europe/Berlin');

// URL-Kuerzung, thx phil
if (!function_exists('snkshort_url'))
{
	function snkshort_url($url, $length = 100) {
		$u = NULL;
		// parsen der getrimmten der URL
		$url = parse_url(trim($url));
		// den url[path] in einen array schieben und bereinigen
		$furl = array_filter(explode('/', $url['path']));
		// falls der url[path] mehr als einen teil hat soll ein '../' eingef�gt werden
		if(count($furl) > 1) $u = '../';
		// den letzten teil der url[path] wieder in den $url array einf�gen
		$url['path'] = $u.array_pop($furl);
		// ausgeben der gek�rzten URL
		$ausgabe = $url['scheme'].'://'.$url['host'].'/'.$url['path'];
		// sicherstellen das die maximall�nge nicht �berschritten wird (standard 100 zeichen)
		print substr($ausgabe, 0, $length);
	}
}

foreach($events as $event) { /* @var $event SN_Model_Event */
?>
	<div>
		<div class="date-container">
			<span class="day"><?php echo date('d', $event->Start); ?></span>
			<span class="month">
				<?php echo htmlentities(utf8_encode(strftime('%b', $event->Start)), ENT_IGNORE, "UTF-8"); ?>
			</span>
		</div>	
		<div class="info-container">	
			<?php // Titel mit Link (wenn nicht leer)
			if (trim($event->URL)=="") {
				echo "<h3>".$event->Title."</h3>";
				}
			else 	{
				echo "<h3><a href=".$event->URL.">".$event->Title."</a></h3>";
				} ?>
	
			<?php // Beschreibung
			if (trim($event->Description)!="") { echo "<p>" . $event->Description . "</p>"; } ?>
			<small>
				<?php // Von-Bis ausgeben, wenn Event mehrtaegig
				if ( trim($event->End) - trim($event->Start) > 0 ) {
					echo "Vom " . date('j.n.Y', $event->Start);
					if (date("H:i", $event->Start) == "00:00") {
						// "wenn 22:00" = "keine Zeit im scoutnet eingetragen" => "ganztaegig (bei Winterzeit)"
						} else {
						echo " (" . gmdate('G:i', $event->Start) . "Uhr)";
						}
					echo " bis zum " . gmdate('j.n.Y', $event->End). "<br />";
				} ?>
				
				<?php // Ort mit PLZ ausgeben
				if (trim($event->Location)!="") {
					echo "Ort: ";
					if (trim($event->ZIP)!="") {
						echo $event->ZIP . " ";
					}
					echo $event->Location;
					echo "<br />";
				} ?>

				<?php
				/* Link */
				if (trim($event->URL)!="") {
					echo "Link: <a title=\"" . $event->Title . " (" . $event->URL . ")" . "\" href=" . $event->URL . ">";
					snkshort_url($event->URL, 100);
					echo "</a><br />";
				} ?>
				Autor: <?php echo $event->Author->get_full_name(); ?>
				
				<?php
				/* wenn geaendert am, sonst create */
				if ($event->Last_Modified_At == 0) {
					echo "(Termin erstellt am " . date('j.n.Y', $event->Created_At) . ")";
					//var_dump($events);
				} else {
 					echo "(Termin ge&auml;ndert am " . date('j.n.Y', $event->Last_Modified_At) . ")";
 				} ?>

			</small>	
		</div>
	</div>
	<br style="clear: both;" />
	<br /><br />
<?php
}
?>