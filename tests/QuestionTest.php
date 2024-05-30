<?php

use PHPUnit\Framework\TestCase;

class QuestionTest extends TestCase
{
    private $question;
    private $mockCon;
    private $mockHelper;

    protected function setUp(): void
    {
        $this->mockCon = $this->createMock(DB::class);
        $this->mockHelper = $this->createMock(Helper::class);

        $this->question = new Question($this->mockCon, $this->mockHelper);
    }

    public function testGetAll()
    {
        $query = "SELECT * FROM `questions`;";
        $result = [['1', 'What is PHP?', 'A scripting language']];

        $this->question = $this->getMockBuilder(Question::class)
            ->setConstructorArgs([$this->mockCon, $this->mockHelper])
            ->onlyMethods(['returnAllNum'])
            ->getMock();

        $this->question->expects($this->once())
            ->method('returnAllNum')
            ->with($query)
            ->willReturn($result);

        $this->assertEquals($result, $this->question->getAll());
    }

    public function testGetShowAll()
    {
        $query = "SELECT * FROM `questions`;";
        $result = [['question_id' => '1', 'question_text' => 'What is PHP?', 'question_answer' => 'A scripting language']];

        $this->question = $this->getMockBuilder(Question::class)
            ->setConstructorArgs([$this->mockCon, $this->mockHelper])
            ->onlyMethods(['returnAllAssoc'])
            ->getMock();

        $this->question->expects($this->once())
            ->method('returnAllAssoc')
            ->with($query)
            ->willReturn($result);

        $this->assertEquals($result, $this->question->getShowAll());
    }

    public function testAdd()
    {
        $question = 'What is PHPUnit?';
        $answer = 'A unit testing framework for PHP';
        $query = "INSERT INTO `questions` (`question_text`, `question_answer`) VALUES ('$question', '$answer');";

        $this->question = $this->getMockBuilder(Question::class)
            ->setConstructorArgs([$this->mockCon, $this->mockHelper])
            ->onlyMethods(['actionQuery'])
            ->getMock();

        $this->question->expects($this->once())
            ->method('actionQuery')
            ->with($query);

        $this->question->add($question, $answer);
    }

    public function testDelete()
    {
        $id = 1;
        $query = "DELETE FROM `questions` WHERE `question_id` = $id;";

        $this->question = $this->getMockBuilder(Question::class)
            ->setConstructorArgs([$this->mockCon, $this->mockHelper])
            ->onlyMethods(['actionQuery'])
            ->getMock();

        $this->question->expects($this->once())
            ->method('actionQuery')
            ->with($query);

        $this->question->delete($id);
    }

    public function testEdit()
    {
        $question = 'What is PHP?';
        $answer = 'A popular scripting language';
        $id = 1;
        $query = "UPDATE `questions` SET `question_text` = '$question', `question_answer` = '$answer' WHERE `question_id` = $id;";

        $this->question = $this->getMockBuilder(Question::class)
            ->setConstructorArgs([$this->mockCon, $this->mockHelper])
            ->onlyMethods(['actionQuery'])
            ->getMock();

        $this->question->expects($this->once())
            ->method('actionQuery')
            ->with($query);

        $this->question->edit($question, $answer, $id);
    }

    public function testGetById()
    {
        $id = 1;
        $query = "SELECT * FROM `questions` WHERE `question_id` = $id";
        $result = ['question_id' => '1', 'question_text' => 'What is PHP?', 'question_answer' => 'A scripting language'];

        $this->question = $this->getMockBuilder(Question::class)
            ->setConstructorArgs([$this->mockCon, $this->mockHelper])
            ->onlyMethods(['returnActionQuery'])
            ->getMock();

        $mysqliResultMock = $this->createMock(mysqli_result::class);
        $mysqliResultMock->method('fetch_assoc')->willReturn($result);

        $this->question->expects($this->once())
            ->method('returnActionQuery')
            ->with($query)
            ->willReturn($mysqliResultMock);

        $this->assertEquals($result, $this->question->getById($id));
    }
}