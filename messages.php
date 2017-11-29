<?php

class Messages
{

	private $id;
	private $nom;
	private $email;
	private $tel;
	private $message;


	public function __construct($value = [])
	{
		if (!empty($value))
		{

			$this->hydrate($value);
		}
	}

	public function hydrate(array $donnees)
	{
		foreach ($donnees as $key => $value)
		{
			$method = 'set'.ucfirst($key);
		
			if (method_exists($this, $method)) 
			{
			$this->$method($value);
			}
		}
	}

	public function setId($id)
	{
		

		$id = (int) $id;

			if ($id > 0)
			{

				$this->id = $id;

			}
	}

	public function getId()
	{
		return $this->id;

	}

	public function setNom($nom)
	{
		
		if (is_string($nom))
		{
		$this->nom = $nom;
		}

	}

	public function getNom()
	{	
		return $this->nom;

	}

	public function setEmail($email)
	{
		
          $this->email = $email;
        
		
	}

	public function getEmail()
	{
		return $this->email;

	}

	public function setTel($tel)
	{
		
			$this->tel = $tel;
		
		
	}

	public function getTel()
	{
		return $this->tel;

	}

	public function setMessage($message)
	{
		if (is_string($message))
		{
		$this->message = $message;
		}
	}

	public function getMessage()
	{
		return $this->message;

	}
	
}