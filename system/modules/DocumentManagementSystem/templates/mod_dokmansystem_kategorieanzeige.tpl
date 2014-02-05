<div class="mod_DokManSystem <?php echo $this->class; ?>"<?php echo $this->cssID; ?><?php if ($this->style): ?> style="<?php echo $this->style; ?>"<?php endif; ?>>
<?php if ($this->headline): ?>

<<?php echo $this->hl; ?>><?php echo $this->headline; ?></<?php echo $this->hl; ?>>
<?php endif; ?>


<div id="search">
	<form action="<?php echo $this->action; ?>" method="post" id="search" name="search">
		<input type="text" name="suchbegriff" id="suchbegriff" value="<?php if ($this->Input->post('suchbegriff') != "Suchbegriff" && $this->Input->post('suchbegriff') != ""){ ?><?php echo $this->Input->post('suchbegriff'); ?><?php } else { ?>Suchbegriff<?php } ?>" style="color:grey;" onclick="value=''"/>
		<input type="hidden" name="submit_kategorieauswahl" value="OK" />
		<input type="submit" name="search" value="Suchen" />
	</form>
</div>


<!--   ********** Auflistungstabelle ********** -->

<table id="dokManAnzeige" cellpadding="4" cellspacing="0"  border="0" summary="DokManSystem">

<thead>
	<tr>
		<th>Kategorie</th>
		<th>&sum;</th>
		<th>Auswahl</th>
	</tr>
</thead>
<tbody>

<form action="<?php echo $this->action; ?>" method="post" id="lister" name="lister">
  
<!--   ********** Leerzeile ********** 
  <tr>
    <td colspan="5">&nbsp;</td>
  </tr>
   --> 
  
<!--   ********** Zeile - alle Kategorien **********
  <tr>
    <td colspan="2" class="anz_katname">alle Kategorien</td>
   <td class="anz_rahmen_oben"><input type="checkbox" name="kategorieauswahl[]" value="a"/></td>
    <td colspan="2" class="anz_rahmen_oben">&nbsp;</td>
    <td class="anz_rahmen_oben"><input type="submit" name="submit_kategorieauswahl" class="submit" value="OK" /></td>

  </tr>
   -->  
  
<!--   ********** Leerzeile ********** 
  <tr>
    <td colspan="5">&nbsp;</td>
  </tr>
  -->  
  
<!--   ********** Zeile - Auflistung der Kategorien mit Einrueckung bei Unterkategorien ********** --> 
<?php $fileCount = 0; ?>
<?php foreach ($this->DocumentManagementSystemKat as $DocumentManagementSystemKat): ?>

<?php if ($DocumentManagementSystemKat['anzeigends'] == 1) {  ?>
 

<?php if ($DocumentManagementSystemKat['leserecht'] == 1) {?>
  <tr class="category_<?php echo $DocumentManagementSystemKat['category']; ?>">
	<td class="category_name first<?php if ($DocumentManagementSystemKat['leserecht'] == 0) { ?> locked<?php } ?>"><?php echo $DocumentManagementSystemKat['kategoriename']; ?></td>
	<td class="category_sum_files">
		<?php
			if ($DocumentManagementSystemKat['leserecht'] == 0) {
				echo '&nbsp;';
			} else {
				echo $DocumentManagementSystemKat['zaehlerds'];
				$fileCount += $DocumentManagementSystemKat['zaehlerds'];
			}
		?>
	</td>
    <?php if ($DocumentManagementSystemKat['leserecht'] == 1 && $DocumentManagementSystemKat['zaehlerds'] > 0) { ?>    
    <td class="category_select"><input type="hidden" name="submit_kategorieauswahl" class="submit" value="OK" /><input onchange="lister.submit();" type="checkbox" name="kategorieauswahl[]" value="<?php echo $DocumentManagementSystemKat['kategorieid']; ?>" <?php if ($DocumentManagementSystemKat['anzeigen'] == 1) {?> checked <?php } ?> /> </td>
    <?php } else { ?>
    <td>&nbsp;</td>
    <?php } ?>
	
  <!-- Spalte 3 (Checkbox) -->                                               
    <?php /*if ($DocumentManagementSystemKat['leserecht'] == 1 && $DocumentManagementSystemKat['zaehlerds'] > 0) { ?>    
    <td class="category_select"><input type="hidden" name="submit_kategorieauswahl" class="submit" value="OK" /><input onchange="lister.submit();" type="checkbox" name="kategorieauswahl[]" value="<?php echo $DocumentManagementSystemKat['kategorieid']; ?>" <?php if ($DocumentManagementSystemKat['anzeigen'] == 1) {?> checked <?php } ?> /> </td>
    <?php } else { ?>
    <td>&nbsp;</td>
    <?php } */?>

  <!-- Spalte 4 (Grafik) -->

  <?php/* if ($DocumentManagementSystemKat['kategoriebild'] <> "" && $DocumentManagementSystemKat['leserecht'] == 1) { ?>
    <td class="anz_rahmen_oben"><a href="{{link_url::anzeige}}?file=<?php echo $DocumentManagementSystemKat['kategoriebild'] ?>" target="_new"> <img src="<?php echo $DocumentManagementSystemKat['kategoriebild'] ?>" width="20" height="20" border="0"  /> </a></td> 
    <?php } else { ?>
    <td class="anz_rahmen_oben">&nbsp;</td>
    <?php } */?>
   
  <!-- Spalte 5 (OK-Button) -->
    <?php /* if ($DocumentManagementSystemKat['leserecht'] == 1 && $DocumentManagementSystemKat['zaehlerds'] <> 0) { ?>
    <td><input type="submit" name ="submit_kategorieauswahl" class="submit" value="OK" /></td>
    <?php } else { ?>
    <td>&nbsp;</td>
    <?php } */?>
</tr>

  
<!--   ********** Zeile - Beschreibung der Kategorien ********** --> 
<?php /*
<tr class="category_<?php echo $DocumentManagementSystemKat['category']; ?>>
  <?php if ($DocumentManagementSystemKat['leserecht'] == 1) { ?>
  <td colspan="5" class="anz_katbes cat_<?php echo $DocumentManagementSystemKat['kategoriestufe']; ?>"><?php echo $DocumentManagementSystemKat['kategoriebeschreibung'] ?> </td>
      <?php } else { ?>
    <td colspan="5">&nbsp;</td>
    <?php } ?>
</tr>
*/ ?>
<?php }?>

  
<!--   ********** Zeile - Auflistung der Dokumente mit Verlinkung ********** -->  
  <?php if ($DocumentManagementSystemKat['anzeigen'] == 1 && $DocumentManagementSystemKat['leserecht'] == 1) { ?> 
    <?php foreach ($DocumentManagementSystemKat['dokdetails'] as $dokdetail) 
     { $arrDokTeile = explode(".", $dokdetail['file_source']);
       $strDokTeil1 = $arrDokTeile[0];
       $strDokTeil2 = $arrDokTeile[1]; ?>
  
			<tr class="category_<?php echo $DocumentManagementSystemKat['category']; ?>">
    
  <!-- 1-6 (Dokument) --> 
			<td colspan="3" class="first document_link"><a href="{{env::request}}?file=<?php echo $DocumentManagementSystemKat['dokdir'].'/'.$strDokTeil1.'_'.$dokdetail['version_major'].'_'.$dokdetail['version_minor'].'.'.$strDokTeil2; ?>" target="_new"><?php echo $dokdetail['name'].' (V. '.$dokdetail['version_major'].'.'.$dokdetail['version_minor'].')'?></a></td>
    
  <!-- Spalte 7 (Grafik) -->  
			<?php /*if ($dokdetail['file_preview'] == "") { ?>
			<td>&nbsp;</td>
			<?php } else { ?>
			<td><a href="{{link_url::anzeige}}?file=<?php echo $DocumentManagementSystemKat['dokdir'].'/preview/'.$dokdetail['name'].'_'.$dokdetail['file_preview'] ?>" target="_new"> <img src="<?php echo $DocumentManagementSystemKat['dokdir'].'/preview/'.$dokdetail['name'].'_'.$dokdetail['file_preview'] ?>" width="20" height="20" border="0"  /> </a></td>
			<?php } */?>
    
  <!-- Spalte 8 (Leer) -->  
			</tr>
 
<!--   ********** Zeile - Beschreibung der Dokumente ********** --> 
			<tr class="category_<?php echo $DocumentManagementSystemKat['category']; ?>">
			<td colspan="3" class="first document_description"><?php echo $dokdetail['dk_beschreibung'] ?></td>
			</tr>

    <?php } ?>
  <?php } ?>
 
 
<?php }  ?> 
  

<!--   ********** Ende der Auslistungstabelle ********** -->
<?php endforeach; ?>

</tbody>


<!--   ********** Schaltflaeche ********** -->    
<tfoot>
  <tr>
<!--  	<td colspan="5"><input type="submit" name ="submit_kategorieauswahl" class="submit" value="Auswahl best&auml;tigen" /></td> -->
    <td colspan="3">
		<?php if ($fileCount > 0) { ?> 
		<input type="submit" name="submit_kategorieauswahl" class="submit" value="alle Kategorien anzeigen" onclick="checkAllCategories(true);"/>
		<input type="submit" name ="submit_kategorieauswahl_loeschen" class="submit" value="alle Kategorien ausblenden" onclick="checkAllCategories(false);"/>
		<?php }  ?> 
	</td>
  </tr>
  </tfoot>
</table>



</form>
</div>
<script type="text/javascript">
<!--
	function checkAllCategories (check) {
		for (var i = 0; i < document.getElementsByName("kategorieauswahl[]").length; i++){
			document.getElementsByName("kategorieauswahl[]")[i].checked = check;
		}
	}
-->
</script>