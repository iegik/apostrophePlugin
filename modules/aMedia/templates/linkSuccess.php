<?php use_helper('a') ?>
<?php slot('body_class') ?>a-media<?php end_slot() ?>

<?php slot('a-page-header') ?>
  <div class="a-admin-header">
    <h3 class="a-admin-title"><?php echo link_to(a_('Media Library'), 'aMedia/resume') ?></h3>
  </div>
<?php end_slot() ?>
<?php include_component('aMedia', 'browser') ?>
<div id="a-media-library">
  <h3><?php echo a_('Linked Accounts') ?></h3>
	<?php if (count($accounts)): ?>
	  <p>
	    <?php echo a_('All new items in these accounts are automatically added to the media repository on a scheduled basis.') ?>
	  </p>
	  <ul class="a-media-linked-accounts">
	    <?php foreach ($accounts as $account): ?>
	      <li>
	        <ul>
	          <li class="a-service a-<?php echo $account->service ?>"><?php echo $account->service ?></li>
	          <li class="a-account"><?php echo a_entities($account->username) ?></li>
	          <?php if (isset($form)): ?>
	            <li class="a-actions"><?php echo link_to(a_('Remove'), 'aMedia/linkRemoveAccount?id=' . $account->id) ?></li>
	          <?php endif ?>
	        </ul>
	      </li>
	    <?php endforeach ?>
	  </ul>
	<?php endif ?>
	<h4><?php echo a_('Add Linked Account') ?></h4>
	<form id="a-media-add-linked-account" method="POST" action="<?php echo url_for('aMedia/linkAddAccount') ?>">
	  <?php echo $form ?>
	  <ul class="a-ui a-controls" id="a-media-video-add-by-embed-form-submit">
      <li><input type="submit" value="<?php echo __('Add', null, 'apostrophe') ?>" class="a-btn a-submit" /></li>
    </ul>
	</form>
	<?php // I am an AJAX target ?>
	<div id="a-media-account-preview-wrapper">
  </div>
</div>

<?php a_js_call('apostrophe.mediaEnableLinkAccount(?)', url_for('aMedia/linkPreviewAccount')) ?>
