<?php
/**
 * 
 * This class has been auto-generated by the Doctrine ORM Framework
 * @package    apostrophePlugin
 * @subpackage    model
 * @author     P'unk Avenue <apostrophe@punkave.com>
 */
abstract class PluginaSmartSlideshowSlot extends BaseaSmartSlideshowSlot
{

  /**
   * DOCUMENT ME
   * @return mixed
   */
  public function isOutlineEditable()
  {
    // We have an edit button and don't use an in-place editor
    return false;
  }

  /**
   * DOCUMENT ME
   * @return mixed
   */
  public function getSearchText()
  {
    $text = "";
    $items = unserialize($this->value);
    foreach ($items as $item)
    {
      // backwards compatibility with older stuff in trinity that
      // didn't have the text fields in the slot
      if (isset($item->title))
      {
        $text .= $item->title . "\n";
        $text .= $item->description . "\n";
        $text .= $item->credit . "\n";
      }
    }
    return $text;
  }

  /**
   * DOCUMENT ME
   * @return mixed
   */
  public function getMediaItemOrder()
  {
    // Smart slideshows do NOT have an order
    return false;
  }

  /**
   * Get the currently appropriate media items. If $options['constraints'] is present then 
   * apply those media size constraints. Filters by category and/or tag according to the user's selections
   * already stored in the slot. The maximum # of results returned is that specified by the user 
   * and already stored in the slot.
   *
   * The result is a natural PHP array for convenience when calling methods
   * like shuffle().
   *
   * @param array $options
   * @return array
   */

  public function getOrderedMediaItemsWithOptions($options = array())
  {
    $value = $this->getArrayValue();
    // Not set yet
    if (!count($value))
    {
      return array();
    }
    if (isset($value['form']))
    {
      // Tolerate what my early alphas did to save our devs some grief, but don't
      // respect it
      return array();
    }
    // We have getBrowseQuery, so reuse it!
    $params = array();
    if (isset($value['categories_list']))
    {
      $params['allowed_categories'] = aCategoryTable::getInstance()->createQuery('c')->whereIn('c.id', $value['categories_list'])->execute();
    }
    if (isset($value['tags_list']))
    {
      $params['allowed_tags'] = $value['tags_list'];
    }
    if (isset($options['constraints']))
    {
      foreach ($options['constraints'] as $k => $v)
      {
        $params[$k] = $v;
      }
    }
    $params['type'] = 'image';
    $q = aMediaItemTable::getBrowseQuery($params);
    $q->andWhere('(aMediaItem.view_is_secure IS NULL OR aMediaItem.view_is_secure IS FALSE)');
    $q->limit(isset($value['count']) ? $value['count'] : 5);
    $q->orderBy('aMediaItem.created_at DESC');
    $items = $q->execute();
    // shuffle likes real arrays better
    $a = array();
    foreach ($items as $item)
    {
      $a[] = $item;
    }
    return $a;
  }

  /**
   * Allows hasMedia() and friends in aBlogItem to find images in smart slideshows.
   * Must match the signature of the base class version of this method, so we can't
   * have an options parameter here (not even an optional one).
   */
  public function getOrderedMediaItems()
  {
    return $this->getOrderedMediaItemsWithOptions();
  }
  
  // We don't need refreshSlot anymore thanks to ON DELETE CASCADE
  // and the new simplified non-API-driven setup
}
