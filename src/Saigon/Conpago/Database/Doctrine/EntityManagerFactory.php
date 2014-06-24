<?php
	/**
	 * Created by PhpStorm.
	 * User: Bartosz Gołek
	 * Date: 2014-06-24
	 * Time: 20:56
	 */

	namespace Saigon\Conpago\Database\Doctrine;

	use Doctrine\ORM\EntityManager;
	use Doctrine\ORM\EntityManagerInterface;
	use Doctrine\ORM\Tools\Setup;
	use Saigon\Conpago\Database\Contract\IDbConfig;
	use Saigon\Conpago\Database\Doctrine\Contract\IDoctrineConfig;

	class EntityManagerFactory
	{
		private $config;
		/**
		 * @var IDbConfig
		 */
		private $dbConfig;

		/**
		 * @var IDoctrineConfig
		 */
		private $doctrineConfig;

		/**
		 * @var array
		 */
		private $dbParams = null;

		/**
		 * @param IDbConfig $dbConfig
		 * @param IDoctrineConfig $doctrineConfig
		 */
		public function __construct(IDBConfig $dbConfig, IDoctrineConfig $doctrineConfig)
		{
			$this->dbConfig = $dbConfig;
			$this->doctrineConfig = $doctrineConfig;

			$paths = array($this->doctrineConfig->getModelPath());

			$this->setDbParams();
			$this->config = Setup::createAnnotationMetadataConfiguration($paths, $this->doctrineConfig->getDevMode());
		}

		private function setDbParams()
		{
			$this->dbParams = array(
				'driver' => $this->dbConfig->getDriver(),
				'user' => $this->dbConfig->getUser(),
				'password' => $this->dbConfig->getPassword(),
				'dbname' => $this->dbConfig->getDbName()
			);
		}

		/**
		 * @return EntityManagerInterface
		 */
		public function createEntityManager()
		{
			return EntityManager::create($this->dbParams, $this->config);
		}
	}