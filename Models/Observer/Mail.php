<?php
/**
 * Primer Observador Envia Email
 */
class Mail implements \SplObserver{
	
	/* (non-PHPdoc)
	 * @see SplObserver::update()
	 */
	public function update(\SplSubject $subject) {
		echo 'Enviando Email con marcador ' . $subject->getScore() . PHP_EOL;
		mail('cirupeto@gmail.com', 'Hubo un gol', $subject->getScore());
	}
	
}