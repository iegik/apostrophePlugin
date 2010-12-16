<?php
  // Compatible with sf_escaping_strategy: true
  $form = isset($form) ? $sf_data->getRaw('form') : null;
?>
<?php use_helper('a') ?>

<div class="a-ui a-signin" id="a-signin">
  <form action="<?php echo url_for('@sf_guard_signin') ?>" method="post" id="a-signin-form" <?php echo ($form->hasErrors())? 'class="has-errors"':''; ?>>

		<div class="a-form-row a-hidden">
  		<?php echo $form->renderHiddenFields() ?>
		</div>

		<div class="a-form-row">
    	<?php echo $form['username']->renderLabel() ?>
    	<?php echo $form['username']->render() ?>
    	<?php echo $form['username']->renderError() ?>
		</div>
		
		<div class="a-form-row">		
    	<?php echo $form['password']->renderLabel() ?>
    	<?php echo $form['password']->render() ?>
    	<?php echo $form['password']->renderError() ?>
		</div>
		
		<ul class="a-form-row submit">
    	<li>
				<input type="submit" class="a-btn a-submit" value="<?php echo __('Sign In', null, 'apostrophe') ?>" />
			</li>
			<li>
			  <?php echo a_js_button(a_('Cancel'), array('a-cancel', 'icon', 'a-login-cancel-button')) ?>
			</li>
		</ul>
		
  </form>
</div>
