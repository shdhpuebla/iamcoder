<?php
require_once 'Iamcoder/Db/Table.php';

class Iamcoder_Db_User extends Iamcoder_Db_Table {
    protected $_name = 'users';
    
    public function exists($user_id) {
        $select = $this->getAdapter()->select()
                   ->from($this->_name)
                   ->where('user_id = ?', $user_id);
        
        return $this->getAdapter()->fetchRow($select);
    }
    
    public function create($name) {
        $this->insert(array(
           'user_id' => null,
           'name' => $name,
           'created' => time(),
           'updated' => time(),
           'knows' => 0,
           'recommendations' => 0,
        ));
    } 
    
    public function setLastUpdated($user_id) {
        $this->insert(array(
           'user_id' => $user_id,
           'updated' => time(),
        ));
    }
    
    public function updateKnows($user_id) {
        $table = new Iamcoder_Db_User_Relationship($user_id);
        $total_knows = $table->getTotalKnows();
        $total_recomendations = $table->getTotalRecommends();
                
        $where = $this->getAdapter()->quoteInto('user_id = ?');
        $this->update(array(
            'knows' => $total_knows,
            'recommendations' => $total_recomendations
        ), $where);
    }
}