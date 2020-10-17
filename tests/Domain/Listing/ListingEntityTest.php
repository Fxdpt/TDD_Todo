<?php

namespace Test\Domain\Listing;

use App\Domain\Listing\Task;
use App\Domain\Listing\Listing;
use PHPUnit\Framework\TestCase;
use App\Domain\Listing\ListingService;
use App\Domain\Listing\ListingException;
use App\Infrastructure\Listing\ListingRepositoryRDB;

class ListingEntityTest extends TestCase
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
     * @var Listing[]
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

    protected function setUp(): void
    {
        $this->listingId = uniqid();
        $this->listingRepository = new ListingRepositoryRDB();
        $this->listingService = new ListingService($this->listingRepository);

        $this->task = (new Task())
            ->setTitle('Task Title');

        $this->goodListing = (new Listing())
            ->setId($this->listingId)
            ->setTitle('List Title');
        $this->listingService->createListing($this->goodListing);
        $this->listingCollection = $this->listingService->getListing();
    }

    public function testItShouldHaveAnId()
    {
        $this->AssertNotNull($this->goodListing->getId());
    }

    public function testItThrowAnExceptionWhenIdIsEmpty()
    {
        $this->expectException(ListingException::class);
        (new Listing())->setId(null);
    }

    public function testItShouldHaveATitle()
    {
        $this->assertNotEmpty($this->goodListing->getTitle());
    }

    public function testItThrowAnExceptionWhenTitleIsEmpty()
    {
        $this->expectException(ListingException::class);
        (new Listing())->setId(uniqid())->setTitle(null);
    }

    public function testItShouldHaveAUniqueTitle()
    {
        $listing = (new Listing())->setId(uniqid())->setTitle('A title');
        foreach($this->listingCollection as $list) {
            $this->assertNotEquals($list->getTitle(), $listing->getTitle());
        }
    }

    public function testItShouldThrownAnExceptionWhenNonUniqueTitle()
    {
        $listing = (new Listing())->setId(uniqid())->setTitle('List Title');
        $this->expectException(ListingException::class);
        $this->listingService->createListing($listing);
    }

    public function testItCouldHaveADescription()
    {
        $this->assertNull($this->goodListing->getDescription());
        $this->goodListing->setDescription('A Description');
        $this->assertNotEmpty($this->goodListing->getDescription());
    }

    public function testItCouldHaveTasks()
    {
        $this->assertNull($this->goodListing->getTasks());
        $this->goodListing->setTask($this->task);
        $this->assertIsArray($this->goodListing->getTasks());
    }
}
