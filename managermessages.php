<?php

class ManagerMessages
{
	private $bdd;

	public function __construct($bdd)
  {
    $this->setBdd($bdd);
  }

  	public function add(Messages $message)
	{

		$req = $this->bdd->prepare('INSERT INTO message (nom, email, tel, message) VALUES(:nom, :email, :tel, :message');
    
    $req->bindValue(':nom', $message->getNom());  
    $req->bindValue(':email', $message->getEmail());
    $req->bindValue(':tel', $message->getTel());
    $req->bindValue(':message', $message->getMessage());

    $req->execute();


  	}

  	public function get($id)
  	{

    $req = $this->bdd->prepare('SELECT id, nom, email, tel, message FROM message WHERE id = :id');
    $req->bindValue(':id', (int) $id, PDO::PARAM_INT);
    $req->execute();
    
    $req->setFetchMode(PDO::FETCH_CLASS | PDO::FETCH_PROPS_LATE, 'Messages');

    $messages = $req->fetch();

    return $messages;

  	}

  	public function getList()
  	{
     	$messages = [];

    	$req = $this->bdd->query('SELECT id, nom, email, tel, message FROM message ORDER BY id DESC');

    		while ($donnees = $req->fetch(PDO::FETCH_ASSOC))
    		{
     			 $messages[] = new Messages($donnees);
    		}

    	return $messages;
  	}

    public function setBDD($bdd)
    {

    $this->bdd = $bdd;
    }

}
