<?php

namespace App;

/**
 * Корзина с просчетом скидки
 */
class Cart
{
	/**
	 * Получить величину скидки
	 *
	 * @return int
	 */
	public function calculateDiscount(): int
	{
		return $this->isMultipleOf5() ? 50 : 0;
	}

	/**
	 * Кратность номера заказа
	 *
	 * @return bool
	 */
	public function isMultipleOf5(): bool
	{
		return $this->getOrderNumber() % 5 === 0;
	}

	/**
	 * Номер заказа
	 *
	 * @return int
	 */
	public function getOrderNumber(): int
	{
		return $_SESSION['orderNumber'];
	}
}
