<?php
declare(strict_types=1);

namespace Hog {

    class HogSelect extends Hog
    {
        /**
         * @return array
         */
        public function getAllHogPlayers(): array
        {
            return $this->returnAllHogPlayers();
        }

        /**
         * @param $srId
         *
         * @return string
         */
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

        /**
         * @return array
         */
        public function getRegionListWithId(): array
        {
            return $this->returnRegionListWithId();
        }

        /**
         * @return array
         */
        public function getRankListWithId(): array
        {
            return $this->returnRankListWithId();
        }

        /**
         * @param string $ip
         * @param int    $hogId
         *
         * @return bool
         */
        public function getIfIpUsed(string $ip, int $hogId):bool
        {
            return $this->returnIfIpUsed($ip, $hogId);
        }

        /**
         * @param string $name
         *
         * @return bool
         */
        public function getIfNameUsed(string $name):bool
        {
            return $this->returnIfNameUsed($name);
        }

        /**
         * @param int $hogId
         *
         * @return array
         */
        public function getPlayerRatingsHistory(int $hogId):array
        {
            return $this->returnPlayerRatingsHistory($hogId);
        }

    }

}