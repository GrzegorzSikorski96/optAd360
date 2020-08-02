<?php

declare(strict_types=1);

namespace App\Service;

use App\Entity\Tag;
use App\Repository\TagRepository;
use Doctrine\ORM\EntityManagerInterface;

/**
 * Class TagService
 * @package App\Service
 */
class TagService extends BaseService
{
    /**
     * @var TagRepository
     */
    protected TagRepository $tagRepository;

    /**
     * TagService constructor.
     * @param EntityManagerInterface $entityManager
     * @param TagRepository $tagRepository
     */
    public function __construct(EntityManagerInterface $entityManager, TagRepository $tagRepository)
    {
        parent::__construct($entityManager);
        $this->tagRepository = $tagRepository;
    }

    /**
     * @param string $name
     * @return Tag
     */
    public function findOrCreate(string $name): Tag
    {
        $tag = $this->tagRepository->findOneBy(['name' => $name]);

        if (!$tag) {
            $tag = new Tag();
            $tag->setName($name);

            $this->entityManager->persist($tag);
            $this->entityManager->flush();
        }

        return $tag;
    }
}
