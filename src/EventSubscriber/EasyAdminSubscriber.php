<?php

namespace App\EventSubscriber;

use App\Entity\User;
use Doctrine\ORM\EntityManagerInterface;
use EasyCorp\Bundle\EasyAdminBundle\Event\BeforeEntityPersistedEvent;
use EasyCorp\Bundle\EasyAdminBundle\Event\BeforeEntityUpdatedEvent;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use Symfony\Component\Security\Core\Event\AuthenticationSuccessEvent;

class EasyAdminSubscriber implements EventSubscriberInterface
{
    public function __construct(
        private readonly EntityManagerInterface $entityManager,
        private readonly UserPasswordHasherInterface $passwordHasher,
    )
    {
    }

    public static function getSubscribedEvents(): array
    {
        return [
            BeforeEntityPersistedEvent::class => 'beforePersist',
            BeforeEntityUpdatedEvent::class => 'beforeUpdate',
        ];
    }

    public function beforePersist(BeforeEntityPersistedEvent $event): void
    {
        $entity = $event->getEntityInstance();

        // Gestion des utilisateurs
        if ($entity instanceof User){
            $newUser = new User();
            $newUser->setEmail($entity->getEmail());
            $newUser->setPassword($this->passwordHasher->hashPassword($newUser, $entity->getPassword()));
            $newUser->setRoles($entity->getRoles());
            $newUser->setStatut(true);
            $this->entityManager->persist($newUser);
            $this->entityManager->flush();
        }
    }

    public function beforeUpdate(BeforeEntityUpdatedEvent $event): void
    {
        $entity = $event->getEntityInstance();

        if ($entity instanceof User){
            $entity->setPassword($this->passwordHasher->hashPassword($entity, $entity->getPassword()));
            $this->entityManager->flush();
        }
    }
}
