<?php
	/**
	 * Created by PhpStorm.
	 * User: Bartosz Gołek
	 * Date: 09.11.13
	 * Time: 15:30
	 */

	namespace Saigon\Conpago\Database\Doctrine;

	use Doctrine\ORM\EntityManagerInterface;
	use Saigon\Conpago\Database\Doctrine\Contract\IDoctrineConfig;

	abstract class DoctrineDao
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
		protected function getModelClassName($shortClassName)
		{
			return $this->doctrineConfig->getModelNamespace() . "\\" . $shortClassName;
		}

		/**
		 * @return \Doctrine\ORM\EntityManager
		 */
		protected function getEntityManager()
		{
			return $this->entityManager;
		}
	}