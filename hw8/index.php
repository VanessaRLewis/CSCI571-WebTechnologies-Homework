 <?php

date_default_timezone_set('America/Los_Angeles');
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: GET, POST');

{
    $Addr = trim($_GET['streetInput']);
    $City=trim($_GET['cityInput']);
    $State=trim($_GET['stateInput']);
    $url='http://www.zillow.com/webservice/GetDeepSearchResults.htm?zws-id=X1-ZWz1b2nvqca0i3_4srxq&address='.urlencode($Addr).'&citystatezip='.urlencode($City).'%2C+'.$State.'&rentzestimate=true';
    
        $xml=simplexml_load_file($url);
    
        $messagecode=isset($xml->message->code)?$xml->message->code : 'N/A';
        $messagetext=isset($xml->message->text)?$xml->message->text : 'N/A';
        $street = isset($xml->response->results->result->address->street) ? $xml->response->results->result->address->street : 'N/A';
        $city = isset($xml->response->results->result->address->city) ? $xml->response->results->result->address->city : 'N/A';
        $state = isset($xml->response->results->result->address->state) ? $xml->response->results->result->address->state : 'N/A';
        $zipcode = isset($xml->response->results->result->address->zipcode) ? $xml->response->results->result->address->zipcode : 'N/A';
        $homedetails = isset($xml->response->results->result->links->homedetails) ? $xml->response->results->result->links->homedetails : 'N/A';

        $PropertyType = isset($xml->response->results->result->useCode) ? $xml->response->results->result->useCode : 'N/A';
        $YearBuilt = isset($xml->response->results->result->yearBuilt) ? $xml->response->results->result->yearBuilt : 'N/A';
        $LotSize = isset($xml->response->results->result->lotSizeSqFt) ? number_format((float)$xml->response->results->result->lotSizeSqFt,0,'.',',').' sq. ft.' : 'N/A';
         
        $FinishedArea = isset($xml->response->results->result->finishedSqFt) ? number_format((float)$xml->response->results->result->finishedSqFt,0,'.',',').' sq. ft.' : 'N/A';
        $Bathrooms = isset($xml->response->results->result->bathrooms) ? $xml->response->results->result->bathrooms : 'N/A';
        $Bedrooms = isset($xml->response->results->result->bedrooms) ? $xml->response->results->result->bedrooms : 'N/A';
        $TaxAssessmentYear = isset($xml->response->results->result->taxAssessmentYear) ? $xml->response->results->result->taxAssessmentYear  : 'N/A';
        $TaxAssessment = isset($xml->response->results->result->taxAssessment) ? '$'.number_format((float)$xml->response->results->result->taxAssessment,2,'.',',')  : 'N/A'; 
        $LastSoldPrice = isset($xml->response->results->result->lastSoldPrice) ? '$'.number_format((float)$xml->response->results->result->lastSoldPrice,2,'.',',')  : 'N/A'; 
        $LastSoldDate = isset($xml->response->results->result->lastSoldDate) ? date_format(date_create($xml->response->results->result->lastSoldDate),'d-M-Y') : 'N/A';
        $propzestimate = isset($xml->response->results->result->zestimate->amount) ? '$'.number_format((float)$xml->response->results->result->zestimate->amount ,2,'.',',') : 'N/A';
        $propzestimateDate = isset($xml->response->results->result->zestimate->{'last-updated'}) ? date_format(date_create($xml->response->results->result->zestimate->{'last-updated'}),'d-M-Y') : 'N/A';

        $OverallChange = isset($xml->response->results->result->zestimate->valueChange) ?(float)$xml->response->results->result->zestimate->valueChange : 'N/A';
        $overallChangeSign = ($OverallChange!=0)?(($OverallChange>0)?'+':'-'):'';
        if ($OverallChange<0)
                {$OverallChange=abs($OverallChange);}
        $OverallChange='$'.number_format((float)$OverallChange,2,'.',',');

        $propRangelow = isset($xml->response->results->result->zestimate->valuationRange->low)?'$'.number_format((float)$xml->response->results->result->zestimate->valuationRange->low,2,'.',','): 'N/A';
        $propRangehigh = isset($xml->response->results->result->zestimate->valuationRange->high)?'$'.number_format((float)$xml->response->results->result->zestimate->valuationRange->high,2,'.',','): 'N/A';
        $rentzestimate = isset($xml->response->results->result->rentzestimate->amount) ? '$'.number_format((float)$xml->response->results->result->rentzestimate->amount,2,'.',',')  : 'N/A';
        $rentzestimateDate = isset($xml->response->results->result->rentzestimate->{'last-updated'}) ? date_format(date_create($xml->response->results->result->rentzestimate->{'last-updated'}),'d-M-Y')  : 'N/A';

        $RentChange = isset($xml->response->results->result->rentzestimate->valueChange) ? (float)$xml->response->results->result->rentzestimate->valueChange: 'N/A';
        $RentChangesign = ($RentChange!=0)?(($RentChange>0)?'+':'-'):'';
        if ($RentChange<0)
            {$RentChange=abs($RentChange);}
        $RentChange='$'.number_format((float)$RentChange,2,'.',',');
        
        $rentRangelow = isset($xml->response->results->result->rentzestimate->valuationRange->low)?'$'.number_format((float)$xml->response->results->result->rentzestimate->valuationRange->low,2,'.',','): 'N/A';
        $rentRangehigh = isset($xml->response->results->result->rentzestimate->valuationRange->high)?'$'.number_format((float)$xml->response->results->result->rentzestimate->valuationRange->high,2,'.',','): 'N/A';
    
        $zpid=isset($xml->response->results->result->zpid)?$xml->response->results->result->zpid:'N/A';
        $homedetails=isset($xml->response->results->result->links->homedetails)?$xml->response->results->result->links->homedetails:'N/A';
        $lat=isset($xml->response->results->result->address->latitude) ? $xml->response->results->result->address->latitude : 'N/A';
        $long=isset($xml->response->results->result->address->longitude) ? $xml->response->results->result->address->longitude : 'N/A';
    
    $arr = array(
        "res"=>array
        (
            "messagecode"=>(string)$messagecode,
            "messagetext"=>(string)$messagetext,
            "homedetails"=>(string)$homedetails,
            "street"=>(string)$street,
            "city"=>(string)$city,
            "state"=>(string)$state,
            "zip"=>(string)$zipcode,
            "lat"=>(string)$lat,
            "long"=>(string)$long,
            "PropertyType"=>(string)$PropertyType,
            "YearBuilt"=>(string)$YearBuilt,
            "LotSize"=>(string)$LotSize,
            "FinishedArea"=>(string)$FinishedArea,
            "Bathrooms"=>(string)$Bathrooms,
            "Bedrooms"=>(string)$Bedrooms,
            "TaxAssessmentYear"=>(string)$TaxAssessmentYear,
            "TaxAssessment"=>(string)$TaxAssessment,
            "LastSoldPrice"=>(string)$LastSoldPrice,
            "LastSoldDate"=>(string)$LastSoldDate,
            "overallChangeSign"=>(string)$overallChangeSign,
            "imgn"=>"http://www-scf.usc.edu/~csci571/2014Spring/hw6/down_r.gif",
            "imgp"=>"http://www-scf.usc.edu/~csci571/2014Spring/hw6/up_g.gif",
            "propzestimate"=>(string)$propzestimate,
            "pzestdate"=>(string)$propzestimateDate,
            "OverallChange"=>(string)$OverallChange,
            "propRangelow"=>(string)$propRangelow,
            "propRangehigh"=>(string)$propRangehigh,
            "rentzestimate"=>(string)$rentzestimate,
            "rentzestimateDate"=>(string)$rentzestimateDate,
            "RentChange"=>(string)$RentChange,
            "RentChangesign"=>(string)$RentChangesign,
            "rentRangelow"=>(string)$rentRangelow,
            "rentRangehigh"=>(string)$rentRangehigh,
            "zpid"=>(string)$zpid
        ),
        "charts"=>array
        (
            "1yr"=>"http://www.zillow.com/app?chartDuration=1year&chartType=partner&height=300&page=webservice%2FGetChart&service=chart&showPercent=true&width=600&zpid=".urlencode($zpid),
            "5yr"=>"http://www.zillow.com/app?chartDuration=5years&chartType=partner&height=300&page=webservice%2FGetChart&service=chart&showPercent=true&width=600&zpid=".urlencode($zpid),
            "10yr"=>"http://www.zillow.com/app?chartDuration=10years&chartType=partner&height=300&page=webservice%2FGetChart&service=chart&showPercent=true&width=600&zpid=".urlencode(+$zpid)
        )
    );
        
   echo json_encode($arr);
  
}

?>
            
            
            
            

