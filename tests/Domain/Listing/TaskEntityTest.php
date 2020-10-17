<?php

namespace Test\Domain\Listing;

use App\Domain\Listing\Task;
use App\Domain\Listing\Listing;
use PHPUnit\Framework\TestCase;
use App\Domain\Listing\TaskException;
use App\Domain\Listing\ListingService;
use App\Infrastructure\Listing\ListingRepositoryRDB;

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
            ->setParentId($this->goodListing->getId());


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
}
