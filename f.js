document.getElementById("showReport").addEventListener("click", function(){

    let rows = document.querySelectorAll("table tbody tr");

    let total = rows.length;
    let present = 0;
    let participated = 0;

    rows.forEach(r => {

        // présent = il a au moins un "✓"
        if(r.innerHTML.includes("✓")) present++;

        // participé = il a au moins un "P"
        if(r.innerHTML.includes("P")) participated++;

    });

    document.getElementById("report").innerHTML = 
        "Total Students: "+total+"<br>"+
        "Present: "+present+"<br>"+
        "Participated: "+participated;

    // now chart
    generateChart(total, present, participated);
});
function generateChart(total, present, participated){

    new Chart(document.getElementById("myChart"),{
        type:"bar",
        data:{
            labels:["Total","Present","Participated"],
            datasets:[{
                data:[total, present, participated]
            }]
        }
    })
}
// ===========================
// STEP 3: Show Report + Chart
// ===========================

// Handle "Show Report" button click
document.getElementById("showReport").addEventListener("click", function () {
    const rows = document.querySelectorAll("#studentTable tbody tr");

    let total = 0;
    let presentCount = 0;
    let participatedCount = 0;

    rows.forEach(row => {
        total++;

        const present = row.cells[2].querySelector("input").checked;
        const participated = row.cells[3].querySelector("input").checked;

        if (present) presentCount++;
        if (participated) participatedCount++;
    });

    // Display the text results
    document.getElementById("report").innerHTML = `
        Total Students: ${total} <br>
        Present: ${presentCount} <br>
        Participated: ${participatedCount}
    `;

    // Draw the Chart.js bar chart
    drawChart(total, presentCount, participatedCount);
});


// ======================
// CHART.JS DRAW FUNCTION
// ======================
let chartInstance = null;

function drawChart(total, present, participated) {
    const ctx = document.getElementById("reportChart");

    // Destroy old chart if exists
    if (chartInstance !== null) {
        chartInstance.destroy();
    }

    chartInstance = new Chart(ctx, {
        type: "bar",
        data: {
            labels: ["Total", "Present", "Participated"],
            datasets: [{
                label: "Attendance Report",
                data: [total, present, participated]
            }]
        },
        options: {
            responsive: true,
            scales: {
                y: {
                    beginAtZero: true
                }
            }
        }
    });
}
