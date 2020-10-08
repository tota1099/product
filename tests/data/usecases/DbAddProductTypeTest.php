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
  use Prophecy\PhpUnit\ProphecyTrait;

  public function testShouldCallAddProductRepositoryWithCorrectValues(): void
  {
    $faker = Faker\Factory::create();
    $productData = new AddProductTypeModel($faker->name());
    $mock = $this->prophesize(AddProductTypeRepository::class);
    $productType = new ProductType($faker->randomDigit(), $faker->name());
    $mock->add($productData)->willReturn($productType)->shouldBeCalledOnce();

    $sut = new DbAddProductType($mock->reveal());
    $sut->add($productData);
  }

  public function testShouldReturnProductTypeOnSuccess(): void
  {
    $faker = Faker\Factory::create();
    $productData = new AddProductTypeModel($faker->name());
    $mock = $this->prophesize(AddProductTypeRepository::class);
    $productType = new ProductType($faker->randomDigit(), $faker->name());
    $mock->add($productData)->willReturn($productType)->shouldBeCalledOnce();

    $sut = new DbAddProductType($mock->reveal());
    $this->assertSame($productType, $sut->add($productData));
  }
}