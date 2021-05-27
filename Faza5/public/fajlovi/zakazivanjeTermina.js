var idLek;
var idPru;

function izmeniInput()
{
    
    var todaysDate=new Date();
    var year=todaysDate.getFullYear();
    var month = ("0" + (todaysDate.getMonth() + 1)).slice(-2);
    var month2 = ("0" + (todaysDate.getMonth() + 2)).slice(-2);
    var day = ("0" + todaysDate.getDate()).slice(-2);
    var minDate = (year +"-"+ month +"-"+ day);
    var maxDate=(year +"-"+ month2 +"-"+ day);
  
     $("#dateExam").attr('min',minDate); 
     $("#dateExam").attr('max',maxDate); 
}
jQuery(document).ready(function() {
   
   
izmeniInput();
  

    jQuery("#dateExam").change(function() {
        if(  jQuery("#dateExam")!=null){
          //  alert(""+$("#dateExam").attr("name"));
            
            var val=$("#dateExam").val();
        }
        



doSomething(times);



function doSomething(php_result){
    let pok=JSON.stringify(php_result);
   
    php_result=php_result;
     
    $("#fromTimeOfExam").empty();
                let satovi=[];
                let vremena=(JSON.parse(pok));
                
               Array.from(vremena).forEach(vreme => {
                 
                   let splits=vreme["DatumIVreme"].split(" ");
                   let datum=splits[0];
            
                   let sat=splits[1];
                   splits=sat.split(":");
                   sat=splits[0];
              
                   if(val == datum){
                       satovi.push(sat);
                   }
                  

                });
                let moguci=[];
                for(let i=0;i<2;i++){
                    for(let j=0;j<10;j++){
                        moguci.push(""+i+""+j);

                    }
                }
                moguci.push("20");
                moguci.push("21");
                moguci.push("22");
                moguci.push("23");
                moguci.forEach(moguc => {
                    if(!satovi.includes(moguc)){
                        let opcija = $("<option></option>");
                        opcija.text(""+moguc);  
                        $("#fromTimeOfExam").append(opcija);
                    }
                });
                
                 }




});


});