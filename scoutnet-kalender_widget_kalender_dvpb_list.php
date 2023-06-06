<?php
	// wenn der Aufruf nicht per AJAX kam, dann dient er zur Vorbereitung der AJAX-Abfrage
	if ($ajaxcall !== true) {
		// deshalb bauen wir hier unseren DIV in den wir per AJAX Dinge reinladen und nicht woanders
		// sonst hätten wir den DIV doppelt
		// Mindesthöhe von 251px ist aus dem FF entnommen, nachdem das komplette DOM nach einem fertigen AJAX-Request gerendert wurde
		?>
		<div class="<?php echo $wrapclassname; ?>" style="min-height: 251px;"><span style="color: #dedede;">Scoutnet ...</span></div>
		<?php
	
	// wenn der Aufruf jedoch per AJAX kam, ganz normal Content ausgeben, mit dem wir unseren DIV füllen wollen
	} else {
		setlocale (LC_ALL, 'de_DE@euro', 'de_DE', 'de', 'ge');

		// Zeitzone ...
		// date_default_timezone_set('Europe/Berlin');		
		
		foreach($events as $event) { /* @var $event SN_Model_Event */
		?>
			<div>
				<div class="date-container">
					<span class="day"><?php echo date('d', $event->Start); ?></span>
					<span class="month"><?php echo htmlentities(utf8_encode(strftime('%b', $event->Start))); ?></span>
				</div>
				<div class="info-container">
					<span class="event-title">
						<?php
						if (trim($event->URL) == '') {
							?>
							<a href="/termine" title="Termin&uuml;bersicht" alt="Termin&uuml;bersicht"><?php echo $event->Title; ?></a>
							<?php
						} else {
							?>
							<a href="<?php echo addslashes(trim($event->URL)); ?>"><?php echo trim($event->Title); ?></a>
							<?php
						}
						?>
					</span></br>
					<span class="event-descr">
						<?php
						if (date("H:i", $event->Start) == "00:00") {
							// "wenn 22:00" = "keine Zeit im scoutnet eingetragen" = "ganztaegig (bei Winterzeit)"
						} else {
							echo gmdate('G:i', $event->Start) . "Uhr<br />";
						}
						?>
						<?php echo $event->Location; ?>
					</span>
				</div>
				<div style="clear: both;"></div>
			</div>
		<?php
		}
	}

?>