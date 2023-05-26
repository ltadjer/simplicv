<?php

namespace App\EventSubscriber;

use App\Entity\CoverLetterModel;
use App\Entity\CVModel;
use DateTime;
use EasyCorp\Bundle\EasyAdminBundle\Event\BeforeEntityPersistedEvent;
use EasyCorp\Bundle\EasyAdminBundle\Event\BeforeEntityUpdatedEvent;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;


class EasyAdminSubscriber implements EventSubscriberInterface
{
    public static function getSubscribedEvents()
    {
        return [
            BeforeEntityPersistedEvent::class => ['setCreatedAt'],
            BeforeEntityUpdatedEvent::class => ['setUpdatedAt'],
        ];
    }

    public function setCreatedAt(BeforeEntityPersistedEvent $event)
    {
        $entityInstance = $event->getEntityInstance();
        if (!$entityInstance instanceof CVModel && !$entityInstance instanceof CoverLetterModel) return;
        $entityInstance->setCreatedAt(new \DateTimeImmutable);
    }

    public function setUpdatedAt(BeforeEntityUpdatedEvent $event)
    {
        $entityInstance = $event->getEntityInstance();
        if (!$entityInstance instanceof CVModel && !$entityInstance instanceof CoverLetterModel) {
            return;
        }
    
        $entityInstance->setUpdatedAt(new \DateTime());
    }
    
    
}
