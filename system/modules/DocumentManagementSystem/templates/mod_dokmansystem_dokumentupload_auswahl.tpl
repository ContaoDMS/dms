
<div class="mod_DokManSystem <?php echo $this->class; ?>"<?php echo $this->cssID; ?><?php if ($this->style): ?> style="<?php echo $this->style; ?>"<?php endif; ?>>
<?php if ($this->headline): ?>

<<?php echo $this->hl; ?>><?php echo $this->headline; ?></<?php echo $this->hl; ?>>
<?php endif; ?>


<form action="<?php echo $this->action; ?>" method="post" enctype="multipart/form-data">
<?php foreach ($this->DocumentManagementSystemUp as $DocumentManagementSystemUp): ?>
<table cellpadding="4" cellspacing="0" border="0" summary="DokManSystem">
	<thead>
	  <tr>
		<th colspan="2" class="tabueb">Dokumentupload - Dateiauswahl</th>
	  </tr>
	</thead>
	<tbody>
	  <tr>
		<td class="label">Kategorie</td>
		<td><?php echo $DocumentManagementSystemUp['kategoriename']; ?></td>
	  </tr>
	  <tr>
		<td class="label">Zul&auml;ssige Dateitypen</td>
		<td><?php echo $DocumentManagementSystemUp['dateitypen']; ?></td>
	  </tr>
	  <tr>
		<td class="label">Maximale Dateigr&ouml;ße</td>
		<td>
		<?php
			$uploadMaxFilesize = trim(ini_get('upload_max_filesize'));
			$last = strtolower($uploadMaxFilesize[strlen($uploadMaxFilesize)-1]);
			$unit = 'Byte';
			switch($last) {
				case 'g':
					$unit = 'GB';break;
				case 'm':
					$unit = 'MB';break;
				case 'k':
					$unit = 'kB';break;
			}
			
			echo trim(substr($uploadMaxFilesize, 0, -1)) . ' ' . $unit;
		?>
		</td>
	  </tr>
	  <tr>
		<td class="label">Dokumentauswahl</td>
		<td><input type="file" name="DateiSource" id="file"/></td>
	  </tr>
	</tbody>
	<tfoot>
	  <tr>
		<td colspan="2"><input type="submit" name="submit_ende" value="Abbrechen"/> <input onClick="return checkFile();" type="submit" name="submit_upload_auswahl" value="Upload starten"/></td>
	  </tr>
	<tfoot>
</table>

<input type="hidden" name="kategorieid" value="<?php echo $DocumentManagementSystemUp['kategorieid']; ?>" />
<input type="hidden" name="kategoriename" value="<?php echo $DocumentManagementSystemUp['kategoriename']; ?>" />
<input type="hidden" name="dateitypen" value="<?php echo $DocumentManagementSystemUp['dateitypen']; ?>" />
<input type="hidden" name="recht_veroeffentlichen" value="<?php echo $DocumentManagementSystemUp['recht_veroeffentlichen']; ?>" />
	
<?php endforeach; ?>
</form>
</div>
<script type="text/javascript">
<!--
  function checkFile() {
    if (document.getElementById("file").value != null && document.getElementById("file").value.length > 0) {
      return true;
    } else {
    	alert("Es wurde keine Datei ausgewählt. Bitte wählen Sie eine Datei von ihrer Festplatte aus!");
    	document.getElementById("file").style.background = "#ff0000";
    	document.getElementById("file").style.color = "#ffffff";
    	document.getElementById("file").focus();
    	return false;
    }
  }

-->
</script>