
<div class="<?php echo $this->class; ?>"<?php echo $this->cssID; ?><?php if ($this->style): ?> style="<?php echo $this->style; ?>"<?php endif; ?>>
<?php if ($this->headline): ?>

<<?php echo $this->hl; ?>><?php echo $this->headline; ?></<?php echo $this->hl; ?>>
<?php endif; ?>

<!--   ********** Ueberschrift ********** -->


 
<form action="<?php echo $this->action; ?>" method="post">
<?php foreach ($this->DocumentManagementSystemVerw as $DocumentManagementSystemVerw): ?>

<table  cellpadding="4" cellspacing="0"  border="0" summary="DokManSystem">

<!--   ********** Zeile - Ueberschrift ********** -->
  <tr>
  	<td colspan="6" class="tabueb">Dokumentenverwaltung&nbsp;&nbsp;&nbsp;-&nbsp;&nbsp;&nbsp;Auswahl</td>
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
    <td colspan="4"><input type="hidden" name="recht_veroeffentlichen" value="<?php echo $DocumentManagementSystemVerw['recht_veroeffentlichen'] ?>" />
										<input type="hidden" name="recht_loeschen" value="<?php echo $DocumentManagementSystemVerw['recht_loeschen'] ?>" />
                    <input type="hidden" name="recht_editieren" value="<?php echo $DocumentManagementSystemVerw['recht_editieren'] ?>" />
                    <input type="hidden" name="kategorieid" value="<?php echo $DocumentManagementSystemVerw['kategorieid'] ?>" />
                    <input type="hidden" name="kategoriename" value="<?php echo $DocumentManagementSystemVerw['kategoriename'] ?>" />
                    <input type="hidden" name="kategoriebeschreibung" value="<?php echo $DocumentManagementSystemVerw['kategoriebeschreibung'] ?>" />
                    <input type="hidden" name="loeschlauf" value="<?php echo $DocumentManagementSystemVerw['loeschlauf'] ?>" />
                    <input type="hidden" name="editierlauf" value="<?php echo $DocumentManagementSystemVerw['editierlauf'] ?>" />
    </td>
  </tr>
 
<!--   ********** Zeile - Dokumentueberschrift ********** -->  
  <tr>
    <td class="verw_tabueb3">Dokumentname</td>
    <td class="verw_tabueb4">ver&ouml;ffentlichen</td>
    <td class="verw_tabueb4">l&ouml;schen</td>
    <td class="verw_tabueb4">editieren</td>
  </tr>

	<?php foreach ($DocumentManagementSystemVerw['dokdetails'] as $dokdetail) 
		{ $arrDokTeile = explode(".", $dokdetail['file_source']);
			$strDokTeil1 = $arrDokTeile[0];
			$strDokTeil2 = $arrDokTeile[1]; ?>  
			<tr>   
  <!-- Spalte 1 - DokumentName --> 
			<td class="verw_dokname"><?php echo $dokdetail['name'].'&nbsp;&nbsp;&nbsp;V.&nbsp;'.$dokdetail['version_major'].'.'.$dokdetail['version_minor']?> </td>
      
  <!-- Spalte 2 - veroeffentlichen -->  
		<td class="verw_dokname_zentriert"><input type="checkbox" name="veroeffentlichen[]" value="<?php echo $dokdetail['id']; ?>" <?php if ($dokdetail['published'] == 1) {?> checked <?php } ?><?php if ($DocumentManagementSystemVerw['recht_veroeffentlichen'] == 0) { ?> disabled <?php } ?> /> </td>

  <!-- Spalte 3 - loeschen -->    
		<td class="verw_dokname_zentriert"><input type="checkbox" name="loeschen[]" value="<?php echo $dokdetail['id']; ?>"<?php if ($DocumentManagementSystemVerw['recht_loeschen'] == 0) { ?> disabled <?php } ?>/> </td>

  <!-- Spalte 4 - editieren -->
		<td class="verw_dokname_zentriert"><input type="checkbox" name="editieren[]" value="<?php echo $dokdetail['id']; ?>"<?php if ($DocumentManagementSystemVerw['recht_editieren'] == 0) { ?> disabled <?php } ?>/> </td> 
     
	</tr>
	<?php } ?>

<?php endforeach; ?>

  <tr>
    <td colspan="4" class="anz_rahmen_oben"><input type="submit" name ="submit_verwaltung_auswahl" class="submit" value="Aktionen best&auml;tigen" /></td>
  </tr>
</table>
</form>
</div>