<?php

namespace App\Console\Commands;

use App\Models\Job;
use App\Services\Provider1Service;
use App\Services\Provider2Service;
use App\Services\ProviderDTO;
use App\Services\ProviderInterface;
use Illuminate\Console\Command;

class FetchJobsCommand extends Command
{
    protected array $providers = [
        Provider1Service::class,
        Provider2Service::class,
    ];

    /**
     * Tanımlı tüm providerlardan jobları çeker ve db kaydeder
     *
     * @var string
     */
    protected $signature = 'app:fetch-jobs';

    /**
     * @var string
     */
    protected $description = 'Fetch jobs data from providers to db';

    /**
     * Execute the console command.
     */
    public function handle(): void
    {
        $totalProvider = count($this->providers);

        $this->info("Veri çekilecek provider sayısı: {$totalProvider}");
        $jobs = [];

        // Get data from all providers
        foreach ($this->providers as $index => $provider) {
            $index++;
            $this->line("  Veri çekilen Provider {$index}/{$totalProvider}: {$provider}");

            /** @var ProviderInterface $provider */
            $provider = new ($provider);

            $jobs = array_merge($jobs, $provider->fetch());
        }

        $this->newLine();
        $this->line('Toplam çekilen iş sayısı: '.count($jobs));

        // Tüm job kayıtlarını db'den sil
        $this->newLine();
        $this->line('DB\'den eski job kayıtları siliniyor..');
        Job::query()->truncate();


        // Providerlardan gelen tüm jobları 50'li gruplar halinde db'ye kaydet
        $this->newLine();
        $this->line('Yeni kayıtlar DB aktarılıyor..');

        $bar = $this->output->createProgressBar(count($jobs));
        $bar->start();

        collect($jobs)
            ->chunk(50)
            ->each(function ($items) use ($bar) {
                $items = collect($items)
                    ->map(function (ProviderDTO $item) use ($bar) {
                        $bar->advance();
                        return [
                            'name'               => $item->getName(),
                            'level'              => $item->getLevel(),
                            'estimated_duration' => $item->getEstimatedDuration(),
                            'created_at'         => now(),
                            'updated_at'         => now(),
                        ];
                    });

                Job::query()->insert($items->toArray());
            });

        $bar->finish();

        $this->newLine(2);
        $this->info('JOB aktarım işlemi tamamlandı.');
    }
}
