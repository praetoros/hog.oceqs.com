<?php
declare(strict_types=1);

namespace Hog {

    class HogSet extends Hog {

        public function addNewHog(string|null $btag, string $name, int $region): int
        {
            return $this->setNewHog($btag, $name, $region);
        }

        public function addNewHogRating(int $rating, int $rank, string $ip, int $hogId): int
        {
            return $this->setNewHogRating($rating, $rank, $ip, $hogId);
        }
    }

}