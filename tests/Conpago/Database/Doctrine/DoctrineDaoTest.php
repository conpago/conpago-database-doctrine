<?php
	/**
	 * Created by PhpStorm.
	 * User: Bartosz Gołek
	 * Date: 2014-06-24
	 * Time: 21:23
	 */

	namespace Conpago\Database\Doctrine;

	use Conpago\Database\Doctrine\Contract\IDoctrineConfig;
    use Doctrine\ORM\EntityManagerInterface;

    class DoctrineDaoTest extends \PHPUnit_Framework_TestCase
	{
		/**
		 * @var \PHPUnit_Framework_MockObject_MockObject
		 */
		private $doctrineConfig;
		/**
		 * @var \PHPUnit_Framework_MockObject_MockObject
		 */
		private $entityManager;

		/**
		 * @var DoctrineDao
		 */
		private $doctrineDao;

		protected function setUp()
		{
			$this->doctrineConfig = $this->createMock(IDoctrineConfig::class);
			$this->entityManager = $this->createMock(EntityManagerInterface::class);
			$this->doctrineDao = new DoctrineDao($this->doctrineConfig, $this->entityManager);
		}

		function testGetModelClassName()
		{
			$this->doctrineConfig->expects($this->any())->method('getModelNamespace')->willReturn('Model');
			$this->assertEquals('Model\Test', $this->doctrineDao->getModelClassName('Test'));
		}

		function testGetEntityManager()
		{
			$this->assertSame($this->entityManager, $this->doctrineDao->getEntityManager());
		}
	}
