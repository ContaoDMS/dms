<div class="mod_dms <?php echo $this->class; ?>"<?php echo $this->cssID; ?><?php if ($this->style): ?> style="<?php echo $this->style; ?>"<?php endif; ?>>
<?php if ($this->headline): ?>

<<?php echo $this->hl; ?>><?php echo $this->headline; ?></<?php echo $this->hl; ?>>
<?php endif; ?>

<form action="<?php echo $this->action; ?>" method="POST" enctype="multipart/form-data" id="management" name="management">
	<input type="hidden" name="FORM_SUBMIT" value="<?php echo $this->formId; ?>">
	<input type="hidden" name="REQUEST_TOKEN" value="{{request_token}}">
	<input type="hidden" name="manageCategory" value="<?php echo $this->category->id; ?>">
	
	<?php if (count($this->messages['errors']) > 0): ?>
	<!-- Errors -->
	<div id="dms_errors">
		<?php foreach ($this->messages['errors'] as $error): ?>
		<div class="error"><?php echo $error; ?></div>
		<?php endforeach; ?>
	</div>
	<?php endif; ?>
		
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
				<th colspan="4" class="headline"><?php echo sprintf($GLOBALS['TL_LANG']['DMS']['management_headline'], $GLOBALS['TL_LANG']['DMS']['management_manage_headline'], $GLOBALS['TL_LANG']['DMS']['management_manage_select_headline']); ?></th>
			</tr>
		</thead>
		<tbody>
			<tr>
				<td colspan="4">
					<span class="label"><?php echo $GLOBALS['TL_LANG']['DMS']['management_manage_select_category']; ?></span>
					<?php echo $this->category->name; ?>
					<?php $arrPathNames = $this->category->getPathNames(true); ?>
					<?php if (count($arrPathNames) > 0): ?>
						(<?php echo implode($GLOBALS['TL_LANG']['DMS']['management_path_separator'], $this->category->getPathNames(true)); ?>)
					<?php endif; ?>
				</td>
			</tr>
			<tr class="subheadline">
				<td class="label" colspan="4"><?php echo $GLOBALS['TL_LANG']['DMS']['management_manage_select_document_headline']; ?></td>
			</tr>
		<?php foreach ($this->category->documents as $document) : ?>
			<tr>
				<td>
					<?php
						$title = sprintf($GLOBALS['TL_LANG']['DMS']['management_manage_select_document_size'], $document->getFileSize(Document::FILE_SIZE_UNIT_MB, true));
						if (strlen($document->getUploadDate() > 0) && $document->hasUploadMemberName())
						{
							$title .= "\n" . sprintf($GLOBALS['TL_LANG']['DMS']['management_manage_select_document_uploaded'], $document->getUploadDate(), $document->uploadMemberName);
						}
						if (strlen($document->getLasteditDate() > 0) && $document->hasLasteditMemberName())
						{
							$title .= "\n" . sprintf($GLOBALS['TL_LANG']['DMS']['management_manage_select_document_lastedited'], $document->getLasteditDate(), $document->lasteditMemberName);
						}
					?>
					<span class="existingDocument <?php if ($document->isPublished()) : ?>published<?php else: ?>unpublished<?php endif; ?>">
						<?php echo $document->name; ?> <?php echo sprintf($GLOBALS['TL_LANG']['DMS']['management_manage_select_document_version'], $document->getVersion()); ?>
						<span class="explanation" title="<?php echo $title; ?>"><?php echo $GLOBALS['TL_LANG']['DMS']['management_explanation']; ?></span>
					</span>
				</td>
				<td class="document_edit centered button">
			<?php if ($this->category->isEditableForCurrentMember()) : ?>
					<button type="submit" name="editDocument" value="<?php echo $document->id; ?>"><?php echo $GLOBALS['TL_LANG']['DMS']['management_button_edit']; ?></button>
			<?php else : ?>
					&nbsp;
			<?php endif; ?>
				</td>
				<td class="document_delete centered button">
			<?php if ($this->category->isDeletableForCurrentMember()) : ?>
					<button type="submit" name="deleteDocument" value="<?php echo $document->id; ?>"><?php echo $GLOBALS['TL_LANG']['DMS']['management_button_delete']; ?></button>
			<?php else : ?>
					&nbsp;
			<?php endif; ?>
				</td>
				<td class="document_publish centered button">
			<?php if ($this->category->isPublishableForCurrentMember()) : ?>
				<?php if ($document->isPublished()) : ?>
					<button type="submit" name="unpublishDocument" value="<?php echo $document->id; ?>"><?php echo $GLOBALS['TL_LANG']['DMS']['management_button_unpublish']; ?></button>
				<?php else : ?>
					<button type="submit" name="publishDocument" value="<?php echo $document->id; ?>"><?php echo $GLOBALS['TL_LANG']['DMS']['management_button_publish']; ?></button>
				<?php endif; ?>
			<?php else : ?>
					&nbsp;
			<?php endif; ?>
				</td>
			</tr>
		<?php endforeach; ?>
		</tbody>
		<tfoot>
			<tr>
				<td colspan="4">
					<button type="submit" name="abort" value="true"><?php echo $GLOBALS['TL_LANG']['DMS']['management_button_back']; ?></button>
				</td>
			</tr>
		</tfoot>
	</table>
</form>

</div>