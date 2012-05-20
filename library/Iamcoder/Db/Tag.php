<?php
require_once 'Iamcoder/Db/Table.php';

class Iamcoder_Db_Tag extends Iamcoder_Db_Table {
    protected $_name = 'tags';
    
    public function exists($tag) {
        $select = $this->getAdapter()->select()
                   ->from($this->_name)
                   ->where('user_id = ?', $user_id);
        
        return $this->getAdapter()->fetchRow($select);
    }
    
    public function create($name) {
        $url = Iamcoder_Util::generateUrl($name);
        if (empty($url)) {
            throw new Exception('Invalid url name');
        }
        
        return $this->insert(array(
           'tag_id' => null,
           'name' => $name,
           'url' => $url,
        ));
    } 
    
    public function increaseUsageTag($tag_id) {

    }
    
    public function decreaseUsageTag($tag_id) {
        
    }
}