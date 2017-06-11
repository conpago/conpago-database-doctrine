<?php
namespace Conpago\Database\Doctrine;

use Conpago\Database\Doctrine\Contract\IDoctrineConfig;
use Doctrine\ORM\EntityManagerInterface;
use PHPUnit\Framework\TestCase;
use PHPUnit_Framework_MockObject_MockObject as MockObject;

class DoctrineDaoTest extends TestCase
{
    /** @var MockObject | IDoctrineConfig */
    private $doctrineConfig;

    /** @var MockObject | EntityManagerInterface */
    private $entityManager;

    /** @var DoctrineDao */
    private $doctrineDao;

    protected function setUp()
    {
        $this->doctrineConfig = $this->createMock(IDoctrineConfig::class);
        $this->entityManager = $this->createMock(EntityManagerInterface::class);
        $this->doctrineDao = new DoctrineDao($this->doctrineConfig, $this->entityManager);
    }

    public function testGetModelClassName()
    {
        $this->doctrineConfig->expects($this->any())->method('getModelNamespace')->willReturn('Model');
        $this->assertEquals('Model\Test', $this->doctrineDao->getModelClassName('Test'));
    }

    public function testGetEntityManager()
    {
        $this->assertSame($this->entityManager, $this->doctrineDao->getEntityManager());
    }
}
