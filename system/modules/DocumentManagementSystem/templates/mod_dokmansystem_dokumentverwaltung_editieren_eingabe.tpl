
<div class="<?php echo $this->class; ?>"<?php echo $this->cssID; ?><?php if ($this->style): ?> style="<?php echo $this->style; ?>"<?php endif; ?>>
<?php if ($this->headline): ?>

<<?php echo $this->hl; ?>><?php echo $this->headline; ?></<?php echo $this->hl; ?>>
<?php endif; ?>
 
<form action="<?php echo $this->action; ?>" method="post">
<?php $ind = -1; ?>
<?php foreach ($this->DocumentManagementSystemVerw as $DocumentManagementSystemVerw): ?>

<table  cellpadding="4" cellspacing="0"  border="0" summary="DokManSystem">

<?php if ($intLauf <> 1) { ?>

<!--   ********** Zeile - Ueberschrift ********** -->
  <tr>
  	<td colspan="5" class="tabueb">Dokumentenverwaltung&nbsp;&nbsp;&nbsp;-&nbsp;&nbsp;&nbsp;Dokumente editieren (Eingabe)</td>
  </tr>
  
<!--   ********** Leerzeile ********** -->
  <tr>
  	<td colspan="5">&nbsp;</td>
  </tr>

	<!--   ********** Zeile - KapitelName ********** -->
	<tr>
		<td colspan="5" class="verw_tabueb2"><?php echo $DocumentManagementSystemVerw['kategoriename']; ?></td>
	</tr>

	<!--   ********** Zeile - KapitelBeschreibung ********** -->
	<tr>
		<td colspan="5" class="anz_katbes"><?php echo $DocumentManagementSystemVerw['kategoriebeschreibung']; ?></td>
	</tr>  
  
	<!--   ********** Leerzeile (versteckte Felder für Rechteweitergabe ********** -->  
  <tr>
    <td colspan="5"><input type="hidden" name="recht_loeschen" value="<?php echo $DocumentManagementSystemVerw['recht_loeschen'] ?>" />
  								  <input type="hidden" name="recht_veroeffentlichen" value="<?php echo $DocumentManagementSystemVerw['recht_veroeffentlichen'] ?>" />
  								  <input type="hidden" name="recht_editieren" value="<?php echo $DocumentManagementSystemVerw['recht_editieren'] ?>" />
  								  <input type="hidden" name="veroeffentlichen" value="<?php echo $DocumentManagementSystemVerw['arr_veroeffentlichen'] ?>" />
  								  <input type="hidden" name="editieren" value="<?php echo $DocumentManagementSystemVerw['arr_editieren'] ?>" />
                    <input type="hidden" name="kategorieid" value="<?php echo $DocumentManagementSystemVerw['kategorieid'] ?>" />
                    <input type="hidden" name="kategoriename" value="<?php echo $DocumentManagementSystemVerw['kategoriename'] ?>" />
                    <input type="hidden" name="kategoriebeschreibung" value="<?php echo $DocumentManagementSystemVerw['kategoriebeschreibung'] ?>" />
                    <input type="hidden" name="loeschen" value="<?php echo $DocumentManagementSystemVerw['arr_loeschen'] ?>" />
                    <input type="hidden" name="loeschlauf" value="<?php echo $DocumentManagementSystemVerw['loeschlauf'] ?>" />  
                    <input type="hidden" name="editierlauf" value="gelaufen" /> 
                    <input type="hidden" name="dokumente_editieren" value="j" />                                      
    </td>
  </tr>
  
 
  

<?php $intLauf = 1; } ?>


	<?php 
  
  	foreach ($DocumentManagementSystemVerw['dokdetails'] as $dokdetail) 
		{ $arrDokTeile = explode(".", $dokdetail['file_source']);
			$strDokTeil1 = $arrDokTeile[0];
			$strDokTeil2 = $arrDokTeile[1];
      $arrStichworte  = explode(",", html_entity_decode($dokdetail['dk_stichworte']));
      $ind = $ind + 1;
  ?>  
	<tr>
   
  <!-- Spalte 1-4 - DokumentName --> 
			<td class="dokname"><?php echo $dokdetail['name'].'&nbsp;&nbsp;&nbsp;V.&nbsp;'.$dokdetail['version_major'].'.'.$dokdetail['version_minor']?> </td>   
	</tr>
  
  	<tr>
  		<td colspan="5" class="fettgrau">Beschreibung</td>
  </tr>
    
  	<tr>
  		<td colspan="5"><textarea name="beschreibung[]" cols="100" rows="7"><?php echo $dokdetail['dk_beschreibung'] ?></textarea>
		</td>
  </tr>
  
  <tr>
  		<td colspan="5" class="fettgrau">Stichworte</td>
  </tr>
   
  <tr>  
  		<td><input type="text" name="dok_stichwort[<?php echo $ind ?>][]" size="18" value="<?php echo $arrStichworte[0] ?>"></td>
      <td><input type="text" name="dok_stichwort[<?php echo $ind ?>][]" size="18" value="<?php echo $arrStichworte[1] ?>"></td>
      <td><input type="text" name="dok_stichwort[<?php echo $ind ?>][]" size="18" value="<?php echo $arrStichworte[2] ?>"></td>
      <td><input type="text" name="dok_stichwort[<?php echo $ind ?>][]" size="18" value="<?php echo $arrStichworte[3] ?>"></td>
      <td><input type="text" name="dok_stichwort[<?php echo $ind ?>][]" size="18" value="<?php echo $arrStichworte[4] ?>"></td>		
  </tr> 
  
	<tr>
  	<td colspan="5">&nbsp;</td>
  </tr>   
	<tr>
  	<td colspan="5" class="anz_rahmen_oben">&nbsp;</td>
  </tr> 
	<?php  } ?>

<?php endforeach; ?>

<!-- Schaltflaeche -->   
  <tr>
    <td colspan="5"><input type="submit" name ="submit_verwaltung_auswahl" class="submit" value="Weiter --->" /></td>
  </tr>
  
</table>

</form>
</div>