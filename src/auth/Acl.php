<?php

namespace auth;

use Zend\Permissions\Acl\Acl as ZendAcl;

/**
 * ACL for Slim Auth Implementation Example.
 */
class Acl extends ZendAcl
{
	protected $defaultPrivilege = array('GET');

	public function __construct()
	{
		// APPLICATION ROLES
		$this->addRole('guest');

		// member role "extends" guest, meaning the member role will get all of
		// the guest role permissions by default
		$this->addRole('member', 'guest');
		$this->addRole('admin');

		// APPLICATION RESOURCES
		// Application resources == Slim route patterns
		$this->addResource('/');
		$this->addResource('/login');
		$this->addResource('/logout');
		$this->addResource('/bami');
		$this->addResource('/admin');
        $this->addResource('/incidents');
        $this->addResource('/incident_update');

		// APPLICATION PERMISSIONS
		// Now we allow or deny a role's access to resources.
		// The third argument is 'privilege'. In Slim Auth privilege == HTTP method
		$this->allow('guest', '/', $this->defaultPrivilege);
		$this->allow('guest', '/login', array('GET', 'POST'));
		$this->allow('guest', '/logout', $this->defaultPrivilege);
        $this->allow('member', '/incidents', array('GET', 'POST'));
        $this->allow('member', '/incident_update', array('GET', 'POST'));

		$this->allow('member', '/bami', $this->defaultPrivilege);


		// This allows admin access to everything
		$this->allow('admin');
	}
}