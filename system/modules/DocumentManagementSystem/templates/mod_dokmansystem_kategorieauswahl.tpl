
<div class="mod_DokManSystem <?php echo $this->class; ?>"<?php echo $this->cssID; ?><?php if ($this->style): ?> style="<?php echo $this->style; ?>"<?php endif; ?>>
<?php if ($this->headline): ?>

<<?php echo $this->hl; ?>><?php echo $this->headline; ?></<?php echo $this->hl; ?>>
<?php endif; ?>
  
<form action="<?php echo $this->action; ?>" method="post">
<table border="0" cellpadding="4" cellspacing="0" summary="DokManSystem">
<thead>
	<tr>
		<th>Kategorie</th>
		<th>Dokument-Upload</th>
		<th>Dokument-Verwaltung</th>
	</tr>
</thead>
<tbody>
<?php $mrkAnzeige = 0; ?>

<?php foreach ($this->DocumentManagementSystemKat as $DocumentManagementSystemKat): ?> 
  <?php if ($DocumentManagementSystemKat['recht_mehralslesen'] == 1) { $mrkAnzeige = 1; ?>
  <tr class="category_<?php echo $DocumentManagementSystemKat['category']; ?>">	
    <!-- ***** Spalte KATEGORIENAME ***** -->
    <td class="first category_name"><?php echo $DocumentManagementSystemKat['einruecken'].$DocumentManagementSystemKat['kategoriename']; ?></td>
    <!-- ***** Spalte UPLOAD ***** -->
    <?php if ($DocumentManagementSystemKat['recht_upload'] == 1) { ?>
    <td class="category_access_right category_access_right_upload"><input type="radio" name="kategorieauswahl[]"  value="<?php echo $DocumentManagementSystemKat['kategorieid'].',u'.$DocumentManagementSystemKat['recht_editieren'].$DocumentManagementSystemKat['recht_loeschen'].$DocumentManagementSystemKat['recht_veroeffentlichen'].$DocumentManagementSystemKat['kategoriename']; ?>" /></td>
    <?php } else { ?>
    <td>&nbsp;</td>
    <?php } ?>
    <!-- ***** Spalte VERWALTEN ***** -->
    <?php if ($DocumentManagementSystemKat['recht_verwalten'] == 1) { ?>
    <td class="category_access_right category_access_right_manage"><input type="radio" name="kategorieauswahl[]"  value="<?php echo $DocumentManagementSystemKat['kategorieid'].',v'.$DocumentManagementSystemKat['recht_editieren'].$DocumentManagementSystemKat['recht_loeschen'].$DocumentManagementSystemKat['recht_veroeffentlichen'].$DocumentManagementSystemKat['kategoriename']; ?>" /></td>
    <?php } else { ?>
    <td>&nbsp;</td>
    <?php } ?>    
  </tr>
  <?php } ?>
<?php endforeach; ?>
</tbody>
 <tfoot>
  <?php if ($mrkAnzeige ==1) { ?>
  <tr>
  	<td colspan="3"><input type="submit" name ="submit_kategorieauswahl" class="submit" value="Auswahl best&auml;tigen" /></td>
  </tr>
  <?php }  else {?>
  <tr>
    <td colspan="3" class="no_right">Sie besitzen f&uuml;r das Dokumenten Management System keinerlei Verwaltungsrechte</td>
  </tr>
  <?php } ?>
 </tfoot>
</table>
</form>
</div>