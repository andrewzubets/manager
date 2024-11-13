<?php

namespace Tests\Unit\Db;

use App\Models\Question;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class QuestionTest extends TestCase
{
    use RefreshDatabase;

    protected const TEST_CREATE_NAME = 'Question 1.';

    protected const TEST_UPDATE_NAME = 'Question updated.';

    /**
     * Test for factory creation.
     */
    public function test_factory(): void
    {
        $expectedCount = 10;

        Question::factory()
            ->count($expectedCount)
            ->create();
        $this->assertDatabaseCount(Question::class, $expectedCount);
        $record = Question::first();
        $this->assertNotEmpty($record->name, 'Factory error: name is empty.');
    }

    /**
     * Test of manual creation.
     */
    public function test_create(): void
    {
        $record = new Question;
        $record->setIsEnabled(true);
        $record->setName(self::TEST_CREATE_NAME);
        $record->save();
        $this->assertDatabaseCount(Question::class, 1);
        $this->assertNotEmpty($record->getId(), 'Manual creation failed: Created question id is empty.');
        $this->assertEquals(self::TEST_CREATE_NAME, $record->getName(), 'Name not match');
        $this->assertTrue($record->getIsEnabled(), 'Is enabled not match');

        $retrieved = Question::findOrFail($record->getId());
        $this->assertEquals(self::TEST_CREATE_NAME, $retrieved->getName(), 'Retrieved name not match.');
        $this->assertTrue($retrieved->getIsEnabled(), 'Retrieved Is enabled not match');
    }

    /**
     * Test of updating.
     */
    public function test_update()
    {
        $record = new Question;
        $record->setIsEnabled(true);
        $record->setName(self::TEST_CREATE_NAME);
        $record->save();

        $record = Question::findOrFail($record->getId());
        $record->setName(self::TEST_UPDATE_NAME);
        $record->setIsEnabled(false);
        $record->save();

        $retrieved = Question::findOrFail($record->getId());
        $this->assertEquals(self::TEST_UPDATE_NAME, $retrieved->getName(), 'Updated name not match.');
        $this->assertFalse($retrieved->getIsEnabled(), 'Update is enabled failed.');
    }

    /**
     * Test deleting.
     */
    public function test_question_delete(): void
    {
        $record = new Question;
        $record->setIsEnabled(true);
        $record->setName(self::TEST_CREATE_NAME);
        $record->save();
        $this->assertDatabaseCount(Question::class, 1);

        $record->delete();
        $this->assertDatabaseCount(Question::class, 0);
    }
}
