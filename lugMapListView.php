<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.1//EN" "http://www.w3.org/TR/xhtml11/DTD/xhtml11.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="it">
<head>
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
  <meta name="language" content="italian" />
  <meta name="keywords" content="Linux, GNU/Linux, software libero, freesoftware, LUG, Linux User Group, $regione" />
  <link href="assets/css/main.css" rel="stylesheet" type="text/css" />
  <title>LUG presenti nella regione <?php echo $regione ?></title>
</head>
<body>

<div id="header">
  <img src="ilsheader-wide.png" alt="Italian Linux Society" />
  <h2 id="title">Linux User Group della regione <?php echo $regione ?></h2>
</div>

<div id="center">
  <a id="backLugMapLink" href="index.phtml">&raquo; torna alla LUGmap</a>
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
	      <td colspan="4"></td>	    
	      </tr>
    </tfoot>
    <tbody>
		  <?php while (list ($nriga, $linea) = each ($db_regione)): ?>
			  <?php # estrazione variabili
					  $campi = explode("|",$linea);
					  $provincia    = $campi[0];
					  $denominazione  = $campi[1];
					  $zona     = $campi[2];
					  $contatti   = $campi[3]; 
			  # stampa dei campi ?>
			  <tr class="row_<?php echo ($nriga % 2); ?>">
			   <td class="province"><?php echo $provincia ?></td>
			   <td><?php echo $denominazione ?></td>
			   <td><?php echo $zona ?></td>
			   <td class="contactUrl"><a href="<?php echo $contatti?>"><?php echo $contatti ?></a></td>
			  </tr>
		  <?php endwhile;?>
    </tbody>
   </table>
   <a id="csvLink" href="db/<?php echo $db_file ?>.txt">&raquo; Elenco in formato CSV</a>
</div>

<div id="footer">
      <p class="helpMessage">Aiutaci a mantenere la LugMap aggiornata!</p> 
      <p class="helpMessage">
	      Segnalaci nuovi/vecchi Lug, cos&igrave; come eventuali correzioni/errori, mandando
	      una mail a <a class="generalink" href="mailto:lugmap@linux.it">lugmap@linux.it</a>, oppure telefonando direttamente ad
	      <a class="generalink" href="mailto:andrea.gelmini@lugbs.linux.it">Andrea Gelmini</a> al 328/7296628.
	    </p> 
	    <p class="helpMessage">
	      Agli stessi recapiti
	      puoi richiedere l'accesso in scrittura al relativo <a class="generalink" href="http://github.com/Gelma/LugMap">repository GitHub.</a>
	      Te ne saremo eternamente grati!
      </p>
</div>

</body>
</html>