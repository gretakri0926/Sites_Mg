<?php
/**
 * @copyright   Copyright (c) 2010 Amasty (http://www.amasty.com)
 */  
class Amasty_Perm_Helper_Data extends Mage_Core_Helper_Abstract
{
    public function getCurrentSalesPersonId()
    {
        $user = Mage::getSingleton('admin/session')->getUser();  
        if (!$user)
            return 0;
            
        if ($user->getRole()->getId() != Mage::getStoreConfig('amperm/general/role')){
            return 0;
        }   

        return $user->getId();       
    }
    
    public function getSalesPersonList()
    {
        $roleId = intVal(Mage::getStoreConfig('amperm/general/role'));
        if (!$roleId)
            return array();
            
        $users = Mage::getResourceModel('admin/user_collection');
        $select = $users->getSelect();
        
        $table = Mage::getSingleton('core/resource')->getTableName('admin/role'); 
        $select->joinInner(array('u'=>$table), 'u.user_id = main_table.user_id')
            ->where("role_type = 'U'")
            ->where("parent_id = $roleId");
 
        return $users;        
    }
   
}