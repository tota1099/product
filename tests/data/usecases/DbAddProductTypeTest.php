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

  private DbAddProductType $sut;
  private ProductType $productType;
  private AddProductTypeRepository $addProductTypeRepositoryMock;
  private AddProductTypeModel $addProductTypeModel;

  protected function setUp() : void
  {
    $faker = Faker\Factory::create();
    $this->productType = new ProductType($faker->randomDigit(), $faker->name());
  }

  private function mockSuccess() {
    $faker = Faker\Factory::create();
    $this->addProductTypeModel = new AddProductTypeModel($faker->name());
    $mock = $this->prophesize(AddProductTypeRepository::class);
    $mock->add($this->addProductTypeModel)->willReturn($this->productType)->shouldBeCalledOnce();
    $this->addProductTypeRepositoryMock = $mock->reveal();
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
}