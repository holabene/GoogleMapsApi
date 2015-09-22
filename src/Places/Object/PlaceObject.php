<?php
namespace GoogleMapsApi\Places\Object;

use Symfony\Component\OptionsResolver\OptionsResolver;

/**
 * Class PredictionResult
 * @package GoogleMapsApi\Places\Result
 */
class PlaceObject
{
    /**
     * @var array $data
     */
    private $data;

    /**
     * @param array $data
     * @see https://developers.google.com/places/web-service/autocomplete#place_autocomplete_results
     */
    public function __construct(array $data)
    {
        $options = new OptionsResolver();
        $options->setDefined([
            'address_components', 'formatted_address', 'formatted_phone_number', 'geometry', 'icon', 'id',
            'international_phone_number', 'name', 'opening_hours', 'adr_address', 'place_id', 'geometry',
            'reference', 'scope', 'types', 'url', 'vicinity'
        ]);
        $this->data = $options->resolve($data);
    }

    /**
     * @return PlaceAddressObject
     */
    public function getAddressComponents()
    {
        return new PlaceAddressObject($this->data['address_components']);
    }

    /**
     * @return bool
     */
    public function isCity()
    {
        return in_array('locality', $this->data['types']);
    }

    /**
     * @return bool
     */
    public function isCountry()
    {
        return in_array('country', $this->data['types']);
    }
}