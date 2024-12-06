<?php

namespace App\Domain\UseCases;

use App\Domain\Repositories\NasaDataRepositoryInterface;
use App\Domain\Repositories\NasaDataRepository;
use App\Services\NasaApiService;
use GuzzleHttp\Client;
use Exception;

use App\Domain\UseCases\ProcesaData\NasaDataMpc;
use App\Domain\UseCases\ProcesaData\NasaDataCmeProcs;
use App\Domain\UseCases\ProcesaData\NasaDataGstProcs;
use App\Domain\UseCases\ProcesaData\NasaDataFlrProcs;
use App\Domain\UseCases\ProcesaData\NasaDataSepProcs;
use App\Domain\UseCases\ProcesaData\NasaDataRbeProcs;
use App\Domain\UseCases\ProcesaData\NasaDataHssProcs;
use App\Domain\UseCases\ProcesaData\NasaDataWSAEProcs;
use App\Domain\UseCases\ProcesaData\GetInstrUsados;
use App\Domain\UseCases\ProcesaData\GetActividades;
use App\Domain\UseCases\ProcesaData\GetUsoInstrumentos;
use App\Domain\UseCases\ProcesaData\GetInstrumentoActividad;
use App\Domain\UseCases\ProcesaData\SetArrayInstruments;

use Illuminate\Http\Request;

class GetNasaData{
    private NasaDataRepository $repository;
    private string $apiKey;
    private Request $request;

    public function __construct(Request $request, NasaApiService $nasaApiService) {
        $this->apiKey = $nasaApiService->getApiKey();
        $this->repository = new NasaDataRepository($this->apiKey);
        $this->request = $request;
    }

    public function execute(): array {

        if(count($this->request->query) != 2){
            return ['required' =>'startDate, endDate'];
        }

        if( strlen($this->request->query('startDate')) <1 || strlen($this->request->query('endDate')) <1 ){
            return ['required' =>'startDate, endDate'];
        }

        try {
            $baseApiDonky = '/DONKI';
            $rutas = ['MPC', 'CME', 'GST', 'FLR', 'SEP', 'RBE', 'HSS', 'WSAEnlilSimulations'];
            $query = ['query' => 
                        [
                        'startDate' => $this->request->query('startDate'), 
                        'endDate' => $this->request->query('endDate'), 
                        'api_key'=> $this->apiKey
                        ]
                    ];

            $data = [];
            foreach($rutas as $indice){
                $data[$indice] = $this->repository->getNasaData($baseApiDonky."/".$indice, $query); // Usa el método del repositorio
            }

            $nasaData = [];
            $pre_nasaData = [];
            $nasaDataCme = [];
            $nasaDataFlr = [];
            $nasaDataSep = [];
            $nasaDataRbe = [];
            $nasaDataHss = [];
            $nasaDataWSAE = [];

            foreach ($data as $puntero => $item) {
                foreach ($item as $datos) {
                    switch ($puntero) {
                        case "MPC":
                            $nasaDataProceso = new NasaDataMpc($datos);
                            $pre_nasaData[] = $nasaDataProceso->procesa_instruments();                                                                
                        break;     
                        case "CME":
                            $nasaDataProceso = new NasaDataCmeProcs($datos);
                            $nasaDataCme[] = $nasaDataProceso->procesa_instruments();                            
                        break;    
                        case "GST":
                            $nasaDataProcesoGts = new NasaDataGstProcs($datos);
                            $nasaDataGst[] = $nasaDataProcesoGts->procesa_instruments();
                        break;   
                        case "FLR":
                            $nasaDataProcesoFlr = new NasaDataFlrProcs($datos); 
                            $nasaDataFlr[] = $nasaDataProcesoFlr->procesa_instruments();                        
                        break;
                        case "SEP":
                            $nasaDataProcesoSep = new NasaDataSepProcs($datos); 
                            $nasaDataSep[] = $nasaDataProcesoSep->procesa_instruments();                        
                        break;
                        case "RBE":
                            $nasaDataProcesoRbe = new NasaDataRbeProcs($datos); 
                            $nasaDataRbe[] = $nasaDataProcesoRbe->procesa_instruments();                        
                        break;
                        case "HSS":
                             $nasaDataProcesoHss = new NasaDataHssProcs($datos); 
                             $nasaDataHss[] = $nasaDataProcesoHss->procesa_instruments();                        
                         break; 
                         case "WSAEnlilSimulations":
                            $nasaDataProcesoWSAE = new NasaDataWSAEProcs($datos); 
                            $nasaDataWSAE[] = $nasaDataProcesoWSAE->procesa_instruments();                        
                        break;                        
                    }
                }
            }


            if(count($nasaDataGst)>0){
                foreach ($nasaDataGst as $datos) {
                    foreach($datos as $listaDatos){
                        $nasaData[]  = $listaDatos;
                    }                       
                }
            }

            if(count($pre_nasaData)>0){
                foreach ($pre_nasaData as $datos) {
                    foreach($datos as $listaDatos){
                        $nasaData[]  = $listaDatos;
                    }                       
                }
            }

            if(count($nasaDataCme)>0){
                foreach ($nasaDataCme as $keyA => $valueA) {
                    foreach ($valueA as $keyB => $valueB) {
                        $nasaData[]  = $valueB;
                    }
                }
            }
            
           if(count($nasaDataFlr)>0){
               foreach($nasaDataFlr as $nasaDataFlrItem){
                    if(count($nasaDataFlrItem)>0){
                        array_push($nasaData, $nasaDataFlrItem[0]);
                    }
                }        
           }

           if(count($nasaDataSep) > 0){
                foreach($nasaDataSep as $nasaDataSepItem){
                    if(count($nasaDataSepItem)>0){
                        foreach($nasaDataSepItem as $activitySepItem ){
                            array_push($nasaData, $activitySepItem);
                        }                
                    }
                }
           }

           if(count($nasaDataRbe)>0){
                foreach($nasaDataRbe as $nasaDataRbeItem){
                    if(count($nasaDataRbeItem)>0){
                        foreach($nasaDataRbeItem as $activityRbeItem){
                            array_push($nasaData, $activityRbeItem);
                        }
                    }
                }
           }

           if(count($nasaDataHss)>0){
                foreach($nasaDataHss as $nasaDataHssItem){
                    if(count($nasaDataHssItem)>0){
                        foreach($nasaDataHssItem as $activityHssItem){
                            array_push($nasaData, $activityHssItem);
                        }
                    }
                }
           }
           
           
           if(count($nasaDataWSAE)>0){
                foreach($nasaDataWSAE as $nasaDataWSAEItem){
                    if(count($nasaDataWSAEItem)>0){
                        foreach($nasaDataWSAEItem as $activityWSAEItem){
                            array_push($nasaData, $activityWSAEItem);
                        }
                    }                    
                }
           }


           $instrUsados = new GetInstrUsados($nasaData); 
           $listaInstr = $instrUsados->procesa_instruments();
           $resultListaInstr = array_unique($listaInstr);
           $array_instruments = [];
           foreach ($resultListaInstr as $keyA => $valueB) {
            $array_instruments[] = $valueB;
           }

           $lasActividades = new GetActividades($nasaData); 
           $listaActividades = $lasActividades->procesa_instruments();
           $resultListaActividades = array_unique($listaActividades);
           $array_activitysIDs = [];
           foreach ($resultListaActividades as $keyA => $valueB) {
            $array_activitysIDs[] = $valueB;
           }
          
           $listaApariciones = new GetUsoInstrumentos($resultListaInstr);
           $listaPorcActividades = $listaApariciones->get_instrumentos($nasaData);

           $listaInstrEvento = new GetInstrumentoActividad($resultListaInstr);
           $listaPorcInstrEvento = $listaInstrEvento->get_instrumentos($nasaData);

            return [
                'instruments'=> $array_instruments,
                 'activitysIDs' => $array_activitysIDs, 
                 'instruments_use' => $listaPorcActividades,
                 'instruments_activity' => $listaPorcInstrEvento,
                ];

        } catch (Exception $e) {
            return [];
        }
    }
}

?>