
<div class="<?php echo $this->class; ?>"<?php echo $this->cssID; ?><?php if ($this->style): ?> style="<?php echo $this->style; ?>"<?php endif; ?>>
<?php if ($this->headline): ?>

<<?php echo $this->hl; ?>><?php echo $this->headline; ?></<?php echo $this->hl; ?>>
<?php endif; ?>


<form action="<?php echo $this->action; ?>" method="post">
<?php foreach ($this->DocumentManagementSystemUpVerarb as $DocumentManagementSystemUpVerarb): ?>
<?php
if ($DocumentManagementSystemUpVerarb['dateifehlermeldung'] == 1) { ?>
<table cellpadding="4" cellspacing="0" border="0">
  <tr>
  	<td colspan="6" class="tabueb">Dokumentupload&nbsp;&nbsp;&nbsp;-&nbsp;&nbsp;&nbsp;Verarbeiten</td>
  </tr>
  <tr>
  	<td colspan="6">&nbsp;</td>
  </tr>
  <tr>
    <td colspan="3" class="fett">die Version :</td>
    <td colspan="3" class="fettgruen"><?php echo $DocumentManagementSystemUpVerarb['dokversionmajor'].".".$DocumentManagementSystemUpVerarb['dokversionminir']; ?></td>
  </tr>
  <tr>
    <td colspan="3" class="fett">des Dokumentes :</td>
    <td colspan="3" class="fettgruen"><?php echo $DocumentManagementSystemUpVerarb['datei_name']; ?></td>
  </tr>
  <tr>
    <td colspan="6" class="fettrot">existiert bereits !</td>
  </tr>
  <tr>
  	<td colspan="6">&nbsp;</td>
  </tr>
  <tr>
  	<td colspan="6" class="fettrot">ein Upload ist daher nicht m&ouml;glich !</td>
  </tr>
  <tr>
  	<td colspan="6">&nbsp;</td>
  </tr>
  <tr>
    <td colspan="6"><input type="submit" name="submit_ende" value="Verarbeitung wurde abgebrochen"/></td>
  </tr>
</table>
<?php }
else { ?>
<table cellpadding="4" cellspacing="0" border="0" summary="DokManSystem"> 
  <tr>
  	<td colspan="6" class="tabueb">Dokumentupload&nbsp;&nbsp;&nbsp;-&nbsp;&nbsp;&nbsp;Verarbeiten</td>
  </tr>
  <tr>
  	<td colspan="6">&nbsp;</td>
  </tr>
  <tr>
  	<td colspan="3" class="fett">In die Kategorie :</td>
    <td colspan="3" class="katname"><?php echo $DocumentManagementSystemUpVerarb['kategoriename']; ?></td>
  </tr>
  <tr>
    <td colspan="6">ist folgendes Dokument aufgenommen worden :</td>
  </tr>
  <tr>
    <td colspan="3">Name :</td>
    <td colspan="3" class="dokname"><?php echo $DocumentManagementSystemUpVerarb['datei_name']; ?></td>
  </tr>
  <tr>
    <td colspan="3">Typ :</td>
    <td colspan="3" class="fettgruen"><?php echo $DocumentManagementSystemUpVerarb['datei_typ']; ?></td>
  </tr>
  <tr>
    <td colspan="3">Gr&ouml;&szlig;e :</td>
    <td colspan="3" class="fettgruen"><?php echo $DocumentManagementSystemUpVerarb['datei_groesse']; ?>&nbsp;Bytes</td>
  </tr>
  <tr>
  	<td colspan="6">&nbsp;</td>
  </tr>
  <tr>
    <td colspan="6" class="fettgrau">Das Dokument bestitzt folgende Eigenschaften : </td>
  </tr>
  <tr>
    <td colspan="3" class="fett">Name :</td>
    <td colspan="3" class="dokname"><?php echo $DocumentManagementSystemUpVerarb['dokname']; ?></td>
  </tr>
  <tr>
    <td colspan="3" class="fett">Beschreibung :</td>
    <td colspan="3" class="dokbes"><?php echo $DocumentManagementSystemUpVerarb['dokbeschreibung']; ?></td>
  </tr>
  <tr>
    <td colspan="3" class="fett">Version :</td>
    <td colspan="3" class="fettgruen"><?php echo $DocumentManagementSystemUpVerarb['dokversionmajor'].".".$DocumentManagementSystemUpVerarb['dokversionminir']; ?></td>
  </tr>
  <tr>
    <td colspan="3" class="fett">Stichworte :</td>
    <td colspan="3" class="fettgruen"><?php echo $DocumentManagementSystemUpVerarb['stichworte']; ?></td>
  </tr>
  <tr>
  	<td colspan="6">&nbsp;</td>
  </tr>
  <tr>
    <td colspan="6" class="fettgrau">Dem Dokument wurde folgendes Bild zugewiesen : </td>
  </tr>
  
  <?php switch ($DocumentManagementSystemUpVerarb['bildfehlermeldung']) {
  case 1: ?>
    <tr>
      <td colspan="6" class="fettrot">Das Bild wurde wegen unzul&auml;ssigem Bildtyps nicht verarbeitet !!!</td>
    </tr>
  <?php break; 
  case 2: ?>
    <tr>
      <td colspan="6" class="fettrot">Das Bild wurde wegen falscher Bildgr&ouml;&szlig;e nicht verarbeitet !!!</td>
    </tr>
  <?php break;
  default: 
    if ($DocumentManagementSystemUpVerarb['bildname'] == "") { ?>
      <tr>
        <td colspan="6">Es wurde keine Bilddatei angegeben.</td>
      </tr> 
    <?php } 
    else { ?>       
       <tr>
         <td colspan="3" class="fett">Bildname :</td>
         <td colspan="3" class="bildname"><?php echo $DocumentManagementSystemUpVerarb['bildname']; ?></td>
       </tr>
       <tr>
         <td colspan="3" class="fett">Bildgr&ouml;&szlig;e :</td>
         <td colspan="3" class="fettbraun"><?php echo $DocumentManagementSystemUpVerarb['bildgroesse']; ?>&nbsp;Bytes</td>
       </tr>
    <?php }
   } ?>

  <tr>
  	<td colspan="6">&nbsp;</td>
  </tr>
  
<?php if ($DocumentManagementSystemUpVerarb['dokveroeffentlichen'] == 1) { ?>
  <tr>
    <td colspan="6" class="dokname">Das Dokument wurde ver&ouml;ffentlicht</td>
  </tr>
  <?php } else { ?>
  <tr>
    <td colspan="6" class="fettrot">Das Dokument wurde noch nicht ver&ouml;ffentlicht !!!</td>
  </tr> 
  <?php } ?> 

  <tr>
  	<td colspan="6">&nbsp;</td>
  </tr>
  <tr>
    <td colspan="6"><input type="submit" name="submit_ende" value="Verarbeitung ist abgeschlossen"/></td>
  </tr>
</table>
<?php } ?>

<?php endforeach; ?>
</form>
</div>