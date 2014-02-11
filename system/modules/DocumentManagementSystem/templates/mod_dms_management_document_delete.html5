
<div class="<?php echo $this->class; ?>"<?php echo $this->cssID; ?><?php if ($this->style): ?> style="<?php echo $this->style; ?>"<?php endif; ?>>
<?php if ($this->headline): ?>

<<?php echo $this->hl; ?>><?php echo $this->headline; ?></<?php echo $this->hl; ?>>
<?php endif; ?>
 
<form action="<?php echo $this->action; ?>" method="post">
<?php foreach ($this->DocumentManagementSystemVerw as $DocumentManagementSystemVerw): ?>

<table  cellpadding="4" cellspacing="0"  border="0" summary="DokManSystem">

<?php if ($intLauf <> 1) { ?>

<!--   ********** Zeile - Ueberschrift ********** -->
  <tr>
  	<td colspan="6" class="tabueb">Dokumentenverwaltung&nbsp;&nbsp;&nbsp;-&nbsp;&nbsp;&nbsp;Dokumente l&ouml;schen (Nachfrage)</td>
  </tr>
  
<!--   ********** Leerzeile ********** -->
  <tr>
  	<td colspan="6">&nbsp;</td>
  </tr>

	<!--   ********** Zeile - KapitelName ********** -->
	<tr>
		<td colspan="4" class="verw_tabueb2"><?php echo $DocumentManagementSystemVerw['kategoriename']; ?></td>
	</tr>

	<!--   ********** Zeile - KapitelBeschreibung ********** -->
	<tr>
		<td colspan="4" class="anz_katbes"><?php echo $DocumentManagementSystemVerw['kategoriebeschreibung']; ?></td>
	</tr>  
  
	<!--   ********** Leerzeile (versteckte Felder für Rechteweitergabe ********** -->  
  <tr>
    <td colspan="4"><input type="hidden" name="recht_loeschen" value="<?php echo $DocumentManagementSystemVerw['recht_loeschen'] ?>" />
  								  <input type="hidden" name="recht_veroeffentlichen" value="<?php echo $DocumentManagementSystemVerw['recht_veroeffentlichen'] ?>" />
  								  <input type="hidden" name="recht_editieren" value="<?php echo $DocumentManagementSystemVerw['recht_editieren'] ?>" />
  								  <input type="hidden" name="veroeffentlichen" value="<?php echo $DocumentManagementSystemVerw['arr_veroeffentlichen'] ?>" />
  								  <input type="hidden" name="editieren" value="<?php echo $DocumentManagementSystemVerw['arr_editieren'] ?>" />
                    <input type="hidden" name="kategorieid" value="<?php echo $DocumentManagementSystemVerw['kategorieid'] ?>" />
                    <input type="hidden" name="kategoriename" value="<?php echo $DocumentManagementSystemVerw['kategoriename'] ?>" />
                    <input type="hidden" name="kategoriebeschreibung" value="<?php echo $DocumentManagementSystemVerw['kategoriebeschreibung'] ?>" />
                    <input type="hidden" name="loeschen" value="<?php echo $DocumentManagementSystemVerw['arr_loeschen'] ?>" />
                    <input type="hidden" name="loeschlauf" value="gelaufen" />
                    <input type="hidden" name="editierlauf" value="<?php echo $DocumentManagementSystemVerw['editierlauf'] ?>" />                                        
    </td>
  </tr>
  
	<!--   ********** Zeile - Hinweis ********** --> 
  <tr>
    <td colpan="4" class="fettrot">folgende Dokumente werden inclusive vorhandener Grafiken gel&ouml;scht :</td>
  </tr> 
  
<?php $intLauf = 1; } ?>


<?php foreach ($DocumentManagementSystemVerw['dokdetails'] as $dokdetail) 
{ $arrDokTeile = explode(".", $dokdetail['file_source']);
	$strDokTeil1 = $arrDokTeile[0];
	$strDokTeil2 = $arrDokTeile[1]; ?>  
	<tr>   
  <!-- Spalte 1-4 - DokumentName --> 
			<td class="dokname"><?php echo $dokdetail['name'].'&nbsp;&nbsp;&nbsp;V.&nbsp;'.$dokdetail['version_major'].'.'.$dokdetail['version_minor']?> </td>   
	</tr>
<?php } ?>

<?php endforeach; ?>

<!--   ********** Leerzeile ********** -->  
	<tr>
  	<td colspan="4">&nbsp;</td>
  </tr>
  
<!--   ********** Zeile Checkbox zum Nichtloeschen ********** --> 
	<tr>
  	<td colspan="4" class="fettrot">Ja - diese Dokumente sollen gel&ouml;scht werden <input type="checkbox" name="dokumente_loeschen" value="j" /></td>
  </tr>
  
  <tr>
    <td colspan="4" class="anz_rahmen_oben"><input type="submit" name ="submit_verwaltung_auswahl" class="submit" value="Aktion best&auml;tigen" /></td>
  </tr>
  
</table>
</form>
</div>