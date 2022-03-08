<?php
/**
 * @var string $type ;
 * @var string|callable $content ;
 * @var bool $dismissible ;
 */

?>
<div class="notice notice-<?php echo $type; ?> <?php echo $dismissible ? 'is-dismissible' : ''; ?>">
	<p>
		<strong>Block Factory: </strong>
		<?php echo is_callable($content) ? $content() : $content; ?>
	</p>
	<?php if ($dismissible): ?>
		<button type="button" class="notice-dismiss">
			<span class="screen-reader-text">Dismiss this notice.</span>
		</button>
	<?php
	endif; ?>
</div>
