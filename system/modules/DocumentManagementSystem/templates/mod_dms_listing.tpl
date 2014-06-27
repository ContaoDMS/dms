<div class="mod_dms <?php echo $this->class; ?>"<?php echo $this->cssID; ?><?php if ($this->style): ?> style="<?php echo $this->style; ?>"<?php endif; ?>>
<?php if ($this->headline): ?>

<<?php echo $this->hl; ?>><?php echo $this->headline; ?></<?php echo $this->hl; ?>>
<?php endif; ?>

<form action="<?php echo $this->action; ?>" method="post" id="listing" name="listing">
	<input type="hidden" name="FORM_SUBMIT" value="<?php echo $this->formId; ?>">
	<input type="hidden" name="REQUEST_TOKEN" value="{{request_token}}">
	<input type="hidden" name="docId" id="docId" value="">
	
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
	
	<!-- Search -->
	<div id="list_search">
		<div id="list_search_params">
			<select name="searchType" id="searchType">
				<option value="<?php echo DmsLoaderParams::DOCUMENT_SEARCH_EXACT; ?>"<?php if ($this->searchType == DmsLoaderParams::DOCUMENT_SEARCH_EXACT): ?> selected="selected"<?php endif; ?>><?php echo $GLOBALS['TL_LANG']['DMS']['listing_search_type_exact']; ?></option>
				<option value="<?php echo DmsLoaderParams::DOCUMENT_SEARCH_LIKE; ?>"<?php if ($this->searchType == DmsLoaderParams::DOCUMENT_SEARCH_LIKE): ?> selected="selected"<?php endif; ?>><?php echo $GLOBALS['TL_LANG']['DMS']['listing_search_type_like']; ?></option>
			</select>
			<input type="text" name="searchText" id="searchText" placeholder="<?php echo $GLOBALS['TL_LANG']['DMS']['listing_search_placeholder']; ?>" value="<?php if ($this->searchText != "") : ?><?php echo $this->searchText; ?><?php endif; ?>" />
		</div>
		<div id="list_search_buttons">
			<button type="button" id="button-reset" onclick="resetSearch();"><?php echo $GLOBALS['TL_LANG']['DMS']['listing_reset_button']; ?></button>
			<button type="button" id="button-search" onclick="search();"><?php echo $GLOBALS['TL_LANG']['DMS']['listing_search_button']; ?></button>
		</div>
	</div>
	
	<!-- Table of categories -->
	<table cellpadding="0" cellspacing="0" border="0">
		<thead>
			<tr>
				<th><?php echo $GLOBALS['TL_LANG']['DMS']['listing_thead_category']; ?></th>
				<th><?php echo $GLOBALS['TL_LANG']['DMS']['listing_thead_filecount']; ?></th>
				<th><?php echo $GLOBALS['TL_LANG']['DMS']['listing_thead_select']; ?></th>
			</tr>
		</thead>
		<tbody>

<?php $fileCount = 0; ?>
<?php foreach ($this->categories as $category): ?>
			<!-- category -->
			<tr id="<?php echo $category->getCssId(); ?>" class="category level_<?php echo $category->getLevel(); ?><?php if (!$category->isReadableForCurrentMember()) : ?> locked<?php endif; ?><?php if (!$category->hasPublishedDocuments()) : ?> empty<?php endif; ?><?php if (strlen($category->getCssClasses()) > 0) : ?> <?php echo $category->getCssClasses(); ?><?php endif; ?>">
				<td class="category_name"><?php echo $category->name; ?></td>
				<td class="category_filecount centered">
	<?php if ($category->isReadableForCurrentMember()) : ?>
					<?php echo $category->getPublishedDocumentCount(); ?>
					<?php $fileCount += $category->getPublishedDocumentCount(); ?>
	<?php else : ?>
					&nbsp;
	<?php endif; ?>
				</td>
				<td class="category_select centered">
	<?php if ($category->isReadableForCurrentMember() && $category->hasPublishedDocuments()) : ?>    
					<input onchange="expandCollapseCategory();" type="checkbox" name="expandedCatagories[]" value="<?php echo $category->id; ?>" <?php if (in_array($category->id, $this->expandedCategories)) : ?> checked="checked" <?php endif; ?> />
	<?php else : ?>
					&nbsp;
	<?php endif; ?>
				</td>
			</tr>
	<?php if ($category->hasDescription()) : ?>
			<!-- category description -->
			<tr class="description category_description level_<?php echo $category->getLevel(); ?><?php if (!$category->isReadableForCurrentMember()) : ?> locked<?php endif; ?><?php if (!$category->hasPublishedDocuments()) : ?> empty<?php endif; ?><?php if (strlen($category->getCssClasses()) > 0) : ?> <?php echo $category->getCssClasses(); ?><?php endif; ?>">
				<td colspan="3" class="category_description"><?php echo $category->description; ?></td>
			</tr>
	<?php endif; ?>
	<?php if ($category->isReadableForCurrentMember() && $category->hasPublishedDocuments() && in_array($category->id, $this->expandedCategories)) : ?>
			<!-- documents -->
		<?php foreach ($category->documents as $document) : ?>
			<?php if ($document->isPublished()) : ?>
			<tr class="document level_<?php echo $category->getLevel(); ?><?php if (strlen($category->getCssClasses()) > 0) : ?> <?php echo $category->getCssClasses(); ?><?php endif; ?>">
				<td colspan="3" class="document_link">
					<?php
						$title = sprintf($GLOBALS['TL_LANG']['DMS']['listing_size'], $document->getFileSize(Document::FILE_SIZE_UNIT_MB, true));
						if (strlen($document->getUploadDate() > 0) && $document->hasUploadMemberName())
						{
							$title .= "\n" . sprintf($GLOBALS['TL_LANG']['DMS']['listing_uploaded'], $document->getUploadDate(), $document->uploadMemberName);
						}
						if (strlen($document->getLasteditDate() > 0) && $document->hasLasteditMemberName())
						{
							$title .= "\n" . sprintf($GLOBALS['TL_LANG']['DMS']['listing_lastedited'], $document->getLasteditDate(), $document->lasteditMemberName);
						}
					?>
					<a href="javascript:downloadFile('<?php echo $document->id; ?>')" title="<?php echo $title; ?>">
						<?php echo $document->name; ?> <?php echo sprintf($GLOBALS['TL_LANG']['DMS']['listing_version'], $document->getVersion()); ?>
					</a>
				</td>
    
  <!-- Spalte 7 (Grafik) -->  
			<?php /*if ($dokdetail['file_preview'] == "") { ?>
			<td>&nbsp;</td>
			<?php } else { ?>
			<td><a href="{{link_url::anzeige}}?file=<?php echo $DocumentManagementSystemKat['dokdir'].'/preview/'.$dokdetail['name'].'_'.$dokdetail['file_preview'] ?>" target="_new"> <img src="<?php echo $DocumentManagementSystemKat['dokdir'].'/preview/'.$dokdetail['name'].'_'.$dokdetail['file_preview'] ?>" width="20" height="20" border="0"  /> </a></td>
			<?php } */?>
			</tr>
				<?php if ($document->hasDescription()) : ?>
			<tr class="description document_description level_<?php echo $category->getLevel(); ?><?php if (strlen($category->getCssClasses()) > 0) : ?> <?php echo $category->getCssClasses(); ?><?php endif; ?>">
				<td colspan="3" class="document_description">
					<?php echo $document->description; ?>
				</td>
			</tr>
				<?php endif; ?>
			<?php endif; ?>
		<?php endforeach; ?>
	<?php endif; ?>
<?php endforeach; ?>

		</tbody>
		<tfoot>
			<tr>
				<td><?php echo $GLOBALS['TL_LANG']['DMS']['listing_tfoot_document_count']; ?></td>
				<td><?php echo $fileCount; ?></td>
				<td>&nbsp;</td>
			</tr>
			<tr>
				<td colspan="3">
				<?php if ($fileCount > 0) : ?> 
					<button type="button" onclick="expandCollapseCategories(true);"><?php echo $GLOBALS['TL_LANG']['DMS']['listing_button_show_all_documents']; ?></button>
					<button type="button" onclick="expandCollapseCategories(false);"/><?php echo $GLOBALS['TL_LANG']['DMS']['listing_button_hide_all_documents']; ?></button>
				<?php endif;  ?> 
				</td>
			</tr>
		</tfoot>
	</table>
</form>

<script type="text/javascript">
<!--
	function expandCollapseCategory ()
	{
		document.getElementById('docId').value = "";
		document.getElementById('listing').submit();
	}
	
	function expandCollapseCategories (check)
	{
		for (var i = 0; i < document.getElementsByName("expandedCatagories[]").length; i++)
		{
			document.getElementsByName("expandedCatagories[]")[i].checked = check;
		}
		document.getElementById('docId').value = "";
		document.getElementById('listing').submit();
	}
	
	function search ()
	{
		document.getElementById('docId').value = "";
		document.getElementById('listing').submit();
	}
	
	function resetSearch ()
	{
		document.getElementById('searchText').value = "";
		document.getElementById('docId').value = "";
		document.getElementById('listing').submit();
	}
	
	function downloadFile (docId)
	{
		document.getElementById('docId').value = docId;
		document.getElementById('listing').submit();
	}
-->
</script>

</div>
