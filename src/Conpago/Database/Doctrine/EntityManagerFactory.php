<?php
	/**
	 * Created by PhpStorm.
	 * User: Bartosz Gołek
	 * Date: 2014-06-24
	 * Time: 20:56
	 */

	namespace Conpago\Database\Doctrine;

	use Doctrine\ORM\EntityManager;
	use Doctrine\ORM\EntityManagerInterface;
	use Doctrine\ORM\Tools\Setup;
	use Conpago\Database\Contract\IDbConfig;
	use Conpago\Database\Doctrine\Contract\IDoctrineConfig;

	/**
	 * Class EntityManagerFactory
	 *
	 * @package Conpago\Database\Doctrine
	 *
	 * @SuppressWarnings(PHPMD.StaticAccess)
	 */
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
			$this->config = Setup::createAnnotationMetadataConfiguration($paths, $this->doctrineConfig->isInDevMode());
		}

		private function setDbParams()
		{
			$this->dbParams = $this->dbConfig->getConfig();
		}

		/**
		 * @return EntityManagerInterface
		 */
		public function createEntityManager()
		{
			return EntityManager::create($this->dbParams, $this->config);
		}
	}
