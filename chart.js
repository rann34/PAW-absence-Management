// EXO 4 ---------------------------------------------------

let currentChart;

document.getElementById("showReport").addEventListener("click", function(){

    const rows = document.querySelectorAll("#attendanceTable tbody tr");
    let total = rows.length;
    let present = 0;
    let participated = 0;

    rows.forEach(r=>{
        let abs = parseInt(r.querySelector(".absencesCell").textContent);
        if(abs < 6) present++;

        let par = parseInt(r.querySelector(".partsCell").textContent);
        if(par > 0) participated++;
    });

    document.getElementById("report").innerHTML =
    `Total Students : ${total} <br> Present : ${present} <br> Participated : ${participated}`;

    if(currentChart) currentChart.destroy();

    currentChart = new Chart(document.getElementById("myChart"),{
        type:"bar",
        data:{
            labels:["Total","Present","Participated"],
            datasets:[{
                data:[total,present,participated]
            }]
        }
    });

});
