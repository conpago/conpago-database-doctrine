<?php
namespace Conpago\Database\Doctrine;

use Doctrine\ORM\EntityManagerInterface;
use Conpago\Database\Doctrine\Contract\IDoctrineConfig;
use Conpago\Database\Doctrine\Contract\IDoctrineDao;

class DoctrineDao implements IDoctrineDao
{
    /** @var IDoctrineConfig */
    private $doctrineConfig;

    /** @var EntityManagerInterface */
    private $entityManager;

    /**
     * @param IDoctrineConfig $doctrineConfig
     * @param EntityManagerInterface $entityManager
     */
    public function __construct(IDoctrineConfig $doctrineConfig, EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
        $this->doctrineConfig = $doctrineConfig;
    }

    /**
     * @param string $shortClassName
     *
     * @return string
     */
    public function getModelClassName(string $shortClassName): string
    {
        return $this->doctrineConfig->getModelNamespace() . "\\" . $shortClassName;
    }

    /**
     * @return EntityManagerInterface
     */
    public function getEntityManager(): EntityManagerInterface
    {
        return $this->entityManager;
    }
}
