const row = 10;
let column;

if(document.cookie === "")
{
    column = 4;
}
else
{
    let colString = document.cookie[document.cookie.length - 1];
    column = parseInt(colString);
}

createBoard(row, column);
mainBalls2D = convert2DArray(column, ".mainBall");
endBalls2D = convert2DArray(column, ".endBall");
randomizeHeader();

let rowAt = 0;
let colAt = 0;

mainBalls2D[rowAt][colAt].id = "selected";

let colChange = document.querySelector("#changeColumns");
let colChangeFunction = function() {
    document.cookie = `columns=${colChange.value}`;
}
colChange.addEventListener("change", colChangeFunction);

let newGame = document.querySelector("#newGame");
let newGameFunction = function() {
    location.reload();
}
newGame.addEventListener("click", newGameFunction);

let button = document.querySelectorAll("button");
let buttonFunction = function(event) {
        onClick(event, mainBalls2D, column, rowAt, colAt)
}
for(let i = 0 ; i < button.length - 2 ; i++)
{
    button[i].addEventListener("click", buttonFunction);
}

let keyPressFunction = function(event) {
    colAt = keyPress(event, mainBalls2D, rowAt, colAt, column);
}
window.addEventListener('keydown', keyPressFunction);

let checkRowFunction = function(event) {
    let rowBefore = rowAt;

    rowAt = checkRow(event, mainBalls2D, rowAt, column, endBalls2D);
    if(rowAt == -1)
    {
        mainBalls2D[rowBefore][colAt].removeAttribute("id");
    }
    else if(rowAt != rowBefore)
    {
        mainBalls2D[rowAt - 1][colAt].removeAttribute("id");
        colAt = 0;
        mainBalls2D[rowAt][colAt].id = "selected";
    }
}
let check = document.querySelector("#check");
check.addEventListener("click", checkRowFunction);

function checkRow(event, mainBalls2D, rowAt, column, endBalls2D, colAt)
{
    const headerBalls = document.querySelectorAll(".headerBall");
    let newHeaderNames = new Array(column);
    let newMainNames = new Array(column);
    let match = new Array(column);
    let count = 0;
    let count2 = 0;

    for(let i = 0 ; i < column ; i++)
    {
        let headerName = headerBalls[i].className;
        let mainName = mainBalls2D[rowAt][i].className;
        let newHeaderName = "";
        let newMainName = "";

        for(let j = 11 ; j < headerName.length ; j++)
        {
            newHeaderName += headerName[j];
        }
        newHeaderNames[i] = newHeaderName;
        for(let j = 9 ; j < mainName.length ; j++)
        {
            newMainName += mainName[j];
        }
        newMainNames[i] = newMainName;
        if(newMainName == newHeaderName)
        {
            match[i] = true;
            count++;
        }
        else if(newMainName === "")
        {
            alert("Please fill all columns!");
            return rowAt;
        }
        else
        {
            match[i] = false;
        }
    }

    let usedColors = [];

    for(let i = 0 ; i < column ; i++)
    {
        let used = false;
        for(let j = 0 ; j < usedColors.length ; j++)
        {
            if(newMainNames[i] == usedColors[j])
            {
                used = true;
            }
        }
        
        if(match[i] == false && used == false)
        {  
            for(let j = 0 ; j < column ; j++)
            {
                if(newMainNames[i] == newHeaderNames[j] && match[j] == false)
                {
                    count2++;
                    usedColors.push(newMainNames[i]);
                }
            }
        }
    }
    for(let i = 0 ; i < count ; i++)
    {
        endBalls2D[rowAt][i].className += " red";
    }
    for(let i = count ; i < count + count2 ; i++)
    {
        endBalls2D[rowAt][i].className += " white";
    }

    if(count == column)
    {
        alert("Congratulations! You have won.");

        for(let i = 0 ; i < column ; i++)
        {
            headerBalls[i].removeAttribute("id");
        }

        let button = document.querySelectorAll("button");
        for(let i = 0 ; i < button.length - 2 ; i++)
        {
            button[i].removeEventListener("click", buttonFunction);
        }

        window.removeEventListener('keydown', keyPressFunction);
        let check = document.querySelector("#check");
        check.removeEventListener("click", checkRowFunction);

        return -1;
    }
    else if(rowAt == 9)
    {
        alert("Sorry you lost.")
        for(let i = 0 ; i < column ; i++)
        {
            headerBalls[i].removeAttribute("id");
        }

        let button = document.querySelectorAll("button");
        for(let i = 0 ; i < button.length - 2 ; i++)
        {
            button[i].removeEventListener("click", buttonFunction);
        }

        window.removeEventListener('keydown', keyPressFunction);
        let check = document.querySelector("#check");
        check.removeEventListener("click", checkRowFunction);

        return -1;
    }
    
    return ++rowAt;
}
function keyPress(event, mainBalls2D, rowAt, colAt, column)
{
    const key = event.key;

    if(key != 'a' && key != "d")
    {
        return colAt;
    }
    mainBalls2D[rowAt][colAt].removeAttribute("id");

    if(key == 'a' && colAt != 0)
    {
        colAt--;
    }
    else if(key == 'd' && colAt != column - 1)
    {
        colAt++;
    }

    mainBalls2D[rowAt][colAt].id = "selected";

    return colAt;
}
function randomizeHeader()
{
    let headerBall = document.querySelectorAll(".headerBall");
    let randomColors = new Array(column);
    let duplicate = false;

    for(let i = 0 ; i < column ; i++)
    {
        let randomColor = Math.floor(Math.random() * 8); //Random integer between 0-7
        for(let j = 0 ; j < column ; j++)
        {
            if(randomColors[j] === randomColor)
            {
                duplicate = true;
            }
        }

        while(duplicate)
        {
            randomColor = Math.floor(Math.random() * 8);
            duplicate = false;
            for(let j = 0 ; j < column ; j++)
            {
                if(randomColors[j] === randomColor)
                {
                    duplicate = true;
                }
            }
        }

        randomColors[i] = randomColor;
        headerBall[i].innerHTML = "?";
        switch(randomColor)
        {
            case 0:
                headerBall[i].className = "headerBall red";
                break;
            case 1:
                headerBall[i].className = "headerBall green";
                break;
            case 2:
                headerBall[i].className = "headerBall blue";
                break;
            case 3:
                headerBall[i].className = "headerBall yellow";
                break;
            case 4:
                headerBall[i].className = "headerBall brown";
                break;
            case 5:
                headerBall[i].className = "headerBall orange";
                break;
            case 6:
                headerBall[i].className = "headerBall black";
                break;
            case 7:
                headerBall[i].className = "headerBall white";
        }
    }
}
function convert2DArray(column, className)
{
    let mainBalls = document.querySelectorAll(className);
    let mainBalls2D = new Array(mainBalls.length / column);
    let k = mainBalls.length - 1;

    for(let i = 0 ; i < mainBalls.length / column ; i++)
    {
        mainBalls2D[i] = new Array(column);
        for(let j = column - 1 ; j >= 0 ; j--)
        {
            mainBalls2D[i][j] = mainBalls[k];
            k--;
        }
    }

    return mainBalls2D;
}
function onClick(click, mainBalls2D, column, rowAt, colAt)
{
    if (typeof onClick.counter == 'undefined') 
    {
        onClick.counter = 0;
    }
    
    let i = parseInt(onClick.counter / column);
    let j = onClick.counter % column;

    const color = click.target.value;
    mainBalls2D[rowAt][colAt].className = "mainBall " + color;

    onClick.counter++;
}
function createBoard(row, col)
{
    const table = document.querySelector("table");

    let headerRow = table.insertRow();

    for(let i = 0 ; i < col ; i++)
    {
        let headerCell = document.createElement("th");
        let headerSpan = document.createElement("span");
        
        headerSpan.id = "colorHidden";
        headerSpan.classList.add("headerBall");
        headerCell.classList.add("headerRow");
        headerCell.appendChild(headerSpan);
        headerRow.appendChild(headerCell);
    }

    for(let i = 0 ; i < row ; i++)
    {
        let newRow = table.insertRow();

        for(let j = 0 ; j <= col ; j++)
        {
            let newCell = newRow.insertCell(j);
            let newSpan = document.createElement("span");
            
            if(j != col)
            {
                newSpan.classList.add("mainBall");
            }
            else
            {
                newSpan.classList.add("endBall");
                newCell.classList.add("end");

                for(let k = 0 ; k < col - 1 ; k++)
                {
                    let newSpanCopy = newSpan.cloneNode(newSpan);
                    newCell.appendChild(newSpanCopy);
                }
            }
            newCell.appendChild(newSpan);
        }
    }

    let endCSS = document.querySelectorAll(".end");
    for(let i = 0 ; i < endCSS.length ; i++)
    {
        if(column == 4)
        {
            endCSS[i].style.width = "3em";
        }
        else if (column == 6)
        {
            endCSS[i].style.width = "4.5em";
        }
        else
        {
            endCSS[i].style.width = "6em";
        }
    }
}