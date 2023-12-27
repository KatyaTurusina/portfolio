var date = new Date();
var year = date.getFullYear();
var month = date.getMonth();
var firstDayOfMonth = new Date(year, month, 1);
var firstDayOfWeek = firstDayOfMonth.getDay();
var lastDayOfMonth = new Date(year, month + 1, 0).getDate()
var tableOfDates = document.createElement("table");
document.body.appendChild(tableOfDates);

tableOfDates.innerHTML = "<tr><td colspan=7 rowspan=1 id='month'>"+ date.toLocaleDateString('ru', {month: 'long'}) +
                            "</td></tr>" + "<tr><td>пн</td><td>вт</td><td>ср</td><td>чт</td><td>пт</td><td>сб</td><td>вс</td></tr>"
for(i = 1; i < 7; i++)
{
    tableOfDates.innerHTML += "<tr><td></td><td></td><td></td><td></td><td></td><td></td><td></td></tr>"
}

for (i = 1; i < lastDayOfMonth; i++) {
    var cell = document.getElementsByTagName("td");
    cell[i].style.borderBottom = '1px solid black';
    cell[i].style.padding = '15px'
    if (i == firstDayOfWeek){
        cell[0].innerHTML = date.toLocaleDateString('ru', {month: 'long'}).charAt(0).toLocaleUpperCase() + date.toLocaleDateString('ru', {month: 'long'}).slice(1);
        cell[7 + i].innerHTML = 1;
        cell[0].align = "center";
        cell[0].style.height = '35px'
        cell[0].style.fontFamily = "arial black";
        cell[0].style.letterSpacing = '2px'
        cell[0].style.color = 'white'
        cell[0].style.backgroundColor = '#7b68ee';
        
                    
        for (j = 0; j < lastDayOfMonth; j++){
            cell[7 + i + j].innerHTML = 1 + j;
            cell[7 + i + j].style.borderBottom = '1px solid black';
            cell[7 + i + j].style.padding = '15px'
            
        }
    }
}