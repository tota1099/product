<?php

use PHPUnit\Framework\TestCase;

class DbAddProductType {
  private AddProductTypeRepository $addProductTypeRepository;

  public function __construct(AddProductTypeRepository $addProductTypeRepository)
  {
    $this->addProductTypeRepository = $addProductTypeRepository;  
  }

  public function add(AddProductTypeModel $addProductModel) {
    return $this->addProductTypeRepository->add($addProductModel);
  }
}

final class DbAddProductTypeTest extends TestCase
{
  private Faker\Generator $faker;
  private DbAddProductType $sut;
  private ProductType $productType;
  private AddProductTypeRepository $addProductTypeRepositoryMock;
  private AddProductTypeModel $addProductTypeModel;

  protected function setUp() : void
  {
    $this->faker = Faker\Factory::create();
    $this->productType = new ProductType($this->faker->randomDigit(), $this->faker->name());
    $this->addProductTypeModel = new AddProductTypeModel($this->faker->name());
  }

  private function mockSuccess() {
    $mock = $this->createMock('AddProductTypeRepository');
    $mock->expects($this->once())
        ->method('add')
        ->willReturn($this->productType);
    $this->addProductTypeRepositoryMock = $mock;
  }

  private function mockThrows() {
    $mock = $this->createMock('AddProductTypeRepository');
    $mock->expects($this->once())
        ->method('add')
        ->willThrowException(new Exception('any error'));
    $this->addProductTypeRepositoryMock = $mock;
  }

  public function testShouldCallAddProductRepositoryWithCorrectValues(): void
  {
    $this->mockSuccess();

    $sut = new DbAddProductType($this->addProductTypeRepositoryMock);

    $sut->add($this->addProductTypeModel);
  }

  public function testShouldReturnProductTypeOnSuccess(): void
  {
    $this->mockSuccess();

    $sut = new DbAddProductType($this->addProductTypeRepositoryMock);

    $this->assertSame($this->productType, $sut->add($this->addProductTypeModel));
  }

  public function testShouldThrowIfRepositoryThrows(): void
  {
    $this->mockThrows();

    $sut = new DbAddProductType($this->addProductTypeRepositoryMock);

    $this->expectException(Exception::class);
    $this->expectExceptionMessage('any error');
    $sut->add($this->addProductTypeModel);
  }
}