<?php
	/**
	 * Created by PhpStorm.
	 * User: Bartosz Gołek
	 * Date: 2014-06-24
	 * Time: 21:13
	 */

	namespace Conpago\Database\Doctrine;

	class EntityManagerFactoryTest extends \PHPUnit_Framework_TestCase
	{
		private $dbConfig;
		private $doctrineConfig;

		/**
		 * @var EntityManagerFactory
		 */
		private $entityManagerFactory;

		protected function setUp()
		{
			$this->getDbConfigMock();

			$this->doctrineConfig = $this->getMock('Conpago\Database\Doctrine\Contract\IDoctrineConfig');
			$this->entityManagerFactory = new EntityManagerFactory($this->dbConfig, $this->doctrineConfig);
		}

		function testCreateLogger()
		{
			$this->assertInstanceOf('Doctrine\ORM\EntityManager', $this->entityManagerFactory->createEntityManager());
		}

		protected function getDbConfigMock()
		{
			$this->dbConfig = $this->getMock('Conpago\Database\Contract\IDbConfig');
			$this->dbConfig->expects($this->any())->method('getConfig')->willReturn(array('driver' => 'pdo_sqlite'));
		}
	}
