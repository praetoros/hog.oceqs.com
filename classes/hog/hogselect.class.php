<?php
declare(strict_types=1);

namespace Hog {

    class HogSelect extends Hog
    {

        public function getAllHogPlayers(): array
        {
            return $this->returnAllHogPlayers();
        }

        public function getSrRangeName($srId): string
        {
            $range = $this->returnSrRange($srId);
            if (sizeof($range) === 2){
                return $range[0]['range'] . '-' . $range[1]['range'];
            } elseif (sizeof($range) === 1) {
                return $range[0]['range'];
            } else {
                return 'Unknown';
            }
        }

        public function getRegionListWithId(): array
        {
            return $this->returnRegionListWithId();
        }

        public function getRankListWithId(): array
        {
            return $this->returnRankListWithId();
        }


        public function getIfIpUsed(string $ip, int $hogId):bool
        {
            return $this->returnIfIpUsed($ip, $hogId);
        }

        public function getIfNameUsed(string $name):bool
        {
            return $this->returnIfNameUsed($name);
        }

    }

}