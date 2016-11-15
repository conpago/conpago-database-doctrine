<?php
	/**
	 * Created by PhpStorm.
	 * User: Bartosz Gołek
	 * Date: 2014-06-24
	 * Time: 21:13
	 */

	namespace Conpago\Database\Doctrine;

	use Conpago\Database\Contract\IDbConfig;
    use Conpago\Database\Doctrine\Contract\IDoctrineConfig;

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

			$this->doctrineConfig = $this->createMock(IDoctrineConfig::class);
			$this->entityManagerFactory = new EntityManagerFactory($this->dbConfig, $this->doctrineConfig);
		}

		function testCreateLogger()
		{
			$this->assertInstanceOf('Doctrine\ORM\EntityManager', $this->entityManagerFactory->createEntityManager());
		}

		protected function getDbConfigMock()
		{
			$this->dbConfig = $this->createMock(IDbConfig::class);
			$this->dbConfig->expects($this->any())->method('getConfig')->willReturn(array('driver' => 'pdo_sqlite'));
		}
	}
