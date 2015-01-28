<!-- indexer::stop -->
<div class="<?php echo $this->class; ?>"<?php echo $this->cssID; ?><?php if ($this->style): ?> style="<?php echo $this->style; ?>"<?php endif; ?>>
<?php if ($this->headline): ?>

<<?php echo $this->hl; ?>><?php echo $this->headline; ?></<?php echo $this->hl; ?>>
<?php endif; ?>

<h2 class="error"><?php echo $GLOBALS['TL_LANG']['DMS']['management_access_denied_headline']; ?></h2>
<div class="error"><?php echo $GLOBALS['TL_LANG']['DMS']['management_access_denied_text']; ?></div>
<!-- indexer::continue --> 