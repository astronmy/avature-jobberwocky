<?php

final class ExternalJobServiceAdapter {

    public function __construct(
        private readonly LinkedInJobResource $linkedInJobs,
        private readonly ZonaJobResource $zonaJobs,
    )
    
    public function searchJobs(array $params, ?ExternalJobProviderEnum $provider = null): Collection {
        
        /*Si recibe un proveedor especifico valida que exista con enum y solo consulta a ese proveedor  
            caso contrario se trae la lista

            ExternalJobProviderEnum::tryFrom();
            
        */
        $providers = ExternalJobProviderEnum::cases();

        $response = [];

        foreach($providers as $provider) {

            $service = match($provider) => {
                ExternalJobProviderEnum::LinkedIn => $linkedInJobs,
                ExternalJobProviderEnum::ZonaJobs => $zonaJobs,
            };

           $response[] = $service->request($params);
        }

        return $reponse;

    }
}