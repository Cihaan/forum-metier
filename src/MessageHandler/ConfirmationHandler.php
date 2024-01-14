<?php

// namespace App\MessageHandler;

// use App\Message\ConfirmationMessage;
// use Symfony\Component\Mailer\MailerInterface;
// use Symfony\Component\Messenger\Handler\MessageHandlerInterface;
// use Symfony\Component\Mime\Email;
// use App\Entity\Utilisateur;
// use Doctrine\ORM\EntityManager;

// class ConfirmationHandler implements MessageHandlerInterface
// {
//   private $mailer;
//   private EntityManager $entityManager;

//   public function __construct(MailerInterface $mailer, EntityManager $entityManager)
//   {
//     $this->mailer = $mailer;
//     $this->entityManager = $entityManager;
//   }

//   public function __invoke(ConfirmationMessage $message)
//   {
//     $userId = $message->getUserId();

//     // Fetch the user by ID from the database (replace this with your actual user fetching logic)
//     $user = $this->entityManager->getRepository(Utilisateur::class)->find($userId);

//     // Send the confirmation email
//     $email = (new Email())
//       ->to($user->getEmail())
//       ->subject('Welcome to Your App!')
//       ->html('<p>Thank you for registering!</p>');

//     $this->mailer->send($email);
//   }
// }
