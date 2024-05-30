<?php

use PHPUnit\Framework\TestCase;

class HelperTest extends TestCase
{
    private $helper;
    private $mockCon;

    protected function setUp(): void
    {
        $this->mockCon = $this->createMock(mysqli::class);
        
        $this->helper = new Helper($this->mockCon);
    }

    public function testGenerationToken()
    {
        $tokenLength = 32;
        $token = $this->helper->generationToken($tokenLength);

        $this->assertEquals($tokenLength, strlen($token));
        $this->assertMatchesRegularExpression('/^[a-zA-Z0-9]+$/', $token);
    }

    public function testEscapeString()
    {
        $input = "O'Reilly";
        $escapedInput = "O&#039;Reilly";

        $this->mockCon->expects($this->once())
                      ->method('real_escape_string')
                      ->with($input)
                      ->willReturn(mysqli_real_escape_string($this->mockCon, $input));

        $this->assertEquals($escapedInput, $this->helper->escape_srting($input));
    }


    public function testCheckImgInvalidExtension()
    {
        $_FILES['testImg'] = [
            'name' => 'image.txt',
            'size' => 5000000
        ];

        $this->expectException(\Exception::class);
        $this->expectExceptionMessage("Invalid image extension");
        $this->helper->checkImg('testImg');
    }

    public function testCheckImgInvalidSize()
    {
        $_FILES['testImg'] = [
            'name' => 'image.jpg',
            'size' => 20000000
        ];

        $this->expectException(\Exception::class);
        $this->expectExceptionMessage("Image size exceeds limit");
        $this->helper->checkImg('testImg');
    }
}