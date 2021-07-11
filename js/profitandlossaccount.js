$(document).ready(function(){
    var startdatefield=$("#startdate"),
        enddatefield=$("#enddate"),
        generatebutton=$("#generate"),
        errordiv=$("#errors"),
        profitandlossaccount=$("#report")

        startdatefield.datepicker({dateFormat: 'dd-M-yy', maxDate: new Date()})
        enddatefield.datepicker({dateFormat: 'dd-M-yy', maxDate: new Date()})

        generatebutton.on("click",function(){
            console.log("clicked")
            var errors=""
            if(startdatefield.val()==""){
                errors="<p class='alert alert-danger'>Please select start date</p>"
            }else if(enddatefield.val()==""){
                errors="<p class='alert alert-danger'>Please select end date</p>"
            }else{
                startdate=startdatefield.val()
                enddate=enddatefield.val()
            }
            if(errors==""){
                errordiv.html("<p class='alert alert-info'>Processing ...</p>")
                $.getJSON(
                    "../controllers/reportoperations.php",
                    {
                        getprofitandlossaccount:true,
                        startdate:startdate,
                        enddate:enddate
                    },
                    function(data){
                        if(data.length>0){
                            var results="<table class='table table-sm table-striped'><tr><td colspan='2' class='font-weight-bold text-uppercase'>"+data[0].classname+"s</td></tr>",
                                nextitem=data[0].classname,
                                total=0,
                                totalrevenue=0,
                                profit=0
                            for (var i=0;i<data.length;i++){
                                if(data[i].classname==nextitem){
                                    results+="<tr><td>&nbsp;&nbsp;&nbsp;&nbsp;"+data[i].accountcode +" - "+data[i].accountname+"</td>"
                                    results+="<td  class='text-right'>"+$.number(+data[i].total,2)+"</td></tr>"
                                    total+=parseFloat(data[i].total)
                                }else{
                                    // add totals row
                                    results+="<tr class='font-weight-bold'><td>GROSS PROFIT</td><td  class='text-right'>"+$.number(total,2)+"</td></tr>"
                                    totalrevenue=total
                                    total=0
                                    nextitem=data[i].classname
                                    // add the new heading 
                                    results+="<tr class='font-weight-bold text-uppercase'><td colspan='2'>"+data[i].classname+"s</td></tr>"
                                    // add the item to the list
                                    results+="<tr><td>&nbsp;&nbsp;&nbsp;&nbsp;"+data[i].accountcode +" - "+data[i].accountname+"</td>"
                                    results+="<td class='text-right'>"+$.number(+data[i].total,2)+"</td><t/tr>"
                                    total+=parseFloat(data[i].total)
                                }
                            }
                            // output total expenses
                            results+="<tr class='font-weight-bold'><td>TOTAL EXPENSES</td><td class='text-right'>"+$.number(total,2)+"</td></tr>"
                            // compute next profit
                            profit=parseFloat(totalrevenue)-parseFloat(total,2)
                            if(profit>=0){
                                results+="<tr class='font-weight-bold'><td>NET PROFIT</td><td  class='text-right'>"+$.number(profit,2)+"</td></tr>"
                            }else{
                                results+="<tr class='font-weight-bold'><td>NET LOSS</td><td  class='text-right'>"+$.number(profit,2)+"</td></tr>"
                            }
                            profitandlossaccount.html(results)
                            errordiv.html("")
                        }else{
                            profitandlossaccount.html("<p class='alert alert-info'>Sorry. No Records matching filter criteria</p>")
                        }
                    }
                )
            }else{
                errordiv.html(errors)
            }
        })
})