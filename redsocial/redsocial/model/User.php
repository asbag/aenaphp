<?php
//namespace redsocial;

class User {
	/**
	 * ID
	 * @var integer
	 */
	private $id;
	/**
	 * FIRSTNAME
	 * @var string
	 */
	private $firstname;
	/**
	 * SURNAME
	 * @var string
	 */
	private $surname;
	/**
	 * SURNAME2
	 * @var string
	 */
	private $surname2;
	/**
	 * EMAIL
	 * @var string
	 */
	private $email;
	/**
	 * AGE
	 * @var integer
	 */
	private $age;
	/**
	 * BIRTHDATE
	 * @var DateTime
	 */
	private $birthdate;
	/**
	 * LOGIN
	 * @var string
	 */
	private $login;
	
	
	public function getId() {
		return $this->id;
	}
	public function setId($id) {
		$this->id = $id;
		return $this;
	}
	public function getFirstname() {
		return $this->firstname;
	}
	public function setFirstname($firstname) {
		$this->firstname = $firstname;
		return $this;
	}
	public function getSurname() {
		return $this->surname;
	}
	public function setSurname($surname) {
		$this->surname = $surname;
		return $this;
	}
	public function getSurname2() {
		return $this->surname2;
	}
	public function setSurname2($surname2) {
		$this->surname2 = $surname2;
		return $this;
	}
	public function getEmail() {
		return $this->email;
	}
	public function setEmail($email) {
		$this->email = $email;
		return $this;
	}
	public function getAge() {
		return $this->age;
	}
	public function setAge($age) {
		$this->age = $age;
		return $this;
	}
	public function getBirthdate() {
		return $this->birthdate;
	}
	public function setBirthdate(DateTime $birthdate) {
		$this->birthdate = $birthdate;
		return $this;
	}
	public function getLogin() {
		return $this->login;
	}
	public function setLogin($login) {
		$this->login = $login;
		return $this;
	}
	
}