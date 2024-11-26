<?php

namespace App\EventSubscriber;

use App\Entity\Category;
use App\Entity\Product;
use Doctrine\Bundle\DoctrineBundle\EventSubscriber\EventSubscriberInterface;
use Doctrine\ORM\Event\PostRemoveEventArgs;
use Doctrine\ORM\Events;
use Symfony\Component\HttpKernel\KernelInterface;

class DatabaseActivitySubscriber implements EventSubscriberInterface
{
    private $appKernel;
    private $rootDir;

    public function __construct(KernelInterface $appKernel)
    {
        $this->appKernel = $appKernel;
        $this->rootDir = $appKernel->getProjectDir();
    }

    public function getSubscribedEvents(): array
    {
        return [
            Events::postRemove,
        ];
    }

    public function postRemove(PostRemoveEventArgs $args): void
    {
        $this->logActivity('remove', $args->getObject());
    }

    public function logActivity(string $action,mixed $entity): void
    {
        //dd($entity);
        if(($entity instanceof Product) && $action === "remove" ){
            $imageUrls = $entity->getImageUrls();

            foreach ($imageUrls as $imageUrl) {
                $filelink = $this->rootDir."/public/assets/images/products/".$imageUrl;
                $this->deleteImage($filelink);
            }
            
            
        }
        if(($entity instanceof Category) && $action === "remove" ){
            $filename = $entity->getImageUrl();
            // unlink("../../public/assets/images/categories/"+$filename);
            $filelink = $this->rootDir."/public/assets/images/categories/".$filename;
            $this->deleteImage($filelink);
           
        }
    }

    public function deleteImage(string $filelink): void {
        try {
            $result =unlink($filelink);
        } catch (\Throwable $th) {
            //throw $th;
        }
    }

}
