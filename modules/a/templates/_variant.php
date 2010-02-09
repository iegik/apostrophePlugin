<?php $variants = sfConfig::get('app_a_slot_variants') ?>
<?php if ((!$slot->isNew()) && isset($variants[$slot->type]) && count($variants[$slot->type])): ?>
  <li class="a-controls-item variant" id="<?php echo "$pageid-$name-$permid-variant" ?>">
		<?php echo jq_link_to_function('Options', '$("#a-'.$pageid.'-'.$name.'-'.$permid.'-variant-options-toggle").parent().toggleClass("open")', array('class' => 'a-variant-options-toggle a-btn icon a-settings', 'id' => 'a-' . $pageid.'-'.$name.'-'.$permid.'-variant-options-toggle', )) ?>
    <ul class="a-variant-options dropshadow">
      <?php foreach ($variants[$slot->type] as $variant => $settings): ?>
        <?php // These classes and ids are carefully set up so that _ajaxUpdateSlot can ?>
        <?php // target them later to change the active variant without rewriting the ?>
        <?php // outer area container ?>
        <?php $id = "a-$pageid-$name-$permid-variant-$variant" ?>
        <?php $active = ($variant === $slot->getEffectiveVariant()) ?>
        <li id="<?php echo $id ?>-active" class="active current" style="<?php echo $active ? '' : 'display: none' ?>">
          <span class="a-btn a-disabled icon a-checked"><?php echo $settings['label'] ?></span>
        </li>
        <li id="<?php echo $id ?>-inactive" class="inactive" style="<?php echo (!$active) ? '' : 'display: none' ?>">
          <?php echo jq_link_to_remote($settings['label'], array('url' => url_for('a/setVariant?' . http_build_query(array('id' => $page->id, 'name' => $name, 'permid' => $permid, 'variant' => $variant))), 'update' => "a-slot-content-$pageid-$name-$permid"), array('class' => 'a-btn icon a-unchecked',)) ?>
        </li>
      <?php endforeach ?>
    </ul>
  </li>
<?php endif ?>