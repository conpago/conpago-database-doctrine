<?php
namespace Conpago\Database\Doctrine;

use Conpago\Database\Contract\IDbConfig;
use Conpago\Database\Doctrine\Contract\IDoctrineConfig;
use PHPUnit\Framework\TestCase;
use PHPUnit_Framework_MockObject_MockObject as MockObject;

class EntityManagerFactoryTest extends TestCase
{
    /** @var MockObject | IDbConfig */
    private $dbConfig;

    /** @var  MockObject | IDoctrineConfig */
    private $doctrineConfig;

    /** @var EntityManagerFactory */
    private $entityManagerFactory;

    public function setUp()
    {
        $this->dbConfig = $this->createMock(IDbConfig::class);
        $this->dbConfig->method('getConfig')->willReturn(array('driver' => 'pdo_sqlite'));

        $this->doctrineConfig = $this->createMock(IDoctrineConfig::class);
        $this->entityManagerFactory = new EntityManagerFactory($this->dbConfig, $this->doctrineConfig);
    }

    public function testCreateLogger()
    {
        $this->assertInstanceOf('Doctrine\ORM\EntityManager', $this->entityManagerFactory->createEntityManager());
    }
}
