<?php
/**
 * 
 * PluginaCategoryUserTable
 * This class has been auto-generated by the Doctrine ORM Framework
 * @package    apostrophePlugin
 * @subpackage    model
 * @author     P'unk Avenue <apostrophe@punkave.com>
 */
class PluginaCategoryUserTable extends Doctrine_Table
{

  /**
   * 
   * Returns an instance of this class.
   * @return object PluginaCategoryUserTable
   */
  public static function getInstance()
  {
    return Doctrine_Core::getTable('PluginaCategoryUser');
  }

  /**
   * DOCUMENT ME
   * @param mixed $old_id
   * @param mixed $new_id
   */
  public function mergeCategory($old_id, $new_id)
  {
    Doctrine::getTable('aCategory')->mergeCategory($old_id, $new_id, 'aCategoryUser', 'category_id', true, 'user_id');
  }

}