<?php

namespace App\EventSubscriber;

use App\Entity\Management;
use App\Entity\User;
use Doctrine\ORM\EntityManagerInterface;
use EasyCorp\Bundle\EasyAdminBundle\Event\BeforeEntityPersistedEvent;
use EasyCorp\Bundle\EasyAdminBundle\Event\BeforeEntityUpdatedEvent;
use Symfony\Bundle\SecurityBundle\Security;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use Symfony\Component\Security\Core\Event\AuthenticationSuccessEvent;
use Symfony\Component\String\Slugger\AsciiSlugger;

class EasyAdminSubscriber implements EventSubscriberInterface
{
    public function __construct(
        private readonly EntityManagerInterface $entityManager,
        private readonly UserPasswordHasherInterface $passwordHasher,
        private readonly Security $security
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
        $user = $this->security?->getUser();


        // Gestion des utilisateurs
        if ($entity instanceof User){
            $entity->setPassword($this->passwordHasher->hashPassword($entity, $entity->getPassword()));
            $entity->setStatut(true);
            $this->entityManager->persist($entity);
            $this->entityManager->flush();
        }

        if ($entity instanceof Management){
            $entity->setSlug(new AsciiSlugger()->slug($entity->getTitre()));
            $entity->setCreatedBy($user?->getUserIdentifier());
            $this->entityManager->flush();
        }


    }

    public function beforeUpdate(BeforeEntityUpdatedEvent $event): void
    {
        $entity = $event->getEntityInstance();
        $user = $this->security?->getUser();

        if ($entity instanceof User){
            $entity->setPassword($this->passwordHasher->hashPassword($entity, $entity->getPassword()));
            $this->entityManager->flush();
        }

        if ($entity instanceof Management){
            $entity->setSlug(new AsciiSlugger()->slug($entity->getTitre()));
            $entity->setUpdatedBy($user?->getUserIdentifier());
            $this->entityManager->flush();
        }
    }
}
