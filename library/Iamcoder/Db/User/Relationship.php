<?php
require_once 'Iamcoder/Db/Table.php';

class Iamcoder_Db_User_Relationship extends Iamcoder_Db_Table {
    const RELATIONSHIP_KNOWS = 'know';
    const RELATIONSHIP_RECOMMENDS = 'recommends';
    
    protected $_name = 'user_relationship';
    protected $user_id;
    
    public function __construct($user_id, $config=array()) {
        parent::__construct($config);
        
        $this->user_id = $user_id;
    }
    
    public function getTotalKnows() {
        $select = $this->getAdapter()->select()
                    ->from($this->_name, new Zend_Db_Expr('COUNT(user_id)'))
                    ->where('relationship = ?', self::REALTIONSHIP_KNOWS)
                    ->where('user_id_from = ?', $this->user_id);
        
        return $this->getAdapter()->fetchOne($select);
    }

    public function getTotalRecommends() {
        $select = $this->getAdapter()->select()
                    ->from($this->_name, new Zend_Db_Expr('COUNT(user_id)'))
                    ->where('relationship = ?', self::REALTIONSHIP_RECOMMENDS)
                    ->where('user_id_from = ?', $this->user_id);
        
        return $this->getAdapter()->fetchOne($select);
    }

    public function create($user_id_to, $relationship) {
        $this->insert(array(
           'user_id_from' => $this->user_id,
           'user_id_to' => $user_id_to,
           'relationship' => $relationship,
           'created' => time()
        ));
    } 
    
    public function setLastUpdated($user_id) {
        $this->insert(array(
           'user_id' => $user_id,
           'updated' => time(),
        ));
    }    
}