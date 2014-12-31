<?php

namespace idwaker\auth\components;

use yii\db\ActiveQuery;
use yii\rbac\ManagerInterface;
use yii\base\Component;
use yii\base\InvalidValueException;
use yii\base\NotSupportedException;

use idwaker\auth\models\Rule;
use idwaker\auth\models\Role;
use idwaker\auth\models\User;
use idwaker\auth\models\Permission;


class AuthManager extends Component implements ManagerInterface
{
    /**
     * @var Array list of role names assigned to every user
     */
    public $defaultRoles = [];

    /**
     * Checks of user has specified permission
     * @param	Integer	$userId		user Id
     * @param	String	$roleName	role name
     * @param	Array	$params		name-value pair that will be passed to
     * rules associated
     * @return	Bool			true if user has permission
     */
    public function checkAccess($userId, $roleName, $params=[])
    {
        $userRoles = $this->getAssignments($userId);
        
        $role = $this->getRole($roleName);
        
        // given role doesn't exists on system
        if ($role === null) {
            return false;
        }
        
        if (isset($userRoles[$roleName]) || 
                in_array($roleName, $this->defaultRoles)) {
            return true;
        }
        
        return false;
    }

    /**
     * creates a new Role object
     * @param	String	$name	name of the new role
     * @return	Object			Role
     */
    public function createRole($name)
    {
        $role = new Role();
        $role->name = $name;
        return $role;
    }

    /**
     * creates a new permission
     * @param	String	$name	name of the permission
     * @return	object			permission
     */
    public function createPermission($name)
    {
        $perm = new Permission();
        $perm->name = $name;
        return $perm;
    }

    /**
     * add a permission, role or rule
     * @param	Object	$obj	permission, role or rule object
     * @return	Bool	        if created or not
     */
    public function add($obj)
    {
        if ($obj instanceof Role || $obj instanceof Rule ||
            $obj instanceof Permission) {
            return $obj->insert();
        }
        else {
            throw new NotSupportedException();
        }
    }

    /**
     * remove a permission, role or rule
     * @param	Object	$obj	permission, role or rule object
     * @return	Bool	        if removed or not
     */
    public function remove($obj)
    {
        if ($obj instanceof Role || $obj instanceof Rule ||
            $obj instanceof Permission) {
            return $obj->delete();
        }
        else {
            throw new NotSupportedException();
        }
    }

    /**
     * updates a specified permission, role or rule
     * @param	String	$name	old name of permission, role or rule
     * @param	Object	$obj	new permission, role or rule object
     * @return	Bool	        if updated or not
     */
    public function update($name, $obj)
    {
        if ($obj instanceof Role || $obj instanceof Rule ||
            $obj instanceof Permission) {
            return $obj->update();
        }
        else {
            throw new NotSupportedException();
        }
    }

    /**
     * returns a named role
     * @param	String	$name	role name
     * @return	Object		Role Object
     */
    public function getRole($name)
    {
        return Role::findOne(['name' => $name]);
    }

    /**
     * returns all roles
     * @return	Array		list of roles
     */
    public function getRoles()
    {
        return Role::findAll();
    }

    /**
     * returns list of roles assigned to user
     * @param	Object	$user	user object
     * @return	Array		list of roles
     */
    public function getRolesByUser($user)
    {
        if (!$user instanceof User) {
            throw new NotSupportedException();
        }
        return $user->getRoles();
    }

    /**
     * return named permission
     * @param	String	$name	permission name
     * @return	Object	        permission object
     */
    public function getPermission($name)
    {
        return Permission::findOne(['name' => $name]);
    }

    /**
     * returns all permissions
     * @return	Array		list of permissions
     */
    public function getPermissions()
    {
        return Permission::findAll();
    }

    /**
     * return list of permissions with given role name
     * @param	String	$role	role name
     * @return	Object		list of permissions
     */
    public function getPermissionsByRole($roleName)
    {
        $role = $this->getRole($roleName);
        return $role->getPermissions();
    }

    /**
     * return list of permissions for given user
     * @param	Object	$user	user object
     * @return	Array		list of permissions
     */
    public function getPermissionsByUser($user)
    {
        throw new NotSupportedException();
    }

    /**
     * return rule by name
     * @param	String	$name	rule name
     * @return	Object		Rule Object
     */
    public function getRule($name)
    {
        return Rule::findOne(['name' => $name]);
    }

    /**
     * return list of rules
     * @return	Array		list of rules
     */
    public function getRules()
    {
        return Rule::findAll();
    }

    /**
     * adds an item as an child of another item
     * @param	Object	$parent	role
     * @param	Object	$child	permission or role
     * @return	Bool
     */
    public function addChild($parent, $child)
    {
        if (!$parent instanceof Role) {
            throw new InvalidValueException();
        }
        if ($child instanceof Role) {
            return $child->link('parent', $parent);
        }
        elseif ($child instanceof Permission) {
            return $child->link('roles', $parent);
        }
        else {
            throw new InvalidValueException();
        }
    }

    /**
     * removes child from ites parent
     * @param	Object	$parent	role
     * @param	Object	$child	permission or role
     * @return	Bool
     */
    public function removeChild($parent, $child)
    {
        if (!$parent instanceof Role) {
            throw new InvalidValueException();
        }
        if ($child instanceof Role) {
            return $child->unlink('parent', $parent);
        }
        elseif ($child instanceof Permission) {
            return $child->unlink('roles', $parent);
        }
        else {
            throw new InvalidValueException();
        }
    }

    /**
     * checks if child already exists for parent
     * @param	Object	$parent	role
     * @param	Object	$child	permission or role
     * @return	Bool		true or false
     */
    public function hasChild($parent, $child)
    {
        if (!$parent instanceof Role) {
            throw new InvalidValueException();
        }
        if ($child instanceof Role) {
            return $parent->equals($child->getParent()->one());
        }
        elseif ($child instanceof Permission) {
            foreach($parent->getPermissions()->all() as $perm) {
                if ($perm->equals($child)) {
                    return true;
                }
            }
            return false;
        }
        else {
            throw new InvalidValueException("child should be either Role or Permission");
        }
    }

    /**
     * return list of child permission or roles
     * @param	Object	$name	role-name
     * @return	Array	        list of items
     */
    public function getChildren($name)
    {
        $role = $this->getRole($name);
        return $role->getChildren()->all();
    }

    /**
     * assigns a role to user
     * @param	Object	$role	role
     * @param	Object	$user	user
     * @return
     */
    public function assign($role, $userId)
    {
        if (!$role instanceof Role) {
            throw new InvalidValueException();
        }
        $user = User::findOne($userId);

        return $role->link('users', $user);
    }

    /**
     * revokes a role from user
     * @param	Object	$role	role
     * @param	Object	$user	user
     * @return	Bool		either successfull or failure
     */
    public function revoke($role, $userId)
    {
        if (!$parent instanceof Role) {
            throw new InvalidValueException();
        }
        $user = User::findOne($userId);

        return $role->unlink('users', $user);
    }

    /**
     * revokes all roles from user
     * @param	Object	$user	user
     * @return	Bool		either successfull or failure
     */
    public function revokeAll($userId)
    {
        $user = User::findOne($userId);

        return $user->unlink('roles');
    }

    /**
     * returns assignment information regarding role and user
     * @param	Object	$role	roleName
     * @param	Object	$user	user
     * @return
     */
    public function getAssignment($roleName, $userId)
    {
        $role = $this->getRole($roleName);
    }

    /**
     * @inheritdoc
     */
    public function getAssignments($userId)
    {
        if (empty($userId)) {
            return [];
        }

        $user = User::findOne($userId);
        return $user->getRoles()->asArray()->all();
    }

    /**
     * remove all data roles, permission, rules and assignments
     * @return	Bool		true if success
     */
    public function removeAll()
    {
        $this->removeAllAssignments();
        $this->removeAllRules();
        $this->removeAllPermissions();
        $this->removeAllRoles();
    }

    /**
     * removes all permissions
     * @return	Bool		true if success
     */
    public function removeAllPermissions()
    {
        return Permission::deleteAll();
    }

    /**
     * removes all roles
     * @return	Bool		true if success
     */
    public function removeAllRoles()
    {
        return Role::deleteAll();
    }

    /**
     * remove all rules
     * @return	Bool		true if success
     */
    public function removeAllRules()
    {
        return Rule::deleteAll();
    }

    /**
     * remove all assignments
     * @return	Bool		true if success
     */
    public function removeAllAssignments()
    {
        return UserRole::deleteAll();
    }
    
    /**
     * detach all children from parent
     * @return	Bool    true if success
     */
    public function removeChildren($parent)
    {
        return true;
    }
}