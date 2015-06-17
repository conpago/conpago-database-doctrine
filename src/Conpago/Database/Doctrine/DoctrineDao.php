<?php
	/**
	 * Created by PhpStorm.
	 * User: Bartosz Gołek
	 * Date: 09.11.13
	 * Time: 15:30
	 */

	namespace Conpago\Database\Doctrine;

	use Doctrine\ORM\EntityManagerInterface;
	use Conpago\Database\Doctrine\Contract\IDoctrineConfig;
	use Conpago\Database\Doctrine\Contract\IDoctrineDao;

	class DoctrineDao implements IDoctrineDao
	{
		/**
		 * @var IDoctrineConfig
		 */
		private $doctrineConfig;

		/**
		 * @var EntityManagerInterface
		 */
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
		 * @param $shortClassName
		 *
		 * @return string
		 */
		public function getModelClassName($shortClassName)
		{
			return $this->doctrineConfig->getModelNamespace() . "\\" . $shortClassName;
		}

		/**
		 * @return \Doctrine\ORM\EntityManagerInterface
		 */
		public function getEntityManager()
		{
			return $this->entityManager;
		}
	}
