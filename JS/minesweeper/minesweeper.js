let field = [];
let width = 12;
let hight = 12;

let bombCount = 15;
let bombMap = [];

let clickedCells = 0;
let flagIsSwitched = false;

let gameOver = false;

window.onload = function() {
    game();
}

function settingMines() {

    let minesLeft = bombCount;
    while (minesLeft > 0) { 
        let randX = Math.round(Math.random() * (width - 1));
        let randY = Math.round(Math.random() * (hight - 1));
        let coordinates = randX.toString() + "-" + randY.toString();

        if (!bombMap.includes(coordinates)) {
            bombMap.push(coordinates);
            minesLeft -= 1;
        }
    }
}


function game() {
    document.querySelector(".flag").addEventListener("click", putFlag);
    settingMines();

    for (let x = 0; x < width; x++) {
        let row = [];
        for (let y = 0; y < hight; y++) {
            let cell = document.createElement("div");
            cell.classList.add(x.toString() + "-" + y.toString());
            cell.classList.add('msw-cell');
            cell.addEventListener("click", clickCell);
            document.querySelector('.msw').append(cell)
            row.push(cell);
        }
        field.push(row);
    }
}

function putFlag() {
    if (flagIsSwitched) {
        flagIsSwitched = false;
        document.querySelector(".flag").classList.remove('switched-flag');
    }
    else {
        flagIsSwitched = true;
        document.querySelector(".flag").classList.add('switched-flag');
    }
}

function clickCell() {
    if (gameOver || this.classList.contains("clicked-cell")) {
        return;
    }

    let cell = this;
    if (flagIsSwitched) {
        if (!cell.classList.contains('msw-cell--mark')) {
            cell.classList.add('msw-cell--mark')
        }
        else if (cell.classList.contains('msw-cell--mark')) {
            cell.classList.remove('msw-cell--mark');
        }
        return;
    }

    if (bombMap.includes(cell.classList[0])) {
        gameOver = true;
        minesOpened();
        return;
    }


    let coordinates = cell.classList[0].split("-");
    let x = parseInt(coordinates[0]);
    let y = parseInt(coordinates[1]);
    checkMine(x, y);

}

function minesOpened() {
    for (let x= 0; x < width; x++) {
        for (let y = 0; y < hight; y++) {
            let cell = field[x][y];
            if (bombMap.includes(cell.classList[0])) {
                cell.classList.add('msw-cell--bomb')                
            }
        }
    }
}

function checkMine(x, y) {
    if (x < 0 || x >= width || y < 0 || y >= hight) {
        return;
    }
    if (field[x][y].classList.contains("clicked-cell")) {
        return;
    }

    field[x][y].classList.add("clicked-cell");
    clickedCells += 1;

    let minesFound = 0;

    minesFound += openCell(x-1, y-1);
    minesFound += openCell(x-1, y);
    minesFound += openCell(x-1, y+1);

    minesFound += openCell(x, y-1);
    minesFound += openCell(x, y+1);

    minesFound += openCell(x+1, y-1);
    minesFound += openCell(x+1, y);
    minesFound += openCell(x+1, y+1);

    if (minesFound > 0) {
        field[x][y].textContent = minesFound;
        field[x][y].classList.add("x" + minesFound.toString());
    }
    else {
        checkMine(x-1, y-1);
        checkMine(x-1, y);
        checkMine(x-1, y+1);

        checkMine(x, y-1);
        checkMine(x, y+1);

        checkMine(x+1, y-1);
        checkMine(x+1, y);
        checkMine(x+1, y+1);
    }

}

function openCell(x, y) {
    if (x < 0 || x >= width || y < 0 || y >= hight) {
        return 0;
    }
    if (bombMap.includes(x.toString() + "-" + y.toString())) {
        return 1;
    }
    return 0;
}