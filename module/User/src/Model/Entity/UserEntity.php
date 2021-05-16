<?php

declare(strict_types=1);

namespace User\Model\Entity;

class UserEntity
{
	  
	protected $iduser;
	protected $email;
	protected $changermotdepasse;
	protected $password;
	protected $first_name;
	protected $last_name;
	protected $datechangepwd;
	protected $views;
	protected $created;
	protected $modified;
	protected $historiqueaccount;
	protected $confirmer;
	protected $role_id;
	protected $active;

	 
 

	/**
	 * Get the value of email
	 *
	 * @return  email
	 */ 
	public function getEmail()
	{
		return $this->email;
	}

	/**
	 * Set the value of email
	 *
	 * @param  email  $email
	 *
	 * @return  self
	 */ 
	public function setEmail($email)
	{
		$this->email = $email;

		return $this;
	}

	/**
	 * Get the value of changermotdepasse
	 */ 
	public function getChangermotdepasse()
	{
		return $this->changermotdepasse;
	}

	/**
	 * Set the value of changermotdepasse
	 *
	 * @return  self
	 */ 
	public function setChangermotdepasse($changermotdepasse)
	{
		$this->changermotdepasse = $changermotdepasse;

		return $this;
	}

	/**
	 * Get the value of password
	 */ 
	public function getPassword()
	{
		return $this->password;
	}

	/**
	 * Set the value of password
	 *
	 * @return  self
	 */ 
	public function setPassword($password)
	{
		$this->password = $password;

		return $this;
	}

	/**
	 * Get the value of first_name
	 */ 
	public function getFirst_name()
	{
		return $this->first_name;
	}

	/**
	 * Set the value of first_name
	 *
	 * @return  self
	 */ 
	public function setFirst_name($first_name)
	{
		$this->first_name = $first_name;

		return $this;
	}

	/**
	 * Get the value of last_name
	 */ 
	public function getLast_name()
	{
		return $this->last_name;
	}

	/**
	 * Set the value of last_name
	 *
	 * @return  self
	 */ 
	public function setLast_name($last_name)
	{
		$this->last_name = $last_name;

		return $this;
	}

	/**
	 * Get the value of datechangepwd
	 */ 
	public function getDatechangepwd()
	{
		return $this->datechangepwd;
	}

	/**
	 * Set the value of datechangepwd
	 *
	 * @return  self
	 */ 
	public function setDatechangepwd($datechangepwd)
	{
		$this->datechangepwd = $datechangepwd;

		return $this;
	}

	/**
	 * Get the value of views
	 */ 
	public function getViews()
	{
		return $this->views;
	}

	/**
	 * Set the value of views
	 *
	 * @return  self
	 */ 
	public function setViews($views)
	{
		$this->views = $views;

		return $this;
	}

	/**
	 * Get the value of created
	 */ 
	public function getCreated()
	{
		return $this->created;
	}

	/**
	 * Set the value of created
	 *
	 * @return  self
	 */ 
	public function setCreated($created)
	{
		$this->created = $created;

		return $this;
	}

	/**
	 * Get the value of modified
	 */ 
	public function getModified()
	{
		return $this->modified;
	}

	/**
	 * Set the value of modified
	 *
	 * @return  self
	 */ 
	public function setModified($modified)
	{
		$this->modified = $modified;

		return $this;
	}

	/**
	 * Get the value of historiqueaccount
	 */ 
	public function getHistoriqueaccount()
	{
		return $this->historiqueaccount;
	}

	/**
	 * Set the value of historiqueaccount
	 *
	 * @return  self
	 */ 
	public function setHistoriqueaccount($historiqueaccount)
	{
		$this->historiqueaccount = $historiqueaccount;

		return $this;
	}

	/**
	 * Get the value of confirmer
	 */ 
	public function getConfirmer()
	{
		return $this->confirmer;
	}

	/**
	 * Set the value of confirmer
	 *
	 * @return  self
	 */ 
	public function setConfirmer($confirmer)
	{
		$this->confirmer = $confirmer;

		return $this;
	}

	/**
	 * Get the value of role_id
	 */ 
	public function getRole_id()
	{
		return $this->role_id;
	}

	/**
	 * Set the value of role_id
	 *
	 * @return  self
	 */ 
	public function setRole_id($role_id)
	{
		$this->role_id = $role_id;

		return $this;
	}

	/**
	 * Get the value of active
	 */ 
	public function getActive()
	{
		return $this->active;
	}

	/**
	 * Set the value of active
	 *
	 * @return  self
	 */ 
	public function setActive($active)
	{
		$this->active = $active;

		return $this;
	}

	 

	/**
	 * Get the value of iduser
	 */ 
	public function getIduser()
	{
		return $this->iduser;
	}

	/**
	 * Set the value of iduser
	 *
	 * @return  self
	 */ 
	public function setIduser($iduser)
	{
		$this->iduser = $iduser;

		return $this;
	}
}
