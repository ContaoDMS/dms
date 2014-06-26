<div class="mod_dms <?php echo $this->class; ?>"<?php echo $this->cssID; ?><?php if ($this->style): ?> style="<?php echo $this->style; ?>"<?php endif; ?>>
<?php if ($this->headline): ?>

<<?php echo $this->hl; ?>><?php echo $this->headline; ?></<?php echo $this->hl; ?>>
<?php endif; ?>

<form action="<?php echo $this->action; ?>" method="post" id="management" name="management">
	<input type="hidden" name="FORM_SUBMIT" value="<?php echo $this->formId; ?>">
	<input type="hidden" name="REQUEST_TOKEN" value="{{request_token}}">
	
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
	
<?php if (count($this->categories) > 0): ?>
	<!-- Table of categories -->
	<table cellpadding="0" cellspacing="0" border="0">
		<thead>
			<tr>
				<th><?php echo $GLOBALS['TL_LANG']['DMS']['management_thead_category']; ?></th>
				<th colspan="2" class="centered"><?php echo $GLOBALS['TL_LANG']['DMS']['management_thead_action']; ?></th>
			</tr>
		</thead>
		<tbody>

<?php $fileCount = 0; ?>
<?php foreach ($this->categories as $category): ?>
			<!-- category -->
			<tr id="<?php echo $category->getCssId(); ?>" class="category level_<?php echo $category->getLevel(); ?><?php if (!$category->isUploadableForCurrentMember() && !$category->isManageableForCurrentMember()) : ?> locked<?php endif; ?><?php if (!$category->hasDocuments()) : ?> empty<?php endif; ?><?php if (strlen($category->getCssClasses()) > 0) : ?> <?php echo $category->getCssClasses(); ?><?php endif; ?>">
				<td class="category_name"><?php echo $category->name; ?></td>
				<td class="category_upload centered button">
	<?php if ($category->isUploadableForCurrentMember()) : ?>
					<button type="submit" name="uploadCategory" value="<?php echo $category->id; ?>"><?php echo $GLOBALS['TL_LANG']['DMS']['management_button_upload']; ?></button>
	<?php else : ?>
					&nbsp;
	<?php endif; ?>
				</td>
				<td class="category_manage centered button">
	<?php if ($category->isManageableForCurrentMember() && $category->hasDocuments()) : ?>
					<button type="submit" name="manageCategory" value="<?php echo $category->id; ?>"><?php echo $GLOBALS['TL_LANG']['DMS']['management_button_manage']; ?></button>
	<?php else : ?>
					&nbsp;
	<?php endif; ?>
				</td>
			</tr>
	<?php if ($category->hasDescription()) : ?>
			<!-- category description -->
			<tr class="description category_description level_<?php echo $category->getLevel(); ?><?php if (!$category->isUploadableForCurrentMember() && !$category->isManageableForCurrentMember()) : ?> locked<?php endif; ?><?php if (!$category->hasDocuments()) : ?> empty<?php endif; ?><?php if (strlen($category->getCssClasses()) > 0) : ?> <?php echo $category->getCssClasses(); ?><?php endif; ?>">
				<td colspan="3" class="category_description"><?php echo $category->description; ?></td>
			</tr>
	<?php endif; ?>
<?php endforeach; ?>

		</tbody>
		<tfoot>
			<tr>
				<td colspan="3">
					&nbsp;
				</td>
			</tr>
		<tfoot>
	</table>
<?php endif; ?>
</form>

</div>