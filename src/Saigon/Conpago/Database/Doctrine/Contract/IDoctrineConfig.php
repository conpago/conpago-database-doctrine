<?php
	/**
	 * Created by PhpStorm.
	 * User: Bartosz Gołek
	 * Date: 2014-06-24
	 * Time: 20:53
	 */

	namespace Saigon\Conpago\Database\Doctrine\Contract;

	interface IDoctrineConfig
	{
		public function getDevMode();

		public function getModelPath();

		public function getModelNamespace();
	}