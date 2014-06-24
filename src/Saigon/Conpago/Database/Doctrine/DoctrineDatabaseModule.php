<?php
	/**
	 * Created by PhpStorm.
	 * User: Bartosz Gołek
	 * Date: 2014-06-24
	 * Time: 21:01
	 */

	namespace Saigon\Conpago\Database\Doctrine;

	use Saigon\Conpago\DI\IContainerBuilder;
	use Saigon\Conpago\IModule;

	class DoctrineDatabaseModule implements IModule
	{

		public function build(IContainerBuilder $builder)
		{
			$builder
				->registerType('Saigon\Conpago\Database\Doctrine\EntityManagerFactory');

			$builder
				->register(function (IContainer $c)
				{
					/** @var EntityManagerFactory $entityManagerFactory */
					$entityManagerFactory = $c->resolve('Saigon\Conpago\Database\Doctrine\EntityManagerFactory');

					return $entityManagerFactory->createEntityManager();
				})
				->asA('Doctrine\ORM\EntityManagerInterface');
		}
	}