<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use App\Comprobante_venta;

class solicitarAutorizacion implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $comprobantes = Comprobante_venta::where('env_xml',0)->get();

        foreach ($comprobantes as $comprobante) {
            if ($comprobante['env_xml']=0) {
                return "lectura";
                Log::info("Enviado, solicitando autorizacion");
            }
        }
    }
}
