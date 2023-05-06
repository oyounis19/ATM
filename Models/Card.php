<?php
class card{
    private string $id;
    private string $CVV;
    private $date;
    private bool $Blocked;

	public function getBlocked(): bool {
		return $this->Blocked;
	}
	
	
	public function setBlocked(bool $Blocked): self {
		$this->Blocked = $Blocked;
		return $this;
	}


	public function getDate() {
		return $this->date;
	}
	

	public function setDate($date): self {
		$this->date = $date;
		return $this;
	}


	public function getCVV(): string {
		return $this->CVV;
	}
	

	public function setCVV(string $CVV): self {
		$this->CVV = $CVV;
		return $this;
	}


	public function getId(): string {
		return $this->id;
	}
	

	public function setId(string $id): self {
		$this->id = $id;
		return $this;
	}
}
?>