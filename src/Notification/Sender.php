<?php

namespace App\Notification;

use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\Mime\Email;
use Symfony\Component\Security\Core\User\UserInterface;

class Sender
{
	/* Méthode de mailer pour php<8.0
	protected  $mailer;
	public function __construct(MailerInterface $mailer){
		$this->mailer = $mailer;
	A partir de la 8, cela se fait juste dans la déclaration.
	}*/
	public function __construct(protected MailerInterface $mailer)
	{}

	public function sendNewUserNotificationToAdmin(UserInterface $user)
	{
		//Pour tester, fonctionne parfaitement
		//file_put_contents('debug.txt', $user->getEmail());

		$message = new Email();
		$message->from('accounts@series.com')
				->to('admin@series.com')
				->subject('new account created on series.com!')
				->html('<h1>New account!</h1>email: '. $user->getEmail());

		$this->mailer ->send($message);



	}
}