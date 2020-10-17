<?php

namespace App\Domain\Listing;

use App\Infrastructure\Listing\ListingRepositoryRDB;
use App\Domain\Listing\ListingException;

class ListingService
{
    /**
     *
     *
     * @var ListingRepositoryRDB
     */
    private $listingRepository;

    public function __construct(ListingRepositoryRDB $listingRepository){
        $this->listingRepository = $listingRepository;
    }

    /**
     * Undocumented function
     *
     * @param string $title
     * @return void
     */
    public function createListing(Listing $listing)
    {
        $listingCollection = $this->listingRepository->getListing();

        if ($listingCollection !== null) {
            foreach ($listingCollection as $list) {
                if($listing->getTitle() === $list->getTitle())
                {
                    throw new ListingException("a list already have the name " . $listing->getTitle());
                }
            }
        }

        $this->listingRepository->createListing($listing);
    }

    /**
     * @return Listing[]
     */
    public function getListing(): ?array
    {
        return $this->listingRepository->getListing();
    }

}