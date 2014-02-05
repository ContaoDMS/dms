
<div class="mod_DokManSystem <?php echo $this->class; ?>"<?php echo $this->cssID; ?><?php if ($this->style): ?> style="<?php echo $this->style; ?>"<?php endif; ?>>
<?php if ($this->headline): ?>

<<?php echo $this->hl; ?>><?php echo $this->headline; ?></<?php echo $this->hl; ?>>
<?php endif; ?>


<form action="<?php echo $this->action; ?>" method="post" enctype="multipart/form-data">
<?php foreach ($this->DocumentManagementSystemUpEig as $DocumentManagementSystemUpEig): ?>
<?php
if ($DocumentManagementSystemUpEig['upload_erlaubt'] == 0)
{ ?>
<table cellpadding="4" cellspacing="0" border="0">
  <tr>
  	<td colspan="6" class="tabueb">Dokumentupload&nbsp;&nbsp;&nbsp;-&nbsp;&nbsp;&nbsp;Eigenschaften</td>
  </tr>
  <tr>
  	<td colspan="6">&nbsp;</td>
  </tr>
  <tr>
    <td colspan="3" class="fett">In der Kategorie : </td>
    <td colspan="3" class="katname"><?php echo $DocumentManagementSystemUpEig['kategoriename']; ?></td>
  </tr>
  <tr>
    <td colspan="6" class="fettrot">ist ein Upload des Typs ==> <?php echo $DocumentManagementSystemUpEig['datei_typ']; ?>  <== nicht gestattet !</td>
  </tr>
  <tr>
    <td colspan="6">&nbsp;</td>
  </tr>
  <tr>
    <td colspan="3">Zul&auml;ssig sind nur die Dateitypen :</td>
    <td colspan="3" class="fett"><?php echo $DocumentManagementSystemUpEig['dateitypen']; ?></td>
  </tr>
  <tr>
    <td colspan="6">&nbsp;</td>
  </tr>
  <tfoot>
	<tr>
		<td colspan="6"><input type="submit" name="submit_ende" value="Verarbeitung wurde abgebrochen"/></td>
	</tr>
  </tfoot>
</table>
<?php }
else
{ ?>
<table cellpadding="4" cellspacing="0" border="0" summary="DokManSystem"> 
  <tr>
  	<td colspan="6" class="tabueb">Dokumentupload&nbsp;&nbsp;&nbsp;-&nbsp;&nbsp;&nbsp;Eigenschaften</td>
  </tr>
  <tr>
  	<td colspan="6">&nbsp;</td>
  </tr>
  <tr>
    <td colspan="3" class="fett">In die Kategorie :</td>
    <td colspan="3" class="katname"><?php echo $DocumentManagementSystemUpEig['kategoriename']; ?></td>
  </tr>
  <tr>
    <td colspan="6">soll folgendes Dokument geladen werden :</td>
  </tr>  
  <tr>
    <td colspan="3">Name :</td>
    <td colspan="3" class="dokname"><?php echo $DocumentManagementSystemUpEig['datei_name']; ?></td>
  </tr>
  <tr>
    <td colspan="3">Typ :</td>
    <td colspan="3"><?php echo $DocumentManagementSystemUpEig['datei_typ']; ?></td>
  </tr>
  <tr>
    <td colspan="3">Gr&ouml;&szlig;e :</td>
    <td colspan="3"><?php echo $DocumentManagementSystemUpEig['datei_groesse']; ?>&nbsp;Bytes</td>
  </tr>
    
  <?php
  if ($DocumentManagementSystemUpEig['versionvorhanden'] == 1)
  { ?>
  <tr>
  	<td colspan="6">Das Dokument existiert bereits in folgenden Versionen :</td>
  </tr> 
 
  <?php foreach ($DocumentManagementSystemUpEig['rows'] as $row) { ?>
  <tr>
    <td colspan="2">Version :&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?php echo $row['version_major'].".".$row['version_minor']; ?></td>
  	<td colspan="2">&nbsp;&nbsp;Ver&ouml;ffentlichung :</td>
    <td colspan="2"><input type="checkbox" name="altdok_veroeffentlichen[]" value="<?php echo $row['id'] ?>"<?php if ($row['published'] == 1) {?> checked <?php } ?> <?php if ($DocumentManagementSystemUpEig['recht_veroeffentlichen'] == 0) { ?> disabled <?php } ?>/> </td>
  </tr> 
  <?php } ?> 
  <tr>
  	<td colspan="6">&nbsp;</td>
  </tr>  
  <?php } ?>
  
  <tr>
  	<td colspan="6">Bitte vervollst&auml;ndigen Sie die Eigenschaften des Dokumentes</td>
  </tr> 
  <tr>
    <td colspan="3" class="fett">Name des Dokumentes <span class="mandatory">*</span> : <br/><div class="additionalinfo">Pflichtfeld, bitte achten Sie auf korrekte<br/>Schreibweise und Namensvergabe.<br/>Nachträgliche Änderungen sind nicht möglich.</div></td>
    <td colspan="3"><input type="text" id="dok_name" name="dok_name" maxlength="64" size="40" value="<?php echo $DocumentManagementSystemUpEig['dokname']; ?>" <?php if ($DocumentManagementSystemUpEig['dokname'] != "") { ?> readonly <?php } ?> /></td>
  </tr>
  <tr>
    <td colspan="3" class="fett">Beschreibung des Dokumentes :</td>
    <td colspan="3"><textarea name="dok_beschreibung" cols="50" rows="5"><?php echo $DocumentManagementSystemUpEig['dokbeschreibung']; ?></textarea></td>
  </tr>
  <tr>
    <td colspan="3" class="fett">Stichworte f&uuml;r das Dokument : </td>
    <td colspan="3"><input type="text" name="dok_stichwort[]" maxlength="20" size="38" value="<?php echo $DocumentManagementSystemUpEig['stichworte'][0]; ?>"/>&nbsp;&nbsp;&nbsp;(nur 1 Wort)</td>
  </tr>
  <tr>
    <td colspan="3">&nbsp;</td>
    <td colspan="3"><input type="text" name="dok_stichwort[]" maxlength="20" size="38" value="<?php echo $DocumentManagementSystemUpEig['stichworte'][1]; ?>"/>&nbsp;&nbsp;&nbsp;(nur 1 Wort)</td>
  </tr>
  <tr>
    <td colspan="3">&nbsp;</td>
    <td colspan="3"><input type="text" name="dok_stichwort[]" maxlength="20" size="38" value="<?php echo $DocumentManagementSystemUpEig['stichworte'][2]; ?>"/>&nbsp;&nbsp;&nbsp;(nur 1 Wort)</td>
  </tr>
  <tr>
    <td colspan="3">&nbsp;</td>
    <td colspan="3"><input type="text" name="dok_stichwort[]" maxlength="20" size="38" value="<?php echo $DocumentManagementSystemUpEig['stichworte'][3]; ?>"/>&nbsp;&nbsp;&nbsp;(nur 1 Wort)</td>
  </tr>
  <tr>
    <td colspan="3">&nbsp;</td>
    <td colspan="3"><input type="text" name="dok_stichwort[]" maxlength="20" size="38" value="<?php echo $DocumentManagementSystemUpEig['stichworte'][4]; ?>"/>&nbsp;&nbsp;&nbsp;(nur 1 Wort)</td>
  </tr>
  <!--tr>
    <td colspan="3" class="fett">Bild des Dokumentes : (jpg/gif/png)</td>
    <td colspan="3"><input type="file" name="dok_bild" />&nbsp;&nbsp;&nbsp;(max 100 KB)</td>
  </tr-->
  <tr>
    <td colspan="3" class="fett">Version des Dokumentes :</td>
    <td colspan="3"><input type="text" name="dok_version_major" maxlength="2" size="2" value="<?php echo $DocumentManagementSystemUpEig['version_major']; ?>"/> .
                    <input type="text" name="dok_version_minir" maxlength="2" size="2" value="<?php echo $DocumentManagementSystemUpEig['version_minir']; ?>"/>&nbsp;&nbsp;&nbsp;(Vorschlag)</td>
  </tr>
  <?php
  if ($DocumentManagementSystemUpEig['recht_veroeffentlichen'] == 1) { ?>
  <tr>
    <td colspan="3" class="fett">Dokument ver&ouml;ffentlichen :</td>
    <td colspan="3"><input type="checkbox" name="dok_veroeffentlichen" value="1" checked="checked"/></td>
  </tr>
  <?php }
  else { ?>
  <tr>
  	<td colspan="6">Sie d&uuml;rfen das Dokument nicht ver&ouml;ffentlichen !<input type="hidden" name="dok_veroeffentlichen" value ="0"/></td>
  </tr>
  <?php } ?>      
  <tfoot>
  <tr>
    <td colspan="6" class="anz_rahmen_oben">
		<input onClick="return checkDokName();" type="submit" name="submit_upload_eigenschaften" value="Eigenschaften best&auml;tigen"/>
		<input type="submit" name="submit_abbrechen" value="Abbrechen"/>
	</td>
  </tr>     
  </tfoot>
</table>

<table>
  <tr>
    <td><input type="hidden" name="kategorieid" value="<?php echo $DocumentManagementSystemUpEig['kategorieid']; ?>" /></td>
    <td><input type="hidden" name="kategoriename" value="<?php echo $DocumentManagementSystemUpEig['kategoriename']; ?>" /></td>
    <td><input type="hidden" name="datei_name" value="<?php echo $DocumentManagementSystemUpEig['datei_name']; ?>" /></td>
    <td><input type="hidden" name="datei_typ" value="<?php echo $DocumentManagementSystemUpEig['datei_typ']; ?>" /></td>
    <td><input type="hidden" name="datei_groesse" value="<?php echo $DocumentManagementSystemUpEig['datei_groesse']; ?>" /></td>
  </tr>
</table>
<?php } ?>
    <?php endforeach; ?>
</form>
</div>
<script type="text/javascript">
<!--
  function checkDokName() {
    if (document.getElementById("dok_name").value != null && document.getElementById("dok_name").value.length > 0) {
      return true;
    } else {
    	alert("Der Name des Dokumentes ist ein Pflichtfeld. Bitte füllen Sie es aus!");
    	document.getElementById("dok_name").style.background = "#ff0000";
    	document.getElementById("dok_name").style.color = "#ffffff";
    	document.getElementById("dok_name").focus();
    	return false;
    }
  }

-->
</script>