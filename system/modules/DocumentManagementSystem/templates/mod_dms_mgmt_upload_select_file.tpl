<!-- indexer::stop -->
<div class="mod_dms <?php echo $this->class; ?>"<?php echo $this->cssID; ?><?php if ($this->style): ?> style="<?php echo $this->style; ?>"<?php endif; ?>>
<?php if ($this->headline): ?>

<<?php echo $this->hl; ?>><?php echo $this->headline; ?></<?php echo $this->hl; ?>>
<?php endif; ?>

<form action="<?php echo $this->action; ?>" method="POST" enctype="multipart/form-data" id="management" name="management">
	<input type="hidden" name="FORM_SUBMIT" value="<?php echo $this->formId; ?>">
	<input type="hidden" name="REQUEST_TOKEN" value="{{request_token}}">
	<input type="hidden" name="MAX_FILE_SIZE" value="<?php echo $this->maxUploadFileSizeByte; ?>" />
	<input type="hidden" name="uploadCategory" value="<?php echo $this->category->id; ?>">
	
	<!-- Errors -->
	<div id="dms_errors"<?php if (count($this->messages['errors']) == 0) : ?> style="display: none;"<?php endif; ?>>
		<?php foreach ($this->messages['errors'] as $error): ?>
		<div class="error"><?php echo $error; ?></div>
		<?php endforeach; ?>
		<div class="error" id="file_error" style="display: none;"></div>
	</div>
	
	<?php if (count($this->messages['warnings']) > 0): ?>
	<!-- Warnings -->
	<div id="dms_warnings">
		<?php foreach ($this->messages['warnings'] as $warning): ?>
		<div class="warning"><?php echo $warning; ?></div>
		<?php endforeach; ?>
	</div>
	<?php endif; ?>
	
	<?php if (count($this->messages['successes']) > 0): ?>
	<!-- Successes -->
	<div id="dms_successes">
		<?php foreach ($this->messages['successes'] as $success): ?>
		<div class="success"><?php echo $success; ?></div>
		<?php endforeach; ?>
	</div>
	<?php endif; ?>
	
	<?php if (count($this->messages['infos']) > 0): ?>
	<!-- Infos -->
	<div id="dms_infos">
		<?php foreach ($this->messages['infos'] as $info): ?>
		<div class="info"><?php echo $info; ?></div>
		<?php endforeach; ?>
	</div>
	<?php endif; ?>
	
	<table cellpadding="0" cellspacing="0" border="0">
		<thead>
			<tr>
				<th colspan="2" class="headline"><?php echo sprintf($GLOBALS['TL_LANG']['DMS']['management_headline'], $GLOBALS['TL_LANG']['DMS']['management_upload_headline'], $GLOBALS['TL_LANG']['DMS']['management_upload_select_headline']); ?></th>
			</tr>
		</thead>
		<tbody>
			<tr>
				<td class="label"><?php echo $GLOBALS['TL_LANG']['DMS']['management_upload_select_category']; ?></td>
				<td>
					<?php echo $this->category->name; ?>
					<?php $arrPathNames = $this->category->getPathNames(true); ?>
					<?php if (count($arrPathNames) > 0): ?>
						(<?php echo implode($GLOBALS['TL_LANG']['DMS']['management_path_separator'], $arrPathNames); ?>)
					<?php endif; ?>
				</td>
			</tr>
			<tr>
				<td class="label"><?php echo $GLOBALS['TL_LANG']['DMS']['management_upload_select_filetypes']; ?></td>
				<td><?php echo implode(", ", $this->category->getAllowedFileTypes()); ?></td>
			</tr>
			<tr>
				<td class="label"><?php echo $GLOBALS['TL_LANG']['DMS']['management_upload_select_max_size']; ?></td>
				<td><?php echo $this->maxUploadFileSizeMbFormatted; ?></td>
			</tr>
			<tr>
				<td class="label"><?php echo $GLOBALS['TL_LANG']['DMS']['management_upload_select_file_select']; ?><span class="mandatory" title="<?php echo $GLOBALS['TL_LANG']['DMS']['management_mandatory']; ?>">*</span></td>
				<td>
					<input type="file" name="dmsFile" id="dmsFile"/>
				</td>
			</tr>
		</tbody>
		<tfoot>
			<tr>
				<td colspan="2">
					<button type="submit" name="abort" value="true"><?php echo $GLOBALS['TL_LANG']['DMS']['management_button_abort']; ?></button>
					<button onClick="return checkFile();" type="submit" name="doUpload" value="true"><?php echo $GLOBALS['TL_LANG']['DMS']['management_button_upload']; ?></button>
				</td>
			</tr>
		<tfoot>
	</table>

</form>

<script type="text/javascript">
<!--
	function checkFile()
	{
		if (document.getElementById("dmsFile").value != null && document.getElementById("dmsFile").value.length > 0)
		{
		  return true;
		}
		else
		{
			document.getElementById("file_error").innerHTML = "<?php echo $GLOBALS['TL_LANG']['DMS']['ERR']['upload_no_file_selected']; ?>";
			document.getElementById("file_error").style.display = "block";
			document.getElementById("dms_errors").style.display = "block";
			document.getElementById("dmsFile").focus();
			return false;
		}
	}
-->
</script>

</div>
<!-- indexer::continue --> 