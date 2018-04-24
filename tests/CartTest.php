<?php

namespace tests;

use App\Cart;
use PHPUnit\Framework\TestCase;

class CartTest extends TestCase
{
	/**
	 * @return void
	 */
	public function testCalculateDiscount(): void
	{
		/* @var $cart Cart|\PHPUnit_Framework_MockObject_MockObject */
		$cart = $this
			->getMockBuilder(Cart::class)
			->disableOriginalConstructor()
			->setMethods(['isMultipleOf5'])
			->getMock();

		$cart->method('isMultipleOf5')->willReturn(true);

		$this->assertEquals(50, $cart->calculateDiscount());
	}

	/**
	 * @return void
	 */
	public function testCalculateDiscountZero(): void
	{
		/* @var $cart Cart|\PHPUnit_Framework_MockObject_MockObject */
		$cart = $this
			->getMockBuilder(Cart::class)
			->disableOriginalConstructor()
			->setMethods(['isMultipleOf5'])
			->getMock();

		$cart->method('isMultipleOf5')->willReturn(false);

		$this->assertEquals(0, $cart->calculateDiscount());
	}

	/**
	 * @dataProvider dataProvider
	 *
	 * @param int $orderNumber
	 * @param bool $expected
	 *
	 * @return void
	 */
	public function testIsMultipleOf5(int $orderNumber, bool $expected): void
	{
		/* @var $cart Cart|\PHPUnit_Framework_MockObject_MockObject */
		$cart = $this
			->getMockBuilder(Cart::class)
			->disableOriginalConstructor()
			->setMethods([
				'getOrderNumber',
			])
			->getMock();

		$cart->method('getOrderNumber')->willReturn($orderNumber);

		$this->assertEquals($expected, $cart->isMultipleOf5());
	}

	/**
	 * Данные для тестирования
	 */
	public function dataProvider(): array
	{
		return [
			[
				'orderNumber' => 5,
				'expected' => true,
			],
			[
				'orderNumber' => 1,
				'expected' => false,
			],
			[
				'orderNumber' => 10,
				'expected' => true,
			],
		];
	}

	/**
	 * @dataProvider dataProviderOrderNumber
	 *
	 * @param $orderNumber
	 * @param int $expected
	 *
	 * @return void
	 */
	public function testGetOrderNumber($orderNumber, int $expected): void
	{
		$_SESSION['orderNumber'] = $orderNumber;

		$cart = new Cart();
		$this->assertSame($expected, $cart->getOrderNumber());
	}

	/**
	 * Данные для тестирования
	 */
	public function dataProviderOrderNumber(): array
	{
		return [
			[
				'orderNumber' => 1,
				'expected' => 1,
			],
			[
				'orderNumber' => 555,
				'expected' => 555,
			],
			[
				'orderNumber' => '777',
				'expected' => 777,
			],
		];
	}
}