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
		$this->addResource('/incidents/all');
		$this->addResource('/incidents/show/:id');
		$this->addResource('/incidents/update');
		$this->addResource('/incident_update');
		$this->addResource('/incident_new');
        $this->addResource('/incidents/close');
        $this->addResource('/questionnaire');
        $this->addResource('/questionnaire/:id');
        $this->addResource('/questionnaire_finished');

		// APPLICATION PERMISSIONS
		// Now we allow or deny a role's access to resources.
		// The third argument is 'privilege'. In Slim Auth privilege == HTTP method
		$this->allow('guest', '/', $this->defaultPrivilege);
		$this->allow('guest', '/login', array('GET', 'POST'));
		$this->allow('guest', '/logout', $this->defaultPrivilege);

		// Incidents
    	$this->allow('member', '/incident_new', array('POST', 'GET'));
		$this->allow('member', '/incidents/all', $this->defaultPrivilege);
		$this->allow('member', '/incidents/show/:id', $this->defaultPrivilege);
		$this->allow('member', '/incidents/update', array('POST'));
        $this->allow('admin', '/incidents/close', array('POST'));


		$this->allow('member', '/bami', $this->defaultPrivilege);

		// Vragenlijst
		$this->allow('guest', '/questionnaire', $this->defaultPrivilege);
		$this->allow('guest', '/questionnaire/:id', $this->defaultPrivilege);
		$this->allow('guest', '/questionnaire_finished', $this->defaultPrivilege);

		// This allows admin access to everything
		$this->allow('admin');
	}
}
