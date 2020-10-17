<?php

namespace App\Infrastructure\Listing;

use App\Domain\Listing\Listing;

class ListingRepositoryRDB
{
    /**
     * @var array<Listing>
     */
    private $listingCollection;

    /**
     * @param Listing $listing
     * @return void
     */
    public function createListing(Listing $listing)
    {
        $this->listingCollection[] = $listing;
    }

    /**
     * @return Listing[]
     */
    public function getListing(): ?array
    {
        return $this->listingCollection;
    }

    /**
     * @param string $id
     * @return Listing|null
     */
    public function getListingById(string $id): ?Listing
    {
        foreach ($this->listingCollection as $listing) {
            if($listing->getId() === $id) {
                return $listing;
            }
        }

        return null;
    }
}