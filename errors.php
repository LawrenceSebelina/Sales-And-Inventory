<?php  if (count($errors) > 0) : ?>
	<div class="error">
		<?php foreach ($errors as $error) : ?>
			<?php echo '<script>swal("Signin Failed","'.$error.'","error");</script>'; ?>
		<?php endforeach ?>
	</div>
<?php  endif ?>


