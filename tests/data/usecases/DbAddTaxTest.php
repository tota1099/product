<?php

use PHPUnit\Framework\TestCase;

final class DbAddTaxTest extends TestCase
{
  private Faker\Generator $faker;
  private Tax $Tax;
  private AddTaxRepository $addTaxRepositoryMock;
  private AddTaxModel $addTaxModel;

  protected function setUp() : void
  {
    $this->faker = Faker\Factory::create();
    $this->Tax = new Tax($this->faker->randomDigit(), $this->faker->name(), $this->faker->randomFloat());
    $this->addTaxModel = new AddTaxModel($this->faker->name(), $this->faker->randomFloat());
  }

  private function mockSuccess() {
    $mock = $this->createMock('AddTaxRepository');
    $mock->expects($this->once())
        ->method('add')
        ->willReturn($this->Tax)
        ->with($this->addTaxModel);
    $this->addTaxRepositoryMock = $mock;
  }

  private function mockThrows() {
    $mock = $this->createMock('AddTaxRepository');
    $mock->expects($this->once())
        ->method('add')
        ->willThrowException(new Exception('any error'));
    $this->addTaxRepositoryMock = $mock;
  }

  public function testShouldCallAddTaxRepositoryWithCorrectValues(): void
  {
    $this->mockSuccess();

    $sut = new DbAddTax($this->addTaxRepositoryMock);

    $sut->add($this->addTaxModel);
  }

  public function testShouldReturnTaxOnSuccess(): void
  {
    $this->mockSuccess();

    $sut = new DbAddTax($this->addTaxRepositoryMock);

    $this->assertSame($this->Tax, $sut->add($this->addTaxModel));
  }

  public function testShouldThrowIfRepositoryThrows(): void
  {
    $this->mockThrows();

    $sut = new DbAddTax($this->addTaxRepositoryMock);

    $this->expectException(Exception::class);
    $this->expectExceptionMessage('any error');
    $sut->add($this->addTaxModel);
  }
}