<div class="mod_dms <?php echo $this->class; ?>"<?php echo $this->cssID; ?><?php if ($this->style): ?> style="<?php echo $this->style; ?>"<?php endif; ?>>
<?php if ($this->headline): ?>

<<?php echo $this->hl; ?>><?php echo $this->headline; ?></<?php echo $this->hl; ?>>
<?php endif; ?>

<form action="<?php echo $this->action; ?>" method="post" id="listing" name="listing">
	<input type="hidden" name="FORM_SUBMIT" value="<?php echo $this->formId; ?>">
	<input type="hidden" name="REQUEST_TOKEN" value="{{request_token}}">
	<input type="hidden" name="docId" id="docId" value="">
	
	<?php if (count($this->errors) > 0): ?>
	<!-- Errors -->
	<div id="dms_errors">
		<?php foreach ($this->errors as $error): ?>
		<div class="error"><?php echo $error; ?></div>
		<?php endforeach; ?>
	</div>
	<?php endif; ?>
	
	<!-- Search -->
	<div id="list_search">
		<div id="list_search_params">
			<?php // TODO (#9) set the search type here (via Drop Down) ?>
			<select name="searchType" id="searchType" style="visibility: hidden;">
				<option value="<?php echo DmsLoaderParams::DOCUMENT_SEARCH_EXACT; ?>"><?php echo DmsLoaderParams::DOCUMENT_SEARCH_EXACT; ?></option>
				<option value="<?php echo DmsLoaderParams::DOCUMENT_SEARCH_EXACT; ?>"><?php echo DmsLoaderParams::DOCUMENT_SEARCH_EXACT; ?></option>
			</select>
			<input type="text" name="searchText" id="searchText" placeholder="<?php echo $GLOBALS['TL_LANG']['DMS']['listing_search_placeholder']; ?>" value="<?php if ($this->searchText != "") : ?><?php echo $this->searchText; ?><?php endif; ?>" />
		</div>
		<div id="list_search_buttons">
			<input type="button" id="button-reset" onclick="resetSearch();" value="<?php echo $GLOBALS['TL_LANG']['DMS']['listing_reset_button']; ?>" />
			<input type="submit" id="button-search" value="<?php echo $GLOBALS['TL_LANG']['DMS']['listing_search_button']; ?>" />
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
			<tr class="category level_<?php echo $category->getLevel(); ?><?php if (!$category->isReadableForCurrentMember()) : ?> locked<?php endif; ?><?php if (!$category->hasDocuments()) : ?> empty<?php endif; ?>">
				<td class="category_name"><?php echo $category->name; ?></td>
				<td class="category_filecount centered">
	<?php if ($category->isReadableForCurrentMember()) : ?>
					<?php echo $category->getDocumentCount(); ?>
					<?php $fileCount += $category->getDocumentCount(); ?>
	<?php else : ?>
					&nbsp;
	<?php endif; ?>
				</td>
				<td class="category_select centered">
	<?php if ($category->isReadableForCurrentMember() && $category->hasDocuments()) : ?>    
					<input onchange="listing.submit();" type="checkbox" name="expandedCatagories[]" value="<?php echo $category->id; ?>" <?php if (in_array($category->id, $this->expandedCategories)) : ?> checked="checked" <?php endif; ?> />
	<?php else : ?>
					&nbsp;
	<?php endif; ?>
				</td>
			</tr>
	<?php if ($category->hasDescription()) : ?>
			<!-- category description -->
			<tr class="description category_description level_<?php echo $category->getLevel(); ?><?php if (!$category->isReadableForCurrentMember()) : ?> locked<?php endif; ?><?php if (!$category->hasDocuments()) : ?> empty<?php endif; ?>">
				<td colspan="3" class="category_description"><?php echo $category->description; ?></td>
			</tr>
	<?php endif; ?>
	<?php if ($category->isReadableForCurrentMember() && $category->hasDocuments() && in_array($category->id, $this->expandedCategories)) : ?>
			<!-- documents -->
		<?php foreach ($category->documents as $document) : ?>
			<?php if ($document->isPublished()) : ?>
			<tr class="document level_<?php echo $category->getLevel(); ?>">
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
			<tr class="description document_description level_<?php echo $category->getLevel(); ?>">
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
					<input type="submit" name="submit_kategorieauswahl" class="submit" value="<?php echo $GLOBALS['TL_LANG']['DMS']['listing_button_show_all_documents']; ?>" onclick="checkAllCategories(true);"/>
					<input type="submit" name ="submit_kategorieauswahl_loeschen" class="submit" value="<?php echo $GLOBALS['TL_LANG']['DMS']['listing_button_hide_all_documents']; ?>" onclick="checkAllCategories(false);"/>
				<?php endif;  ?> 
				</td>
			</tr>
		</tfoot>
	</table>
</form>

<script type="text/javascript">
<!--
	function checkAllCategories (check)
	{
		for (var i = 0; i < document.getElementsByName("expandedCatagories[]").length; i++)
		{
			document.getElementsByName("expandedCatagories[]")[i].checked = check;
		}
	}
	
	function resetSearch ()
	{
		document.getElementById('searchText').value = "";
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
