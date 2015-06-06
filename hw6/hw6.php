<!DOCTYPE html>
<html>
<head>
<title>hw6</title>
<script type="text/javascript">

function validate()
{
   var x= document.myform.StAddr.value;
   var y= document.myform.city.value;
   var z= document.myform.state.value;
    
    if(( x == ""||x==null )&&( y == ""||y==null )&&( z == "0"||z==null ))
    {
        alert( "Please enter all values" );
        return false;
    }
    
    else if(( x == ""||x==null )&&( y == ""||y==null ))
    {
        alert( "Please enter value for Street Address and City" );
        return false;
    }
    
     else if(( x == ""||x==null )&&( z == "0"||z==null ))
    {
        alert( "Please enter value for Street Address and State" );
        return false;
    }
    
    else if(( y == ""||y==null )&&( z == "0"||z==null ))
    {
        alert( "Please enter value for City and State" );
        return false;
    }
  
   else if( x == ""||x==null )
   {
     alert( "Please enter value for Street Address" );
     //x.focus() ;
     return false;
   }
    
   else if( y == ""||y==null )
   {
     alert( "Please enter value for City" );
     //y.focus() ;
     return false;
   }
    
   else if( z == "0"||z==null )
   {
     alert( "Please select value for State" );
     //z.focus() ;
     return false;
   }
    
    else
        return true;
}
//-->
</script>
    
<style>
    
    h2
    {text-align: center;}
    
    .err
    {text-align: center;
     font-weight:bold;
    }
    
    div 
    {
        margin-left: auto;
        margin-right: auto;
        width: 60%;
        border: 2px solid;
    }
    #header
    {
        background-color:Khaki;
        border: 1px solid;
        border-radius: 5px;
        
    }
    
    #headlink{text-decoration: none;}
    
  .r
    {text-align: right;}
 
</style>
</head>
    
<body>
    <h2>Real Estate Search</h2>
    <div>
        <br>
        <table>
        <form name="myform" action="" method="post" onsubmit="return validate()">
        <tr><td>Street address*: </td><td><input type="text" name="StAddr"></td></tr>
        <tr><td>City*: </td><td><input type="text" name="city"></td></tr>
        <tr><td>State*:</td><td><select name="state" size="1">
            <option value="0"> </option>
            <option value="AK">AK</option>
            <option value="AL">AL</option>
            <option value="AR">AR</option>
            <option value="AZ">AZ</option>
            <option value="CA">CA</option>

            <option value="CO">CO</option>
            <option value="CT">CT</option>
            <option value="DC">DC</option>
            <option value="DE">DE</option>

            <option value="FL">FL</option>
            <option value="GA">GA</option>
            <option value="HI">HI</option>
            <option value="IA">IA</option>

            <option value="ID">ID</option>
            <option value="IL">IL</option>
            <option value="IN">IN</option>
            <option value="KS">KS</option>

            <option value="KY">KY</option>
            <option value="LA">LA</option>
            <option value="MA">MA</option>
            <option value="MD">MD</option>

            <option value="ME">ME</option>
            <option value="MI">MI</option>
            <option value="MN">MN</option>
            <option value="MO">MO</option>

            <option value="MS">MS</option>
            <option value="MT">MT</option>
            <option value="NC">NC</option>
            <option value="ND">ND</option>

            <option value="NE">NE</option>
            <option value="NH">NH</option>
            <option value="NJ">NJ</option>
            <option value="NM">NM</option>

            <option value="NV">NV</option>
            <option value="NY">NY</option>
            <option value="OH">OH</option>
            <option value="OK">OK</option>

            <option value="OR">OR</option>
            <option value="PA">PA</option>
            <option value="RI">RI</option>
            <option value="SC">SC</option>

            <option value="SD">SD</option>
            <option value="TN">TN</option>
            <option value="TX">TX</option>
            <option value="UT">UT</option>

            <option value="VA">VA</option>
            <option value="VT">VT</option>
            <option value="WA">WA</option>
            <option value="WI">WI</option>

            <option value="WV">WV</option>
            <option value="WY">WY</option>
        </select></td></tr>
        
        <tr><td></td><td><input type="submit" name="submit" value="submit">
    </form>      
    <img src="http://www.zillow.com/widgets/GetVersionedResource.htm?path=/static/logos/Zillowlogo_150x40_rounded.gif" width="150" height="40" alt="Zillow Real Estate Search" /></td></tr>
</table>
    <p>*<i>- Mandatory fields</i></p>
    </div>    
        
    </body>
</html>


<?php 

date_default_timezone_set('America/Los_Angeles');

if(isset($_POST['submit']))
{
    $Addr = trim($_POST['StAddr']);
    $City=trim($_POST['city']);
    $State=trim($_POST['state']);
    $url='http://www.zillow.com/webservice/GetDeepSearchResults.htm?zws-id=X1-ZWz1b2nvqca0i3_4srxq&address='.urlencode($Addr).'&citystatezip='.urlencode($City).'%2C+'.$State.'&rentzestimate=true';
    
    
    $xml=simplexml_load_file($url);
    
    if(($xml->message->code)==0)
    {
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

        $propRangelow = isset($xml->response->results->result->zestimate->valuationRange->low)?'$'.number_format((float)$xml->response->results->result->zestimate->valuationRange->low,2,'.',','): 'N/A';
        $propRangehigh = isset($xml->response->results->result->zestimate->valuationRange->high)?'$'.number_format((float)$xml->response->results->result->zestimate->valuationRange->high,2,'.',','): 'N/A';
        $rentzestimate = isset($xml->response->results->result->rentzestimate->amount) ? '$'.number_format((float)$xml->response->results->result->rentzestimate->amount,2,'.',',')  : 'N/A';
        $rentzestimateDate = isset($xml->response->results->result->rentzestimate->{'last-updated'}) ? date_format(date_create($xml->response->results->result->rentzestimate->{'last-updated'}),'d-M-Y')  : 'N/A';

        $RentChange = isset($xml->response->results->result->rentzestimate->valueChange) ? (float)$xml->response->results->result->rentzestimate->valueChange: 'N/A';

        $rentRangelow = isset($xml->response->results->result->rentzestimate->valuationRange->low)?'$'.number_format((float)$xml->response->results->result->rentzestimate->valuationRange->low,2,'.',','): 'N/A';
        $rentRangehigh = isset($xml->response->results->result->rentzestimate->valuationRange->high)?'$'.number_format((float)$xml->response->results->result->rentzestimate->valuationRange->high,2,'.',','): 'N/A';

        echo '<br><h2>Search Results</h2>';
        /*making table*/    
        echo'<table>
        <col style="width:30%">
        <col style="width:20%">
        <col style="width:50%">
        <col align="right" style="width:30%">

        <tr><td colspan="4" id="header">See more details for <a id="headlink" href="',$homedetails,'" >',$street,', ',$city,', ',$state,' - ',$zipcode,'</a> on Zillow </td></tr>
        <tr><td>Property Type:</td><td>',$PropertyType,'</td><td>Last Sold Price: </td><td class="r">',$LastSoldPrice,'</td></tr>
        <tr><td>Year Built:</td><td>',$YearBuilt,'</td><td>Last Sold Date: </td><td class="r">',$LastSoldDate,'</td></tr>
        <tr><td>Lot Size:</td><td>',$LotSize,'</td><td>Zestimate &reg Property Estimate as of ',$propzestimateDate,': </td><td class="r">',$propzestimate,'</td></tr>';
        if ($OverallChange<0)
        {
        $OverallChange=abs($OverallChange);
        $OverallChange='$'.number_format((float)$OverallChange,2,'.',',');
        echo'<tr><td>Finished Area:</td><td>',$FinishedArea,'</td><td>30 Days Overall Change <img src="http://cs-server.usc.edu:45678/hw/hw6/down_r.gif">: </td><td class="r">',$OverallChange,'</td></tr>';
        }
        else if($OverallChange>0)
        {
        $OverallChange='$'.number_format((float)$OverallChange,2,'.',',');
        echo'<tr><td>Finished Area:</td><td>',$FinishedArea,'</td><td>30 Days Overall Change <img src="http://cs-server.usc.edu:45678/hw/hw6/up_g.gif">: </td><td class="r">',$OverallChange,'</td></tr>';
        }
        else
        {
        $OverallChange='$'.number_format((float)$OverallChange,2,'.',',');
        echo'<tr><td>Finished Area:</td><td>',$FinishedArea,'</td><td>30 Days Overall Change : </td><td class="r">',$OverallChange,'</td></tr>';
        }
            
        echo'<tr><td>Bathrooms:</td><td>',$Bathrooms,'</td><td>All Time Property Range: </td><td class="r">',$propRangelow,'-',$propRangehigh,'</td></tr>
        <tr><td>Bedrooms:</td><td>',$Bedrooms,'</td><td>Rent Zestimate &reg Rent Valuation as of ',$rentzestimateDate,': </td><td class="r">',$rentzestimate,'</td></tr>';
        if ($RentChange<0)
        {
        $RentChange=abs($RentChange);
        $RentChange='$'.number_format((float)$RentChange,2,'.',',');
        echo'<tr><td>Tax Assessment Year:</td><td>',$TaxAssessmentYear,'</td><td>30 Days Rent Change<img src="http://cs-server.usc.edu:45678/hw/hw6/down_r.gif">: </td><td class="r">',$RentChange,'</td></tr>';
        }
        else if ($RentChange>0)
        {
        $RentChange='$'.number_format((float)$RentChange,2,'.',',');
        echo'<tr><td>Tax Assessment Year:</td><td>',$TaxAssessmentYear,'</td><td>30 Days Rent Change<img src="http://cs-server.usc.edu:45678/hw/hw6/up_g.gif">: </td><td class="r">',$RentChange,'</td></tr>';
        }
        else
        {
        $RentChange='$'.number_format((float)$RentChange,2,'.',',');
        echo'<tr><td>Tax Assessment Year:</td><td>',$TaxAssessmentYear,'</td><td>30 Days Rent Change: </td><td class="r">',$RentChange,'</td></tr>';
        }
        
        echo'<tr><td>Tax Assessment:</td><td>',$TaxAssessment,'</td><td>All Time Rent Range: </td><td class="r">',$rentRangelow,'-',$rentRangehigh,'</td></tr>';
        echo'</table>';

        echo'<p style="text-align: center">&copy Zillow, Inc., 2006-2014. Use is subject to <a href="http://www.zillow.com/corp/Terms.htm">Terms of Use</a><br><a href="http://www.zillow.com/zestimate/">What&#39s a Zestimate?</a></p>';
    }
    
   else if($xml->message->code==508)
    {
        echo'<br><p class="err">No exact match found -- Verify that the given address is correct.</p>';
    }
    
    else
    {
        echo'<br><p class="err">',$xml->message->text,'</p>';
    }
        
  
}

?>

    


    
