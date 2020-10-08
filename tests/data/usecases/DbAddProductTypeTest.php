<?php

use PHPUnit\Framework\TestCase;

class DbAddProductType {
  private AddProductTypeRepository $addProductTypeRepository;

  public function __construct(AddProductTypeRepository $addProductTypeRepository)
  {
    $this->addProductTypeRepository = $addProductTypeRepository;  
  }

  public function add(AddProductTypeModel $addProductModel) {
    $this->addProductTypeRepository->add($addProductModel);
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
    $mock->add($productData)->willReturn(new ProductType())->shouldBeCalledOnce();

    $sut = new DbAddProductType($mock->reveal());
    $sut->add($productData);
  }
}