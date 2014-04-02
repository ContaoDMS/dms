<div class="mod_dms <?php echo $this->class; ?>"<?php echo $this->cssID; ?><?php if ($this->style): ?> style="<?php echo $this->style; ?>"<?php endif; ?>>
<?php if ($this->headline): ?>

<<?php echo $this->hl; ?>><?php echo $this->headline; ?></<?php echo $this->hl; ?>>
<?php endif; ?>

<form action="<?php echo $this->action; ?>" method="POST" enctype="multipart/form-data" id="management" name="management">
	<input type="hidden" name="FORM_SUBMIT" value="<?php echo $this->formId; ?>">
	<input type="hidden" name="REQUEST_TOKEN" value="{{request_token}}">
	<input type="hidden" name="uploadCategory" value="<?php echo $this->category->id; ?>">
	<input type="hidden" name="tempFileName" value="<?php echo $this->tempFileName; ?>">
	<input type="hidden" name="fileName" value="<?php echo $this->fileName; ?>">
	<input type="hidden" name="fileType" value="<?php echo $this->fileType; ?>">
	<input type="hidden" name="fileSize" value="<?php echo $this->fileSize; ?>">
	
	<!-- Errors -->
	<div id="dms_errors"<?php if (count($this->messages['errors']) == 0) : ?> style="display: none;"<?php endif; ?>>
		<?php foreach ($this->messages['errors'] as $error): ?>
		<div class="error"><?php echo $error; ?></div>
		<?php endforeach; ?>
		<div class="error" id="name_error" style="display: none;"></div>
		<div class="error" id="version_error" style="display: none;"></div>
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
				<th colspan="2" class="headline"><?php echo sprintf($GLOBALS['TL_LANG']['DMS']['management_headline'], $GLOBALS['TL_LANG']['DMS']['management_upload_headline'], $GLOBALS['TL_LANG']['DMS']['management_upload_properties_headline']); ?></th>
			</tr>
		</thead>
		<tbody>
			<tr>
				<td class="label"><?php echo $GLOBALS['TL_LANG']['DMS']['management_upload_properties_category']; ?></td>
				<td>
					<?php echo $this->category->name; ?>
					<?php $arrPathNames = $this->category->getPathNames(true); ?>
					<?php if (count($arrPathNames) > 0): ?>
						(<?php echo implode($GLOBALS['TL_LANG']['DMS']['management_path_separator'], $this->category->getPathNames(true)); ?>)
					<?php endif; ?>
				</td>
			</tr>
			<tr class="subheadline">
				<td class="label" colspan="2"><?php echo $GLOBALS['TL_LANG']['DMS']['management_upload_properties_file_headline']; ?></td>
			</tr>
			<tr>
				<td class="label"><?php echo $GLOBALS['TL_LANG']['DMS']['management_upload_properties_file_name']; ?></td>
				<td><?php echo $this->fileName; ?></td>
			</tr>
			<tr>
				<td class="label"><?php echo $GLOBALS['TL_LANG']['DMS']['management_upload_properties_file_type']; ?></td>
				<td><?php echo $this->fileType; ?></td>
			</tr>
			<tr>
				<td class="label"><?php echo $GLOBALS['TL_LANG']['DMS']['management_upload_properties_file_size']; ?></td>
				<td><?php echo $this->fileSizeMbFormatted; ?></td>
			</tr>
	<?php if (count($this->existingDocuments) > 0) : ?>
			<tr class="subheadline">
				<td class="label" colspan="2"><?php echo $GLOBALS['TL_LANG']['DMS']['management_upload_properties_existing_headline']; ?></td>
			</tr>
		<?php foreach ($this->existingDocuments as $document) : ?>
			<tr>
				<td class="label"><?php echo $GLOBALS['TL_LANG']['DMS']['management_upload_properties_existing_name']; ?></td>
				<td>
					<?php
						$title = sprintf($GLOBALS['TL_LANG']['DMS']['management_upload_properties_existing_size'], $document->getFileSize(Document::FILE_SIZE_UNIT_MB, true));
						if (strlen($document->getUploadDate() > 0) && $document->hasUploadMemberName())
						{
							$title .= "\n" . sprintf($GLOBALS['TL_LANG']['DMS']['management_upload_properties_existing_uploaded'], $document->getUploadDate(), $document->uploadMemberName);
						}
						if (strlen($document->getLasteditDate() > 0) && $document->hasLasteditMemberName())
						{
							$title .= "\n" . sprintf($GLOBALS['TL_LANG']['DMS']['management_upload_properties_existing_lastedited'], $document->getLasteditDate(), $document->lasteditMemberName);
						}
						$arrPathNames = $document->category->getPathNames(true);
						$categoryPath = "";
						if (count($arrPathNames) > 0)
						{
							$categoryPath = "(" . implode($GLOBALS['TL_LANG']['DMS']['management_path_separator'], $this->category->getPathNames(true)) . ")";
						}
						$title .= "\n" . sprintf($GLOBALS['TL_LANG']['DMS']['management_upload_properties_existing_category'], $document->category->name, $categoryPath);
					?> 
					<span class="existingDocument <?php if ($document->isPublished()) : ?>published<?php else: ?>unpublished<?php endif; ?>">
						<?php echo $document->name; ?> <?php echo sprintf($GLOBALS['TL_LANG']['DMS']['management_upload_properties_existing_version'], $document->getVersion()); ?> 
						 - <?php if ($document->isPublished()) : ?><?php echo $GLOBALS['TL_LANG']['DMS']['management_upload_properties_existing_published']; ?><?php else: ?><?php echo $GLOBALS['TL_LANG']['DMS']['management_upload_properties_existing_unpublished']; ?><?php endif; ?>
						<span class="explanation" title="<?php echo $title; ?>"><?php echo $GLOBALS['TL_LANG']['DMS']['management_explanation']; ?></span>
					</span>
				</td>
			</tr>
		<?php endforeach; ?>
	<?php endif; ?>
			<tr class="subheadline">
				<td class="label" colspan="2"><?php echo $GLOBALS['TL_LANG']['DMS']['management_upload_properties_document_headline']; ?></td>
			</tr>
			<tr>
				<td class="label"><?php echo $GLOBALS['TL_LANG']['DMS']['management_upload_properties_document_name']; ?><span class="mandatory" title="<?php echo $GLOBALS['TL_LANG']['DMS']['management_mandatory']; ?>">*</span><span class="explanation" title="<?php echo $GLOBALS['TL_LANG']['DMS']['management_upload_properties_document_name_explanation']; ?>"><?php echo $GLOBALS['TL_LANG']['DMS']['management_explanation']; ?></span></td>
				<td><input type="text" id="documentName" name="documentName" maxlength="255" value="<?php echo $this->documentName; ?>" /></td>
			</tr>
			<tr>
				<td class="label"><?php echo $GLOBALS['TL_LANG']['DMS']['management_upload_properties_document_description']; ?></td>
				<td><textarea id="documentDescription" name="documentDescription" cols="50" rows="5"><?php echo $this->documentDescription; ?></textarea></td>
			</tr>
			<tr>
				<td class="label"><?php echo $GLOBALS['TL_LANG']['DMS']['management_upload_properties_document_keywords']; ?><span class="explanation" title="<?php echo $GLOBALS['TL_LANG']['DMS']['management_upload_properties_document_keywords_explanation']; ?>"><?php echo $GLOBALS['TL_LANG']['DMS']['management_explanation']; ?></span></td>
				<td><input type="text" id="documentKeywords" name="documentKeywords" maxlength="255" value="<?php echo $this->documentKeywords; ?>" /></td>
			</tr>
			<tr>
				<td class="label"><?php echo $GLOBALS['TL_LANG']['DMS']['management_upload_properties_document_version']; ?><span class="mandatory" title="<?php echo $GLOBALS['TL_LANG']['DMS']['management_mandatory']; ?>">*</span><span class="explanation" title="<?php echo $GLOBALS['TL_LANG']['DMS']['management_upload_properties_document_version_explanation']; ?>"><?php echo $GLOBALS['TL_LANG']['DMS']['management_explanation']; ?></span></td>
				<td>
					<input type="text" id="documentVersionMajor" name="documentVersionMajor" maxlength="3" size="3" value="<?php echo $this->documentVersionMajor; ?>" />
					.
					<input type="text" id="documentVersionMinor" name="documentVersionMinor" maxlength="3" size="3" value="<?php echo $this->documentVersionMinor; ?>" />
					.
					<input type="text" id="documentVersionPatch" name="documentVersionPatch" maxlength="3" size="3" value="<?php echo $this->documentVersionPatch; ?>" />
				</td>
			</tr>
			<tr>
				<td class="label"><?php echo $GLOBALS['TL_LANG']['DMS']['management_upload_properties_document_publish']; ?><span class="explanation" title="<?php echo $GLOBALS['TL_LANG']['DMS']['management_upload_properties_document_publish_explanation']; ?>"><?php echo $GLOBALS['TL_LANG']['DMS']['management_explanation']; ?></span></td>
			<?php if ($this->category->isPublishableForCurrentMember()) : ?>
				<td><input type="checkbox" id="documentPublish" name="documentPublish" value="true"<?php if ($this->documentPublish) : ?> checked="checked"<?php endif; ?> /></td>
			<?php else : ?>
				<td>
					<div class="not_allowed"><?php echo $GLOBALS['TL_LANG']['DMS']['management_upload_properties_document_publish_not_allowed']; ?></div>
					<input type="hidden" name="documentPublish" value="<?php echo $this->documentPublish; ?>"/>
				</td>
			<?php endif; ?>
			</tr>
		</tbody>
		<tfoot>
			<tr>
				<td colspan="2">
					<button type="submit" name="abort" value="true"><?php echo $GLOBALS['TL_LANG']['DMS']['management_button_abort']; ?></button>
					<button type="submit" name="storeProperties" value="true"><?php echo $GLOBALS['TL_LANG']['DMS']['management_button_store_properties']; ?></button>
				</td>
			</tr>
		</tfoot>
	</table>
</form>

<script type="text/javascript">
<!--
	function checkMandatoryFields()
	{
		var alreadyFocused = false;
		var send = false;
		if (document.getElementById("documentName").value != null &&document.getElementById("documentName").value.length > 0)
		{
			send = true;
			document.getElementById("name_error").style.display = "none";
		}
		else
		{
			document.getElementById("name_error").innerHTML = "<?php echo $GLOBALS['TL_LANG']['DMS']['ERR']['upload_no_name_set']; ?>";
			document.getElementById("name_error").style.display = "block";
			document.getElementById("dms_errors").style.display = "block";
			if (!alreadyFocused)
			{
				document.getElementById("documentName").focus();
				alreadyFocused = true;
			}
			send = false;
		}
		if (document.getElementById("documentVersionMajor").value != null &&document.getElementById("documentVersionMajor").value.length > 0 && !isNaN(document.getElementById("documentVersionMajor").value) && 
			document.getElementById("documentVersionMinor").value != null &&document.getElementById("documentVersionMinor").value.length > 0 && !isNaN(document.getElementById("documentVersionMinor").value) && 
			document.getElementById("documentVersionPatch").value != null &&document.getElementById("documentVersionPatch").value.length > 0 && !isNaN(document.getElementById("documentVersionPatch").value))
		{
			send = send && true;
			document.getElementById("version_error").style.display = "none";
		}
		else
		{
			document.getElementById("version_error").innerHTML = "<?php echo $GLOBALS['TL_LANG']['DMS']['ERR']['upload_no_version_set']; ?>";
			document.getElementById("version_error").style.display = "block";
			document.getElementById("dms_errors").style.display = "block";
			if (!alreadyFocused)
			{
				document.getElementById("documentVersionMajor").focus();
				alreadyFocused = true;
			}
			send = send && false;
		}
		return send;
	}
-->
</script>

</div>