<?php

namespace Test\Domain\Listing;

use App\Domain\Category\Category;
use App\Domain\Listing\Listing;
use App\Domain\Listing\ListingService;
use App\Domain\Listing\Task;
use App\Domain\Listing\TaskException;
use App\Infrastructure\Listing\ListingRepositoryRDB;
use PHPUnit\Framework\TestCase;

class TaskEntityTest extends TestCase
{
     /**
     * @var string
     */
    private $listingId;

    /**
     * @var Listing
     */
    private $goodListing;

    /**
     * @var array<Listing>|null
     */
    private $listingCollection;

    /**
     * @var ListingService
     */
    private $listingService;

    /**
     * @var ListingRepositoryRDB
     */
    private $listingRepository;

    /**
     * @var Task
     */
    private $task;

    protected function setUp(): void
    {
        $this->listingId = uniqid();
        $this->listingRepository = new ListingRepositoryRDB();
        $this->listingService = new ListingService($this->listingRepository);

        $this->goodListing = (new Listing())
            ->setId($this->listingId)
            ->setTitle('List Title');
        $this->task = (new Task())
            ->setTitle('Task Title')
            ->setParentId($this->goodListing->getId())
            ->setStatus(Task::STATUS_DONE);


        $this->listingService->createListing($this->goodListing);
        $this->listingCollection = $this->listingService->getListing();
    }

    public function testItShouldHaveATitle(): void
    {
        $this->assertNotNull($this->task->getTitle());
    }

    public function testItThrowAnExceptionWhenTitleIsEmpty(): void
    {
        $this->expectException(TaskException::class);
        (new Task())->setTitle(null);
    }

    public function testItShouldHaveAParentListing(): void
    {
        $this->assertNotNull($this->task->getParentId());
    }

    public function testItThrowAnExceptionWhenParentIdIsEmpty(): void
    {
        $this->expectException(TaskException::class);
        (new Task())->setParentId(null);
    }

    public function testItCouldHaveADescription(): void
    {
        $this->assertNull($this->task->getDescription());
        $this->task->setDescription('A Description');
        $this->assertNotEmpty($this->task->getDescription());
    }

    public function testItCouldHaveACategory(): void
    {
        $category = new Category();
        $this->assertNull($this->task->getCategory());
        $this->task->setCategory($category);
        $this->assertNotNull($this->task->getCategory());
        $this->assertInstanceOf(Category::class, $this->task->getCategory());
    }

    public function testItShouldHaveAStatus(): void
    {
        $this->assertNotNull($this->task->getStatus());
    }

    public function testItThrownAnExceptionWhenStatusIsEmpty(): void
    {
        $this->expectException(TaskException::class);
        $this->task->setStatus(null);
    }

    public function testItThrownAnExceptionWhenInvalidStatusIsSet(): void
    {
        $this->expectException(TaskException::class);
        $this->task->setStatus('Invalid Status');
    }
}
