<?php

if ($_SERVER['HTTP_HOST'] != 'lugmap.it' AND $_SERVER['HTTP_HOST'] != 'www.lugmap.it') {
	include('visualizza-regione.php');
	exit (0);
}

require_once ('varie.php');

?>

<html>
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />

		<title>Mappa dei Linux User Groups Italiani</title>

		<script type="text/javascript" src="http://maps.google.com/maps?file=api&amp;v=2&amp;key=ABQIAAAA1wmNYgsPLSLzBfUdqFykjxQR8KvcGyCdgVa1pp5vyItO0ej8oxRFxpi5aceT4KQUnwoDtmcRMpZ5iA"></script>
		<script type="text/javascript" src="http://openlayers.org/api/OpenLayers.js"></script>

		<script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.4.4/jquery.min.js"></script>
		<script type="text/javascript" src="js/verticaltabs.js"></script>
		<script type="text/javascript" src="forge/lug-o-matic/generator.js"></script>
		<link rel="stylesheet" href="assets/css/main.css" />

		<script type="text/javascript">
			<!--

			/*
				Buona parte del codice qui presente e' stato copiato da linuxday.it
			*/

			var map, layer;

			OpenLayers.Feature.prototype.createPopup = function (closeBox) {
				if (this.lonlat != null) {
					var id = this.id + "_popup";
					var anchor = this.marker ? this.marker.icon : null;

					this.popup = new (this.popupClass)(id, this.lonlat, this.data.popupSize, this.data.popupContentHTML, anchor, true);
					this.popup.autoSize = true;

					if (this.data.overflow != null)
						this.popup.contentDiv.style.overflow = 'auto';

					this.popup.feature = this;
				}

				return this.popup;
			}

			function lonLatToMercator(ll) {
				var lon = ll.lon * 20037508.34 / 180;
				var lat = Math.log (Math.tan ((90 + ll.lat) * Math.PI / 360)) / (Math.PI / 180);
				lat = lat * 20037508.34 / 180;
				return new OpenLayers.LonLat(lon, lat);
			}

			function osm_getTileURL(bounds) {
				var res = this.map.getResolution();
				var x = Math.round((bounds.left - this.maxExtent.left) / (res * this.tileSize.w));
				var y = Math.round((this.maxExtent.top - bounds.top) / (res * this.tileSize.h));
				var z = this.map.getZoom();
				var limit = Math.pow(2, z);

				if (y < 0 || y >= limit) {
					return OpenLayers.Util.getImagesLocation() + "404.png";
				} else {
					x = ((x % limit) + limit) % limit;
					return this.url + z + "/" + x + "/" + y + "." + this.type;
				}
			}

			function init () {
				var options = {
			  		projection: new OpenLayers.Projection("EPSG:900913"),
			  		displayProjection: new OpenLayers.Projection("EPSG:4326"),
			  		units: "m",
			  		maxResolution: 156543.0339,
			  		controls:[], numZoomLevels:20,
			  		maxExtent: new OpenLayers.Bounds(-20037508, -20037508, 20037508, 20037508.34)
				}

				map = new OpenLayers.Map('map', options);

				var mapnik = new OpenLayers.Layer.TMS( "OSM Mapnik", "http://tile.openstreetmap.org/",
					{ type: 'png', getURL: osm_getTileURL, displayOutsideMaxExtent: true, attribution: '<a href="http://www.openstreetmap.org/">OpenStreetMap - slippy map</a>',
					isBaseLayer: true, visibility: true, numZoomLevels:20 } );

				var gmap = new OpenLayers.Layer.Google("Google Streets", {numZoomLevels: 20} );

				map.addLayers([mapnik, gmap]);

				map.addControl(new OpenLayers.Control.Navigation());
				map.addControl(new OpenLayers.Control.PanZoomBar() );
				map.addControl(new OpenLayers.Control.Permalink());
				map.addControl(new OpenLayers.Control.ScaleLine());
				map.addControl(new OpenLayers.Control.LayerSwitcher());

				var newl = new OpenLayers.Layer.Text( "LUG", {location: "./dati.txt"} );
				map.addLayer(newl);

				map.setCenter( lonLatToMercator(new OpenLayers.LonLat(12.483215,41.979911)),6);
			}

			$(document).ready(function(){
				$("#pager").verticaltabs({slideShow: false, activeIndex: 0});
				init ();
			});

			-->
		</script>
	</head>

	<body>
		<div class="verticalslider" id="pager">
			<ul class="verticalslider_tabs">
				<li><a href="#">Mappa</a></li>
				<li><a href="#">Lista delle Regioni</a></li>
				<li><a href="#">Lista Completa</a></li>
				<li><a href="#">Partecipa</a></li>
				<li><a href="#">Progetti Collaterali</a></li>

				<li>
					<p class="intro">
						<img src="images/logo.png" alt="lugmap.it" />
					</p>
				</li>
			</ul>

			<ul class="verticalslider_contents">
				<li class="page">
					<div id="map" class="smallmap"></div>
				</li>

				<li class="page">
					<div class="center_frame">
						<div class="duallist">
							<ul>
								<li><a href="http://abruzzo.lugmap.it/">Abruzzo</a></li>
								<li><a href="http://basilicata.lugmap.it/">Basilicata</a></li>
								<li><a href="http://calabria.lugmap.it/">Calabria</a></li>
								<li><a href="http://campania.lugmap.it/">Campania</a></li>
								<li><a href="http://emilia.lugmap.it/">Emilia Romagna</a></li>
								<li><a href="http://friuli.lugmap.it/">Friuli Venezia-Giulia</a></li>
								<li><a href="http://lazio.lugmap.it/">Lazio</a></li>
								<li><a href="http://liguria.lugmap.it/">Liguria</a></li>
							</ul>
							<ul>
								<li><a href="http://lombardia.lugmap.it/">Lombardia</a></li>
								<li><a href="http://marche.lugmap.it/">Marche</a></li>
								<li><a href="http://molise.lugmap.it/">Molise</a></li>
								<li><a href="http://piemonte.lugmap.it/">Piemonte</a></li>
								<li><a href="http://puglia.lugmap.it/">Puglia</a></li>
								<li><a href="http://sardegna.lugmap.it/">Sardegna</a></li>
								<li><a href="http://sicilia.lugmap.it/">Sicilia</a></li>
								<li><a href="http://toscana.lugmap.it/">Toscana</a></li>
							</ul>
							<ul>
								<li><a href="http://trentino.lugmap.it/">Trentino Alto Adige</a></li>
								<li><a href="http://umbria.lugmap.it/">Umbria</a></li>
								<li><a href="http://valle.lugmap.it/">Valle d'Aosta</a></li>
								<li><a href="http://veneto.lugmap.it/">Veneto</a></li>
								<li>&nbsp;</li>
								<li><a href="http://italia.lugmap.it/">Italia</a></li>
							</ul>
						</div>
					</div>
				</li>

				<li class="page">
					<div>
						<?php

						$db_regione = array ();

						foreach (glob ('./db/*.txt') as $db_file) {
							$db_regione = array_merge ($db_regione, file ($db_file));
							sort ($db_regione);
						}

						?>

						<div class="description">
							<p>
								Ci sono <?php echo count ($db_regione); ?> Linux User Groups in Italia.
							</p>

							<p>
								Probabilmente, almeno uno di questi è vicino a casa tua.
							</p>
						</div>

						<table id="lugListTable">
							<thead>
								<tr>
									<th>Provincia</th>
									<th>Denominazione</th>
									<th>Zona</th>
									<th>Contatti</th>
								</tr>
							</thead>

							<tfoot>
								<tr>
									<th>Provincia</th>
									<th>Denominazione</th>
									<th>Zona</th>
									<th>Contatti</th>
								</tr>
							</tfoot>

							<tbody>
								<?php

								while (list ($nriga, $linea) = each ($db_regione)):
									$campi = explode("|",$linea);
									$provincia    = $campi[0];
									$denominazione  = $campi[1];
									$zona     = $campi[2];
									$contatti   = $campi[3];
									?>

									<tr class="row_<?php echo ($nriga % 2); ?>">
									<td class="province"><?php echo $provincia ?></td>
									<td><?php echo $denominazione ?></td>
									<td><?php echo $zona ?></td>
									<td class="contactUrl"><a href="<?php echo $contatti?>"><?php echo $contatti ?></a></td>
									</tr>
								<?php endwhile;?>
							</tbody>
						</table>
					</div>
				</li>

				<li class="page">
					<div class="center_frame">
						<div class="textual">
							<p>
								Questa LugMap è frutto di un lavoro collettivo e collaborativo, cui tutti sono invitati a partecipare con suggerimenti e segnalazioni.
							</p>
							<p>
								Il sito viene periodicamente aggiornato sulla base di un <a href="https://github.com/Gelma/LugMap">repository GitHub</a> pubblicamente leggibile, in cui le informazioni sui LUG sono organizzate in <a href="http://github.com/Gelma/LugMap/blob/master/db/">file direttamente accessibili</a>, e comodamente fruibili da terzi alla stregua di file CSV.
							</p>
							<p>
								Segnalaci nuovi/vecchi LUG, così come eventuali correzioni ed errori, mandando una mail a <a href="mailto:lugmap@linux.it">lugmap@linux.it</a>. Ancor meglio, se sei interessato, puoi avere accesso allo stesso <a href="https://github.com/Gelma/LugMap">repository</a> per partecipare attivamente all'aggiornamento dei contenuti. Il tuo contributo ha molteplici effetti: questi dati sono la stessa fonte della <a href="http://www.linux.it/LUG">LugMap di ILS</a>, da cui diverse riviste ricavano le informazioni da pubblicare.
							</p>
						</div>
					</div>
				</li>

				<li class="page">
					<div class="center_frame">
						<div class="textual">
							<p>
								In virtù del semplice formato con cui le informazioni sui LUG italiani sono salvate e rese accessibili, è possibile implementare rapidamente nuove applicazioni web (ma non solo!) per la promozione, l'organizzazione e la connessione dei gruppi stessi.
							</p>
							<p>
								Qui di seguito alcuni dei progetti collaterali nati intorno a tali dati, e spunti per ulteriori creazioni.
							</p>
							<p>
								Se hai una nuova idea e vuoi condividerla con tutti gli altri su questo sito, oppure vuoi riportare un problema o una miglioria per uno dei progetti qui elencati, mandaci una segnalazione all'indirizzo mail <a href="lugmap@linux.it">lugmap@linux.it</a>.
							</p>

							<a name="widget-web" />

							<fieldset>
								<legend>Widget web coi LUG di una regione</legend>

								<div id="introTabel">
									<div class="generator">
										<p>
										Regione <select name="region">
											<?php
											foreach ($elenco_regioni as $simple => $name) {
											?>

											<option value="<?php echo $simple; ?>"><?php echo $name; ?></option>

											<?php
											}
											?>
										</select>
										</p>

										<div class="preview"><iframe id="lugmap" src="http://lugmap.it/forge/lug-o-matic/widget.php?region=abruzzo" onload="calcSize();" width="200px" scrolling="no" frameborder="0"></iframe></div>

										<br />

										<textarea class="code" cols="45" rows="15"><?php echo htmlentities (
										'<script language="JavaScript"><!--
										function calcSize () { document.getElementById(\'lugmap\').height = document.getElementById(\'lugmap\').contentWindow.document.body.scrollHeight;
										}
										//--></script>
										<iframe id="lugmap" src="http://lugmap.it/forge/lug-o-matic/widget.php?region=abruzzo"
										onLoad="calcSize();" width="200px" scrolling="no" frameborder="0"></iframe>'); ?>
										</textarea>
									</div>

									<div>
										<p>
											Usando il generatore qui accanto puoi ottenere il codice HTML di un semplice widget web da
											copiare ed incollare sul tuo sito, con l'elenco sempre automaticamente aggiornato dei Linux
											User Group della regione selezionata.
										</p>

										<p>
											Per tutti coloro che gestiscono delle pagine web, sia veterani del mondo Linux che semplici simpatizzanti,
											questo è un ottimo modo per fare pubblicità ai gruppi vicini di casa.
										</p>
									</div>

									<div class="clear_spacer"></div>
								</div>
							</fieldset>

							<a name="OPML" />

							<fieldset>
								<legend>Generatore di OPML dei feeds dei LUG</legend>

								<p>
									Il generatore <a href="http://www.opml.org/">OPML</a> della LugMap permette di ricostruire la lista dei feeds
									<a href="http://it.wikipedia.org/wiki/Really_simple_syndication">RSS</a> dei siti dei LUG indicizzati nella mappa.
									Esso ispeziona i vari files delle regioni, per ogni URL indicato scarica l'HTML della homepage del sito e verifica
									l'esistenza del tag <i>&lt;link rel="alternate"&gt;</i> abitualmente utilizzato per l'auto-discovery.
								</p>

								<p>
									Tale file OPML può poi essere importato nel proprio lettore RSS, se si vogliono leggere tutte le notizie riguardanti
									l'esteso e variegato mondo degli User Groups, oppure essere utilizzato come punto di partenza per nuove applicazioni
									che prevedono l'aggregazione di contenuti a tema prettamente "linuxofilo".
								</p>

								<p>
									Lo script è in PHP, e può essere lanciato dalla linea di comando con <i>php find_feeds.php</i>
								</p>

								<p>
									<a href="http://github.com/Gelma/LugMap/blob/lugmap.it/forge/opml-generator/find_feeds.php">Scarica lo script qui!</a>
								</p>
							</fieldset>

							<a name="map-generator" />

							<fieldset>
								<legend>Generatore di mappa OpenStreetMap dei LUG</legend>

								<p>
									Sulla homepage di questo sito si trova una grossa mappa con i riferimenti geografici dei diversi LUG indicizzati in questa
									LugMap. Tale elemento web è realizzato con uno script <a href="http://openlayers.org/">OpenLayers</a> ed un file con le
									coordinate da marcare sulla cartina.
								</p>

								<p>
									Suddetto file viene generato eseguendo un apposito script PHP, il quale setaccia l'intero database su file dei LUG, per ognuno
									individua la città o il paese di riferimento, ed appoggiandosi al servizio <a href="http://wiki.openstreetmap.org/wiki/Nominatim">Nominatim</a>
									di <a href="http://openstreetmap.org/">OpenStreetMap</a> ne ricava le coordinate.
								</p>

								<p>
									Il file completo utilizzato in questo sito è sempre reperibile all'URL <i>http://lugmap.it/dati.txt</i>, ed è già pronto per essere
									passato come parametro ad un oggetto Javascript <a href="http://dev.openlayers.org/apidocs/files/OpenLayers/Layer/Text-js.html">OpenLayers.Layer.Text</a>.
									Chi vuole invece generarsi autonomamente il set di dati, può reperire lo script completo
									<a href="http://github.com/Gelma/LugMap/blob/lugmap.it/forge/map-generator/map-generator.php">qui</a>; attenzione: per tale
									operazione sono richieste anche le liste dei comuni italiani già formattate e scaricabili da
									<a href="https://github.com/Gelma/LugMap/tree/lugmap.it/forge/map-generator/liste_comuni">qua</a>.
								</p>
							</fieldset>
						</div>
					</div>
				</li>
			</ul>
		</div>
	</body>
</html>