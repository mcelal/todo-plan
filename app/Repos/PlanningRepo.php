<?php

namespace App\Repos;

use App\Models\Developer;
use App\Models\Job;
use Illuminate\Database\Eloquent\Collection;

class PlanningRepo
{
    /**
     * Developerların haftalık çalışma süresi
     */
    public const WEEKLY_HOURS = 45;

    protected Collection $developers;

    protected Collection $jobs;

    public function calculate(): array
    {
        $this->developers = $this->getDevelopers();

        $this->jobs = $this->getJobs();

        $report = [
            'week'       => 0,
            'totalHours' => $this->callRequiredTotalHour(),
            'totalJobs'  => $this->jobs->count(),
            'items'      => [],
        ];

        /**
         * İşleri tamamlamak için gerekli toplam süre
         */
        $hours = $this->callRequiredTotalHour();

        while ($hours > 0) {
            $report['week']++;

            foreach ($this->developers as $developer) {
                $hoursLeft = self::WEEKLY_HOURS;

                foreach ($this->jobs as $key => $job) {
                    // İşin kriterleri developer için uygunsa developer'a bu işi ata
                    if ($job->estimated_duration <= $hoursLeft
                        && $job->level <= $developer->level
                    ) {
                        $hoursLeft -= $job->estimated_duration;
                        $hours -= $job->estimated_duration;

                        // İş developara atanır rapor için data oluşturulur
                        $report['items'][$report['week']][$developer->id][] = [
                            'developer'      => $developer->name,
                            'job'            => $job->name,
                            'level'          => $job->level,
                            'hour'           => $job->estimated_duration
                        ];

                        // Atanan işi listeden kaldır
                        $this->jobs->forget($key);
                    }
                }
            }
        }

        return $report;
    }

    protected function getDevelopers(): Collection
    {
        return Developer::query()->get();
    }

    protected function getJobs(): Collection
    {
        return Job::query()
            ->orderBy('estimated_duration', 'desc')
            ->get();
    }

    protected function callRequiredTotalHour(): int
    {
        return $this->jobs->sum('estimated_duration');
    }
}
