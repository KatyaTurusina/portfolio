let multiplyTable = document.createElement('table');
multiplyTable.style.textAlign = 'center';
multiplyTable.style.fontFamily = 'Courier New';
multiplyTable.style.width = '500px'
multiplyTable.style.height = '500px'
for (let i = 1; i <= 10; i++) {
    let tr = document.createElement('tr');
    for (let j = 1; j <=10; j++)
    {   
        td = document.createElement('th')
        td.appendChild(document.createTextNode(i*j));
        td.style.padding = '5px';
        td.style.border = '1px solid black'
        tr.appendChild(td);
    }
    multiplyTable.appendChild(tr);
}
document.body.appendChild(multiplyTable);

