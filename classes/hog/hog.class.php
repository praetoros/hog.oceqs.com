<?php
declare(strict_types=1);

namespace Hog {

    use Db;

    class Hog extends Db
    {

        protected function returnAllHogPlayers(): array
        {
            $sql = "
            SELECT 
                `hogPlayers_id`                             AS 'id',
                `hogPlayers_name`                           AS 'name',
                `hogPlayers_bTag`                           AS 'bTag',
                `tbl_hogRegions`.`hogRegions_region`        AS 'region',
                Avg(`tbl_hogRatings`.`hogRatings_rating`)   AS 'rating',
                Avg(`tbl_hogRatings`.`hogRatings_sr`)       AS 'avgSrRange',
                count(`tbl_hogRatings`.`hogRatings_player`) AS 'countHog'
            FROM `tbl_hogPlayers`
                JOIN
                    `tbl_hogRatings` ON `tbl_hogPlayers`.`hogPlayers_id` = `tbl_hogRatings`.`hogRatings_player`
                JOIN
                    `tbl_hogRegions` ON `tbl_hogPlayers`.`hogPlayers_region` = `tbl_hogRegions`.`hogRegions_id`
            GROUP BY `tbl_hogPlayers`.`hogPlayers_id`
            ORDER BY rating DESC 
            ;";

            $stmt = $this->connect()->prepare($sql);
            $stmt->execute();

            return $stmt->fetchAll();
        }

        protected function returnSrRange(float $srRange): array
        {
            $sql = "
            SELECT 
                `hogSr_name` as 'range'
            FROM 
                `tbl_hogSr` 
            WHERE 
                `hogSr_id` = FLOOR(:srRangeFLOOR)
                OR
                `hogSr_id` = CEILING(:srRangeCEILING)
            ;";

            $stmt = $this->connect()->prepare($sql);
            $stmt->execute([
                'srRangeFLOOR' => $srRange,
                'srRangeCEILING' => $srRange
            ]);

            return $stmt->fetchAll();
        }

        protected function returnRegionListWithId(): array
        {
            $sql = "
            SELECT 
                `tbl_hogRegions`.`hogRegions_id`     as 'id',
                `tbl_hogRegions`.`hogRegions_region` as 'region'
            FROM 
                `tbl_hogRegions`
            WHERE
                `tbl_hogRegions`.`hogRegions_id` != 0
            ;";

            $stmt = $this->connect()->prepare($sql);
            $stmt->execute();

            return $stmt->fetchAll();
        }

        protected function returnRankListWithId(): array
        {
            $sql = "
            SELECT 
                `tbl_hogSr`.`hogSr_id`   as 'id',
                `tbl_hogSr`.`hogSr_name` as 'name'
            FROM `tbl_hogSr`
            ;";

            $stmt = $this->connect()->prepare($sql);
            $stmt->execute();

            return $stmt->fetchAll();
        }


        protected function setNewHog(string|null $hogPlayers_bTag, string $hogPlayers_name, int $hogPlayers_region): int
        {
            $sql = "
            INSERT INTO 
                tbl_hogPlayers (hogPlayers_bTag, hogPlayers_name, hogPlayers_region) 
            VALUES 
                (:hogPlayers_bTag, :hogPlayers_name, :hogPlayers_region)
            ;";

            $dbh = $this->connect();
            $stmt = $dbh->prepare($sql);
            $stmt->execute([
                    'hogPlayers_bTag' => $hogPlayers_bTag,
                    'hogPlayers_name' => $hogPlayers_name,
                    'hogPlayers_region' => $hogPlayers_region
            ]);

            return (int)$dbh->lastInsertId();
        }



        protected function setNewHogRating(int $hogRatings_rating, int $hogRatings_sr, string $hogRatings_submitted, int $hogRatings_player): int
        {
            $sql = "
            INSERT INTO 
                tbl_hogRatings (hogRatings_rating, hogRatings_sr, hogRatings_submitted, hogRatings_player) 
            VALUES 
                (:hogRatings_rating, :hogRatings_sr, :hogRatings_submitted, :hogRatings_player)
            ;";

            $stmt = $this->connect()->prepare($sql);
            $stmt->execute([
                'hogRatings_rating' => $hogRatings_rating,
                'hogRatings_sr' => $hogRatings_sr,
                'hogRatings_submitted' => $hogRatings_submitted,
                'hogRatings_player' => $hogRatings_player
            ]);

            return 1;
        }

        protected function returnRankIdForSr(int $sr): int
        {
            $sql = "
            SELECT
                `hogSr_id` as 'id'
            FROM
                `tbl_hogSr`
            WHERE
                `hogSR_rangeHigh` > :sr
            ORDER BY
                `hogSR_rangeLow`
            LIMIT 1
            ;";

            $stmt = $this->connect()->prepare($sql);
            $stmt->execute([
                'sr' => $sr
            ]);

            return $stmt->fetch()['id'];
        }


        protected function returnIfIpUsed(string $hogRatings_submitted, int $hogRatings_player): bool
        {
            $sql = "
            SELECT
                *
            FROM
                `tbl_hogRatings`
            WHERE
                `hogRatings_player` like :hogRatings_player
                AND
                `hogRatings_submitted` like :hogRatings_submitted
            ;";

            $stmt = $this->connect()->prepare($sql);
            $stmt->execute([
                'hogRatings_player' => $hogRatings_player,
                'hogRatings_submitted' => $hogRatings_submitted
            ]);

            return (bool)$stmt->rowCount();
        }

        protected function returnIfNameUsed(string $hogPlayers_name): bool
        {
            $sql = "
            SELECT
                *
            FROM
                `tbl_hogPlayers`
            WHERE
                `hogPlayers_name` like :hogPlayers_name
            ;";

            $stmt = $this->connect()->prepare($sql);
            $stmt->execute([
                'hogPlayers_name' => $hogPlayers_name
            ]);

            return (bool)$stmt->rowCount();
        }

    }

}
