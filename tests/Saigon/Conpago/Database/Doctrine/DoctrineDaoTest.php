<?php
	/**
	 * Created by PhpStorm.
	 * User: Bartosz Gołek
	 * Date: 2014-06-24
	 * Time: 21:23
	 */

	namespace Saigon\Conpago\Database\Doctrine;

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

		private $doctrineDao;

		protected function setUp()
		{
			$this->doctrineConfig = $this->getMock('Saigon\Conpago\Database\Doctrine\Contract\IDoctrineConfig');
			$this->entityManager = $this->getMock('Doctrine\ORM\EntityManagerInterface');
			$this->doctrineDao = new TestDoctrineDao($this->doctrineConfig, $this->entityManager);
		}

		function testGetModelClassName()
		{
			$this->doctrineConfig->expects($this->any())->method('getModelNamespace')->willReturn('Model');
			$this->assertEquals('Model\Test', $this->doctrineDao->publicGetModelClassName('Test'));
		}

		function testGetEntityManager()
		{
			$this->assertSame($this->entityManager, $this->doctrineDao->publicGetEntityManager());
		}
	}

	class TestDoctrineDao extends DoctrineDao
	{
		function publicGetModelClassName($shortClassName)
		{
			return $this->getModelClassName($shortClassName);
		}

		function publicGetEntityManager()
		{
			return $this->getEntityManager();
		}
	}