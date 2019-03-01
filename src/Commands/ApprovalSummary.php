<?php
namespace Adamhut\Approvable\Commands;


use Illuminate\Console\Command;
use Adamhut\Approvable\Approval;

class ApprovalSummary extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'approval:summary {model?}';
    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'A summary of current approval ';
    /**
     * Execute the console command.
     *
     * @return void
     */
    public function handle()
    {
        $results =Approval::select(\DB::raw('approvable_type as model, approved, COUNT(id) as count'))
            ->groupBy(\DB::raw('approvable_type , approved'))
            ->get();

        foreach($results as $result)
        {
            $this->info($result->model .' => '.($result->approved === null ? 'pending' : ( $result->approved  ? 'approved':'denied')) .' :'.   $result->count);
        }

    }
}

