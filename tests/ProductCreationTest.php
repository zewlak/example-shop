<?php
/**
 *  * Created by PhpStorm.
 * User: Tomasz Żewłakow <zewlak@gmail.com>
 * Date: 15.02.2018
 * Time: 20:39
 */

namespace App\Tests;

use App\Entity\DTO\ProductTypeDTO;
use Symfony\Component\Form\Test\TypeTestCase;
use Symfony\Component\Validator\Validation;

class ProductCreationTest extends TypeTestCase
{

    public function testProductTypeDTORequiredFields()
    {
        $validator = Validation::createValidatorBuilder()->enableAnnotationMapping()->getValidator();

        $productDTO = new ProductTypeDTO();

        $errors = $validator->validate($productDTO);

        $this->assertCount(3, $errors);
    }


    public function testProductTypeDTOUnexpectedData()
    {
        $validator = Validation::createValidatorBuilder()->enableAnnotationMapping()->getValidator();

        $formData = array(
            'name' => '', //empty
            'price' => 999999999, //too big
            'description' => 'Lorem', //too short
        );

        $errors = $validator->validate($this->prepareDto($formData));
        $this->assertCount(3, $errors);
    }

    public function testProductTypeDTOExpectedData()
    {
        $validator = Validation::createValidatorBuilder()->enableAnnotationMapping()->getValidator();

        $formData = array(
            'name' => 'Lorem ipsum', //empty
            'price' => 99999999, //too big
            'description' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. In at aliquet nibh. Donec mattis felis odio, in tristique justo auctor in. Curabitur vitae est dapibus, malesuada sem vitae, mattis libero. Pellentesque nec eleifend mi. Sed at volutpat turpis, in maximus ante. Donec non malesuada tortor. Etiam vestibulum efficitur porttitor. Suspendisse finibus, eros quis tincidunt tempor, turpis nisl ornare ipsum, et ullamcorper turpis felis faucibus sem.', //too short
        );

        $errors = $validator->validate($this->prepareDto($formData));
        $this->assertCount(0, $errors);
    }

    /**
     * Create and populate DTO.
     *
     * @param array $formData
     *
     * @return ProductTypeDTO
     */
    private function prepareDto(array $formData): ProductTypeDTO
    {
        $productDTO = new ProductTypeDTO();
        $productDTO->setName($formData['name']);
        $productDTO->setPrice($formData['price']);
        $productDTO->setDescription($formData['description']);

        return $productDTO;
    }
}
