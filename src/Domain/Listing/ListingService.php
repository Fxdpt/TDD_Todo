<?php

namespace App\Domain\Listing;

use App\Domain\Listing\Listing;
use App\Domain\Listing\ListingException;
use App\Infrastructure\Listing\ListingRepositoryRDB;

class ListingService
{
    /**
     * @var ListingRepositoryRDB
     */
    private $listingRepository;

    public function __construct(ListingRepositoryRDB $listingRepository)
    {
        $this->listingRepository = $listingRepository;
    }

    /**
     * @param Listing $listing
     * @return void
     */
    public function createListing(Listing $listing): void
    {
        $listingCollection = $this->listingRepository->getListing();

        if ($listingCollection !== null) {
            foreach ($listingCollection as $list) {
                if ($listing->getTitle() === $list->getTitle()) {
                    throw new ListingException("a list already have the name " . $listing->getTitle());
                }
            }
        }

        $this->listingRepository->createListing($listing);
    }

    /**
     * @return Listing[]|null
     */
    public function getListing(): ?array
    {
        return $this->listingRepository->getListing();
    }
}
