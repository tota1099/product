<?php

use PHPUnit\Framework\TestCase;

final class DbAddProductTest extends TestCase
{
  private Faker\Generator $faker;
  private Product $product;
  private ProductRepository $addProductRepositoryMock;
  private ExistsProductTypeRepository $addProductTypeRepositoryMock;
  private AddProductModel $addProductModel;

  protected function setUp() : void
  {
    $this->faker = Faker\Factory::create();
    $this->product = new Product($this->faker->randomDigit(), $this->faker->name(), $this->faker->randomFloat(), $this->faker->randomDigit());
    $this->addProductModel = new AddProductModel($this->faker->name(), $this->faker->randomFloat(), $this->faker->randomDigit());
  }

  private function mockSuccess() {
    $mock = $this->createMock('ProductRepository');
    $mock->expects($this->once())
        ->method('add')
        ->willReturn($this->product)
        ->with($this->addProductModel);
    $this->addProductRepositoryMock = $mock;
    $mockType = $this->createMock('ExistsProductTypeRepository');
    $mockType->expects($this->once())
        ->method('exists')
        ->willReturn(true)
        ->with('id', $this->addProductModel->type);
    $this->addProductTypeRepositoryMock = $mockType;
  }

  private function mockThrows() {
    $mock = $this->createMock('ProductRepository');
    $mock->expects($this->once())
        ->method('add')
        ->willThrowException(new Exception('any error'));
    $this->addProductRepositoryMock = $mock;
    $mockType = $this->createMock('ExistsProductTypeRepository');
    $mockType->expects($this->once())
        ->method('exists')
        ->willReturn(true)
        ->with('id', $this->addProductModel->type);
    $this->addProductTypeRepositoryMock = $mockType;
  }

  public function testShouldCallProductRepositoryWithCorrectValues(): void
  {
    $this->mockSuccess();

    $sut = new DbAddProduct($this->addProductRepositoryMock, $this->addProductTypeRepositoryMock);

    $sut->add($this->addProductModel);
  }

  public function testShouldReturnProductOnSuccess(): void
  {
    $this->mockSuccess();

    $sut = new DbAddProduct($this->addProductRepositoryMock, $this->addProductTypeRepositoryMock);

    $this->assertSame($this->product, $sut->add($this->addProductModel));
  }

  public function testShouldThrowIfRepositoryThrows(): void
  {
    $this->mockThrows();

    $sut = new DbAddProduct($this->addProductRepositoryMock, $this->addProductTypeRepositoryMock);

    $this->expectException(Exception::class);
    $this->expectExceptionMessage('any error');
    $sut->add($this->addProductModel);
  }
}