
$(function(){
  var city= ['Agra','Ahmedabad','Bengaluru','Bhopal','Chennai',
            'Ghaziabad','Hyderabad','Indore','Jaipur','Kanpur',
            'Kolkata','Lucknow','Mumbai','Nagpur','Nashik',
            'Patna','Pimpri-Chinchwad','Pune','Surat','Thane',
            'Vadodara','Vishakhapatnam','Meerut','Rajkot','Kalyan-Dombivili',
            'Amritsar','Aurangabad','Chandigarh','Coimbatore','Dhanbad',
            'Guwahati','Gwalior','Howrah','Jabalpur','Jodhpur',
            'Kota','Madurai','Meerut','Navi Mumbai','Nagpur',
            'Raipur','Rajkot','Ranchi','Sangli','Solapur',
            'Varanasi','Vasai-Virar','Vijayawada','Ailgarh','Amravati',
            'Panvel','Bhiwandi','Jalgaon','Mira-Bhayandar','Akola',
            'Kolapur','Malegaon','Nanded','Ulhasnagar','Kupwad',
            'Dhule','Latur','Ahmednagar','Bilaspur','Satara',
            'Jalna','Ambernath','Bhusaval','Raigad','Ratnagiri'];

    $(document).ready(function()
    {
      for(var count=0; count<city.length; count++) 
      {
        $('#loc').append('<option value="'+city[count]+'">');
      }
      
    });

});

/*for(var i=0; i<city.length; i++)
{
  $(this).attr('data-search-term', $(this).text().toLowerCase());  
}


$(document).on('keyup','#loc',function()
{
  var searchTerm= $(this).val().toLowerCase();

  for(var i=0; i<city.length; i++)
  {
    if($(this).filter('[data-search-term *='+searchTerm+']').length>0 || searchTerm.length<1)
    {
      $(this).show();
    }
    else
    {
      $(this).hide();
    }
  }
});*/
