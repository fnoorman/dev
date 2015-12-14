<?php
namespace common\components;

use Yii;
use yii\db\Query;
use yii\di\Instance;
use yii\caching\Cache;
use yii\db\Connection;
use yii\db\Expression;
use yii\rbac\DbManager;
use yii\helpers\ArrayHelper;
use yii\base\InvalidCallException;
use yii\base\InvalidParamException;
use yii\rbac\Item;


class Authorization extends DbManager
{

    public function getRecursiveAssignedRole($roleName)
    {
        $childrenList = $this->getChildrenList();
        $result = [];
        $this->getChildrenRecursive($roleName, $childrenList, $result);
        if (empty($result)) {
            return [];
        }
        $query = (new Query)->from($this->itemTable)->where([
            'type' => 1,
            'name' => array_keys($result),
        ]);
        $directRoles = $this->getChildrenByType($roleName,1);
        $roles = [];
        foreach ($query->all($this->db) as $row) {
            $enable = false;
            if(array_key_exists($row['name'], $directRoles))
              $enable = true;
            $roles[$row['name']] = ['item' => $this->populateItem($row), 'enable' => $enable];
        }

        return $roles;
    }

    public function getRecursiveAssignedPermission($roleName)
    {
        $childrenList = $this->getChildrenList();
        $result = [];
        $this->getChildrenRecursive($roleName, $childrenList, $result);
        if (empty($result)) {
            return [];
        }
        $query = (new Query)->from($this->itemTable)->where([
            'type' => Item::TYPE_PERMISSION,
            'name' => array_keys($result),
        ]);
        $permissions = [];
        $directPermissions = $this->getChildrenByType($roleName, 2);
        foreach ($query->all($this->db) as $row) {
            $enable = false;
            if(array_key_exists($row['name'], $directPermissions))
              $enable = true;
            $permissions[$row['name']] = ['item' => $this->populateItem($row), 'enable' => $enable];
        }

        return $permissions;
    }

    public function getChildrenByType($name,$type)
    {
        $query = (new Query)
            ->select(['name', 'type', 'description', 'rule_name', 'data', 'created_at', 'updated_at'])
            ->from([$this->itemTable, $this->itemChildTable])
            ->where(['parent' => $name, 'name' => new Expression('[[child]]'),'type'=>$type]);

        $children = [];
        foreach ($query->all($this->db) as $row) {
            $children[$row['name']] = $this->populateItem($row);
        }
        return $children;
    }

    public function getRoleOptions($roleName)
    {
        $rolesInSystem = $this->getRoles();
        $recursiveRole = $this->getRecursiveAssignedRole($roleName);
        $recursiveAscendants = $this->getAscendants($roleName,1);
        $result = [];
        // $this->getRecursiveParents($roleName, $result);
        $roles =[];

        foreach ($rolesInSystem as $key => $value) {
            if((!array_key_exists($key, $recursiveRole) && !array_key_exists($key, $recursiveAscendants)) && ($key !== $roleName))
              $roles[$key] = $key;
        }
        return $roles;
    }

    public function getPermissionOptions($roleName)
    {
        $permissionInSystem = $this->getPermissions();
        $recursivePermission = $this->getRecursiveAssignedPermission($roleName);
        $recursiveAscendants = $this->getAscendants($roleName,2);
        $result = [];
        // $this->getRecursiveParents($roleName, $result);
        $permissions =[];

        foreach ($permissionInSystem as $key => $value) {
            if((!array_key_exists($key, $recursivePermission) && !array_key_exists($key, $recursiveAscendants)) && ($key !== $roleName))
              $permissions[$key] = $key;
        }
        return $permissions;
    }

    public function getAscendants($roleName,$type)
    {
        $result = [];
        $this->getRecursiveParents($roleName, $result,$type);
        return $result;
    }

    private function getRecursiveParents($name,&$result,$type)
    {
        $query = (new Query)
            ->select(['name', 'type', 'description', 'rule_name', 'data', 'created_at', 'updated_at'])
            ->from([$this->itemTable, $this->itemChildTable])
            ->where(['child' => $name, 'name' => new Expression('[[parent]]'),'type' =>$type]);

        foreach ($query->all($this->db) as $row) {
//            $result[$row['name']] = $row['name'];
            $enable = true;
            if(array_key_exists($name, $result))
                $enable = false;
            $result[$row['name']] = ['item' => $this->populateItem($row),'enable'=>$enable];
            $this->getRecursiveParents($row['name'],$result,$type);

        }
    }

}

?>
