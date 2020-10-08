<?php

use PHPUnit\Framework\TestCase;

class DbAddProduct {
  private AddProductRepository $addProductRepository;

  public function __construct(AddProductRepository $addProductRepository)
  {
    $this->addProductRepository = $addProductRepository;  
  }

  public function add(AddProductModel $addProductModel) {
    return $this->addProductRepository->add($addProductModel);
  }
}

final class DbAddProductTest extends TestCase
{
  private Faker\Generator $faker;
  private Product $product;
  private AddProductRepository $addProductRepositoryMock;
  private AddProductModel $addProductModel;

  protected function setUp() : void
  {
    $this->faker = Faker\Factory::create();
    $productType = new ProductType($this->faker->randomDigit(), $this->faker->name());
    $this->product = new Product($this->faker->randomDigit(), $this->faker->name(), $this->faker->randomFloat(), $productType);
    $this->addProductModel = new AddProductModel($this->faker->name(), $this->faker->randomFloat(), $productType);
  }

  private function mockSuccess() {
    $mock = $this->createMock('AddProductRepository');
    $mock->expects($this->once())
        ->method('add')
        ->willReturn($this->product)
        ->with($this->addProductModel);
    $this->addProductRepositoryMock = $mock;
  }

  private function mockThrows() {
    $mock = $this->createMock('AddProductRepository');
    $mock->expects($this->once())
        ->method('add')
        ->willThrowException(new Exception('any error'));
    $this->addProductRepositoryMock = $mock;
  }

  public function testShouldCallAddProductRepositoryWithCorrectValues(): void
  {
    $this->mockSuccess();

    $sut = new DbAddProduct($this->addProductRepositoryMock);

    $sut->add($this->addProductModel);
  }

  public function testShouldReturnProductOnSuccess(): void
  {
    $this->mockSuccess();

    $sut = new DbAddProduct($this->addProductRepositoryMock);

    $this->assertSame($this->product, $sut->add($this->addProductModel));
  }

  public function testShouldThrowIfRepositoryThrows(): void
  {
    $this->mockThrows();

    $sut = new DbAddProduct($this->addProductRepositoryMock);

    $this->expectException(Exception::class);
    $this->expectExceptionMessage('any error');
    $sut->add($this->addProductModel);
  }
}